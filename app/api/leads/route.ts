import { NextResponse } from 'next/server';
import { prisma } from '../../../lib/db-products';
import { isAdminAuthenticated } from '../../../lib/admin-auth';
import { notifyNewLead } from '../../../lib/lead-notifications';
import { clientIp, isRateLimited } from '../../../lib/rate-limit';

const fallbackLeads: Array<Record<string, unknown>> = [];

function firstValue(form: FormData, keys: string[]) {
  for (const key of keys) {
    const value = form.get(key);
    if (typeof value === 'string' && value.trim()) return value.trim();
  }
  return '';
}

function htmlThanks() {
  return new Response(
    `<!doctype html><script>alert('Terima kasih! Permintaan Anda telah kami terima. Tim kami akan segera menghubungi via WhatsApp.'); window.location.href = '/';</script>`,
    { headers: { 'content-type': 'text/html; charset=utf-8' } },
  );
}

export async function POST(request: Request) {
  const accept = request.headers.get('accept') || '';
  const ip = clientIp(request);
  if (isRateLimited(`lead:${ip}`, 6, 10 * 60 * 1000)) {
    if (accept.includes('text/html')) return htmlThanks();
    return NextResponse.json({ ok: false, error: 'Terlalu banyak request. Coba lagi sebentar.' }, { status: 429 });
  }

  const form = await request.formData();
  const rawLead = Object.fromEntries([...form.entries()].map(([key, value]) => [key, String(value)]));
  const honeypot = firstValue(form, ['website', 'url', 'company_site']);
  if (honeypot) {
    if (accept.includes('text/html')) return htmlThanks();
    return NextResponse.json({ ok: true, skipped: true });
  }

  const lead = {
    name: firstValue(form, ['nama', 'name', 'nama_pelanggan']) || 'Tanpa Nama',
    whatsapp: firstValue(form, ['nomor_wa', 'whatsapp', 'wa', 'phone']) || '-',
    city: firstValue(form, ['kota', 'city', 'lokasi']) || null,
    productInterest: firstValue(form, ['minat_produk', 'productInterest', 'produk']) || null,
    type: firstValue(form, ['tipe', 'type']).toLowerCase().includes('b2b') ? 'B2B' as const : 'RESIDENTIAL' as const,
    businessName: firstValue(form, ['nama_bisnis', 'businessName', 'company']) || null,
    quantity: firstValue(form, ['jumlah', 'quantity', 'qty']) || null,
    message: firstValue(form, ['pesan', 'message', 'catatan']) || null,
    source: firstValue(form, ['source']) || 'website',
  };

  try {
    if (process.env.DATABASE_URL) {
      const saved = await prisma.lead.create({ data: lead });
      await notifyNewLead(saved);
      if (accept.includes('text/html')) return htmlThanks();
      return NextResponse.json({ ok: true, lead: saved });
    }
  } catch (error) {
    console.warn('Lead database save failed, using in-memory fallback:', error);
  }

  const fallbackLead = { ...rawLead, ...lead, createdAt: new Date().toISOString() };
  fallbackLeads.push(fallbackLead);
  await notifyNewLead(fallbackLead);
  if (accept.includes('text/html')) return htmlThanks();
  return NextResponse.json({ ok: true, lead });
}

export async function GET() {
  if (!(await isAdminAuthenticated())) {
    return NextResponse.json({ error: 'Unauthorized' }, { status: 401 });
  }
  if (process.env.DATABASE_URL) {
    try {
      const leads = await prisma.lead.findMany({ orderBy: { createdAt: 'desc' }, take: 50 });
      return NextResponse.json({ leads });
    } catch (error) {
      console.warn('Lead database read failed, using in-memory fallback:', error);
    }
  }
  return NextResponse.json({ leads: fallbackLeads });
}
