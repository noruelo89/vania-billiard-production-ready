import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Untuk Rumah",
  description: "Mulai dari ukuran ruangan, pilihan 7ft/8ft/9ft, budget, desain, dan kebutuhan pemasangan.",
  path: "/untuk-rumah",
});

export default function Page() {
  return (
    <PageShell eyebrow="Untuk Rumah" title="Rencanakan meja billiard yang cocok untuk ruangan rumah." description="Mulai dari ukuran ruangan, pilihan 7ft/8ft/9ft, budget, desain, dan kebutuhan pemasangan.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Cek ukuran ruangan lewat simulator</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Pilih produk sesuai ruang dan budget</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Konsultasikan pengiriman dan pemasangan</li>
      </div>
    </PageShell>
  );
}
