import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Kontak",
  description: "Pilih jalur komunikasi sesuai kebutuhan agar data meja dan aksesoris tidak tercampur.",
  path: "/kontak",
});

export default function Page() {
  return (
    <PageShell eyebrow="Kontak" title="Hubungi Vania Billiard untuk konsultasi meja dan aksesoris." description="Pilih jalur komunikasi sesuai kebutuhan agar data meja dan aksesoris tidak tercampur.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">WhatsApp meja: +62 822-4154-5326</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">WhatsApp aksesoris: +62 851-8230-6565</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Marketplace dan maps dikonfirmasi melalui link resmi</li>
      </div>
    </PageShell>
  );
}
