import { Button } from "@/components/ui/Button";
import { Reveal } from "@/components/ui/Reveal";
import { SectionHeading } from "@/components/ui/SectionHeading";

const tools = [
  {
    title: "Simulator Ruangan",
    description: "Cek apakah ruangan nyaman, terbatas, atau tidak direkomendasikan untuk ukuran meja tertentu.",
    href: "/simulator-ruangan",
    status: "MVP utama",
  },
  {
    title: "Hitung Kebutuhan Usaha",
    description: "Estimasi jumlah meja yang bisa masuk berdasarkan luas ruang, sirkulasi, dan area pendukung.",
    href: "/hitung-kebutuhan-usaha",
    status: "MVP utama",
  },
  {
    title: "Estimasi Modal",
    description: "Kisaran komponen modal untuk meja, aksesoris, pengiriman, pemasangan, dan renovasi ringan.",
    href: "/buka-usaha-billiard",
    status: "MVP-plus",
  },
];

export function ToolsOverview() {
  return (
    <section className="bg-bg px-5 py-20 lg:px-8 lg:py-28">
      <div className="mx-auto max-w-7xl">
        <SectionHeading
          eyebrow="Decision tools"
          title="Hitung dulu sebelum memilih meja."
          subtitle="Tools memberi rekomendasi awal dan batasan yang jelas. Keputusan final tetap dikonfirmasi lewat konsultasi."
        />
        <div className="grid gap-5 lg:grid-cols-3">
          {tools.map((tool, index) => (
            <Reveal key={tool.title} delay={index * 100}>
              <article className="flex h-full flex-col border border-border-subtle bg-surface p-6">
                <p className="mb-5 w-fit border border-copper/30 px-3 py-1 font-mono text-[10px] uppercase tracking-[0.18em] text-copper">
                  {tool.status}
                </p>
                <h3 className="font-serif text-3xl font-semibold text-text">{tool.title}</h3>
                <p className="mt-3 flex-1 text-sm leading-relaxed text-text-muted">{tool.description}</p>
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
