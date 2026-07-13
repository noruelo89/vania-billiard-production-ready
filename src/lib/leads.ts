import type { LeadInput, LeadSegment, LeadSource } from "@/types/lead";
import { generateLeadId } from "@/lib/lead-id";

export interface CapturedLead extends LeadInput {
  id: string;
  status: "Captured";
  createdAt: string;
}

export interface LeadValidationResult {
  ok: boolean;
  errors: Record<string, string>;
}

const validSegments: LeadSegment[] = ["home", "business", "venue", "accessories"];
const validSources: LeadSource[] = ["organic", "social", "paid", "direct", "referral", "website", "website-tool", "unknown"];

function cleanText(value: unknown) {
  return typeof value === "string" ? value.trim().slice(0, 160) : undefined;
}

function cleanSource(value: unknown): LeadSource {
  const source = cleanText(value) as LeadSource | undefined;
  return source && validSources.includes(source) ? source : "website";
}

export function normalizeLeadPayload(payload: Record<string, unknown>): LeadInput {
  const segment = cleanText(payload.segment) as LeadSegment | undefined;
  const tableCountText = cleanText(payload.tableCount);
  const numberOfTables = tableCountText ? Number.parseInt(tableCountText, 10) : undefined;

  return {
    name: cleanText(payload.name) || "",
    city: cleanText(payload.city) || "",
    segment: segment && validSegments.includes(segment) ? segment : "home",
    roomSize: cleanText(payload.roomSize),
    numberOfTables: Number.isFinite(numberOfTables) ? numberOfTables : undefined,
    budget: cleanText(payload.budget),
    timeline: cleanText(payload.timeline),
    productInterest: cleanText(payload.productInterest),
    attribution: {
      source: cleanSource(payload.source),
      campaign: cleanText(payload.campaign),
    },
  };
}

export function validateLead(input: LeadInput): LeadValidationResult {
  const errors: Record<string, string> = {};
  if (!input.name || input.name.length < 2) errors.name = "Nama wajib diisi.";
  if (!input.city || input.city.length < 2) errors.city = "Kota wajib diisi.";
  if (!validSegments.includes(input.segment)) errors.segment = "Segment tidak valid.";
  return { ok: Object.keys(errors).length === 0, errors };
}

export function captureLead(input: LeadInput): CapturedLead {
  return {
    ...input,
    id: generateLeadId({ segment: input.segment, tableCount: input.numberOfTables }),
    status: "Captured",
    createdAt: new Date().toISOString(),
  };
}
