"use client";

import { useState, type FormEvent } from "react";
import { Button } from "@/components/ui/Button";
import { FormField } from "@/components/ui/FormField";
import type { LeadSegment } from "@/types/lead";

interface LeadResponse {
  ok: boolean;
  lead?: { id: string };
  whatsappUrl?: string;
  errors?: Record<string, string>;
}

export function LeadCapturePanel({
  segment = "home",
  roomSize,
  tableCount,
  productInterest,
  title = "Simpan hasil dan lanjut konsultasi",
}: {
  segment?: LeadSegment;
  roomSize?: string;
  tableCount?: string;
  productInterest?: string;
  title?: string;
}) {
  const [name, setName] = useState("");
  const [city, setCity] = useState("");
  const [budget, setBudget] = useState("");
  const [timeline, setTimeline] = useState("");
  const [loading, setLoading] = useState(false);
  const [result, setResult] = useState<LeadResponse | null>(null);

  async function onSubmit(event: FormEvent<HTMLFormElement>) {
    event.preventDefault();
    setLoading(true);
    setResult(null);

    const response = await fetch("/api/leads", {
      method: "POST",
      headers: { "Content-Type": "application/json" },
      body: JSON.stringify({
        name,
        city,
        segment,
        roomSize,
        tableCount,
        budget,
        timeline,
        productInterest,
        source: "website-tool",
      }),
    });

    const data = (await response.json()) as LeadResponse;
    setResult(data);
    setLoading(false);
  }

  return (
    <section className="border border-border-subtle bg-surface p-5 lg:p-6">
      <h2 className="font-serif text-3xl text-text">{title}</h2>
      <p className="mt-3 text-sm leading-relaxed text-text-muted">
        Data ini dipakai untuk membuat kode konsultasi sebelum handoff ke WhatsApp. Nomor telepon tidak wajib di website.
      </p>
      <form className="mt-6 grid gap-4" onSubmit={onSubmit}>
        <div className="grid gap-4 sm:grid-cols-2">
          <FormField label="Nama" name="lead-name" value={name} onChange={(event) => setName(event.target.value)} error={result?.errors?.name} required />
          <FormField label="Kota" name="lead-city" value={city} onChange={(event) => setCity(event.target.value)} error={result?.errors?.city} required />
          <FormField label="Budget" name="lead-budget" placeholder="Contoh: 15-25 juta" value={budget} onChange={(event) => setBudget(event.target.value)} />
          <FormField label="Timeline" name="lead-timeline" placeholder="Contoh: bulan ini" value={timeline} onChange={(event) => setTimeline(event.target.value)} />
        </div>
        <Button type="submit" disabled={loading}>{loading ? "Membuat kode..." : "Buat Kode Konsultasi"}</Button>
      </form>
      {result?.ok && result.lead && result.whatsappUrl ? (
        <div className="mt-5 border border-copper/30 bg-copper/10 p-4">
          <p className="font-mono text-xs uppercase tracking-[0.18em] text-copper">Kode konsultasi</p>
          <p className="mt-2 font-serif text-3xl text-text">{result.lead.id}</p>
          <Button href={result.whatsappUrl} external variant="whatsapp" className="mt-4">
            Lanjut ke WhatsApp
          </Button>
        </div>
      ) : null}
      {result?.errors?.form ? <p className="mt-4 text-sm text-copper">{result.errors.form}</p> : null}
    </section>
  );
}
