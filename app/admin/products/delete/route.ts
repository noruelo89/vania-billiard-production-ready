import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../../lib/admin-auth';
import { prisma } from '../../../../lib/db-products';

export async function POST(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const form = await request.formData();
  const id = Number(form.get('id') || 0);
  if (id) await prisma.product.delete({ where: { id } }).catch(() => null);
  redirect('/admin/products');
}
