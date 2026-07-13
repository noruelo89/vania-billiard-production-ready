import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Syarat & Ketentuan",
  description: "Informasi harga, stok, spesifikasi, pengiriman, dan pemasangan dapat berubah dan perlu dikonfirmasi sebelum transaksi.",
  path: "/syarat-ketentuan",
});

export default function Page() {
  return (
    <PageShell eyebrow="Syarat & Ketentuan" title="Ketentuan penggunaan website dan informasi produk." description="Informasi harga, stok, spesifikasi, pengiriman, dan pemasangan dapat berubah dan perlu dikonfirmasi sebelum transaksi.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Harga memakai konteks mulai dari</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Tidak ada klaim profit atau BEP terjamin</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Layout final dan quotation melalui konsultasi</li>
      </div>
    </PageShell>
  );
}
