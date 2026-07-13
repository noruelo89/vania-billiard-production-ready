export type ContentPillar = "tables" | "room-size" | "business-planning" | "accessories";

export interface ArticleMeta {
  slug: string;
  title: string;
  description: string;
  pillar: ContentPillar;
  updatedAt: string;
  reviewer: string;
  primaryCta: {
    label: string;
    href: string;
  };
}

export interface FaqItem {
  question: string;
  answer: string;
}
