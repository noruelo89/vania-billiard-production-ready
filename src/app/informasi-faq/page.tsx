import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "FAQ",
  description: "Jawaban ringkas untuk ukuran ruangan, harga mulai, pengiriman, pemasangan, custom, aksesoris, dan konsultasi WhatsApp.",
  path: "/informasi-faq",
});

export default function Page() {
  return (
    <PageShell eyebrow="FAQ" title="Pertanyaan umum sebelum membeli meja billiard." description="Jawaban ringkas untuk ukuran ruangan, harga mulai, pengiriman, pemasangan, custom, aksesoris, dan konsultasi WhatsApp.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Harga bersifat mulai dari</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Simulator adalah rekomendasi awal</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Quotation final melalui konsultasi</li>
      </div>
    </PageShell>
  );
}
