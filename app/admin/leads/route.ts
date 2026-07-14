import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../lib/admin-auth';
import { adminShell, escapeHtml } from '../../../lib/admin-ui';
import { prisma } from '../../../lib/db-products';

export const dynamic = 'force-dynamic';

const statuses = ['NEW', 'CONTACTED', 'QUALIFIED', 'CLOSED', 'LOST'] as const;
type LeadStatus = (typeof statuses)[number];
type LeadRow = Awaited<ReturnType<typeof prisma.lead.findMany>>[number];
type SourceRow = { source: string };

function whatsappLink(phone: string, name: string, interest?: string | null) {
  const number = phone.replace(/\D/g, '').replace(/^0/, '62');
  const text = encodeURIComponent(`Halo ${name}, saya dari Vania Billiard. Saya mau follow up minat ${interest || 'konsultasi'} Anda.`);
  return `https://wa.me/${number}?text=${text}`;
}

export async function GET(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');

  const url = new URL(request.url);
  const status = url.searchParams.get('status') as LeadStatus | null;
  const source = url.searchParams.get('source') || '';
  const q = url.searchParams.get('q') || '';

  const where = {
    ...(status && statuses.includes(status as (typeof statuses)[number]) ? { status } : {}),
    ...(source ? { source } : {}),
    ...(q ? { OR: [
      { name: { contains: q, mode: 'insensitive' as const } },
      { whatsapp: { contains: q, mode: 'insensitive' as const } },
      { city: { contains: q, mode: 'insensitive' as const } },
      { productInterest: { contains: q, mode: 'insensitive' as const } },
    ] } : {}),
  };

  const [leads, sources] = await Promise.all([
    prisma.lead.findMany({ where, orderBy: { createdAt: 'desc' }, take: 150 }),
    prisma.lead.findMany({ select: { source: true }, distinct: ['source'], orderBy: { source: 'asc' } }),
  ]);

  const rows = leads.map((lead: LeadRow) => {
    const wa = whatsappLink(lead.whatsapp, lead.name, lead.productInterest);
    return `<tr class="border-b border-gray-800 align-top">
      <td class="py-4 pr-4"><p class="font-serif text-xl">${escapeHtml(lead.name)}</p><p class="text-xs text-gray-500 mt-1">${lead.createdAt.toLocaleString('id-ID')}</p><p class="text-[10px] uppercase tracking-widest text-luxury-copper mt-2">${escapeHtml(lead.source)}</p></td>
      <td class="py-4 pr-4 text-sm text-gray-300">${escapeHtml(lead.whatsapp)}${lead.city ? '<br>'+escapeHtml(lead.city) : ''}<br><a target="_blank" rel="noreferrer" href="${wa}" class="text-luxury-copper text-xs uppercase tracking-widest">WhatsApp</a></td>
      <td class="py-4 pr-4 text-sm text-gray-300 max-w-xs"><strong>${escapeHtml(lead.productInterest || 'Konsultasi')}</strong>${lead.message ? '<p class="text-gray-500 mt-2 whitespace-pre-wrap">'+escapeHtml(lead.message)+'</p>' : ''}</td>
      <td class="py-4 pr-4"><form method="post" action="/admin/leads/status" class="space-y-2"><input type="hidden" name="id" value="${lead.id}"><select name="status" class="bg-black border border-gray-700 p-2 text-xs w-full">${statuses.map(item => `<option value="${item}" ${lead.status === item ? 'selected' : ''}>${item}</option>`).join('')}</select><textarea name="notes" placeholder="Catatan follow-up lokal (belum disimpan)" class="bg-black border border-gray-700 p-2 text-xs w-full min-w-48"></textarea><button class="text-luxury-copper text-xs uppercase tracking-widest">Simpan</button></form></td>
      <td class="py-4"><form method="post" action="/admin/leads/delete" onsubmit="return confirm('Hapus lead ini?')"><input type="hidden" name="id" value="${lead.id}"><button class="text-red-300 text-xs uppercase tracking-widest hover:text-red-200">Hapus</button></form></td>
    </tr>`;
  }).join('');

  const statusOptions = [''].concat([...statuses]).map(item => `<option value="${item}" ${status === item ? 'selected' : ''}>${item || 'Semua status'}</option>`).join('');
  const sourceOptions = [''].concat((sources as SourceRow[]).map((item: SourceRow) => item.source)).map((item: string) => `<option value="${escapeHtml(item)}" ${source === item ? 'selected' : ''}>${escapeHtml(item || 'Semua source')}</option>`).join('');
  const content = `<main class="px-6 md:px-10 py-10 max-w-7xl mx-auto"><div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-8"><div><p class="text-luxury-copper text-xs uppercase tracking-[0.4em] mb-3">Sales Pipeline</p><h1 class="font-serif text-5xl">Leads.</h1></div><div class="flex gap-4"><a href="/admin/leads/export" class="text-xs uppercase tracking-widest text-luxury-copper">Export CSV</a><a href="/admin" class="text-xs uppercase tracking-widest text-gray-400 hover:text-luxury-copper">Dashboard</a></div></div><form class="bg-luxury-surface border border-gray-800 p-4 mb-6 grid md:grid-cols-4 gap-3"><input name="q" value="${escapeHtml(q)}" placeholder="Cari nama/WA/kota/minat" class="bg-black border border-gray-700 p-3 text-sm"><select name="status" class="bg-black border border-gray-700 p-3 text-sm">${statusOptions}</select><select name="source" class="bg-black border border-gray-700 p-3 text-sm">${sourceOptions}</select><button class="bg-luxury-copper text-white uppercase tracking-widest text-xs">Filter</button></form><section class="bg-luxury-surface border border-gray-800 p-6 overflow-x-auto"><table class="w-full text-left"><thead class="text-[10px] uppercase tracking-[0.3em] text-gray-500"><tr><th class="pb-4 pr-4">Nama</th><th class="pb-4 pr-4">Kontak</th><th class="pb-4 pr-4">Minat</th><th class="pb-4 pr-4">Status & Notes</th><th class="pb-4">Action</th></tr></thead><tbody>${rows || '<tr><td colspan="5" class="py-10 text-gray-500">Belum ada lead.</td></tr>'}</tbody></table></section></main>`;
  return new Response(adminShell(content, 'Leads Admin | Vania Billiard'), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}
