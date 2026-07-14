import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../lib/admin-auth';
import { adminShell, escapeHtml, rupiah } from '../../../lib/admin-ui';
import { prisma } from '../../../lib/db-products';

export const dynamic = 'force-dynamic';

function slugify(value: string) {
  return value.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '') || 'produk';
}

async function ensureCategory(name: string, shippingType: string) {
  const slug = slugify(name);
  return prisma.category.upsert({
    where: { slug },
    update: { name, shippingType },
    create: { name, slug, shippingType },
  });
}

function fieldClass() {
  return 'bg-black border border-gray-700 p-3 outline-none focus:border-luxury-copper text-sm';
}

export async function GET() {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const [products, categories] = await Promise.all([
    prisma.product.findMany({ include: { category: true }, orderBy: { id: 'desc' } }),
    prisma.category.findMany({ orderBy: { name: 'asc' } }),
  ]);

  const categoryOptions = (selectedId?: number) => categories.map(category => `<option value="${category.id}" ${selectedId === category.id ? 'selected' : ''}>${escapeHtml(category.name)} / ${escapeHtml(category.shippingType)}</option>`).join('');
  const rows = products.map(product => `<details class="border border-gray-800 bg-black/25 p-5 mb-4"><summary class="cursor-pointer flex flex-col md:flex-row md:items-center gap-4"><img src="/assets/images/${escapeHtml(product.image)}" class="w-28 h-20 object-cover bg-black" alt=""><span class="flex-1"><span class="block font-serif text-2xl">${escapeHtml(product.name)}</span><span class="block text-xs text-gray-500 mt-1">${escapeHtml(product.slug)} / ${escapeHtml(product.category?.name || '-')}</span></span><span class="text-luxury-copper">${rupiah(product.price)}</span></summary><form method="post" action="/admin/products/update" class="grid md:grid-cols-2 gap-3 mt-6"><input type="hidden" name="id" value="${product.id}"><input name="name" value="${escapeHtml(product.name)}" required class="${fieldClass()}"><input name="price" type="number" value="${product.price}" required class="${fieldClass()}"><input name="image" value="${escapeHtml(product.image)}" class="${fieldClass()}"><select name="categoryId" class="${fieldClass()}">${categoryOptions(product.categoryId)}</select><textarea name="description" required class="md:col-span-2 ${fieldClass()}">${escapeHtml(product.description)}</textarea><label class="text-sm text-gray-400 flex items-center gap-3"><input type="checkbox" name="isFeatured" ${product.isFeatured ? 'checked' : ''}> Featured</label><div class="flex justify-end gap-4"><button class="text-luxury-copper text-xs uppercase tracking-widest">Update Produk</button></div></form><form method="post" action="/admin/products/delete" onsubmit="return confirm('Hapus produk ini?')" class="mt-3"><input type="hidden" name="id" value="${product.id}"><button class="text-red-300 text-xs uppercase tracking-widest hover:text-red-200">Hapus Produk</button></form></details>`).join('');

  const content = `<main class="px-6 md:px-10 py-10 max-w-7xl mx-auto"><div class="flex flex-col md:flex-row md:items-end md:justify-between gap-6 mb-10"><div><p class="text-luxury-copper text-xs uppercase tracking-[0.4em] mb-3">Catalog Control</p><h1 class="font-serif text-5xl">Produk.</h1></div><a href="/admin" class="text-xs uppercase tracking-widest text-gray-400 hover:text-luxury-copper">Kembali Dashboard</a></div>
  <section class="bg-luxury-surface border border-gray-800 p-6 mb-10"><h2 class="font-serif text-2xl mb-6">Tambah Produk</h2><form method="post" action="/admin/products" class="grid md:grid-cols-2 gap-4"><input name="name" placeholder="Nama produk" required class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><input name="price" type="number" placeholder="Harga" required class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><input name="image" value="placeholder-product.svg" placeholder="Nama file gambar di /assets/images" class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><select name="categoryId" class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><option value="">Pakai kategori baru</option>${categoryOptions()}</select><input name="categoryName" placeholder="Kategori baru (opsional)" class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><input name="shippingType" placeholder="Tipe pengiriman" value="Paket Aman" class="bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"><textarea name="description" placeholder="Deskripsi" required class="md:col-span-2 bg-black border border-gray-700 p-4 outline-none focus:border-luxury-copper"></textarea><label class="text-sm text-gray-400 flex items-center gap-3"><input type="checkbox" name="isFeatured" checked> Featured</label><button class="md:col-span-2 bg-luxury-copper text-white uppercase tracking-[0.2em] text-xs font-bold py-4">Simpan Produk</button></form></section>
  <section>${rows || '<div class="bg-luxury-surface border border-gray-800 p-8 text-gray-500">Belum ada produk.</div>'}</section></main>`;
  return new Response(adminShell(content, 'Produk Admin | Vania Billiard'), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}

export async function POST(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const form = await request.formData();
  const name = String(form.get('name') || '').trim();
  const price = Number(form.get('price') || 0);
  const description = String(form.get('description') || '').trim();
  const image = String(form.get('image') || 'placeholder-product.svg').trim() || 'placeholder-product.svg';
  const existingCategoryId = Number(form.get('categoryId') || 0);
  const categoryName = String(form.get('categoryName') || '').trim();
  const shippingType = String(form.get('shippingType') || 'Paket Aman').trim();
  if (!name || !price || !description) redirect('/admin/products');

  const category = existingCategoryId ? await prisma.category.findUnique({ where: { id: existingCategoryId } }) : await ensureCategory(categoryName || 'Produk', shippingType);
  if (!category) redirect('/admin/products');

  const baseSlug = slugify(name);
  const slug = `${baseSlug}-${Date.now().toString(36)}`;
  await prisma.product.create({ data: { name, slug, description, price, image, isFeatured: form.has('isFeatured'), categoryId: category.id } });
  redirect('/admin/products');
}
