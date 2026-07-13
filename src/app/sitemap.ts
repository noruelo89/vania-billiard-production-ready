import type { MetadataRoute } from "next";
import { publicSiteUrl, shouldIndex } from "@/config/site";
import { accessories } from "@/data/accessories";
import { articles } from "@/data/articles";
import { products } from "@/data/products";

const implementedRoutes = [
  "/",
  "/meja-billiard",
  "/simulator-ruangan",
  "/hitung-kebutuhan-usaha",
  "/estimasi-modal-usaha",
  "/aksesoris",
  "/artikel",
  "/galeri",
  "/tentang",
  "/informasi-faq",
  "/kontak",
  "/kebijakan-privasi",
  "/syarat-ketentuan",
  "/untuk-rumah",
  "/untuk-usaha",
  "/buka-usaha-billiard",
];

export default function sitemap(): MetadataRoute.Sitemap {
  if (!shouldIndex) {
    return [];
  }

  const lastModified = new Date();
  const productRoutes = products.map((product) => `/meja-billiard/${product.slug}`);
  const accessoryRoutes = accessories.map((accessory) => `/aksesoris/${accessory.slug}`);
  const articleRoutes = articles.map((article) => `/artikel/${article.slug}`);
  const routes = [...implementedRoutes, ...productRoutes, ...accessoryRoutes, ...articleRoutes];

  return routes.map((route) => ({
    url: new URL(route, publicSiteUrl).toString(),
    lastModified,
    changeFrequency: route === "/" ? "weekly" : "monthly",
    priority: route === "/" ? 1 : route === "/meja-billiard" ? 0.8 : 0.7,
  }));
}
