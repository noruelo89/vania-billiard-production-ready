"use client";

import { useMemo, useState } from "react";
import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import { LeadCapturePanel } from "@/components/leads/LeadCapturePanel";
import { ResultPanel } from "@/components/ui/ResultPanel";
import { simulatorAssumptions, type TableSize } from "@/config/tools";
import { simulateRoom } from "@/lib/room-tools";
import { waSimulatorLink } from "@/lib/whatsapp";

const statusTone = {
  comfortable: "comfortable",
  limited: "limited",
  "not-recommended": "warning",
} as const;

const statusLabel = {
  comfortable: "Nyaman",
  limited: "Terbatas",
  "not-recommended": "Tidak Direkomendasikan",
} as const;

export function RoomSimulatorClient() {
  const [lengthM, setLengthM] = useState(6);
  const [widthM, setWidthM] = useState(4.5);
  const [tableSize, setTableSize] = useState<TableSize>("9ft");
  const [cueLengthCm, setCueLengthCm] = useState<number>(simulatorAssumptions.defaultCueLengthCm);

  const result = useMemo(
    () => simulateRoom({ lengthM, widthM, tableSize, cueLengthCm }),
    [lengthM, widthM, tableSize, cueLengthCm]
  );

  const tableWidthPercent = Math.min(82, Math.max(28, (result.tableWidthCm / Math.max(result.roomWidthCm, 1)) * 100));
  const tableHeightPercent = Math.min(82, Math.max(28, (result.tableLengthCm / Math.max(result.roomLengthCm, 1)) * 100));

  return (
    <div className="grid gap-8 lg:grid-cols-[0.85fr_1.15fr]">
      <div className="border border-border-subtle bg-surface p-5 lg:p-7">
        <div className="grid gap-4">
          <FormField
            label="Panjang ruangan (meter)"
            name="length"
            type="number"
            min="1"
            step="0.1"
            value={lengthM}
            onChange={(event) => setLengthM(Number(event.target.value))}
          />
          <FormField
            label="Lebar ruangan (meter)"
            name="width"
            type="number"
            min="1"
            step="0.1"
            value={widthM}
            onChange={(event) => setWidthM(Number(event.target.value))}
          />
          <FormField
            kind="select"
            label="Ukuran meja"
            name="table-size"
            value={tableSize}
            onChange={(event) => setTableSize(event.target.value as TableSize)}
            options={[
              { label: "7ft", value: "7ft" },
              { label: "8ft", value: "8ft" },
              { label: "9ft", value: "9ft" },
            ]}
          />
          <FormField
            label="Panjang stick/cue (cm)"
            name="cue-length"
            type="number"
            min="100"
            step="5"
            value={cueLengthCm}
            hint="Default 145 cm. Pakai angka lebih pendek jika memakai short cue."
            onChange={(event) => setCueLengthCm(Number(event.target.value))}
          />
        </div>
      </div>

      <div className="space-y-5">
        <ResultPanel
          eyebrow="Hasil awal"
          title={statusLabel[result.status]}
          description={result.message}
          tone={statusTone[result.status]}
        >
          <div className="grid gap-3 text-sm sm:grid-cols-2">
            <p>Clearance panjang: {result.clearanceLengthCm} cm/sisi</p>
            <p>Clearance lebar: {result.clearanceWidthCm} cm/sisi</p>
            <p>Nyaman minimal: {result.comfortableLengthCm} x {result.comfortableWidthCm} cm</p>
            <p>Terbatas minimal: {result.limitedLengthCm} x {result.limitedWidthCm} cm</p>
          </div>
        </ResultPanel>

        <div className="relative h-72 border border-border-subtle bg-[#101010] p-4">
          <div className="absolute inset-4 border border-text-muted/25 bg-bg/70">
            <div
              className="absolute left-1/2 top-1/2 grid -translate-x-1/2 -translate-y-1/2 place-items-center border border-copper bg-copper/20 text-xs font-semibold text-copper"
              style={{ width: `${tableWidthPercent}%`, height: `${tableHeightPercent}%` }}
            >
              {tableSize}
            </div>
          </div>
          <p className="absolute bottom-3 left-4 text-xs text-text-muted">
            Visual sederhana, bukan gambar layout final.
          </p>
        </div>

        <div className="flex flex-col gap-3 sm:flex-row">
          <Button href={waSimulatorLink({ length: lengthM, width: widthM, size: tableSize })} external variant="secondary">
            WhatsApp Tanpa Kode
          </Button>
          <Button href="/meja-billiard" variant="secondary">
            Lihat Produk Relevan
          </Button>
        </div>

        <LeadCapturePanel
          segment="home"
          roomSize={`${lengthM} x ${widthM} m`}
          productInterest={`Meja ${tableSize}`}
        />
      </div>
    </div>
  );
}
