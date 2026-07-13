import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Buka Usaha Billiard",
  description: "Gunakan halaman ini sebagai pintu awal sebelum estimator modal MVP-plus tersedia.",
  path: "/buka-usaha-billiard",
});

export default function Page() {
  return (
    <PageShell eyebrow="Buka Usaha Billiard" title="Panduan awal membuka usaha billiard." description="Gunakan halaman ini sebagai pintu awal sebelum estimator modal MVP-plus tersedia.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Hitung kapasitas meja dulu</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Siapkan area pendukung venue</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Jangan menganggap estimasi sebagai jaminan profit</li>
      </div>
    </PageShell>
  );
}
