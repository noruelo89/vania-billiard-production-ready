import { Button } from "@/components/ui/Button";
import { Reveal } from "@/components/ui/Reveal";

const tools = [
  {
    title: "Simulator Ruangan",
    description: "Cek apakah ruangan nyaman, terbatas, atau tidak direkomendasikan untuk ukuran meja tertentu.",
    href: "/simulator-ruangan",
    status: "Clearance",
    detail: "7ft / 8ft / 9ft",
  },
  {
    title: "Hitung Kebutuhan Usaha",
    description: "Estimasi jumlah meja berdasarkan luas ruang, sirkulasi, dan area pendukung venue.",
    href: "/hitung-kebutuhan-usaha",
    status: "Layout",
    detail: "jumlah meja",
  },
  {
    title: "Estimasi Modal",
    description: "Kisaran komponen modal untuk meja, aksesoris, pengiriman, pemasangan, dan renovasi ringan.",
    href: "/estimasi-modal-usaha",
    status: "Capital",
    detail: "broad range",
  },
];

export function ToolsOverview() {
  return (
    <section className="relative overflow-hidden bg-bg px-5 py-20 lg:px-8 lg:py-28">
      <div className="pointer-events-none absolute inset-0 grid-felt opacity-20" />
      <div className="relative mx-auto max-w-7xl">
        <div className="mb-12 grid gap-8 lg:grid-cols-[0.8fr_1.2fr] lg:items-end">
          <Reveal>
            <div>
              <p className="font-mono text-[10px] uppercase tracking-[0.24em] text-copper">Tool bench</p>
              <h2 className="mt-5 max-w-2xl font-serif text-4xl leading-tight text-text md:text-5xl">
                Tiga alat kecil untuk mengurangi keputusan yang asal.
              </h2>
            </div>
          </Reveal>
          <Reveal delay={100}>
            <p className="max-w-2xl text-base leading-8 text-text-muted lg:ml-auto">
              Tools bukan pengganti konsultasi. Fungsinya membuat pembicaraan WhatsApp lebih siap: ukuran, asumsi, batasan, dan produk yang masuk akal.
            </p>
          </Reveal>
        </div>

        <div className="grid gap-5 lg:grid-cols-[1.18fr_0.92fr_0.92fr]">
          {tools.map((tool, index) => (
            <Reveal key={tool.title} delay={index * 100}>
              <article className="card-luxury group relative flex min-h-[330px] flex-col overflow-hidden p-6 transition-transform duration-300 hover:-translate-y-1 md:p-7">
                <div className="pointer-events-none absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-copper/70 to-transparent" />
                <div className="pointer-events-none absolute -right-16 -top-16 h-48 w-48 rounded-full border border-copper/20" />
                <div className="flex items-center justify-between gap-4">
                  <p className="font-mono text-[10px] uppercase tracking-[0.22em] text-copper">{tool.status}</p>
                  <p className="text-xs text-text-dim">{tool.detail}</p>
                </div>
                <div className="my-8 h-28 border border-border-subtle bg-bg/50 p-3">
                  <div className="h-full w-full bg-[linear-gradient(rgba(217,201,163,0.08)_1px,transparent_1px),linear-gradient(90deg,rgba(217,201,163,0.08)_1px,transparent_1px)] bg-[length:22px_22px]">
                    <div className="mx-auto h-full w-2/3 border border-copper/35 bg-copper/10" />
                  </div>
                </div>
                <h3 className="font-serif text-3xl font-medium text-text">{tool.title}</h3>
                <p className="mt-3 flex-1 text-sm leading-7 text-text-muted">{tool.description}</p>
                <Button href={tool.href} variant={index === 0 ? "primary" : "secondary"} className="mt-7">
                  Buka Tool
                </Button>
              </article>
            </Reveal>
          ))}
        </div>
      </div>
    </section>
  );
}
