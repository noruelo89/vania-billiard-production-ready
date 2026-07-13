import { Button } from "@/components/ui/Button";
import { Reveal } from "@/components/ui/Reveal";
import { SectionHeading } from "@/components/ui/SectionHeading";

const needs = [
  {
    title: "Meja untuk rumah",
    description: "Cek ukuran ruangan, pilihan 7ft/8ft/9ft, dan produk yang aman untuk ruang keluarga.",
    href: "/untuk-rumah",
    cta: "Konsultasi Rumah",
  },
  {
    title: "Buka usaha billiard",
    description: "Hitung jumlah meja, kebutuhan ruang, perlengkapan awal, dan alur konsultasi quotation.",
    href: "/untuk-usaha",
    cta: "Rencana Usaha",
  },
  {
    title: "Tambah meja venue",
    description: "Siapkan kebutuhan komersial, pengiriman multi-unit, renovasi, dan maintenance.",
    href: "/buka-usaha-billiard",
    cta: "Untuk Venue",
  },
  {
    title: "Cari aksesoris",
    description: "Tanya stok laken, stick, bola, cover, glove, lampu, dan kebutuhan perawatan.",
    href: "/aksesoris",
    cta: "Lihat Aksesoris",
  },
];

export function NeedSelector() {
  return (
    <section className="bg-bg px-5 py-20 lg:px-8 lg:py-28">
      <div className="mx-auto max-w-7xl">
        <SectionHeading
          eyebrow="Pilih kebutuhan"
          title="Mulai dari situasi yang paling dekat dengan rencana Anda."
          subtitle="Setiap jalur diarahkan ke panduan, tools, produk, dan konsultasi yang relevan."
        />
        <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-4">
          {needs.map((need, index) => (
            <Reveal key={need.title} delay={index * 90}>
              <article className="group flex h-full flex-col border border-border-subtle bg-surface p-5 transition-all duration-300 hover:-translate-y-1 hover:border-copper/50 hover:shadow-2xl hover:shadow-copper/10">
                <p className="mb-5 font-mono text-xs text-copper">0{index + 1}</p>
                <h3 className="font-serif text-2xl font-semibold text-text">{need.title}</h3>
                <p className="mt-3 flex-1 text-sm leading-relaxed text-text-muted">{need.description}</p>
                <Button href={need.href} variant="ghost" size="sm" className="mt-6 justify-start px-0 text-copper">
                  {need.cta}
                </Button>
              </article>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
