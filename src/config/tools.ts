export type TableSize = "7ft" | "8ft" | "9ft";

export const tableDimensions = {
  "7ft": { label: "7ft", lengthCm: 213, widthCm: 107 },
  "8ft": { label: "8ft", lengthCm: 254, widthCm: 127 },
  "9ft": { label: "9ft", lengthCm: 284, widthCm: 142 },
} as const;

export const simulatorAssumptions = {
  defaultCueLengthCm: 145,
  comfortableClearanceCm: 150,
  limitedClearanceCm: 120,
  defaultCirculationCm: 90,
  defaultSupportingAreaRatio: 0.18,
  disclaimer:
    "Hasil simulator adalah rekomendasi awal. Layout final, pengiriman, pemasangan, dan konfigurasi perlu dikonfirmasi lewat konsultasi.",
} as const;

export function getRecommendedRoom(size: TableSize) {
  const table = tableDimensions[size];
  const clearance = simulatorAssumptions.comfortableClearanceCm * 2;

  return {
    lengthCm: table.lengthCm + clearance,
    widthCm: table.widthCm + clearance,
  };
}
