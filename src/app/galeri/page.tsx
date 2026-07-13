import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Galeri & Bukti",
  description: "Dokumentasi publik hanya menampilkan pekerjaan yang aman dibagikan, tanpa data pribadi pelanggan.",
  path: "/galeri",
});

export default function Page() {
  return (
    <PageShell eyebrow="Galeri & Bukti" title="Bukti pengiriman, pemasangan, dan proyek meja billiard Vania." description="Dokumentasi publik hanya menampilkan pekerjaan yang aman dibagikan, tanpa data pribadi pelanggan.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Dokumentasi pengiriman nasional</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Pemasangan rumah dan venue</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Preview sebelum/sesudah jika tersedia</li>
      </div>
    </PageShell>
  );
}
