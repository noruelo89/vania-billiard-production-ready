import { PageShell } from "@/components/layout/PageShell";
import { buildPageMetadata } from "@/lib/seo";

export const metadata = buildPageMetadata({
  title: "Kebijakan Privasi",
  description: "Website hanya meminta data yang relevan untuk konsultasi, seperti nama, kota, kebutuhan, ukuran ruangan, budget, timeline, dan produk diminati.",
  path: "/kebijakan-privasi",
});

export default function Page() {
  return (
    <PageShell eyebrow="Kebijakan Privasi" title="Cara Vania mengelola data lead dan konsultasi." description="Website hanya meminta data yang relevan untuk konsultasi, seperti nama, kota, kebutuhan, ukuran ruangan, budget, timeline, dan produk diminati.">
      <div className="grid gap-4 md:grid-cols-3">
              <li key="0" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Data digunakan untuk konsultasi dan handoff WhatsApp</li>
              <li key="1" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Data pribadi tidak dikirim ke analytics</li>
              <li key="2" className="border border-border-subtle bg-surface p-5 text-sm leading-relaxed text-text-muted">Penghapusan data dapat diminta melalui kontak resmi</li>
      </div>
    </PageShell>
  );
}
