import type { LeadSegment } from "@/types/lead";

const segmentCodes: Record<LeadSegment, string> = {
  home: "HOME",
  business: "BIZ",
  venue: "VENUE",
  accessories: "ACC",
};

function randomCode(length = 4) {
  const alphabet = "ABCDEFGHJKLMNPQRSTUVWXYZ23456789";
  let output = "";

  for (let index = 0; index < length; index += 1) {
    output += alphabet[Math.floor(Math.random() * alphabet.length)];
  }

  return output;
}

export function generateLeadId({
  segment,
  tableSize,
  tableCount,
}: {
  segment: LeadSegment;
  tableSize?: string;
  tableCount?: number;
}) {
  const middle = tableCount ? `${tableCount}T` : tableSize ? tableSize.toUpperCase() : "GEN";

  return `VB-${segmentCodes[segment]}-${middle}-${randomCode()}`;
}
