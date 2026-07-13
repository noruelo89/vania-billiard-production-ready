import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import { Reveal } from "@/components/ui/Reveal";

export function QuickAssessment() {
  return (
    <section className="bg-surface px-5 py-20 lg:px-8 lg:py-28">
      <div className="mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.9fr_1.1fr] lg:items-center">
        <Reveal>
          <div>
            <p className="mb-4 font-mono text-[11px] uppercase tracking-[0.25em] text-copper">Quick assessment</p>
            <h2 className="font-serif text-4xl font-medium leading-tight text-text lg:text-5xl">
              Belum yakin meja dan ruangan cocok? Mulai dari data paling dasar.
            </h2>
            <p className="mt-5 text-base leading-relaxed text-text-muted lg:text-lg">
              Masukkan gambaran awal ruangan, kebutuhan, dan budget. Untuk hasil detail, lanjutkan ke simulator dan form konsultasi.
            </p>
          </div>
        </Reveal>
        <Reveal delay={120}>
          <div className="border border-border-subtle bg-bg p-5 shadow-2xl shadow-black/30 lg:p-7">
            <div className="grid gap-4 sm:grid-cols-2">
              <FormField label="Panjang ruangan" name="quick-length" placeholder="Contoh: 6 meter" />
              <FormField label="Lebar ruangan" name="quick-width" placeholder="Contoh: 4 meter" />
              <FormField
                kind="select"
                label="Kebutuhan"
                name="quick-segment"
                defaultValue="home"
                options={[
                  { label: "Meja untuk rumah", value: "home" },
                  { label: "Buka usaha", value: "business" },
                  { label: "Venue/cafe", value: "venue" },
                  { label: "Aksesoris", value: "accessories" },
                ]}
              />
              <FormField label="Kota" name="quick-city" placeholder="Contoh: Semarang" />
            </div>
            <div className="mt-6 flex flex-col gap-3 sm:flex-row">
              <Button href="/simulator-ruangan" className="flex-1">Lanjut ke Simulator</Button>
              <Button href="/kontak" variant="secondary" className="flex-1">Konsultasi Cepat</Button>
            </div>
            <p className="mt-4 text-xs leading-relaxed text-text-muted">
              Assessment ini belum menyimpan data. Lead capture resmi akan muncul pada hasil simulator/konsultasi.
            </p>
          </div>
        </Reveal>
      </div>
    </section>
  );
}
