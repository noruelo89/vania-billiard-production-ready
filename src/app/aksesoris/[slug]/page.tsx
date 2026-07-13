import { notFound } from "next/navigation";
import { Footer } from "@/components/layout/Footer";
import { FloatingWA } from "@/components/layout/FloatingWA";
import { MobileStickyCTA } from "@/components/layout/MobileStickyCTA";
import { Navbar } from "@/components/layout/Navbar";
import { Button } from "@/components/ui/Button";
import { AccessoryCard } from "@/components/ui/AccessoryCard";
import { accessories, categoryLabels } from "@/data/accessories";
import { formatRupiah } from "@/data/products";
import { buildPageMetadata } from "@/lib/seo";
import { waAccessoriesLink } from "@/lib/whatsapp";

interface AccessoryPageProps {
  params: Promise<{ slug: string }>;
}

export function generateStaticParams() {
  return accessories.map((item) => ({ slug: item.slug }));
}

export async function generateMetadata({ params }: AccessoryPageProps) {
  const { slug } = await params;
  const accessory = accessories.find((item) => item.slug === slug);
  if (!accessory) return {};
  return buildPageMetadata({
    title: accessory.name,
    description: `${accessory.name} - ${accessory.shortDescription}`,
    path: `/aksesoris/${accessory.slug}`,
  });
}

export default async function AccessoryDetailPage({ params }: AccessoryPageProps) {
  const { slug } = await params;
  const accessory = accessories.find((item) => item.slug === slug);
  if (!accessory) notFound();
  const related = accessories.filter((item) => item.slug !== accessory.slug && item.category === accessory.category).slice(0, 3);

  return (
    <>
      <Navbar />
      <main className="bg-bg px-5 pb-24 pt-32 lg:px-8 lg:pt-40">
        <article className="mx-auto max-w-7xl">
          <section className="grid gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
            <div className="border border-border-subtle bg-surface p-8">
              <p className="font-mono text-[11px] uppercase tracking-[0.25em] text-copper">
                {categoryLabels[accessory.category]}
              </p>
              <h1 className="mt-4 font-serif text-4xl font-medium leading-tight text-text lg:text-6xl">{accessory.name}</h1>
              <p className="mt-5 text-lg leading-relaxed text-text-muted">{accessory.shortDescription}</p>
              <p className="mt-7 font-serif text-4xl font-semibold text-copper">
                {accessory.price ? formatRupiah(accessory.price) : "Tanya WhatsApp"}
              </p>
              <p className="mt-2 text-sm text-text-muted">{accessory.priceNote} · Stok: {accessory.stockStatus}</p>
              <div className="mt-7 flex flex-col gap-3 sm:flex-row">
                <Button href={waAccessoriesLink(accessory.name)} external variant="whatsapp">Tanya Stok</Button>
                <Button href="/aksesoris" variant="secondary">Kembali ke Aksesoris</Button>
              </div>
            </div>
            <div className="border border-border-subtle bg-surface p-6">
              <h2 className="font-serif text-3xl text-text">Poin produk</h2>
              <ul className="mt-5 space-y-3 text-sm text-text-muted">
                {accessory.highlights.map((item) => <li key={item}>- {item}</li>)}
              </ul>
              <p className="mt-6 text-sm leading-relaxed text-text-muted">
                Detail stok, warna, ukuran, dan link marketplace perlu dikonfirmasi karena dapat berubah sewaktu-waktu.
              </p>
            </div>
          </section>
          {related.length ? (
            <section className="mt-16">
              <h2 className="mb-6 font-serif text-3xl text-text">Produk terkait</h2>
              <div className="grid gap-5 md:grid-cols-2 lg:grid-cols-3">
                {related.map((item) => <AccessoryCard key={item.id} accessory={item} />)}
              </div>
            </section>
          ) : null}
        </article>
      </main>
      <Footer />
      <MobileStickyCTA />
      <FloatingWA />
    </>
  );
}
