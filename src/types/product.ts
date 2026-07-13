import type { TableSize } from "@/config/tools";

export type ProductSeries = "standard" | "abimanyu" | "custom";
export type ProductUseCase = "home" | "business" | "venue";
export type ProductVerification = "verified" | "placeholder" | "unknown";

export interface ProductSpec {
  label: string;
  value: string;
  verification: ProductVerification;
}

export interface TableProduct {
  id: string;
  slug: string;
  name: string;
  series: ProductSeries;
  tagline: string;
  startingPrice: number | null;
  priceNote: string;
  sizes: TableSize[];
  useCases: ProductUseCase[];
  featured: boolean;
  recommended?: boolean;
  positioning: string;
  highlights: string[];
  specs: ProductSpec[];
}

export interface AccessoryProduct {
  id: string;
  slug: string;
  name: string;
  category: string;
  summary: string;
  marketplaceEligible: boolean;
}
