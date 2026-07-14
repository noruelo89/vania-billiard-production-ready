import { prisma } from '../../lib/db-products';

export const dynamic = 'force-dynamic';

function escapeHtml(input: string) {
  return input.replace(/[&<>'"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[c]!));
}

function rupiah(value: number) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
}

function adminShell(content: string) {
  return `<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin | Vania Billiard</title>
  <link rel="icon" type="image/png" href="/assets/images/logo_vb.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sans:['Inter','sans-serif'],serif:['Playfair Display','serif']},colors:{'luxury-bg':'#0a0a0a','luxury-surface':'#141414','luxury-copper':'#C86A36'}}}}</script>
</head>
<body class="bg-luxury-bg text-gray-100 font-sans min-h-screen selection:bg-luxury-copper selection:text-white">
  <nav class="sticky top-0 z-50 bg-[#0a0a0a]/90 backdrop-blur-xl border-b border-gray-800 px-6 md:px-10 py-5 flex items-center justify-between">
    <a href="/" class="flex items-center gap-3"><img src="/assets/images/logo_vb.png" class="h-9 w-auto" alt="Vania"><span class="font-serif text-xl tracking-[0.2em] uppercase">Vania Admin</span></a>
    <div class="flex items-center gap-5 text-[10px] uppercase tracking-[0.2em] font-bold"><a class="text-luxury-copper" href="/admin">Dashboard</a><a class="hover:text-luxury-copper" href="/katalog">Katalog</a><a class="hover:text-luxury-copper" href="/api/leads">API Leads</a></div>
  </nav>
  ${content}
</body>
</html>`;
}

export async function GET() {
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
      <p class="text-gray-400 max-w-2xl">Panel awal untuk monitoring produk dan leads. CRUD lengkap bisa dibangun di phase berikutnya setelah struktur data final.</p>
    </section>

    <section class="grid md:grid-cols-3 gap-5 mb-12">
      <div class="bg-luxury-surface border border-gray-800 p-7"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Produk</p><p class="font-serif text-5xl text-white">${products.length}</p></div>
      <div class="bg-luxury-surface border border-gray-800 p-7"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Kategori</p><p class="font-serif text-5xl text-white">${categories.length}</p></div>
      <div class="bg-luxury-surface border border-gray-800 p-7"><p class="text-[10px] uppercase tracking-[0.3em] text-gray-500 mb-3">Leads</p><p class="font-serif text-5xl text-luxury-copper">${leads.length}</p></div>
    </section>

    <section class="grid lg:grid-cols-2 gap-8">
      <div class="bg-luxury-surface border border-gray-800 overflow-hidden">
        <div class="p-6 border-b border-gray-800"><h2 class="font-serif text-2xl">Produk Database</h2></div>
        <div class="divide-y divide-gray-800">${products.map(product => `<div class="p-5 flex gap-4 items-center"><img src="/assets/images/${escapeHtml(product.image)}" class="w-20 h-16 object-cover bg-black" alt=""><div class="flex-1"><h3 class="font-serif text-xl">${escapeHtml(product.name)}</h3><p class="text-xs text-gray-500 uppercase tracking-widest">${escapeHtml(product.category?.name || '-')} / ${escapeHtml(product.category?.shippingType || '-')}</p></div><p class="text-luxury-copper text-sm">${rupiah(product.price)}</p></div>`).join('')}</div>
      </div>

      <div class="bg-luxury-surface border border-gray-800 overflow-hidden">
        <div class="p-6 border-b border-gray-800"><h2 class="font-serif text-2xl">Lead Terbaru</h2></div>
        <div class="divide-y divide-gray-800">${leads.length ? leads.map(lead => `<div class="p-5"><div class="flex justify-between gap-4"><h3 class="font-serif text-xl">${escapeHtml(lead.name)}</h3><span class="text-[10px] uppercase tracking-widest text-luxury-copper">${escapeHtml(lead.status)}</span></div><p class="text-sm text-gray-400 mt-1">${escapeHtml(lead.whatsapp)}${lead.city ? ' / '+escapeHtml(lead.city) : ''}</p><p class="text-xs text-gray-500 mt-2">${escapeHtml(lead.productInterest || 'Konsultasi')}</p></div>`).join('') : '<div class="p-6 text-gray-500">Belum ada lead.</div>'}</div>
      </div>
    </section>
  </main>`;

  return new Response(adminShell(content), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}
