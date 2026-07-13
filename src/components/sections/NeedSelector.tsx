import { Button } from "@/components/ui/Button";
import { Reveal } from "@/components/ui/Reveal";

const needs = [
  {
    title: "Meja untuk rumah",
    description: "Mulai dari ukuran ruang keluarga, jarak ayunan stik, pilihan 7ft/8ft/9ft, dan produk yang aman untuk penggunaan rumah.",
    href: "/untuk-rumah",
    cta: "Jalur Rumah",
    mark: "Home room",
  },
  {
    title: "Buka usaha billiard",
    description: "Rancang jumlah meja, sirkulasi pemain, area pendukung, perlengkapan awal, dan kebutuhan quotation.",
    href: "/untuk-usaha",
    cta: "Jalur Usaha",
    mark: "Venue plan",
  },
  {
    title: "Tambah meja venue",
    description: "Siapkan kebutuhan komersial, pengiriman multi-unit, renovasi ringan, laken, dan maintenance rutin.",
    href: "/buka-usaha-billiard",
    cta: "Jalur Venue",
    mark: "Expansion",
  },
  {
    title: "Cari aksesoris",
    description: "Tanya stok laken, stick, bola, cover, glove, lampu, microfiber, dan produk perawatan.",
    href: "/aksesoris",
    cta: "Jalur Aksesoris",
    mark: "Support kit",
  },
];

export function NeedSelector() {
  return (
    <section className="section-flow relative overflow-hidden bg-bg px-5 py-20 lg:px-8 lg:py-28">
      <div className="pointer-events-none absolute inset-0 dot-matrix opacity-15" />
      <div className="relative mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.72fr_1.28fr] lg:items-end">
        <Reveal>
          <div className="lg:sticky lg:top-28">
            <p className="font-mono text-[10px] uppercase tracking-[0.24em] text-copper">Pilih kebutuhan</p>
            <h2 className="mt-5 max-w-xl font-serif text-4xl leading-tight text-text md:text-5xl">
              Empat pintu masuk, satu alur konsultasi yang rapi.
            </h2>
            <p className="mt-5 max-w-lg text-base leading-8 text-text-muted">
              Pilih situasi yang paling dekat dengan rencana lo. Setiap jalur diarahkan ke panduan, tools, produk, dan WhatsApp yang relevan.
            </p>
          </div>
        </Reveal>

        <div className="grid gap-4 md:grid-cols-2">
          {needs.map((need, index) => (
            <Reveal key={need.title} delay={index * 90}>
              <article className="rail-card group flex min-h-[260px] flex-col justify-between p-6 transition-all duration-300 hover:-translate-y-1 hover:border-copper/45 hover:shadow-2xl hover:shadow-copper/10">
                <div>
                  <div className="mb-8 flex items-center justify-between gap-5">
                    <p className="font-mono text-[10px] uppercase tracking-[0.2em] text-copper">{need.mark}</p>
                    <span className="h-px flex-1 bg-gradient-to-r from-copper/40 to-transparent" />
                  </div>
                  <h3 className="font-serif text-3xl font-medium leading-tight text-text">{need.title}</h3>
                  <p className="mt-4 text-sm leading-7 text-text-muted">{need.description}</p>
                </div>
                <Button href={need.href} variant="ghost" size="sm" className="mt-8 justify-start px-0 text-copper">
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
