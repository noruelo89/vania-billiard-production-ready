import Link from "next/link";
import { Button } from "@/components/ui/Button";
import { waConsultationLink } from "@/lib/whatsapp";

const proofCards = [
  { label: "Ruang", value: "7ft / 8ft / 9ft", note: "clearance dulu" },
  { label: "Usaha", value: "Table count", note: "estimasi layout" },
  { label: "Handoff", value: "Lead ID", note: "siap WhatsApp" },
];

const atelierMarks = [
  { label: "Cue line", x: "18%", y: "28%" },
  { label: "Rail", x: "64%", y: "44%" },
  { label: "Pocket", x: "42%", y: "70%" },
];

export function Hero() {
  return (
    <section className="felt-radial atelier-frame relative isolate min-h-[100svh] overflow-hidden px-5 pt-24 md:px-8 lg:pt-28">
      <div className="pointer-events-none absolute inset-0 grid-felt opacity-35" />
      <div className="pointer-events-none absolute left-0 top-0 h-40 w-full bg-gradient-to-b from-bg via-bg/65 to-transparent" />
      <div className="pointer-events-none absolute -left-24 top-28 h-80 w-80 rounded-full bg-copper/16 blur-3xl" />
      <div className="pointer-events-none absolute right-0 top-1/3 h-[32rem] w-[32rem] rounded-full bg-[#184b35]/20 blur-3xl" />

      <div className="relative z-10 mx-auto grid min-h-[calc(100svh-6rem)] max-w-7xl gap-10 pb-10 lg:grid-cols-[0.92fr_1.08fr] lg:items-center">
        <div className="max-w-3xl py-10 lg:py-0">
          <div className="mb-7 flex items-center gap-4 anim-fade-up" style={{ animationDelay: "120ms" }}>
            <span className="h-px w-14 bg-copper" />
            <span className="font-mono text-[10px] uppercase tracking-[0.28em] text-copper md:text-xs">
              Showroom keputusan billiard
            </span>
          </div>

          <h1
            className="max-w-4xl font-serif text-[clamp(3rem,8vw,6.7rem)] font-medium leading-[0.92] tracking-[-0.055em] text-text anim-fade-up"
            style={{ animationDelay: "260ms" }}
          >
            Rancang ruang. Pilih meja. Baru konsultasi.
          </h1>

          <p
            className="mt-7 max-w-2xl text-base leading-8 text-text-muted anim-fade-up md:text-lg"
            style={{ animationDelay: "420ms" }}
          >
            Platform persiapan untuk calon pembeli rumah dan pemilik usaha: cek ukuran ruangan, jumlah meja, produk, aksesoris, lalu bawa data itu ke WhatsApp Vania.
          </p>

          <div className="mt-9 flex flex-col gap-3 anim-fade-up sm:flex-row" style={{ animationDelay: "560ms" }}>
            <Button href="/simulator-ruangan" variant="primary" size="md">
              Mulai Hitung Kebutuhan
            </Button>
            <Button href={waConsultationLink()} variant="whatsapp" size="md" external>
              Konsultasi WhatsApp
            </Button>
          </div>

          <div className="mt-7 anim-fade-up" style={{ animationDelay: "680ms" }}>
            <Link
              href="/meja-billiard"
              className="link-underline inline-flex items-center text-xs font-semibold uppercase tracking-[0.18em] text-text-muted transition-colors hover:text-copper"
            >
              Lihat pilihan meja
              <span className="ml-3 h-px w-9 bg-current" />
            </Link>
          </div>

          <div className="mt-12 grid max-w-2xl grid-cols-3 gap-2 anim-fade-up" style={{ animationDelay: "820ms" }}>
            {proofCards.map((card) => (
              <div key={card.label} className="score-slip px-3 py-4 sm:px-4">
                <p className="font-mono text-[9px] uppercase tracking-[0.18em] text-copper">{card.label}</p>
                <p className="mt-2 text-sm font-semibold text-text sm:text-base">{card.value}</p>
                <p className="mt-1 text-[11px] text-text-dim">{card.note}</p>
              </div>
            ))}
          </div>
        </div>

        <div className="relative min-h-[560px] overflow-hidden border border-copper/20 bg-[#090907] shadow-[0_34px_110px_rgba(0,0,0,0.55)] lg:min-h-[72vh]">
          <img
            src="/images/hero/hero-main.jpg"
            alt="Showroom meja billiard Vania untuk perencanaan ruang rumah dan usaha"
            className="absolute inset-0 h-full w-full object-cover opacity-[0.68] transition duration-700 anim-ken-burns img-reveal hover:opacity-85"
            loading="eager"
          />
          <div className="absolute inset-0 bg-gradient-to-r from-bg/85 via-bg/20 to-bg/10" />
          <div className="absolute inset-0 bg-gradient-to-t from-bg via-transparent to-bg/35" />
          <div className="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-copper to-transparent" />

          {atelierMarks.map((mark) => (
            <div key={mark.label} className="absolute hidden md:block" style={{ left: mark.x, top: mark.y }}>
              <span className="absolute h-4 w-4 rounded-full bg-copper/50 anim-pulse-copper" />
              <span className="relative block h-4 w-4 rounded-full border border-white/80 bg-copper shadow-[0_0_18px_rgba(200,106,54,0.8)]" />
            </div>
          ))}

          <div className="absolute right-5 top-5 w-64 card-luxury p-4 backdrop-blur-md">
            <p className="font-mono text-[9px] uppercase tracking-[0.18em] text-copper">Decision ratio</p>
            <p className="mt-2 font-serif text-2xl text-text">70% meja, 30% aksesoris</p>
            <div className="mt-4 h-1.5 bg-white/10">
              <div className="h-full w-[70%] bg-copper" />
            </div>
          </div>

          <div className="absolute bottom-5 left-5 right-5 grid gap-3 md:grid-cols-[1fr_0.8fr]">
            <div className="score-slip bg-bg/82 p-4 backdrop-blur-md">
              <p className="font-mono text-[10px] uppercase tracking-[0.2em] text-copper">Planning slip</p>
              <p className="mt-3 text-sm leading-relaxed text-text-muted">
                Simulator memberi estimasi awal. Layout final, ongkir, dan pemasangan tetap dikonfirmasi lewat konsultasi.
              </p>
            </div>
            <div className="hidden bg-light-bg p-4 text-light-text md:block">
              <p className="font-mono text-[10px] uppercase tracking-[0.18em] text-copper-dim">Atelier note</p>
              <p className="mt-3 font-serif text-2xl leading-tight">Beli meja mahal tidak boleh dimulai dari tebak-tebakan ruang.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
