"use client";

import { useMemo, useState } from "react";
import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import { ResultPanel } from "@/components/ui/ResultPanel";
import { LeadCapturePanel } from "@/components/leads/LeadCapturePanel";

const tierPrice = { basic: 15000000, pro: 23000000, prime: 24000000 } as const;
const accessoryPrice = { basic: 2500000, complete: 5000000 } as const;
const renovationPrice = { none: 0, light: 10000000, medium: 25000000 } as const;
const deliveryPrice = { java: 3000000, outside: 8000000 } as const;

function rupiah(value: number) {
  return new Intl.NumberFormat("id-ID", { style: "currency", currency: "IDR", maximumFractionDigits: 0 }).format(value);
}

export function CapitalEstimatorClient() {
  const [tableCount, setTableCount] = useState(4);
  const [tier, setTier] = useState<keyof typeof tierPrice>("basic");
  const [accessories, setAccessories] = useState<keyof typeof accessoryPrice>("basic");
  const [renovation, setRenovation] = useState<keyof typeof renovationPrice>("light");
  const [delivery, setDelivery] = useState<keyof typeof deliveryPrice>("java");

  const estimate = useMemo(() => {
    const tableTotal = tableCount * tierPrice[tier];
    const accessoryTotal = tableCount * accessoryPrice[accessories];
    const base = tableTotal + accessoryTotal + renovationPrice[renovation] + deliveryPrice[delivery];
    return { low: Math.round(base * 0.85), high: Math.round(base * 1.25), tableTotal, accessoryTotal };
  }, [tableCount, tier, accessories, renovation, delivery]);

  return (
    <div className="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
      <div className="border border-border-subtle bg-surface p-5 lg:p-7">
        <div className="grid gap-4">
          <FormField label="Jumlah meja" name="capital-count" type="number" min="1" value={tableCount} onChange={(event) => setTableCount(Number(event.target.value))} />
          <FormField kind="select" label="Tier produk" name="capital-tier" value={tier} onChange={(event) => setTier(event.target.value as keyof typeof tierPrice)} options={[{ label: "Basic", value: "basic" }, { label: "Pro", value: "pro" }, { label: "Prime", value: "prime" }]} />
          <FormField kind="select" label="Paket aksesoris" name="capital-accessories" value={accessories} onChange={(event) => setAccessories(event.target.value as keyof typeof accessoryPrice)} options={[{ label: "Basic", value: "basic" }, { label: "Complete", value: "complete" }]} />
          <FormField kind="select" label="Renovasi" name="capital-renovation" value={renovation} onChange={(event) => setRenovation(event.target.value as keyof typeof renovationPrice)} options={[{ label: "Tidak ada", value: "none" }, { label: "Ringan", value: "light" }, { label: "Sedang", value: "medium" }]} />
          <FormField kind="select" label="Region pengiriman" name="capital-delivery" value={delivery} onChange={(event) => setDelivery(event.target.value as keyof typeof deliveryPrice)} options={[{ label: "Pulau Jawa", value: "java" }, { label: "Luar Jawa", value: "outside" }]} />
        </div>
      </div>
      <div className="space-y-5">
        <ResultPanel eyebrow="Estimasi modal kasar" title={`${rupiah(estimate.low)} - ${rupiah(estimate.high)}`} description="Rentang ini hanya untuk persiapan diskusi. Tidak termasuk sewa tempat, izin, operasional bulanan, dan tidak menjamin profit/BEP." tone="limited">
          <div className="grid gap-3 text-sm sm:grid-cols-2">
            <p>Komponen meja: {rupiah(estimate.tableTotal)}</p>
            <p>Komponen aksesoris: {rupiah(estimate.accessoryTotal)}</p>
          </div>
        </ResultPanel>
        <LeadCapturePanel segment="business" tableCount={`${tableCount}`} productInterest={`Estimasi modal ${tier}`} title="Simpan estimasi modal dan lanjut konsultasi" />
        <Button href="/hitung-kebutuhan-usaha" variant="secondary">Hitung Kapasitas Ruang</Button>
      </div>
    </div>
  );
}
