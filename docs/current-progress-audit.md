# Current Progress Audit - Vania Billiard Website

Audit date: 2026-07-13
Repo: `/home/hermes_research/vania-billiard-website`
Live preview: `https://vania-billiard-website.vercel.app`
Latest observed commit: `3ca17d9 v1.2: Animation & polish pass`

## 1. Executive Assessment

The current project is a strong v1.2 homepage/visual prototype. It should be kept as the visual base, but it is not yet the PRD v3.1 MVP.

Current maturity:

```text
Visual prototype: strong
Homepage preview: partial
Business funnel: missing
Decision tools: missing
Lead capture: missing
SEO/content hub: missing
Production readiness: early
```

Best next move: keep the visual system, then rebuild the architecture and funnel around PRD v3.1.

## 2. Existing Project Inventory

### App

- `src/app/layout.tsx` - root layout, fonts, metadata.
- `src/app/page.tsx` - single homepage assembly.
- `src/app/globals.css` - Tailwind v4 theme and animations.

### Layout Components

- `src/components/layout/Navbar.tsx`
- `src/components/layout/MobileMenu.tsx`
- `src/components/layout/Footer.tsx`
- `src/components/layout/FloatingWA.tsx`

### Homepage Sections

- `src/components/sections/Hero.tsx`
- `src/components/sections/TrustBadges.tsx`
- `src/components/sections/BigQuote.tsx`
- `src/components/sections/FeaturedTables.tsx`
- `src/components/sections/TableSelectionGuide.tsx`
- `src/components/sections/SimulatorTeaser.tsx`
- `src/components/sections/AccessoriesCategories.tsx`
- `src/components/sections/WhyChooseVania.tsx`
- `src/components/sections/GalleryPreview.tsx`
- `src/components/sections/ShippingProof.tsx`
- `src/components/sections/ArticlesPreview.tsx`
- `src/components/sections/FAQPreview.tsx`
- `src/components/sections/FinalCTA.tsx`

### UI Components

- `src/components/ui/Button.tsx`
- `src/components/ui/ProductCard.tsx`
- `src/components/ui/Reveal.tsx`
- `src/components/ui/SectionHeading.tsx`
- `src/components/ui/SocialIcon.tsx`

### Data and Utils

- `src/data/products.ts`
- `src/data/accessories.ts`
- `src/data/articles.ts`
- `src/data/faqs.ts`
- `src/data/nav.ts`
- `src/lib/whatsapp.ts`

## 3. Keep / Refactor / Rewrite Matrix

| Area | Current state | Decision | Notes |
|---|---|---|---|
| Visual direction | Premium dark + copper already aligned | Keep | Good base for PRD v3.1. |
| Fonts | Playfair + Inter + IBM Plex Mono | Keep/refine | PRD suggests Playfair/Cormorant for heading and Inter/Geist/Plus Jakarta for body. Current is acceptable. |
| Navbar/mobile menu | Exists | Refactor | Needs final IA links and environment-safe routes. |
| Footer | Exists | Refactor | Needs policy links, marketplace, social, contact, no unsupported claims. |
| Floating WA | Exists | Refactor | Needs table/accessories chooser plus lead-aware message. |
| Homepage sections | Exists | Reorder/refactor | Must follow PRD section order and positioning. |
| Product data | Exists | Audit heavily | Contains specs that may be fabricated/unsupported. Must verify or remove. |
| Product card | Exists | Keep/refactor | Useful for catalog and featured tables. |
| Articles data | Exists | Refactor | Needs pillar structure, updated date, reviewer, direct answer, CTA mapping. |
| Accessories data | Exists | Refactor | Needs category hub and marketplace tracking. |
| WhatsApp helper | Exists | Rewrite | Needs centralized config, lead ID, PRD message template, source/campaign fields. |
| Metadata | Exists | Rewrite | Currently always indexable and uses production canonical. Preview/staging must be noindex. |
| Tests/check scripts | Missing | Add | Required by PRD. |
| Lead capture | Missing | Build | Core PRD requirement. |
| Simulator/calculators | Missing | Build | Core PRD differentiator. |
| Routes | Mostly missing | Build | Current app has only homepage. |
| Analytics | Missing | Build | Required for funnel tracking. |
| Supabase/API | Missing | Build/defer adapter | Lead endpoint required; DB can be Supabase or adapter initially. |

