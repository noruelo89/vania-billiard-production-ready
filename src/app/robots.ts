import type { MetadataRoute } from "next";
import { publicSiteUrl, shouldIndex } from "@/config/site";

export default function robots(): MetadataRoute.Robots {
  if (!shouldIndex) {
    return {
      rules: {
        userAgent: "*",
        disallow: "/",
      },
    };
  }

  return {
    rules: {
      userAgent: "*",
      allow: "/",
    },
    sitemap: `${publicSiteUrl}/sitemap.xml`,
  };
}
