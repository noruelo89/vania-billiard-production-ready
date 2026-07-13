import { businessConfig } from "@/config/business";
import type { LeadInput } from "@/types/lead";

export const WA = {
  meja: businessConfig.whatsapp.table.number,
  aksesoris: businessConfig.whatsapp.accessories.number,
  displayMeja: businessConfig.whatsapp.table.display,
  displayAksesoris: businessConfig.whatsapp.accessories.display,
} as const;

const MESSAGES = {
  tableGeneral:
    "Halo Vania Billiard, saya ingin konsultasi meja billiard.\n\nProduk diminati: [Nama Produk]\n\nMohon rekomendasi meja, konfigurasi, pengiriman, dan langkah selanjutnya.",
  accessoriesGeneral:
    "Halo Vania Billiard, saya ingin tanya stok dan harga untuk [Nama Aksesoris].",
  simulator:
    "Halo Vania Billiard, saya sudah mencoba simulator ruangan.\n\nUkuran ruangan saya:\nPanjang: [x] meter\nLebar: [y] meter\nMeja yang saya coba: [7ft/8ft/9ft]\n\nMohon rekomendasi ukuran meja yang paling cocok.",
  consultation: "Halo Vania Billiard, saya ingin konsultasi meja billiard.",
} as const;

export function buildWaUrl(number: string, message: string): string {
  const encoded = encodeURIComponent(message);
  return `https://wa.me/${number}?text=${encoded}`;
}

export function buildLeadWaMessage(leadId: string, lead: LeadInput) {
  return [
    "Halo Vania Billiard, saya ingin konsultasi meja billiard.",
    "",
    `Kode konsultasi: ${leadId}`,
    `Kebutuhan: ${lead.segment}`,
    `Ukuran ruangan: ${lead.roomSize || "Belum diisi"}`,
    `Jumlah meja: ${lead.numberOfTables || "Belum diisi"}`,
    "Ukuran meja: Belum dipilih",
    `Budget: ${lead.budget || "Belum diisi"}`,
    `Kota: ${lead.city || "Belum diisi"}`,
    `Produk diminati: ${lead.productInterest || "Belum diisi"}`,
    `Sumber: ${lead.attribution.source}`,
    "",
    "Mohon rekomendasi meja, konfigurasi, pengiriman, dan langkah selanjutnya.",
  ].join("\n");
}

export const waTableLink = (productName = "meja billiard") =>
  buildWaUrl(WA.meja, MESSAGES.tableGeneral.replace("[Nama Produk]", productName));

export const waAccessoriesLink = (accessoryName = "aksesoris billiard") =>
  buildWaUrl(WA.aksesoris, MESSAGES.accessoriesGeneral.replace("[Nama Aksesoris]", accessoryName));

export const waSimulatorLink = (params: { length: number; width: number; size: string }) =>
  buildWaUrl(
    WA.meja,
    MESSAGES.simulator
      .replace("[x]", String(params.length))
      .replace("[y]", String(params.width))
      .replace("[7ft/8ft/9ft]", params.size)
  );

export const waConsultationLink = () => buildWaUrl(WA.meja, MESSAGES.consultation);

export const waLeadLink = (leadId: string, lead: LeadInput) =>
  buildWaUrl(
    lead.segment === "accessories" ? WA.aksesoris : WA.meja,
    buildLeadWaMessage(leadId, lead)
  );
