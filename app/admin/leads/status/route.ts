import { LeadStatus } from '@prisma/client';
import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../../lib/admin-auth';
import { prisma } from '../../../../lib/db-products';

export async function POST(request: Request) {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const form = await request.formData();
  const id = Number(form.get('id') || 0);
  const status = String(form.get('status') || 'NEW') as LeadStatus;
  if (id) await prisma.lead.update({ where: { id }, data: { status } }).catch(() => null);
  redirect('/admin/leads');
}
