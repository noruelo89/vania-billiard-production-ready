import Link from "next/link";
import { Button } from "@/components/ui/Button";
import { waConsultationLink } from "@/lib/whatsapp";

export function Hero() {
  return (
    <section className="relative flex min-h-[100svh] flex-col overflow-hidden lg:min-h-[92vh] md:flex-row">
      <div className="relative z-10 flex min-h-[62vh] w-full flex-col justify-center px-6 py-24 md:min-h-[92vh] md:w-1/2 md:px-12 md:py-0 lg:px-20">
        <div className="mb-8 h-px w-12 bg-copper anim-fade-up" style={{ animationDelay: "200ms" }} />
        <p
          className="mb-6 font-mono text-[10px] uppercase tracking-[0.3em] text-copper anim-fade-up md:text-xs"
          style={{ animationDelay: "300ms" }}
        >
          Persiapan Meja & Usaha Billiard
        </p>
        <h1
          className="mb-6 max-w-2xl font-serif text-4xl font-medium leading-[1.03] text-white anim-fade-up md:text-5xl lg:text-[5rem]"
          style={{ animationDelay: "450ms" }}
        >
          Rencanakan Meja dan Usaha Billiard dengan Lebih Tepat Sebelum Membeli.
        </h1>
        <p
          className="mb-8 max-w-xl text-sm font-light leading-relaxed text-text-secondary anim-fade-up md:text-base"
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
            className="link-underline flex items-center text-xs font-semibold uppercase tracking-[0.2em] text-text-secondary transition-colors hover:text-copper"
          >
            Lihat Pilihan Meja
            <span className="ml-3 h-px w-6 bg-text-tertiary transition-all duration-300" />
          </Link>
        </div>
      </div>
      <div className="group relative h-[58vh] w-full overflow-hidden bg-[#0e0e0e] md:h-[92vh] md:w-1/2">
        <img
          src="/images/hero/hero-main.jpg"
          alt="Showroom meja billiard Vania untuk perencanaan ruang rumah dan usaha"
          className="absolute inset-0 h-full w-full object-cover opacity-70 transition-opacity duration-700 anim-ken-burns img-reveal group-hover:opacity-90"
          loading="eager"
        />
        <div className="absolute inset-0 bg-gradient-to-t from-[#080808] via-transparent to-transparent" />
        <div className="absolute inset-0 bg-gradient-to-r from-[#080808]/75 via-transparent to-transparent md:from-[#080808]/45" />
        <div className="absolute bottom-6 left-6 right-6 border border-copper/30 bg-bg/75 p-4 backdrop-blur-md lg:left-auto lg:w-80">
          <p className="font-mono text-[10px] uppercase tracking-[0.22em] text-copper">Rekomendasi awal</p>
          <p className="mt-2 text-sm leading-relaxed text-text-muted">
            Simulator hanya membantu estimasi. Layout final, pengiriman, dan pemasangan tetap dikonfirmasi lewat konsultasi.
          </p>
        </div>
      </div>
    </section>
  );
}
