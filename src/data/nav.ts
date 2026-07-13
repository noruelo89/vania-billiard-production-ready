import { businessConfig } from "@/config/business";

export interface NavItem {
  label: string;
  href: string;
  children?: NavItem[];
}

export const mainNav: NavItem[] = [
  { label: "Home", href: "/" },
  { label: "Meja Billiard", href: "/meja-billiard" },
  { label: "Untuk Rumah", href: "/untuk-rumah" },
  { label: "Untuk Usaha", href: "/untuk-usaha" },
  { label: "Simulator", href: "/simulator-ruangan" },
  { label: "Aksesoris", href: "/aksesoris" },
  { label: "Artikel", href: "/artikel" },
  { label: "Tentang", href: "/tentang" },
  { label: "Kontak", href: "/kontak" },
];

export const mobileNav: NavItem[] = [
  { label: "Home", href: "/" },
  { label: "Meja", href: "/meja-billiard" },
  { label: "Usaha", href: "/untuk-usaha" },
  { label: "Simulator", href: "/simulator-ruangan" },
  { label: "Aksesoris", href: "/aksesoris" },
  { label: "Kontak", href: "/kontak" },
];

export const footerNav = {
  produk: [
    { label: "Meja 7ft", href: "/meja-billiard/meja-billiard-7ft" },
    { label: "Meja 8ft", href: "/meja-billiard/meja-billiard-8ft" },
    { label: "Abimanyu Gen 2", href: "/meja-billiard/abimanyu-gen-2" },
    { label: "Abimanyu Gen 5 Pro", href: "/meja-billiard/abimanyu-gen-5-pro" },
    { label: "Abimanyu Prime", href: "/meja-billiard/abimanyu-prime" },
    { label: "Custom", href: "/meja-billiard/custom" },
    { label: "Kain Laken", href: "/aksesoris/laken" },
    { label: "Stick Billiard", href: "/aksesoris/stick" },
  ],
  informasi: [
    { label: "Untuk Rumah", href: "/untuk-rumah" },
    { label: "Untuk Usaha", href: "/untuk-usaha" },
    { label: "Buka Usaha Billiard", href: "/buka-usaha-billiard" },
    { label: "Simulator Ruangan", href: "/simulator-ruangan" },
    { label: "Hitung Kebutuhan Usaha", href: "/hitung-kebutuhan-usaha" },
    { label: "Galeri", href: "/galeri" },
    { label: "Artikel", href: "/artikel" },
    { label: "FAQ", href: "/informasi-faq" },
  ],
  bantuan: [
    { label: "Konsultasi Meja", href: `https://wa.me/${businessConfig.whatsapp.table.number}` },
    { label: "Tanya Aksesoris", href: `https://wa.me/${businessConfig.whatsapp.accessories.number}` },
    { label: "Kontak", href: "/kontak" },
    { label: "Kebijakan Privasi", href: "/kebijakan-privasi" },
    { label: "Syarat & Ketentuan", href: "/syarat-ketentuan" },
  ],
};

export const marketplaceLinks = [
  { label: "Shopee", href: businessConfig.marketplace.shopee, icon: "shopee" },
  { label: "TikTok Shop", href: businessConfig.marketplace.tiktokShop, icon: "tiktok" },
  { label: "Marketplace Lain", href: businessConfig.marketplace.other, icon: "link" },
] as const;

export const socialLinks: {
  label: string;
  href: string;
  icon: "instagram" | "tiktok" | "facebook" | "youtube";
}[] = [
  { label: "Instagram", href: "https://instagram.com/vaniabilliard", icon: "instagram" },
  { label: "TikTok", href: "https://tiktok.com/@vaniabilliard", icon: "tiktok" },
  { label: "Facebook", href: "https://facebook.com/vaniabilliard", icon: "facebook" },
  { label: "YouTube", href: "https://youtube.com/@vaniabilliard", icon: "youtube" },
];
