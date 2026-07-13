import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Navbar } from "@/components/layout/Navbar";
import { TableCatalogClient } from "@/components/catalog/TableCatalogClient";
import { products } from "@/data/products";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Katalog Meja Billiard",
  description:
    "Lihat pilihan meja billiard Vania mulai dari 7ft, 8ft, Abimanyu Series, Prime, Phantom, sampai custom request.",
  path: "/meja-billiard",
});

export default function MejaBilliardPage() {
  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <section className="mx-auto max-w-7xl">
          <div className="mb-10 max-w-3xl">
            <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">Katalog meja</p>
            <h1 className="font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">
              Pilihan meja billiard untuk rumah, venue, dan usaha.
            </h1>
            <p className="mt-5 text-base leading-relaxed text-text-muted lg:text-lg">
              Harga menggunakan konteks mulai dari. Spesifikasi final, pengiriman, pemasangan, dan custom request tetap dikonfirmasi lewat konsultasi.
            </p>
          </div>
          <TableCatalogClient products={products} />
        </section>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
