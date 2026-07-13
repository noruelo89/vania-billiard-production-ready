# UI/UX Reference Audit

Audit singkat untuk polish visual Vania Billiard agar terasa lebih intentional dan tidak generic.

## Referensi yang Diaudit

- Internal legacy reference: `https://github.com/elnoru09/vania-billiard-uiux`
- `https://kaching.id/`
- `https://carabaobilliards.com/`
- `https://branapparel.com/`

## Aspek yang Diambil

### Legacy Vania UI/UX

- Split hero editorial: copy kuat di kiri, gambar atmosfer di kanan.
- Hotspot pada gambar produk/showroom untuk memberi rasa premium dan interaktif tanpa carousel berat.
- Ticker/marquee trust strip setelah hero.
- Tipografi serif besar dengan aksen italic/copper.
- Kartu hover dengan copper glow yang halus.
- Tool page terasa seperti planner, bukan form biasa.

### Kaching

- Floating micro-cards sebagai proof widgets, bukan paragraf panjang.
- Dashboard/product-like panel untuk menjelaskan nilai tools.
- Soft glow dan dotted/grid background untuk memberi kesan sistem/perhitungan.
- Headline besar dengan highlighted phrase.

### Carabao Billiards

- Sports-brand energy: section divider tegas, uppercase labels, dark cinematic imagery.
- Kombinasi store + news + ecosystem, relevan untuk katalog, artikel, dan galeri Vania.
- Product/category strip yang terasa seperti brand discovery.
- Diagonal cue-line motif sebagai pengganti bentuk marketplace biasa.

### Bran Apparel

- Cinematic hero, high-contrast CTA hierarchy, floating contact access.
- Icon-led benefits dan stat row sebagai trust signal cepat.
- Strong accent color system, tetapi untuk Vania tetap copper/black agar tidak meniru merah Bran.

## Prinsip Adaptasi untuk Vania

1. Tetap patuh PRD: premium dark billiard showroom + decision tools + consultation funnel.
2. Tidak meniru warna/brand referensi mentah-mentah.
3. Tidak menambah dependency/motion berat.
4. Hindari klaim palsu: proof cards harus berupa proses, tools, dan disclaimer, bukan angka fabricated.
5. Fokus visual 70:30 tetap ke meja billiard, accessories hanya pendukung.

## Implementasi Saat Ini

- Hero dipoles dengan highlighted phrase, layered proof widgets, hotspot image, dan decision panel.
- Ditambah trust ticker `TrustTicker` setelah hero untuk memberi ritme sports/editorial.
- Global CSS mendapat utility texture: felt/grid/dot/cue-line/diagonal-divider/card-luxury.
- Need selector dan tools cards dipoles dengan nomor vertikal, icon mark, dan background texture.

## Deferred

- Full draggable room planner ala legacy simulator belum diambil karena akan memperbesar scope dan risiko bug.
- Live streaming / event CTA ala Carabao tidak diambil karena belum ada event/live stream resmi.
- Light SaaS palette Kaching tidak diambil karena tidak sesuai PRD dark showroom.
- Carousel Bran tidak diambil karena PRD melarang hero carousel dan performa harus ringan.
