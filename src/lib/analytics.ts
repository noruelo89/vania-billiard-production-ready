export type AnalyticsEventName =
  | "view_item"
  | "view_item_list"
  | "product_filter"
  | "simulator_start"
  | "simulator_complete"
  | "table_count_start"
  | "table_count_complete"
  | "recommendation_start"
  | "recommendation_complete"
  | "generate_lead"
  | "whatsapp_click"
  | "marketplace_click"
  | "article_cta_click"
  | "qualify_lead"
  | "close_convert_lead"
  | "close_unconvert_lead";

type AnalyticsPayload = Record<string, string | number | boolean | null | undefined>;

declare global {
  interface Window {
    gtag?: (command: "event", eventName: string, payload?: AnalyticsPayload) => void;
  }
}

export function trackEvent(eventName: AnalyticsEventName, payload: AnalyticsPayload = {}) {
  if (typeof window === "undefined" || !window.gtag) {
    return;
  }

  // Never pass personal data here. Lead details belong in the lead database only.
  window.gtag("event", eventName, payload);
}
