import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../lib/admin-auth';
import { adminShell, escapeHtml } from '../../../lib/admin-ui';
import { prisma } from '../../../lib/db-products';

export const dynamic = 'force-dynamic';

const statuses = ['NEW', 'CONTACTED', 'QUALIFIED', 'CLOSED', 'LOST'];

export async function GET() {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const leads = await prisma.lead.findMany({ orderBy: { createdAt: 'desc' }, take: 100 });
  const rows = leads.map(lead => `<tr class="border-b border-gray-800 align-top"><td class="py-4 pr-4"><p class="font-serif text-xl">${escapeHtml(lead.name)}</p><p class="text-xs text-gray-500 mt-1">${lead.createdAt.toLocaleString('id-ID')}</p></td><td class="py-4 pr-4 text-sm text-gray-300">${escapeHtml(lead.whatsapp)}${lead.city ? '<br>'+escapeHtml(lead.city) : ''}</td><td class="py-4 pr-4 text-sm text-gray-300">${escapeHtml(lead.productInterest || 'Konsultasi')}</td><td class="py-4 pr-4"><form method="post" action="/admin/leads/status" class="flex gap-2"><input type="hidden" name="id" value="${lead.id}"><select name="status" class="bg-black border border-gray-700 p-2 text-xs">${statuses.map(status => `<option value="${status}" ${lead.status === status ? 'selected' : ''}>${status}</option>`).join('')}</select><button class="text-luxury-copper text-xs uppercase tracking-widest">Update</button></form></td><td class="py-4"><form method="post" action="/admin/leads/delete" onsubmit="return confirm('Hapus lead ini?')"><input type="hidden" name="id" value="${lead.id}"><button class="text-red-300 text-xs uppercase tracking-widest hover:text-red-200">Hapus</button></form></td></tr>`).join('');
  const content = `<main class="px-6 md:px-10 py-10 max-w-7xl mx-auto"><div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10"><div><p class="text-luxury-copper text-xs uppercase tracking-[0.4em] mb-3">Sales Pipeline</p><h1 class="font-serif text-5xl">Leads.</h1></div><div class="flex gap-4"><a href="/admin/leads/export" class="text-xs uppercase tracking-widest text-luxury-copper">Export CSV</a><a href="/api/leads" class="text-xs uppercase tracking-widest text-luxury-copper">JSON</a><a href="/admin" class="text-xs uppercase tracking-widest text-gray-400 hover:text-luxury-copper">Dashboard</a></div></div><section class="bg-luxury-surface border border-gray-800 p-6 overflow-x-auto"><table class="w-full text-left"><thead class="text-[10px] uppercase tracking-[0.3em] text-gray-500"><tr><th class="pb-4 pr-4">Nama</th><th class="pb-4 pr-4">Kontak</th><th class="pb-4 pr-4">Minat</th><th class="pb-4 pr-4">Status</th><th class="pb-4">Action</th></tr></thead><tbody>${rows || '<tr><td colspan="5" class="py-10 text-gray-500">Belum ada lead.</td></tr>'}</tbody></table></section></main>`;
  return new Response(adminShell(content, 'Leads Admin | Vania Billiard'), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}
