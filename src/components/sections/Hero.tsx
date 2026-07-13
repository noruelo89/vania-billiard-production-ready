import Link from "next/link";
import { Button } from "@/components/ui/Button";
import { waConsultationLink } from "@/lib/whatsapp";

const proofCards = [
  { label: "Ruang", value: "7ft / 8ft / 9ft", note: "cek clearance" },
  { label: "Usaha", value: "Jumlah meja", note: "estimasi awal" },
  { label: "Handoff", value: "Kode lead", note: "masuk WhatsApp" },
];

export function Hero() {
  return (
    <section className="felt-radial relative flex min-h-[100svh] flex-col overflow-hidden lg:min-h-[92vh] md:flex-row">
      <div className="pointer-events-none absolute inset-0 grid-felt opacity-40" />
      <div className="pointer-events-none absolute -left-28 top-24 h-72 w-72 rounded-full bg-copper/20 blur-3xl" />
      <div className="relative z-10 flex min-h-[64vh] w-full flex-col justify-center px-6 py-24 md:min-h-[92vh] md:w-1/2 md:px-12 md:py-0 lg:px-20">
        <div className="mb-8 flex items-center gap-4 anim-fade-up" style={{ animationDelay: "200ms" }}>
          <span className="h-px w-12 bg-copper" />
          <span className="font-mono text-[10px] uppercase tracking-[0.32em] text-copper md:text-xs">
            Persiapan Meja & Usaha Billiard
          </span>
        </div>
        <h1
          className="mb-6 max-w-3xl font-serif text-4xl font-medium leading-[1.02] text-white anim-fade-up md:text-5xl lg:text-[5.2rem]"
          style={{ animationDelay: "450ms" }}
        >
          Rencanakan meja billiard dengan <span className="italic text-copper">lebih tepat</span> sebelum membeli.
        </h1>
        <p
          className="mb-8 max-w-xl text-sm font-light leading-relaxed text-text-muted anim-fade-up md:text-base"
          style={{ animationDelay: "650ms" }}
        >
          Hitung kebutuhan ruang, jumlah meja, kisaran modal, pilihan produk, dan perlengkapan, lalu konsultasikan pilihan yang sesuai untuk rumah atau usaha.
        </p>
        <div className="flex flex-col items-start gap-4 anim-fade-up sm:flex-row sm:items-center" style={{ animationDelay: "800ms" }}>
          <Button href="/simulator-ruangan" variant="primary" size="md">
            Mulai Hitung Kebutuhan
          </Button>
          <Button href={waConsultationLink()} variant="whatsapp" size="md" external>
            Konsultasi via WhatsApp
          </Button>
          <Link
            href="/meja-billiard"
            className="link-underline flex items-center text-xs font-semibold uppercase tracking-[0.2em] text-text-muted transition-colors hover:text-copper"
          >
            Lihat Pilihan Meja
            <span className="ml-3 h-px w-6 bg-text-dim transition-all duration-300" />
          </Link>
        </div>

        <div className="mt-12 grid max-w-xl grid-cols-3 gap-2 anim-fade-up" style={{ animationDelay: "950ms" }}>
          {proofCards.map((card) => (
            <div key={card.label} className="card-luxury px-3 py-4">
              <p className="font-mono text-[9px] uppercase tracking-[0.2em] text-copper">{card.label}</p>
              <p className="mt-2 text-sm font-semibold text-text">{card.value}</p>
              <p className="mt-1 text-[11px] text-text-dim">{card.note}</p>
            </div>
          ))}
        </div>
      </div>
      <div className="group relative h-[58vh] w-full overflow-hidden bg-[#0e0e0e] md:h-[92vh] md:w-1/2">
        <img
          src="/images/hero/hero-main.jpg"
          alt="Showroom meja billiard Vania untuk perencanaan ruang rumah dan usaha"
          className="absolute inset-0 h-full w-full object-cover opacity-[0.72] transition-opacity duration-700 anim-ken-burns img-reveal group-hover:opacity-90"
          loading="eager"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-[#080808] via-[#080808]/20 to-transparent" />
        <div className="absolute inset-0 bg-gradient-to-r from-[#080808]/80 via-transparent to-[#080808]/15 md:from-[#080808]/45" />

        <div className="absolute left-[18%] top-[28%] hidden md:block">
          <span className="absolute h-4 w-4 rounded-full bg-copper/60 anim-pulse-copper" />
          <span className="relative block h-4 w-4 rounded-full border-2 border-white bg-copper shadow-[0_0_18px_rgba(200,106,54,0.8)]" />
          <div className="card-luxury absolute left-6 top-6 w-56 p-4 opacity-0 transition-all duration-300 group-hover:opacity-100">
            <p className="font-mono text-[9px] uppercase tracking-[0.18em] text-copper">Cue clearance</p>
            <p className="mt-2 text-xs leading-relaxed text-text-muted">Jarak ayunan stik menjadi faktor utama sebelum memilih ukuran meja.</p>
          </div>
        </div>

        <div className="absolute right-5 top-24 hidden w-64 card-luxury p-4 md:block">
          <p className="font-mono text-[9px] uppercase tracking-[0.2em] text-copper">Decision platform</p>
          <p className="mt-2 text-2xl font-serif text-text">Ruang + produk + konsultasi</p>
          <div className="mt-4 h-2 overflow-hidden bg-border-subtle">
            <div className="h-full w-[70%] bg-copper" />
          </div>
          <p className="mt-2 text-[11px] text-text-dim">70% fokus meja, 30% aksesoris pendukung.</p>
        </div>

        <div className="absolute bottom-6 left-6 right-6 border border-copper/30 bg-bg/80 p-4 backdrop-blur-md lg:left-auto lg:w-80">
          <p className="font-mono text-[10px] uppercase tracking-[0.22em] text-copper">Rekomendasi awal</p>
          <p className="mt-2 text-sm leading-relaxed text-text-muted">
            Simulator hanya membantu estimasi. Layout final, pengiriman, dan pemasangan tetap dikonfirmasi lewat konsultasi.
          </p>
        </div>
      </div>
    </section>
  );
}