## 4. PRD v3.1 Gap Analysis

### Phase 0 - Business and Data Readiness

Status: partial.

Present:

- Product lineup exists in `src/data/products.ts`.
- WhatsApp numbers exist in `src/lib/whatsapp.ts`.
- Accessories/articles/FAQ seed data exists.

Gaps:

- Product specs are not verified and may violate the PRD rule against fabricated specs.
- Missing formal lead fields document.
- Missing missing-data register.
- Missing simulator assumptions document.
- Missing claims review.

Action:

- Freeze/audit data before building product pages.

### Phase 1 - Project Foundation

Status: partial.

Present:

- Next.js App Router.
- TypeScript.
- Tailwind.
- Basic metadata.
- Vercel deployment.

Gaps:

- No central config.
- No sitemap/robots implementation.
- No environment-aware noindex.
- No analytics wrapper.
- No lead model.
- No lint/typecheck/test scripts.
- No `.env.example`.

Action:

- Do this before feature expansion.

### Phase 2 - Design System and Navigation

Status: partial-to-good.

Present:

- Navbar, mobile menu, footer, buttons, product card, reveal animation, section heading.

Gaps:

- Missing form components.
- Missing result panels.
- Missing lead capture modal/page patterns.
- Missing mobile sticky CTA formal pattern.
- Navigation does not yet map to all PRD routes.

Action:

- Refactor existing components into PRD-ready primitives.

### Phase 3 - Homepage

Status: partial.

Present:

- Strong homepage visuals and many relevant sections.

Gaps:

- Section order differs from PRD.
- Need selector and quick assessment are not implemented as specified.
- Copy still leans company profile/premium product more than decision partner.
- CTA tracking not implemented.

Action:

- Rebuild homepage sequence using existing visual blocks.

### Phase 4 - Room Simulator and Table-Count Estimator

Status: missing.

Present:

- `SimulatorTeaser` only.

Gaps:

- No `/simulator-ruangan` route.
- No `/hitung-kebutuhan-usaha` route.
- No calculations, status, visual room, lead CTA.

Action:

- Build after foundation/config.

### Phase 5 - Table Catalog and Product Pages

Status: missing.

Present:

- Product data and cards.

Gaps:

- No `/meja-billiard` catalog.
- No `/meja-billiard/[slug]` pages.
- No filters/search.
- No product schema.
- No verified specs discipline.

Action:

- Build only after product data audit.

### Phase 6 - Lead Capture and Attribution

Status: missing.

Present:

- WhatsApp links only.

Gaps:

- No lead form.
- No lead ID.
- No database/API.
- No UTM/source capture.
- No lead statuses.
- WhatsApp opens without saved lead context.

Action:

- Core MVP requirement; prioritize after tools.

### Phase 7 - Accessories Hub

Status: partial preview only.

Present:

- Accessories categories section.

Gaps:

- No `/aksesoris` page.
- No `/aksesoris/[slug]` pages.
- No marketplace tracking.
- No recurring/venue maintenance content links.

Action:

- Build after table funnel basics.

### Phase 8 - Trust and Business Pages

Status: mostly missing.

Present:

- Gallery/shipping/about-ish preview sections.

Gaps:

- No `/untuk-rumah`, `/untuk-usaha`, `/buka-usaha-billiard`, `/galeri`, `/tentang`, `/informasi-faq`, `/kontak`, policy pages.

Action:

