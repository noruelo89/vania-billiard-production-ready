export type LeadSegment = "home" | "business" | "venue" | "accessories";
export type LeadSource = "organic" | "social" | "paid" | "direct" | "referral" | "unknown";

export type LeadStatus =
  | "Captured"
  | "WhatsApp Opened"
  | "Handed Off"
  | "Acknowledged"
  | "Qualified"
  | "Quotation Sent"
  | "Won"
  | "Lost"
  | "Outcome Unknown";

export interface LeadAttribution {
  source: LeadSource;
  campaign?: string;
  utmSource?: string;
  utmMedium?: string;
  utmCampaign?: string;
  landingPage?: string;
  referrer?: string;
}

export interface LeadInput {
  name?: string;
  city?: string;
  segment: LeadSegment;
  roomSize?: string;
  numberOfTables?: number;
  budget?: string;
  timeline?: string;
  productInterest?: string;
  phone?: string;
  attribution: LeadAttribution;
}

export interface LeadRecord extends LeadInput {
  id: string;
  status: LeadStatus;
  createdAt: string;
}
