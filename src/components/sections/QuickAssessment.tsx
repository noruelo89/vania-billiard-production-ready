import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import { Reveal } from "@/components/ui/Reveal";

export function QuickAssessment() {
  return (
    <section className="relative overflow-hidden bg-surface px-5 py-20 lg:px-8 lg:py-28">
      <div className="pointer-events-none absolute inset-y-0 left-0 w-1/2 bg-gradient-to-r from-bg/70 to-transparent" />
      <div className="relative mx-auto grid max-w-7xl gap-10 lg:grid-cols-[0.95fr_1.05fr] lg:items-center">
        <Reveal>
          <div className="score-slip p-6 md:p-8">
            <p className="font-mono text-[10px] uppercase tracking-[0.24em] text-copper">Measurement slip</p>
            <h2 className="mt-5 font-serif text-4xl font-medium leading-tight text-text lg:text-5xl">
              Jangan mulai dari model meja. Mulai dari ruangnya.
            </h2>
            <p className="mt-5 text-base leading-8 text-text-muted lg:text-lg">
              Data paling sederhana sudah cukup untuk membaca risiko awal: panjang, lebar, kebutuhan, kota, dan arah pembelian.
            </p>
            <div className="mt-8 grid grid-cols-3 gap-2 text-xs text-text-dim">
              <div className="border border-border-subtle p-3">Ruang</div>
              <div className="border border-border-subtle p-3">Budget</div>
              <div className="border border-border-subtle p-3">Kota</div>
            </div>
          </div>
        </Reveal>

        <Reveal delay={120}>
          <div className="rail-card p-5 shadow-2xl shadow-black/30 lg:p-7">
            <div className="mb-6 flex items-center justify-between gap-4 border-b border-border-subtle pb-4">
              <div>
                <p className="font-mono text-[10px] uppercase tracking-[0.2em] text-copper">Assessment awal</p>
                <p className="mt-1 text-sm text-text-muted">Belum menyimpan data, hanya mengarahkan ke tool yang tepat.</p>
              </div>
              <span className="hidden h-10 w-10 rounded-full border border-copper/40 md:block" />
            </div>
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
              <Button href="/simulator-ruangan" className="flex-1">Buka Simulator Ruangan</Button>
              <Button href="/kontak" variant="secondary" className="flex-1">Konsultasi Cepat</Button>
            </div>
          </div>
        </Reveal>
      </div>
    </section>
  );
}
