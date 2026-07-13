"use client";

import { useMemo, useState } from "react";
import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import { LeadCapturePanel } from "@/components/leads/LeadCapturePanel";
import { ResultPanel } from "@/components/ui/ResultPanel";
import { type TableSize } from "@/config/tools";
import { estimateTableCount } from "@/lib/room-tools";
import { waConsultationLink } from "@/lib/whatsapp";

export function TableCountEstimatorClient() {
  const [lengthM, setLengthM] = useState(18);
  const [widthM, setWidthM] = useState(10);
  const [tableSize, setTableSize] = useState<TableSize>("9ft");
  const [circulationCm, setCirculationCm] = useState(90);
  const [supportingAreaRatio, setSupportingAreaRatio] = useState(0.18);

  const result = useMemo(
    () => estimateTableCount({ lengthM, widthM, tableSize, circulationCm, supportingAreaRatio }),
    [lengthM, widthM, tableSize, circulationCm, supportingAreaRatio]
  );

  return (
    <div className="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
      <div className="border border-border-subtle bg-surface p-5 lg:p-7">
        <div className="grid gap-4">
          <FormField label="Panjang ruangan (meter)" name="biz-length" type="number" min="1" step="0.1" value={lengthM} onChange={(event) => setLengthM(Number(event.target.value))} />
          <FormField label="Lebar ruangan (meter)" name="biz-width" type="number" min="1" step="0.1" value={widthM} onChange={(event) => setWidthM(Number(event.target.value))} />
          <FormField
            kind="select"
            label="Ukuran meja"
            name="biz-table-size"
            value={tableSize}
            onChange={(event) => setTableSize(event.target.value as TableSize)}
            options={[
              { label: "7ft", value: "7ft" },
              { label: "8ft", value: "8ft" },
              { label: "9ft", value: "9ft" },
            ]}
          />
          <FormField label="Sirkulasi per sisi (cm)" name="circulation" type="number" min="50" step="10" value={circulationCm} onChange={(event) => setCirculationCm(Number(event.target.value))} />
          <FormField
            kind="select"
            label="Area pendukung"
            name="supporting-area"
            value={String(supportingAreaRatio)}
            onChange={(event) => setSupportingAreaRatio(Number(event.target.value))}
            options={[
              { label: "Minimal - 10%", value: "0.1" },
              { label: "Standar - 18%", value: "0.18" },
              { label: "Luas - 25%", value: "0.25" },
            ]}
          />
        </div>
      </div>

      <div className="space-y-5">
        <ResultPanel
          eyebrow="Estimasi awal"
          title={`${result.estimatedCount} meja`}
          description="Jumlah ini adalah estimasi kasar untuk diskusi awal, bukan layout final venue."
          tone={result.estimatedCount > 0 ? "comfortable" : "warning"}
        >
          <div className="grid gap-3 text-sm sm:grid-cols-2">
            <p>Area efektif: {result.usableAreaM2} m2</p>
            <p>Footprint/meja: {result.footprintPerTableM2} m2</p>
          </div>
        </ResultPanel>

        <div className="grid gap-4 md:grid-cols-2">
          <div className="border border-border-subtle bg-surface p-5">
            <h3 className="font-serif text-2xl text-text">Asumsi</h3>
            <ul className="mt-4 space-y-3 text-sm text-text-muted">
              {result.assumptions.map((item) => <li key={item}>- {item}</li>)}
            </ul>
          </div>
          <div className="border border-border-subtle bg-surface p-5">
            <h3 className="font-serif text-2xl text-text">Batasan</h3>
            <ul className="mt-4 space-y-3 text-sm text-text-muted">
              {result.limitations.map((item) => <li key={item}>- {item}</li>)}
            </ul>
          </div>
        </div>

        <div className="flex flex-col gap-3 sm:flex-row">
          <Button href={waConsultationLink()} external variant="secondary">
            WhatsApp Tanpa Kode
          </Button>
          <Button href="/buka-usaha-billiard" variant="secondary">
            Baca Panduan Usaha
          </Button>
        </div>

        <LeadCapturePanel
          segment="business"
          roomSize={`${lengthM} x ${widthM} m`}
          tableCount={`${result.estimatedCount}`}
          productInterest={`Meja ${tableSize}`}
          title="Simpan estimasi usaha dan lanjut konsultasi"
        />
      </div>
    </div>
  );
}
