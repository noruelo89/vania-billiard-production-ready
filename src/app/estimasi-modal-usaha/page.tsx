import { PageShell } from "@/components/layout/PageShell";
import { CapitalEstimatorClient } from "@/components/tools/CapitalEstimatorClient";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Estimasi Modal Usaha Billiard",
  description: "Hitung kisaran modal awal usaha billiard berdasarkan jumlah meja, tier produk, aksesoris, renovasi, dan pengiriman.",
  path: "/estimasi-modal-usaha",
});

export default function EstimasiModalUsahaPage() {
  return (
    <PageShell
      eyebrow="MVP-plus"
      title="Estimasi modal awal usaha billiard."
      description="Tool ini memberi rentang kasar untuk persiapan konsultasi. Tidak menjanjikan profit, BEP, atau hasil bisnis tertentu."
    >
      <CapitalEstimatorClient />
    </PageShell>
  );
}
