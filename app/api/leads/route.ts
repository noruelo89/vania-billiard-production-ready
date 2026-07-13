import { NextResponse } from 'next/server';

const leads: Array<Record<string, string>> = [];

export async function POST(request: Request) {
  const form = await request.formData();
  const lead = Object.fromEntries([...form.entries()].map(([key, value]) => [key, String(value)]));
  leads.push({ ...lead, createdAt: new Date().toISOString() });
  const accept = request.headers.get('accept') || '';
  if (accept.includes('text/html')) {
    return new Response(`<!doctype html><script>alert('Terima kasih! Permintaan Anda telah kami terima. Tim kami akan segera menghubungi via WhatsApp.'); window.location.href = '/';</script>`, { headers: { 'content-type': 'text/html; charset=utf-8' } });
  }
  return NextResponse.json({ ok: true, lead });
}

export function GET() {
  return NextResponse.json({ leads });
}
