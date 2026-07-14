const baseUrl = process.env.NEXT_PUBLIC_SITE_URL || 'https://vania-billiard-website-rouge.vercel.app';

const routes = ['', '/katalog', '/simulator', '/jurnal', '/profil', '/b2b'];

export async function GET() {
  const now = new Date().toISOString();
  const body = `<?xml version="1.0" encoding="UTF-8"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
${routes.map(path => `  <url><loc>${baseUrl}${path}</loc><lastmod>${now}</lastmod><changefreq>weekly</changefreq><priority>${path === '' ? '1.0' : '0.8'}</priority></url>`).join('\n')}
</urlset>`;
  return new Response(body, { headers: { 'content-type': 'application/xml; charset=utf-8' } });
}
