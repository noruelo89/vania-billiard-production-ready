import type { Category, Lead, Product } from '@prisma/client';

export function escapeHtml(input: string) {
  return input.replace(/[&<>'"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[c]!));
}

export function rupiah(value: number) {
  return new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 }).format(value);
}

export function adminShell(content: string, title = 'Admin | Vania Billiard') {
  return `<!DOCTYPE html>
<html lang="id" class="dark">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>${escapeHtml(title)}</title>
  <link rel="icon" type="image/png" href="/assets/images/logo_vb.png">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,800;1,400&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sans:['Inter','sans-serif'],serif:['Playfair Display','serif']},colors:{'luxury-bg':'#0a0a0a','luxury-surface':'#141414','luxury-copper':'#C86A36'}}}}</script>
</head>
<body class="bg-luxury-bg text-gray-100 font-sans min-h-screen selection:bg-luxury-copper selection:text-white">
  <nav class="sticky top-0 z-50 bg-[#0a0a0a]/90 backdrop-blur-xl border-b border-gray-800 px-6 md:px-10 py-5 flex items-center justify-between">
    <a href="/admin" class="flex items-center gap-3"><img src="/assets/images/logo_vb.png" class="h-9 w-auto" alt="Vania"><span class="font-serif text-xl tracking-[0.2em] uppercase">Vania Admin</span></a>
    <div class="flex items-center gap-5 text-[10px] uppercase tracking-[0.2em] font-bold"><a class="text-luxury-copper" href="/admin">Dashboard</a><a class="hover:text-luxury-copper" href="/admin/products">Produk</a><a class="hover:text-luxury-copper" href="/admin/leads">Leads</a><a class="hover:text-luxury-copper" href="/katalog">Website</a><form method="post" action="/admin/logout"><button class="hover:text-luxury-copper">Logout</button></form></div>
  </nav>
  ${content}
</body>
</html>`;
}

export function loginPage(error = '') {
  return `<!DOCTYPE html><html lang="id" class="dark"><head><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1.0"><title>Login Admin | Vania Billiard</title><link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Playfair+Display:wght@600&display=swap" rel="stylesheet"><script src="https://cdn.tailwindcss.com"></script><script>tailwind.config={theme:{extend:{fontFamily:{sans:['Inter','sans-serif'],serif:['Playfair Display','serif']},colors:{'luxury-bg':'#0a0a0a','luxury-surface':'#141414','luxury-copper':'#C86A36'}}}}</script></head><body class="min-h-screen bg-luxury-bg text-white flex items-center justify-center p-6"><form method="post" action="/admin/login" class="w-full max-w-md bg-luxury-surface border border-gray-800 p-8"><p class="text-luxury-copper text-xs uppercase tracking-[0.4em] mb-4">Restricted Area</p><h1 class="font-serif text-4xl mb-6">Admin Login</h1>${error ? `<p class="bg-red-950/40 border border-red-900 text-red-200 text-sm p-3 mb-4">${escapeHtml(error)}</p>` : ''}<label class="block text-xs uppercase tracking-widest text-gray-500 mb-2">Password</label><input type="password" name="password" class="w-full bg-black border border-gray-700 p-4 mb-6 outline-none focus:border-luxury-copper" required autofocus><button class="w-full bg-luxury-copper text-white uppercase tracking-[0.2em] text-xs font-bold py-4">Masuk Admin</button></form></body></html>`;
}

export type ProductWithCategory = Product & { category?: Category | null };
export type LeadRow = Lead;
