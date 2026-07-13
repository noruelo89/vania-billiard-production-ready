import type { MetadataRoute } from "next";
import { publicSiteUrl, shouldIndex } from "@/config/site";

const plannedRoutes = [
  "/",
  "/meja-billiard",
  "/untuk-rumah",
  "/untuk-usaha",
  "/buka-usaha-billiard",
  "/simulator-ruangan",
  "/hitung-kebutuhan-usaha",
  "/aksesoris",
  "/galeri",
  "/artikel",
  "/tentang",
  "/informasi-faq",
  "/kontak",
  "/kebijakan-privasi",
  "/syarat-ketentuan",
];

export default function sitemap(): MetadataRoute.Sitemap {
  if (!shouldIndex) {
    return [];
  }

  const lastModified = new Date();

  // Keep this route list synchronized as pages are implemented.
  return plannedRoutes.map((route) => ({
    url: new URL(route, publicSiteUrl).toString(),
    lastModified,
    changeFrequency: route === "/" ? "weekly" : "monthly",
    priority: route === "/" ? 1 : 0.7,
  }));
}