- Build unique intent pages; avoid duplicated thin pages.

### Phase 9 - Articles, SEO, and AI Search

Status: missing system, partial seed.

Present:

- Article preview and static article data.

Gaps:

- No article index/detail routes.
- No pillar model.
- No direct answer/key takeaways/updated/reviewer fields.
- No schema/internal linking strategy.

Action:

- Build content system after core funnel routes.

### Phase 10 - Capital Estimator MVP-Plus

Status: not started.

Action:

- Defer until core MVP is validated.

### Phase 11 - Analytics, QA, Security, Accessibility, Performance

Status: early.

Present:

- Some visual QA was done in past session.
- Build previously passed.

Gaps:

- No analytics events.
- No lead endpoint protection.
- No formal accessibility/performance report.
- No secret scan process.

Action:

- Add continuously, finalize before launch.

### Phase 12 - Deployment and Handover

Status: preview only.

Present:

- Vercel preview/live URL exists.
- GitHub repo exists.

Gaps:

- No staging branch flow.
- No production readiness checklist doc in repo.
- No domain DNS inventory.
- Domain not connected, correctly deferred.

Action:

- Keep using Vercel preview until readiness passes.

## 5. High-Risk Issues Found

### Product specs may be unsupported

`src/data/products.ts` includes specific materials, slate thickness, cloth claims, finishing, and warranty. PRD says no fabricated specs. These must be verified or removed before product detail pages go live.

Examples of claims needing verification:

- `Kayu Jati grade A`
- `Slate 1pc 30mm`
- `Simonis grade`
- `presisi +/-0.1mm`
- warranty duration

### Metadata indexes preview as production

`src/app/layout.tsx` currently uses `metadataBase: https://vaniabilliard.com` and `robots.index: true` globally. This conflicts with PRD v3.1 because preview/staging must be noindex and should not use production canonical incorrectly.

### WhatsApp opens before lead capture

`src/lib/whatsapp.ts` builds direct WA messages without stored lead context. PRD requires capturing lead data before WhatsApp handoff where relevant.

### Scripts are incomplete

`package.json` only has `dev`, `build`, and `start`. PRD requires lint, typecheck, tests, and build checks.

## 6. Recommended Immediate Changes

Priority order:

1. Add docs and central config.
2. Fix environment-aware metadata/noindex.
3. Add lint/typecheck/test scripts.
4. Refactor product data to separate verified vs placeholder fields.
5. Rebuild homepage to PRD order.
6. Build room simulator route.
7. Build lead capture + lead ID.
8. Build catalog/product pages.

## 7. Reusable Assets

Reusable without major concern:

- Visual palette and animation direction.
- `Button`, `Reveal`, `SectionHeading`, `SocialIcon`.
- Most layout styling patterns.
- AI-generated images for preview only.

Reusable with refactor:

- `Navbar`, `MobileMenu`, `Footer`, `FloatingWA`.
- `ProductCard`.
- Homepage sections.
- Accessories/articles/FAQ data.

Do not trust without verification:

- Product specs.
- Product claims.
- Warranty statements.
- Performance/precision claims.
- Any claim implying official distributor/manufacturer/turnamen quality.

## 8. Next Implementation Sprint

Recommended sprint: Phase 1 foundation alignment.

Concrete tasks:

- Create `src/config/site.ts`, `src/config/business.ts`, `src/config/tools.ts`.
- Create `src/types/product.ts`, `src/types/lead.ts`, `src/types/content.ts`.
- Move WhatsApp numbers and price disclaimer into config.
- Add `.env.example`.
- Add `src/lib/seo.ts` with environment-aware `shouldIndex`.
- Add `src/app/robots.ts` and `src/app/sitemap.ts`.
- Update `src/app/layout.tsx` to avoid indexing preview/staging.
- Add `lint`, `typecheck`, and `test` scripts.
- Update README to point to `docs/development-plan-v4.md`.
