"use client";

import { useMemo, useState } from "react";
import { FormField } from "@/components/ui/FormField";
import { ProductCard } from "@/components/ui/ProductCard";
import type { Product, TableSize } from "@/data/products";

export function TableCatalogClient({ products }: { products: Product[] }) {
  const [query, setQuery] = useState("");
  const [series, setSeries] = useState("all");
  const [size, setSize] = useState<TableSize | "all">("all");
  const [useCase, setUseCase] = useState("all");

  const filtered = useMemo(() => {
    const keyword = query.trim().toLowerCase();
    return products.filter((product) => {
      const matchesQuery = keyword
        ? [product.name, product.tagline, product.positioning, ...product.highlights]
            .join(" ")
            .toLowerCase()
            .includes(keyword)
        : true;
      const matchesSeries = series === "all" || product.series === series;
      const matchesSize = size === "all" || product.sizes.includes(size);
      const matchesUseCase =
        useCase === "all" ||
        product.positioning.toLowerCase().includes(useCase) ||
        product.tagline.toLowerCase().includes(useCase) ||
        product.highlights.join(" ").toLowerCase().includes(useCase);
      return matchesQuery && matchesSeries && matchesSize && matchesUseCase;
    });
  }, [products, query, series, size, useCase]);

  return (
    <div className="space-y-8">
      <div className="grid gap-4 border border-border-subtle bg-surface p-5 md:grid-cols-2 lg:grid-cols-4">
        <FormField label="Cari produk" name="search" placeholder="Abimanyu, 8ft, custom" value={query} onChange={(event) => setQuery(event.target.value)} />
        <FormField
          kind="select"
          label="Series"
          name="series"
          value={series}
          onChange={(event) => setSeries(event.target.value)}
          options={[
            { label: "Semua series", value: "all" },
            { label: "Standard", value: "standard" },
            { label: "Abimanyu", value: "abimanyu" },
            { label: "Custom", value: "custom" },
          ]}
        />
        <FormField
          kind="select"
          label="Ukuran"
          name="size"
          value={size}
          onChange={(event) => setSize(event.target.value as TableSize | "all")}
          options={[
            { label: "Semua ukuran", value: "all" },
            { label: "7ft", value: "7ft" },
            { label: "8ft", value: "8ft" },
            { label: "9ft", value: "9ft" },
          ]}
        />
        <FormField
          kind="select"
          label="Kebutuhan"
          name="use-case"
          value={useCase}
          onChange={(event) => setUseCase(event.target.value)}
          options={[
            { label: "Semua", value: "all" },
            { label: "Rumah", value: "rumah" },
            { label: "Usaha / venue", value: "venue" },
            { label: "Custom", value: "custom" },
          ]}
        />
      </div>

      <p className="text-sm text-text-muted">Menampilkan {filtered.length} dari {products.length} pilihan meja.</p>

      <div className="grid gap-6 lg:grid-cols-3">
        {filtered.map((product) => (
          <ProductCard key={product.id} product={product} />
        ))}
      </div>
    </div>
  );
}
