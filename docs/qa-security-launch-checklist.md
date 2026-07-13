# QA, Security, Analytics, and Launch Checklist

Status: Phase 11 baseline checklist. This does not approve production launch by itself.

## Automated checks

Run before every production candidate:

```bash
npm run lint
npm run typecheck
npm run test
NEXT_TELEMETRY_DISABLED=1 npm run build
```

## SEO and indexing

- Production may index only when `NEXT_PUBLIC_ENVIRONMENT=production`.
- Preview and staging must stay `noindex, nofollow`.
- Sitemap must include only implemented routes.
- Canonical URL must use `https://vaniabilliard.com` only for production.
- Open Graph images still need final assets before public launch.

## Analytics

- GA4 ID must be configured in production only when ready.
- Do not send name, city, phone, or WhatsApp message text to analytics.
- Track high-level events only: product views, tool completion, lead generated, WhatsApp click, marketplace click.

## Lead capture

- Current MVP generates lead IDs and WhatsApp handoff.
- Supabase/database persistence is not yet connected.
- Production launch needs database decision: separate production project or approved fallback SOP.
- Rate limiting secret must be configured before public paid traffic.

## Security and privacy

- Keep `.env.local` and secrets out of Git.
- Service role keys must never use `NEXT_PUBLIC_`.
- Validate lead payload server-side.
- Policies are present as baseline pages but need business review.

## Content risks

- Product prices use "mulai dari".
- Product detail pages avoid publishing unverified final specs.
- Some existing product/accessory data may still contain seed claims and must be business-verified before production domain launch.
- Do not connect `vaniabilliard.com` until final product names, prices, images, marketplace links, and policies are approved.

## Manual QA

- Mobile: homepage, simulator, estimator, catalog, product detail, lead form.
- Desktop: navigation, filters, cards, sticky/floating CTAs.
- Forms: valid lead, invalid lead, WhatsApp handoff opens correct number.
- SEO: robots, sitemap, title/description, noindex behavior.
- Browser: Chrome, Safari/WebKit where possible.

## Rollback

- Keep last good Vercel deployment available.
- Do not change domain DNS without backing up existing MX, SPF, DKIM, DMARC, and TXT records.
