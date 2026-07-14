import fs from 'node:fs';
import path from 'node:path';
import { products as fallbackProducts, rupiah, type Product } from './legacy-data';

const root = process.cwd();

function productCard(product: Product, index = 0, variant: 'home' | 'catalog' = 'catalog') {
  if (variant === 'home') {
    const direction = index % 2 === 0 ? 'md:flex-row' : 'md:flex-row-reverse';
    const colorButtons = product.nama_kategori.toLowerCase().includes('meja') ? `
      <div class="flex items-center justify-center gap-3 mt-6" data-aos="fade-up">
        <span class="text-[10px] uppercase tracking-widest text-gray-500 mr-2">Varian Laken:</span>
        <button onclick="changeColor('img-${product.id}', 0)" class="w-5 h-5 rounded-full bg-[#1E3A8A] border-2 border-transparent color-dot active" title="Tournament Blue"></button>
        <button onclick="changeColor('img-${product.id}', 90)" class="w-5 h-5 rounded-full bg-[#065F46] border-2 border-transparent color-dot" title="Classic Green"></button>
        <button onclick="changeColor('img-${product.id}', -30)" class="w-5 h-5 rounded-full bg-[#991B1B] border-2 border-transparent color-dot" title="Burgundy Red"></button>
      </div>` : '';
    return `
    <div class="flex flex-col ${direction} items-center gap-10 md:gap-16 group">
      <div class="w-full md:w-1/2">
        <a href="/detail?id=${product.id}" class="block w-full aspect-[4/3] bg-gray-100 dark:bg-luxury-surface relative cursor-pointer editorial-img-container overflow-hidden shadow-lg hover:-translate-y-2 hover:shadow-[0_20px_40px_rgba(200,106,54,0.15)] transition-all duration-700 ease-out" data-aos="fade-up">
          <img id="img-${product.id}" src="/assets/images/${product.gambar}" alt="${escapeHtml(product.nama_produk)}" loading="lazy" class="w-full h-full object-cover editorial-img opacity-90 hover:opacity-100 transition-all duration-500">
        </a>
        ${colorButtons}
      </div>
      <div class="w-full md:w-1/2 transition-all duration-500" data-aos="fade-up" data-aos-delay="100">
        <div class="flex items-center gap-3 mb-4">
          <span class="text-[10px] uppercase tracking-[0.2em] text-gray-500 border border-gray-300 dark:border-gray-700 px-2 py-1">${escapeHtml(product.nama_kategori)}</span>
          <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-copper border border-luxury-copper px-2 py-1">${escapeHtml(product.tipe_pengiriman)}</span>
        </div>
        <a href="/detail?id=${product.id}"><h4 class="font-serif text-3xl text-gray-900 dark:text-white mb-6 group-hover:text-luxury-copper transition-colors">${escapeHtml(product.nama_produk)}</h4></a>
        <p class="font-light text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8 max-w-md">${escapeHtml(product.deskripsi).slice(0, 120)}...</p>
        <p class="text-luxury-copper font-serif italic text-xl mb-6">${rupiah(product.harga)}</p>
        <div class="flex flex-wrap gap-4 relative z-20">
          <a href="/detail?id=${product.id}" class="inline-flex items-center text-xs uppercase tracking-widest font-bold text-white border border-luxury-copper bg-luxury-copper px-6 py-3 hover:bg-[#b05929] hover:-translate-y-1 hover:shadow-lg transition-all duration-300">Lihat Detail & Specs</a>
          <a href="#pesan" class="inline-flex items-center text-xs uppercase tracking-widest font-bold text-gray-900 dark:text-white border border-gray-300 dark:border-gray-700 px-6 py-3 hover:border-luxury-copper hover:text-luxury-copper transition-all duration-300">Konsultasi WA</a>
        </div>
      </div>
    </div>`;
  }
  return `
  <a href="/detail?id=${product.id}" class="group flex flex-col hover-card-effect p-4 -m-4 rounded-lg transition-all duration-300" data-aos="fade-up" data-aos-delay="${(index % 3) * 100}">
    <div class="w-full aspect-[4/3] bg-gray-200 dark:bg-luxury-surface mb-6 overflow-hidden border border-gray-200 dark:border-gray-800 relative">
      <img src="/assets/images/${product.gambar}" alt="${escapeHtml(product.nama_produk)}" loading="lazy" class="w-full h-full object-cover editorial-img opacity-90 transition-all duration-700">
      <div class="absolute top-4 left-4 bg-black/60 backdrop-blur text-white text-[10px] uppercase tracking-widest px-3 py-1 border border-white/10">${escapeHtml(product.nama_kategori)}</div>
    </div>
    <div class="flex items-center gap-3 mb-4">
      <span class="text-[10px] uppercase tracking-[0.2em] text-luxury-copper">${escapeHtml(product.tipe_pengiriman)}</span>
    </div>
    <h3 class="font-serif text-2xl md:text-3xl text-gray-900 dark:text-white mb-4 group-hover:text-luxury-copper transition-colors">${escapeHtml(product.nama_produk)}</h3>
    <p class="text-sm text-gray-500 dark:text-gray-400 leading-relaxed mb-6">${escapeHtml(product.deskripsi).slice(0, 150)}...</p>
    <p class="text-luxury-copper font-serif italic text-lg mt-auto">${rupiah(product.harga)}</p>
  </a>`;
}

