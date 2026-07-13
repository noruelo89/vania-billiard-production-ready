import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Navbar } from "@/components/layout/Navbar";
import { AccessoryCard } from "@/components/ui/AccessoryCard";
import { accessories, categoryLabels } from "@/data/accessories";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Aksesoris Billiard",
  description: "Lihat pilihan laken, stick, bola, cover, glove, chalk, tas, dan produk perawatan billiard.",
  path: "/aksesoris",
});

export default function AksesorisPage() {
  const categories = Object.entries(categoryLabels).filter(([category]) =>
    accessories.some((item) => item.category === category)
  );

  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <section className="mx-auto max-w-7xl">
          <div className="mb-10 max-w-3xl">
            <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">Aksesoris billiard</p>
            <h1 className="font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">
              Perlengkapan pendukung untuk meja rumah dan venue.
            </h1>
            <p className="mt-5 text-base leading-relaxed text-text-muted lg:text-lg">
              Aksesoris membantu perawatan, operasional venue, dan pembelian berulang. Untuk stok dan marketplace, konfirmasi lewat WhatsApp.
            </p>
          </div>
          <div className="mb-8 flex flex-wrap gap-2">
            {categories.map(([category, label]) => (
              <a key={category} href={`#${category}`} className="border border-border-subtle px-3 py-2 text-xs uppercase tracking-[0.16em] text-text-muted hover:border-copper hover:text-copper">
                {label}
              </a>
            ))}
          </div>
          <div className="space-y-14">
            {categories.map(([category, label]) => (
              <section key={category} id={category}>
                <h2 className="mb-5 font-serif text-3xl text-text">{label}</h2>
                <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                  {accessories.filter((item) => item.category === category).map((item) => (
                    <AccessoryCard key={item.id} accessory={item} />
                  ))}
                </div>
              </section>
            ))}
          </div>
        </section>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
