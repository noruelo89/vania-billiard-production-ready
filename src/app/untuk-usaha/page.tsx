import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Untuk Usaha",
  description: "Hitung kapasitas ruang, jumlah meja, perlengkapan awal, dan kebutuhan quotation sebelum membuka venue.",
  path: "/untuk-usaha",
});

export default function Page() {
  return (
    <PageShell eyebrow="Untuk Usaha" title="Rencanakan kebutuhan meja untuk usaha billiard." description="Hitung kapasitas ruang, jumlah meja, perlengkapan awal, dan kebutuhan quotation sebelum membuka venue.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Estimasi jumlah meja</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Kebutuhan aksesoris venue</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Quotation formal melalui konsultasi</li>
      </div>
    </PageShell>
  );
}