function escapeHtml(input: string) {
  return input.replace(/[&<>'"]/g, c => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', "'": '&#039;', '"': '&quot;' }[c]!));
}

function stripPhp(html: string) {
  return html.replace(/<\?php[\s\S]*?\?>/g, '').replace(/<\?=[\s\S]*?\?>/g, '');
}

function common(html: string) {
  return html
    .replaceAll('assets/images/', '/assets/images/')
    .replaceAll('href="index.php"', 'href="/"')
    .replaceAll('href="index.php#pesan"', 'href="/#pesan"')
    .replaceAll('href="katalog.php"', 'href="/katalog"')
    .replaceAll('href="simulator.php"', 'href="/simulator"')
    .replaceAll('href="jurnal.php"', 'href="/jurnal"')
    .replaceAll('href="profil.php"', 'href="/profil"')
    .replaceAll('href="b2b.php"', 'href="/b2b"')
    .replaceAll('href="index-tech.php"', 'href="/index-tech"')
    .replaceAll('action="submit_lead.php"', 'action="/api/leads"')
    .replaceAll('src="lang.js"', 'src="/lang.js"')
    .replaceAll("src='lang.js'", "src='/lang.js'")
    .replace(/detail\.php\?id=/g, '/detail?id=');
}

function replaceProductLoop(html: string, file: string, products: Product[], count?: number) {
  const cards = products
    .slice(0, count)
    .map((product, index) => productCard(product, index, file === 'index.php' ? 'home' : 'catalog'))
    .join('\n');
  const options = products
    .map(product => `<option value="${escapeHtml(product.nama_produk)}" class="bg-white dark:bg-luxury-surface text-gray-900 dark:text-white">Tertarik pada: ${escapeHtml(product.nama_produk)}</option>`)
    .join('\n');
  return html
    .replace(/<\?php\s+foreach \(\$products as \$index => \$product\): \?>[\s\S]*?<\?php\s+endforeach;\s+\?>/g, cards)
    .replace(/<\?php\s+foreach \(\$products as \$product\): \?>[\s\S]*?<\?php\s+endforeach;\s+\?>/g, options);
}

export function renderLegacyPage(file: string, products: Product[] = fallbackProducts) {
  let html = fs.readFileSync(path.join(root, 'legacy-source', file), 'utf8');
  html = replaceProductLoop(html, file, products, file === 'index.php' ? 4 : undefined);
  html = stripPhp(html);
  html = common(html);
  if (file === 'simulator.php') html = enhanceSimulatorLeadFlow(html);
  return html;
}

