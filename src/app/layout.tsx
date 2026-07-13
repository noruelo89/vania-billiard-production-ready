import type { Metadata } from "next";
import { buildPageMetadata } from "@/lib/seo";
import { siteConfig } from "@/config/site";
import "./globals.css";

export const metadata: Metadata = {
  ...buildPageMetadata(),
  title: {
    default: siteConfig.title,
    template: siteConfig.titleTemplate,
  },
  keywords: [
    "meja billiard",
    "harga meja billiard",
    "ukuran meja billiard",
    "simulator ruangan billiard",
    "buka usaha billiard",
    "aksesoris billiard",
  ],
  authors: [{ name: siteConfig.name }],
  creator: siteConfig.name,
};

export default function RootLayout({
  children,
}: Readonly<{
  children: React.ReactNode;
}>) {
  return (
    <html lang="id">
      <body className="min-h-screen antialiased">
        {children}
      </body>
    </html>
  );
}
