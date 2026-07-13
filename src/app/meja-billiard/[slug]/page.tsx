import { notFound } from "next/navigation";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Navbar } from "@/components/layout/Navbar";
import { Button } from "@/components/ui/Button";
import { ProductCard } from "@/components/ui/ProductCard";
import { formatRupiah, products } from "@/data/products";
import { buildPageMetadata } from "@/lib/seo";
import { waTableLink } from "@/lib/whatsapp";

interface ProductPageProps {
  params: Promise<{ slug: string }>;
}

export function generateStaticParams() {
  return products.map((product) => ({ slug: product.slug }));
}

export async function generateMetadata({ params }: ProductPageProps) {
  const { slug } = await params;
  const product = products.find((item) => item.slug === slug);
  if (!product) return {};
  return buildPageMetadata({
    title: product.name,
    description: `${product.name} - ${product.tagline} Harga ${product.priceNote.toLowerCase()}. Konsultasikan ukuran, ruangan, pengiriman, dan pemasangan.`,
    path: `/meja-billiard/${product.slug}`,
  });
}

export default async function ProductDetailPage({ params }: ProductPageProps) {
  const { slug } = await params;
  const product = products.find((item) => item.slug === slug);
  if (!product) notFound();

  const related = products.filter((item) => item.slug !== product.slug).slice(0, 3);

  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <article className="mx-auto max-w-7xl">
          <section className="grid gap-10 lg:grid-cols-[1.05fr_0.95fr] lg:items-start">
            <div className="overflow-hidden border border-border-subtle bg-surface">
              <img
                src={`/images/products/${product.slug}.jpg`}
                alt={`Meja billiard ${product.name}`}
                className="aspect-[4/3] w-full object-cover"
              />
            </div>
            <div>
              <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">
                {product.series === "abimanyu" ? "Abimanyu Series" : product.series === "custom" ? "Custom request" : "Standard Series"}
              </p>
              <h1 className="font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">{product.name}</h1>
              <p className="mt-5 text-lg leading-relaxed text-text-muted">{product.tagline}</p>
              <div className="mt-7 border-y border-border-subtle py-6">
                <p className="font-mono text-xs uppercase tracking-[0.18em] text-text-muted">
                  {product.startingPrice ? "Harga mulai dari" : "Harga"}
                </p>
                <p className="mt-2 font-serif text-4xl font-semibold text-copper">
                  {product.startingPrice ? formatRupiah(product.startingPrice) : "Hubungi WhatsApp"}
                </p>
                <p className="mt-3 text-sm leading-relaxed text-text-muted">
                  Harga dapat menyesuaikan ukuran, material, laken, aksesoris, pengiriman, pemasangan, dan custom request.
                </p>
              </div>
              <p className="mt-6 text-base leading-relaxed text-text-muted">{product.positioning}</p>
              <div className="mt-7 flex flex-col gap-3 sm:flex-row">
                <Button href={waTableLink(product.name)} external variant="whatsapp">
                  Konsultasi Produk Ini
                </Button>
                <Button href="/simulator-ruangan" variant="secondary">
                  Cek Ukuran Ruangan
                </Button>
              </div>
            </div>
          </section>

          <section className="mt-16 grid gap-6 lg:grid-cols-3">
            <div className="border border-border-subtle bg-surface p-6">
              <h2 className="font-serif text-3xl text-text">Cocok untuk</h2>
              <ul className="mt-5 space-y-3 text-sm text-text-muted">
                {product.highlights.map((item) => <li key={item}>- {item}</li>)}
              </ul>
            </div>
            <div className="border border-border-subtle bg-surface p-6">
              <h2 className="font-serif text-3xl text-text">Ukuran</h2>
              <p className="mt-5 text-sm leading-relaxed text-text-muted">
                Tersedia pilihan {product.sizes.join(", ")}. Kebutuhan ruang sebaiknya dicek lewat simulator sebelum konsultasi final.
              </p>
            </div>
            <div className="border border-border-subtle bg-surface p-6">
              <h2 className="font-serif text-3xl text-text">Custom options</h2>
              <p className="mt-5 text-sm leading-relaxed text-text-muted">
                Warna laken, finishing, paket aksesoris, pengiriman, dan pemasangan dikonfirmasi melalui WhatsApp berdasarkan kebutuhan dan kota.
              </p>
            </div>
          </section>

          <section className="mt-10 border border-copper/30 bg-copper/10 p-6">
            <h2 className="font-serif text-3xl text-text">Catatan spesifikasi</h2>
            <p className="mt-3 text-sm leading-relaxed text-text-muted">
              Detail spesifikasi teknis belum dipublikasikan sebagai klaim final. Tim Vania perlu memverifikasi material, laken, slate, paket included items, dan garansi sebelum digunakan untuk quotation.
            </p>
          </section>

          <section className="mt-16">
            <h2 className="mb-6 font-serif text-3xl text-text">Pilihan lain yang bisa dibandingkan</h2>
            <div className="grid gap-6 lg:grid-cols-3">
              {related.map((item) => <ProductCard key={item.id} product={item} variant="compact" />)}
            </div>
          </section>
        </article>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
