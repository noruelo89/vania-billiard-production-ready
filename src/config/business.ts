export const businessConfig = {
  positioning:
    "Partner konsultasi dan persiapan sebelum membeli meja billiard atau membuka usaha billiard.",
  focusRatio: {
    tables: 70,
    accessories: 30,
  },
  whatsapp: {
    table: {
      label: "Konsultasi Meja",
      display: "+62 822-4154-5326",
      number: process.env.NEXT_PUBLIC_WHATSAPP_TABLE || "6282241545326",
    },
    accessories: {
      label: "Tanya Aksesoris",
      display: "+62 851-8230-6565",
      number: process.env.NEXT_PUBLIC_WHATSAPP_ACCESSORIES || "6285182306565",
    },
  },
  marketplace: {
    shopee: process.env.NEXT_PUBLIC_SHOPEE_URL || "#",
    tiktokShop: process.env.NEXT_PUBLIC_TIKTOK_SHOP_URL || "#",
    other: process.env.NEXT_PUBLIC_OTHER_MARKETPLACE_URL || "#",
  },
  mapsUrl: process.env.NEXT_PUBLIC_GOOGLE_MAPS_URL || "#",
  priceDisclaimer:
    "Harga dapat menyesuaikan ukuran, material, laken, aksesoris, pengiriman, pemasangan, dan custom request.",
  unsupportedClaims: [
    "Produsen terbesar",
    "Nomor satu di Indonesia",
    "Paling murah",
    "Distributor resmi semua merek",
    "Kualitas turnamen internasional tanpa bukti",
    "Semua produk diproduksi sendiri",
    "Pasti untung",
    "BEP terjamin",
    "Semua ruangan pasti cocok",
  ],
} as const;
