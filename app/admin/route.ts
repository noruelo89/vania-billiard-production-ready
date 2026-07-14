import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../lib/admin-auth';
import { adminShell, escapeHtml, rupiah } from '../../lib/admin-ui';
import { prisma } from '../../lib/db-products';

export const dynamic = 'force-dynamic';

export async function GET() {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');

  if (!process.env.DATABASE_URL) {
    return new Response(adminShell('<main class="p-10"><h1 class="font-serif text-4xl mb-4">Database belum aktif.</h1><p class="text-gray-400">Set DATABASE_URL dulu untuk mengaktifkan admin.</p></main>'), { headers: { 'content-type': 'text/html; charset=utf-8' } });
  }

  const [products, leads, categories] = await Promise.all([
    prisma.product.findMany({ include: { category: true }, orderBy: { id: 'desc' } }),
    prisma.lead.findMany({ orderBy: { createdAt: 'desc' }, take: 25 }),
    prisma.category.findMany({ orderBy: { name: 'asc' } }),
  ]);

  const content = `<main class="px-6 md:px-10 py-10 max-w-7xl mx-auto">
    <section class="mb-12">
      <p class="text-luxury-copper text-xs uppercase tracking-[0.4em] mb-3">Production Control</p>
      <h1 class="font-serif text-4xl md:text-6xl mb-4">Dashboard Kurator.</h1>
      <p class="text-gray-400 max-w-2xl">Panel awal untuk monitoring produk dan leads. CRUD produk dan lead management sudah tersedia.</p>
    </section>
    <section class="grid md:grid-cols-3 gap-5 mb-12">
      <a href="/admin/products" class="bg-luxury-surface border border-gray-800 p-7 hover:border-luxury-copper transition"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Produk</p><p class="font-serif text-5xl text-white">${products.length}</p></a>
      <div class="bg-luxury-surface border border-gray-800 p-7"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Kategori</p><p class="font-serif text-5xl text-white">${categories.length}</p></div>
      <a href="/admin/leads" class="bg-luxury-surface border border-gray-800 p-7 hover:border-luxury-copper transition"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Leads</p><p class="font-serif text-5xl text-luxury-copper">${leads.length}</p></a>
    </section>
    <section class="grid lg:grid-cols-2 gap-8">
      <div class="bg-luxury-surface border border-gray-800 overflow-hidden"><div class="p-6 border-b border-gray-800 flex justify-between items-center"><h2 class="font-serif text-2xl">Produk Database</h2><a href="/admin/products" class="text-luxury-copper text-xs uppercase tracking-widest">Kelola</a></div><div class="divide-y divide-gray-800">${products.map(product => `<div class="p-5 flex gap-4 items-center"><img src="/assets/images/${escapeHtml(product.image)}" class="w-20 h-16 object-cover bg-black" alt=""><div class="flex-1"><h3 class="font-serif text-xl">${escapeHtml(product.name)}</h3><p class="text-xs text-gray-500 uppercase tracking-widest">${escapeHtml(product.category?.name || '-')} / ${escapeHtml(product.category?.shippingType || '-')}</p></div><p class="text-luxury-copper text-sm">${rupiah(product.price)}</p></div>`).join('')}</div></div>
      <div class="bg-luxury-surface border border-gray-800 overflow-hidden"><div class="p-6 border-b border-gray-800 flex justify-between items-center"><h2 class="font-serif text-2xl">Lead Terbaru</h2><a href="/admin/leads" class="text-luxury-copper text-xs uppercase tracking-widest">Kelola</a></div><div class="divide-y divide-gray-800">${leads.length ? leads.map(lead => `<div class="p-5"><div class="flex justify-between gap-4"><h3 class="font-serif text-xl">${escapeHtml(lead.name)}</h3><span class="text-[10px] uppercase tracking-widest text-luxury-copper">${escapeHtml(lead.status)}</span></div><p class="text-sm text-gray-400 mt-1">${escapeHtml(lead.whatsapp)}${lead.city ? ' / '+escapeHtml(lead.city) : ''}</p><p class="text-xs text-gray-500 mt-2">${escapeHtml(lead.productInterest || 'Konsultasi')}</p></div>`).join('') : '<div class="p-6 text-gray-500">Belum ada lead.</div>'}</div></div>
    </section>
  </main>`;

  return new Response(adminShell(content), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}
