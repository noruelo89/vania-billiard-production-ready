import { simulatorAssumptions, tableDimensions, type TableSize } from "@/config/tools";

export type FitStatus = "comfortable" | "limited" | "not-recommended";

export interface RoomSimulatorInput {
  lengthM: number;
  widthM: number;
  tableSize: TableSize;
  cueLengthCm?: number;
}

export interface RoomSimulatorResult {
  status: FitStatus;
  tableLengthCm: number;
  tableWidthCm: number;
  roomLengthCm: number;
  roomWidthCm: number;
  clearanceLengthCm: number;
  clearanceWidthCm: number;
  comfortableLengthCm: number;
  comfortableWidthCm: number;
  limitedLengthCm: number;
  limitedWidthCm: number;
  message: string;
}

export interface TableCountInput {
  lengthM: number;
  widthM: number;
  tableSize: TableSize;
  circulationCm?: number;
  supportingAreaRatio?: number;
}

export interface TableCountResult {
  estimatedCount: number;
  usableAreaM2: number;
  footprintPerTableM2: number;
  assumptions: string[];
  limitations: string[];
}

function toCentimeters(valueM: number) {
  return Math.max(0, Math.round(valueM * 100));
}

export function simulateRoom(input: RoomSimulatorInput): RoomSimulatorResult {
  const table = tableDimensions[input.tableSize];
  const cueLength = input.cueLengthCm || simulatorAssumptions.defaultCueLengthCm;
  const roomLengthCm = toCentimeters(input.lengthM);
  const roomWidthCm = toCentimeters(input.widthM);
  const clearanceLengthCm = Math.floor((roomLengthCm - table.lengthCm) / 2);
  const clearanceWidthCm = Math.floor((roomWidthCm - table.widthCm) / 2);
  const comfortableLengthCm = table.lengthCm + simulatorAssumptions.comfortableClearanceCm * 2;
  const comfortableWidthCm = table.widthCm + simulatorAssumptions.comfortableClearanceCm * 2;
  const limitedLengthCm = table.lengthCm + simulatorAssumptions.limitedClearanceCm * 2;
  const limitedWidthCm = table.widthCm + simulatorAssumptions.limitedClearanceCm * 2;

  const comfortable = roomLengthCm >= comfortableLengthCm && roomWidthCm >= comfortableWidthCm;
  const limited = roomLengthCm >= limitedLengthCm && roomWidthCm >= limitedWidthCm;
  const cueSafe = clearanceLengthCm >= cueLength && clearanceWidthCm >= cueLength;

  let status: FitStatus = "not-recommended";
  let message = "Ruangan belum direkomendasikan untuk ukuran meja ini.";

  if (comfortable && cueSafe) {
    status = "comfortable";
    message = "Ruangan relatif nyaman untuk ukuran meja ini berdasarkan clearance awal.";
  } else if (limited) {
    status = "limited";
    message = "Ruangan masih mungkin, tetapi clearance terbatas dan perlu dikonfirmasi lewat layout final.";
  }

  return {
    status,
    tableLengthCm: table.lengthCm,
    tableWidthCm: table.widthCm,
    roomLengthCm,
    roomWidthCm,
    clearanceLengthCm,
    clearanceWidthCm,
    comfortableLengthCm,
    comfortableWidthCm,
    limitedLengthCm,
    limitedWidthCm,
    message,
  };
}

export function estimateTableCount(input: TableCountInput): TableCountResult {
  const table = tableDimensions[input.tableSize];
  const circulation = input.circulationCm || simulatorAssumptions.defaultCirculationCm;
  const supportingRatio = input.supportingAreaRatio ?? simulatorAssumptions.defaultSupportingAreaRatio;
  const roomAreaM2 = Math.max(0, input.lengthM * input.widthM);
  const usableAreaM2 = roomAreaM2 * (1 - supportingRatio);
  const footprintLengthM = (table.lengthCm + circulation * 2) / 100;
  const footprintWidthM = (table.widthCm + circulation * 2) / 100;
  const footprintPerTableM2 = footprintLengthM * footprintWidthM;
  const estimatedCount = Math.max(0, Math.floor(usableAreaM2 / footprintPerTableM2));

  return {
    estimatedCount,
    usableAreaM2: Number(usableAreaM2.toFixed(1)),
    footprintPerTableM2: Number(footprintPerTableM2.toFixed(1)),
    assumptions: [
      `Sirkulasi awal ${circulation} cm di setiap sisi meja.`,
      `Area pendukung dipotong sekitar ${Math.round(supportingRatio * 100)}%.`,
      `Ukuran meja ${input.tableSize}: ${table.lengthCm} x ${table.widthCm} cm.`,
    ],
    limitations: [
      "Belum memperhitungkan kolom, pintu, toilet, kasir, sofa, dan bentuk ruangan tidak beraturan.",
      "Hasil bukan layout final dan tidak menjamin semua meja nyaman dipakai.",
    ],
  };
}
