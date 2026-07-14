import { redirect } from 'next/navigation';
import { setAdminSession, verifyAdminPassword } from '../../../lib/admin-auth';
import { loginPage } from '../../../lib/admin-ui';

export async function GET() {
  return new Response(loginPage(), { headers: { 'content-type': 'text/html; charset=utf-8' } });
}

export async function POST(request: Request) {
  const form = await request.formData();
  const password = String(form.get('password') || '');
  if (!verifyAdminPassword(password)) {
    return new Response(loginPage('Password admin salah.'), { status: 401, headers: { 'content-type': 'text/html; charset=utf-8' } });
  }
  await setAdminSession();
  redirect('/admin');
}
