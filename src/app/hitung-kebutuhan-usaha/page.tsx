import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { TableCountEstimatorClient } from "@/components/tools/TableCountEstimatorClient";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Hitung Kebutuhan Usaha Billiard",
  description:
    "Estimasi jumlah meja billiard yang bisa ditempatkan untuk rencana usaha, cafe, venue, atau ruang komersial.",
  path: "/hitung-kebutuhan-usaha",
});

export default function HitungKebutuhanUsahaPage() {
  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <section className="mx-auto max-w-7xl">
          <div className="mb-10 max-w-3xl">
            <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">Estimator usaha</p>
            <h1 className="font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">
              Estimasi jumlah meja untuk rencana usaha billiard.
            </h1>
            <p className="mt-5 text-base leading-relaxed text-text-muted lg:text-lg">
              Hitung kapasitas awal berdasarkan dimensi ruangan, ukuran meja, sirkulasi, dan area pendukung. Hasil ini bukan layout final atau jaminan kapasitas.
            </p>
          </div>
          <TableCountEstimatorClient />
        </section>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