function enhanceSimulatorLeadFlow(html: string) {
  const leadPanel = `<div class="mt-4 p-4 border border-luxury-copper/30 bg-luxury-copper/10 rounded">
                        <p class="text-[9px] uppercase tracking-widest mb-3 text-luxury-copper font-bold">Kirim Layout ke Konsultan</p>
                        <form id="sim-lead-form" class="space-y-2">
                            <input name="nama" required placeholder="Nama" class="w-full text-xs p-2 bg-white dark:bg-[#111] border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white">
                            <input name="nomor_wa" required placeholder="Nomor WhatsApp" class="w-full text-xs p-2 bg-white dark:bg-[#111] border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white">
                            <input name="kota" placeholder="Kota" class="w-full text-xs p-2 bg-white dark:bg-[#111] border border-gray-300 dark:border-gray-700 text-gray-900 dark:text-white">
                            <input type="hidden" name="source" value="simulator">
                            <input type="hidden" name="minat_produk" value="Room Planner Simulator">
                            <textarea name="pesan" id="sim-lead-summary" class="hidden"></textarea>
                            <button class="w-full bg-luxury-copper text-white text-[10px] font-bold uppercase tracking-widest py-2 hover:bg-[#b05929] transition-all">Kirim Layout</button>
                            <p id="sim-lead-status" class="text-[10px] text-gray-500"></p>
                        </form>
                    </div>`;
  html = html.replace('</div>\n                </div>\n            </div>\n        </aside>', `${leadPanel}\n                </div>\n                </div>\n            </div>\n        </aside>`);
  return html.replace('</script>', `
        function collectSimulatorSummary() {
            const roomW = document.getElementById('room-width')?.value || '-';
            const roomH = document.getElementById('room-height')?.value || '-';
            const inv = document.getElementById('inv-count')?.innerText || '0 Unit';
            const price = document.getElementById('live-price')?.innerText || 'Rp 0';
            const objects = [...document.querySelectorAll('.sim-object')].map((el, index) => {
                const label = el.querySelector('.label-text')?.innerText || el.innerText.trim().split('\\n')[0] || 'Objek';
                return (index + 1) + '. ' + label + ' @ ' + Math.round(parseFloat(el.style.left || '0')) + ',' + Math.round(parseFloat(el.style.top || '0'));
            }).join(' | ');
            return 'Simulator layout: Ruang ' + roomW + 'm x ' + roomH + 'm. Inventory ' + inv + '. Estimasi ' + price + '. Objek: ' + (objects || 'Belum ada objek.');
        }
        document.addEventListener('submit', async function(event) {
            if (event.target?.id !== 'sim-lead-form') return;
            event.preventDefault();
            const status = document.getElementById('sim-lead-status');
            const summary = document.getElementById('sim-lead-summary');
            summary.value = collectSimulatorSummary();
            status.textContent = 'Mengirim layout...';
            const response = await fetch('/api/leads', { method: 'POST', body: new FormData(event.target) });
            status.textContent = response.ok ? 'Layout terkirim. Tim Vania akan follow up.' : 'Gagal mengirim layout, coba lagi.';
            if (response.ok) event.target.reset();
        });
    </script>`);
}

export function renderDetail(product: Product) {
  let html = fs.readFileSync(path.join(root, 'legacy-source', 'detail.php'), 'utf8');
  html = html.replace(/<title>[\s\S]*?<\/title>/, `<title>${escapeHtml(product.nama_produk)} | Vania Billiard</title>`);
  html = html.replace(/<meta name="description"[\s\S]*?>/, `<meta name="description" content="${escapeHtml(product.deskripsi.slice(0, 150))}...">`);
  html = stripPhp(html);
  html = common(html);
  html = html.replace(/Mahakarya tidak ditemukan\./g, escapeHtml(product.nama_produk));
  html = html.replace(/src=""/g, `src="/assets/images/${product.gambar}"`);
  html = html.replace(/alt=""/g, `alt="${escapeHtml(product.nama_produk)}"`);
  html = html.replace(/Rp\s*0|IDR\s*0/g, rupiah(product.harga));
  html = html.replace(/<h1([^>]*)>\s*<\/h1>/, `<h1$1>${escapeHtml(product.nama_produk)}</h1>`);
  return html;
}

export function htmlResponse(html: string) {
  return new Response(html, { headers: { 'content-type': 'text/html; charset=utf-8' } });
}
