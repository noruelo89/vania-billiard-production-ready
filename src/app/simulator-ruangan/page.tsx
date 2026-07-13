import { Navbar } from "@/components/layout/Navbar";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { RoomSimulatorClient } from "@/components/tools/RoomSimulatorClient";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Simulator Ruangan Meja Billiard",
  description:
    "Cek kebutuhan ruang untuk meja billiard 7ft, 8ft, atau 9ft sebelum konsultasi dan membeli.",
  path: "/simulator-ruangan",
});

export default function SimulatorRuanganPage() {
  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <section className="mx-auto max-w-7xl">
          <div className="mb-10 max-w-3xl">
            <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">Simulator ruangan</p>
            <h1 className="font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">
              Cek apakah ruangan cocok untuk meja billiard.
            </h1>
            <p className="mt-5 text-base leading-relaxed text-text-muted lg:text-lg">
              Masukkan ukuran ruangan dan ukuran meja. Hasil ini hanya rekomendasi awal sebelum layout final, pengiriman, dan pemasangan dikonfirmasi.
            </p>
          </div>
          <RoomSimulatorClient />
        </section>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
