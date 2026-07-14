import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../../lib/admin-auth';
import { prisma } from '../../../../lib/db-products';

const statuses = ['NEW', 'CONTACTED', 'QUALIFIED', 'CLOSED', 'LOST'];

export async function POST(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const form = await request.formData();
  const id = Number(form.get('id') || 0);
  const status = String(form.get('status') || 'NEW');
  if (id && statuses.includes(status)) {
    await prisma.lead.update({ where: { id }, data: { status: status as never } }).catch(() => null);
  }
  redirect('/admin/leads');
}
