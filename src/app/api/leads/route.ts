import { NextResponse } from "next/server";
import { captureLead, normalizeLeadPayload, validateLead } from "@/lib/leads";
import { waLeadLink } from "@/lib/whatsapp";

export async function POST(request: Request) {
  try {
    const payload = (await request.json()) as Record<string, unknown>;
    const input = normalizeLeadPayload(payload);
    const validation = validateLead(input);

    if (!validation.ok) {
      return NextResponse.json({ ok: false, errors: validation.errors }, { status: 400 });
    }

    const lead = captureLead(input);

    // MVP stores no private data unless database credentials are configured in a later integration.
    // The lead ID is still returned so WhatsApp handoff can be measured and reconciled manually.
    return NextResponse.json({
      ok: true,
      lead,
      whatsappUrl: waLeadLink(lead.id, lead),
    });
  } catch {
    return NextResponse.json(
      { ok: false, errors: { form: "Payload lead tidak valid." } },
      { status: 400 }
    );
  }
}
