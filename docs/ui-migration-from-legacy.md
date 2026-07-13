# UI Migration from Legacy Vania UI/UX

Dokumen ini menetapkan repo legacy `elnoru09/vania-billiard-uiux` sebagai visual baseline untuk redesign pass Next.js.

## Keputusan

- Production codebase tetap repo Next.js saat ini.
- Legacy PHP UI dipakai sebagai visual master, bukan dipakai mentah-mentah.
- Implementasi harus tetap patuh PRD v3.1: decision platform, 70% meja, 30% aksesoris, lead capture, dan WhatsApp handoff.

## Bahasa Visual Baru

Nama arah desain: **Premium Billiard Decision Atelier**.

Karakter:

- Dark showroom, bukan dark SaaS.
- Editorial catalog, bukan marketplace murah.
- Planning instrument, bukan form biasa.
- Felt texture, table-rail lines, cue trajectory dots, measurement ticks.
- Copper/brass dipakai terbatas untuk decision points dan CTA.
- Section mengalir seperti walkthrough showroom: entry, diagnosis, tools, product curation, proof, education, consultation.

## Prinsip Anti Generic AI

- Hindari card grid yang sama terus menerus.
- Hindari decorative icon tile di atas heading.
- Hindari headline italic serif sebagai gimmick utama.
- Hindari angka/testimoni palsu.
- Hindari efek live activity, geolocation banner, quiz modal, atau counter animasi.
- Gunakan copy konkret: ruang, ukuran meja, clearance, jumlah meja, pengiriman, pemasangan, lead ID.

## Mapping Legacy ke Next.js

| Legacy Pattern | Next.js Translation | Status |
|---|---|---|
| Split editorial hero | `Hero` dengan copy kiri, image atelier kanan, hotspot, planning slip | Implement first pass |
| Trust/product ticker | `TrustTicker` sebagai runway transition setelah hero | Existing, keep |
| Katalog kurator | Product cards sebagai collection sheet, bukan marketplace | Next pass |
| Simulator planner | Tool cards dan simulator memakai grid/ruler/clearance motif | Existing, improve later |
| Jurnal kurator | Article hub sebagai editorial knowledge base | Existing, improve later |
| VIP consultation | Consultation CTA tetap berbasis PRD dan WhatsApp lead | Existing, keep |

## Section Flow Homepage

1. **Hero Atelier Entry**: positioning, CTA, proof slip, hotspot.
2. **Ticker Runway**: ritme pendek, bukan klaim palsu.
3. **Decision Paths**: empat jalur kebutuhan dalam layout asymmetric showroom.
4. **Measurement Slip**: quick assessment sebagai form instrument.
5. **Tool Bench**: simulator, table-count, capital estimator.
6. **Curated Tables**: produk meja sebagai fokus utama.
7. **Trust and Proof**: proses, pengiriman, pemasangan.
8. **Accessories Support**: 30% support commerce.
9. **Editorial Guides**: artikel decision support.
10. **Consultation Close**: WhatsApp + lead-ready framing.

## Verification Gates

Setiap redesign pass wajib:

```text
npm run lint
npm run typecheck
npm run test
NEXT_TELEMETRY_DISABLED=1 npm run build
```

Untuk visual pass besar, tambahkan screenshot QA desktop dan mobile bila waktu memungkinkan.
