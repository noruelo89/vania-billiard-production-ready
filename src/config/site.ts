export type AppEnvironment = "development" | "preview" | "staging" | "production";

const envValue = process.env.NEXT_PUBLIC_ENVIRONMENT;

export const appEnvironment: AppEnvironment =
  envValue === "preview" || envValue === "staging" || envValue === "production"
    ? envValue
    : "development";

export const siteConfig = {
  name: "Vania Billiard",
  domain: "vaniabilliard.com",
  canonicalUrl: "https://vaniabilliard.com",
  previewUrl: "https://vania-billiard-website.vercel.app",
  locale: "id_ID",
  language: "id",
  title: "Vania Billiard - Rencanakan Meja dan Usaha Billiard",
  titleTemplate: "%s | Vania Billiard",
  description:
    "Hitung kebutuhan ruang, jumlah meja, kisaran modal, pilihan produk, dan perlengkapan sebelum membeli meja billiard untuk rumah atau usaha.",
  ogImage: "/og-image.jpg",
  environment: appEnvironment,
} as const;

export const publicSiteUrl =
  process.env.NEXT_PUBLIC_SITE_URL ||
  (appEnvironment === "production" ? siteConfig.canonicalUrl : siteConfig.previewUrl);

export const shouldIndex = appEnvironment === "production";
