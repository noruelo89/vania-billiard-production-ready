import type { MetadataRoute } from "next";
import { publicSiteUrl, shouldIndex } from "@/config/site";
import { products } from "@/data/products";

const implementedRoutes = [
  "/",
  "/meja-billiard",
  "/simulator-ruangan",
  "/hitung-kebutuhan-usaha",
];

export default function sitemap(): MetadataRoute.Sitemap {
  if (!shouldIndex) {
    return [];
  }

  const lastModified = new Date();
  const productRoutes = products.map((product) => `/meja-billiard/${product.slug}`);
  const routes = [...implementedRoutes, ...productRoutes];

  return routes.map((route) => ({
    url: new URL(route, publicSiteUrl).toString(),
    lastModified,
    changeFrequency: route === "/" ? "weekly" : "monthly",
    priority: route === "/" ? 1 : route === "/meja-billiard" ? 0.8 : 0.7,
  }));
}
