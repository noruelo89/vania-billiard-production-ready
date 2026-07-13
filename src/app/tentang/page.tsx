import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Tentang Vania",
  description: "Vania membantu calon pembeli memahami ukuran, kebutuhan ruang, pilihan produk, aksesoris, pengiriman, dan pemasangan sebelum mengambil keputusan.",
  path: "/tentang",
});

export default function Page() {
  return (
    <PageShell eyebrow="Tentang Vania" title="Partner konsultasi sebelum membeli meja billiard." description="Vania membantu calon pembeli memahami ukuran, kebutuhan ruang, pilihan produk, aksesoris, pengiriman, dan pemasangan sebelum mengambil keputusan.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Fokus pada konsultasi dan edukasi</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">70% mesin penjualan meja, 30% aksesoris</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Tidak menggunakan klaim yang belum terverifikasi</li>
      </div>
    </PageShell>
  );
}
