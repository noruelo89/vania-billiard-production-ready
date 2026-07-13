import type { MetadataRoute } from "next";
import { publicSiteUrl, shouldIndex } from "@/config/site";
import { accessories } from "@/data/accessories";
import { products } from "@/data/products";

const implementedRoutes = [
  "/",
  "/meja-billiard",
  "/simulator-ruangan",
  "/hitung-kebutuhan-usaha",
  "/aksesoris",
];

export default function sitemap(): MetadataRoute.Sitemap {
  if (!shouldIndex) {
    return [];
  }

  const lastModified = new Date();
  const productRoutes = products.map((product) => `/meja-billiard/${product.slug}`);
  const accessoryRoutes = accessories.map((accessory) => `/aksesoris/${accessory.slug}`);
  const routes = [...implementedRoutes, ...productRoutes, ...accessoryRoutes];

  return routes.map((route) => ({
    url: new URL(route, publicSiteUrl).toString(),
    lastModified,
    changeFrequency: route === "/" ? "weekly" : "monthly",
    priority: route === "/" ? 1 : route === "/meja-billiard" ? 0.8 : 0.7,
  }));
}
