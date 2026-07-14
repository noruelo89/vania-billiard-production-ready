import { redirect } from 'next/navigation';
import { isAdminAuthenticated } from '../../../../lib/admin-auth';
import { prisma } from '../../../../lib/db-products';

function csvEscape(value: unknown) {
  const text = value == null ? '' : String(value);
  return `"${text.replace(/"/g, '""')}"`;
}

export async function GET() {
  if (!(await isAdminAuthenticated())) redirect('/admin/login');
  const leads = await prisma.lead.findMany({ orderBy: { createdAt: 'desc' } });
  const headers = ['id', 'name', 'whatsapp', 'city', 'productInterest', 'type', 'status', 'source', 'message', 'createdAt'];
  const rows = leads.map(lead => headers.map(key => csvEscape((lead as unknown as Record<string, unknown>)[key])).join(','));
  return new Response([headers.join(','), ...rows].join('\n'), {
    headers: {
      'content-type': 'text/csv; charset=utf-8',
      'content-disposition': 'attachment; filename="vania-leads.csv"',
    },
  });
}
