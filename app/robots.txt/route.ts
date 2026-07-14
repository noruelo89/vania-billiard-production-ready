const baseUrl = process.env.NEXT_PUBLIC_SITE_URL || 'https://vania-billiard-website-rouge.vercel.app';

export async function GET() {
  return new Response(`User-agent: *
Allow: /
Disallow: /admin
Disallow: /api

Sitemap: ${baseUrl}/sitemap.xml
`, { headers: { 'content-type': 'text/plain; charset=utf-8' } });
}
