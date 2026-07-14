import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../../lib/admin-auth';
import { prisma } from '../../../../lib/db-products';

export async function POST(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const form = await request.formData();
  const id = Number(form.get('id') || 0);
  const name = String(form.get('name') || '').trim();
  const price = Number(form.get('price') || 0);
  const description = String(form.get('description') || '').trim();
  const image = String(form.get('image') || 'placeholder-product.svg').trim() || 'placeholder-product.svg';
  const categoryId = Number(form.get('categoryId') || 0);
  if (id && name && price && description && categoryId) {
    await prisma.product.update({
      where: { id },
      data: { name, price, description, image, categoryId, isFeatured: form.has('isFeatured') },
    }).catch(() => null);
  }
  redirect('/admin/products');
}
