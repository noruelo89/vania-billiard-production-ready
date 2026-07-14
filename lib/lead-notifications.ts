type LeadNotification = {
  id?: number;
  name: string;
  whatsapp: string;
  city?: string | null;
  productInterest?: string | null;
  type?: string;
  businessName?: string | null;
  quantity?: string | null;
  message?: string | null;
  source?: string;
  createdAt?: Date | string;
};

function formatLead(lead: LeadNotification) {
  const lines = [
    'Lead baru Vania Billiard',
    `Nama: ${lead.name}`,
    `WhatsApp: ${lead.whatsapp}`,
    lead.city ? `Kota: ${lead.city}` : '',
    lead.productInterest ? `Minat: ${lead.productInterest}` : '',
    lead.type ? `Tipe: ${lead.type}` : '',
    lead.businessName ? `Bisnis: ${lead.businessName}` : '',
    lead.quantity ? `Qty: ${lead.quantity}` : '',
    lead.source ? `Source: ${lead.source}` : '',
    lead.message ? `Pesan: ${lead.message}` : '',
  ];
  return lines.filter(Boolean).join('\n');
}

async function postJson(url: string, body: unknown) {
  const response = await fetch(url, {
    method: 'POST',
    headers: { 'content-type': 'application/json' },
    body: JSON.stringify(body),
  });
  if (!response.ok) throw new Error(`Notification webhook failed: ${response.status}`);
}

export async function notifyNewLead(lead: LeadNotification) {
  const text = formatLead(lead);
  const jobs: Array<Promise<void>> = [];

  if (process.env.LEAD_NOTIFICATION_WEBHOOK_URL) {
    jobs.push(postJson(process.env.LEAD_NOTIFICATION_WEBHOOK_URL, { text, lead }));
  }

  if (process.env.DISCORD_WEBHOOK_URL) {
    jobs.push(postJson(process.env.DISCORD_WEBHOOK_URL, { content: text }));
  }

  if (process.env.TELEGRAM_BOT_TOKEN && process.env.TELEGRAM_CHAT_ID) {
    const url = `https://api.telegram.org/bot${process.env.TELEGRAM_BOT_TOKEN}/sendMessage`;
    jobs.push(postJson(url, { chat_id: process.env.TELEGRAM_CHAT_ID, text }));
  }

  if (!jobs.length) return;
  const results = await Promise.allSettled(jobs);
  for (const result of results) {
    if (result.status === 'rejected') console.warn('Lead notification failed:', result.reason);
  }
}
