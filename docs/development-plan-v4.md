# Vania Billiard Website - Development Plan v4

Source PRD: `PRD FINAL v3.1 - Vania Billiard Website`
Status: planning baseline for rebuilding the current v1.2 preview into the PRD-aligned MVP.

## 1. North Star

Build Vania Billiard as a premium Indonesian billiard decision platform, not just a company profile.

Primary formula:

```text
70% table sales engine
+ 30% accessories commerce hub
+ decision tools
+ SEO
+ lead data
+ WhatsApp consultation
```

Primary conversion path:

```text
Search/social visitor
-> educational page or homepage
-> decision tool
-> semi-gated lead capture
-> lead ID
-> WhatsApp handoff
-> sales follow-up
```

## 2. Current Baseline

The existing repo is a v1.2 visual homepage preview.

Already useful:

- Next.js App Router project.
- TypeScript and Tailwind v4.
- Premium dark visual direction.
- Homepage sections and reusable UI pieces.
- Static seed data for products, accessories, articles, FAQ, and navigation.
- Floating WhatsApp entry point.
- Vercel preview deployment.

Not yet MVP-ready:

- No full route architecture.
- No real tools/calculators.
- No lead capture, lead ID, database, attribution, or statuses.
- No product detail pages.
- No article detail system.
- No environment-aware SEO/noindex rules.
- No analytics wrapper or event instrumentation.
- No production readiness workflow.

## 3. Execution Rules

- Work phase-by-phase; do not mark a phase done if acceptance fails.
- After each phase, run the relevant verification checks first; if safe, commit to GitHub before starting the next phase.
- Preserve approved visual direction where it supports the PRD.
- Centralize config before adding more routes.
- No fabricated product specs, claims, reviews, or proof.
- Use `mulai dari` pricing language and the global price disclaimer.
- Keep preview/staging noindex.
- Do not connect `vaniabilliard.com` until production readiness passes.
- Do not send personal data to GA4.
- Prefer static typed content for MVP; CMS/ERP are post-MVP.
- Keep accessories visually and commercially secondary to tables.

## 4. Phase Plan

### Phase 0 - Product/Data Readiness Reset

Goal: freeze the data and assumptions needed before building more pages.

Tasks:

- Confirm product lineup, starting prices, and which specs are verified.
- Mark unknown specs as placeholders or omit them from public UI.
- Define lead fields by journey: home, business, venue, accessories.
- Define simulator assumptions: room clearance, cue length, table dimensions, circulation.
- Define marketplace URLs and final contact links.
- Define unsupported claims list in code/docs.
- Create a missing-data register.

Deliverables:

- `docs/product-data-audit.md`
- `docs/lead-flow.md`
- `docs/simulator-assumptions.md`
- `docs/missing-data.md`

Acceptance:

- Featured product data is verified or clearly marked placeholder.
- Lead fields and WhatsApp handoff are frozen for MVP.
- Claims risk is documented.

### Phase 1 - Foundation Alignment

Goal: make the project structure match the PRD before feature buildout.

Tasks:

- Add centralized config for site, WhatsApp, marketplace, analytics, pricing, assumptions, and environment.
- Add typed models: product, accessory, article, FAQ, lead, tool result.
- Add environment model: `development`, `preview`, `staging`, `production`.
- Add environment-aware metadata and robots handling.
- Add `sitemap.ts`, `robots.ts`, and canonical URL helpers.
- Add scripts: `lint`, `typecheck`, `test`, `build`.
- Add `.env.example` with names/descriptions only.
- Update README to reflect PRD v3.1 workflow.

Candidate files:

- `src/config/site.ts`
- `src/config/business.ts`
- `src/config/tools.ts`
- `src/types/product.ts`
- `src/types/lead.ts`
- `src/lib/seo.ts`
- `src/lib/analytics.ts`
- `src/app/robots.ts`
- `src/app/sitemap.ts`
- `.env.example`

Acceptance:

- `npm run lint` passes.
- `npm run typecheck` passes.
- `npm run test` passes or has an explicit minimal test baseline.
- `npm run build` passes.
- Preview/staging are noindex.
- Config is centralized.

### Phase 2 - Design System and Navigation Alignment

Goal: formalize existing components into reusable PRD-ready blocks.

Tasks:

- Keep/refine Navbar, MobileMenu, Footer, FloatingWA.
- Add WhatsApp chooser states for table vs accessories.
- Standardize Button, Card, FormField, Select, ResultPanel, Notice, Badge.
- Add mobile sticky CTA pattern.
- Add accessible focus states and reduced-motion behavior.
- Add reusable page shell and section templates.

Acceptance:

- Keyboard navigation works.
- Components support mobile-first layouts.
- WhatsApp table/accessories split is clear.
- Accessibility states are visible.

### Phase 3 - Homepage Rebuild to PRD Order

Goal: make homepage copy and flow match the final positioning.

Required order:

```text
Hero
-> Pilih kebutuhan
-> Quick assessment
-> Tools
-> Featured tables
-> Why Vania
-> Accessories preview
-> Installation and delivery proof
-> Educational content
-> FAQ
-> Final CTA
```

Tasks:

- Rewrite hero copy exactly around decision/planning positioning.
- Add need selector cards for home, business, venue, accessories.
- Add quick assessment module that routes users into tools/lead flow.
- Keep table-heavy visual weighting.
- Keep accessories preview smaller than table sections.
- Add CTA tracking hooks.

Acceptance:

- Homepage communicates consultation/decision partner first.
- 70:30 table/accessories ratio is visible.
- Every major section has a clear CTA.
- No unsupported claim appears.

### Phase 4 - Room Simulator and Table-Count Estimator

Goal: ship the two decision tools that drive table leads.

Routes:

- `/simulator-ruangan`
- `/hitung-kebutuhan-usaha`

Room simulator inputs:

- Length.
- Width.
- Table size.
- Use case.
- Optional cue length.

Room simulator outputs:

- Comfortable, limited, or not recommended.
- Cue clearance explanation.
- Simple visual room output.
- Recommended products.
- Lead CTA.

Table-count estimator inputs:

- Room dimensions.
- Table size.
- Circulation assumption.
- Supporting area.

Table-count estimator outputs:

- Estimated table count.
- Assumptions.
- Limitations.
- Lead CTA.

Acceptance:

- Tool calculations are transparent and documented.
- Outputs never imply guaranteed fit or profit.
- Tool completion can transition into lead capture.

### Phase 5 - Table Catalog and Product Detail

Goal: build the main sales catalog.

Routes:

- `/meja-billiard`
- `/meja-billiard/[slug]`

Tasks:

- Build catalog grid and filters: series, size, price, use case, home/business, recommended, custom, search.
- Build detail page structure: hero, price, positioning, suitable for, benefits, sizes, room requirement, verified specs, custom options, included items, proof, comparison, FAQ, WhatsApp.
- Add product schema.
- Add sticky CTA.

Acceptance:

- All PRD products have pages or a documented defer reason.
- Unknown specs are not fabricated.
- Price disclaimer is visible.
- WhatsApp message includes product interest.

### Phase 6 - Lead Capture and Attribution

Goal: capture valuable lead data before opening WhatsApp.

Tasks:

- Create lead form components.
- Generate lead IDs like `VB-HOME-8F-A72K`.
- Capture source, campaign, UTM, segment, city, budget, timeline, product interest, tool result.
- Add API route with server-side validation.
- Add Supabase integration or a documented temporary local/mock adapter.
- Add lead statuses, including `Outcome Unknown`.
- Build WhatsApp URL with lead ID and submitted context.

Acceptance:

- Lead is stored before WhatsApp opens.
- WhatsApp message matches PRD format.
- Table and accessories leads are separated.
- Personal data is not sent to analytics.

### Phase 7 - Accessories Hub

Goal: support recurring accessories commerce without overpowering tables.

Routes:

- `/aksesoris`
- `/aksesoris/[slug]`

Tasks:

- Build category hub: laken, stick, bola, cover, glove, tas, chalk, lampu, microfiber, papan skor, care products.
- Add stock inquiry CTA.
- Add Shopee/TikTok/marketplace links via centralized config.
- Add venue maintenance internal links.
- Track marketplace clicks.

Acceptance:

- Accessories hub is useful but visually secondary.
- WhatsApp accessories number is used.
- Marketplace links are centralized and trackable.

### Phase 8 - Trust and Business Pages

Routes:

- `/untuk-rumah`
- `/untuk-usaha`
- `/buka-usaha-billiard`
- `/galeri`
- `/tentang`
- `/informasi-faq`
- `/kontak`
- `/kebijakan-privasi`
- `/syarat-ketentuan`

Acceptance:

- Pages have unique intent and copy.
- Gallery does not expose private customer data.
- Contact and policy pages are production-ready.
- Business pages avoid profit/BEP guarantees.

### Phase 9 - Articles, SEO, and AI Search Readiness

Routes:

- `/artikel`
- `/artikel/[slug]`

Tasks:

- Build article index and MDX/typed article rendering.
- Seed four pillars: table, room/size, business planning, accessories.
- Add direct-answer blocks, key takeaways, comparison, calculations, limitations, updated date, reviewer, internal links, CTA.
- Add schema where appropriate.

Acceptance:

- Articles are not thin keyword pages.
- Internal links connect article -> tool -> product -> lead.
- Metadata/canonical are valid.

### Phase 10 - Capital Estimator MVP-Plus

Only start after core lead funnel is validated.

Route candidate:

- `/estimasi-modal-billiard`

Acceptance:

- Broad ranges only.
- No profit or BEP guarantee.
- Detail remains semi-gated.

### Phase 11 - Analytics, QA, Security, Accessibility, Performance

Tasks:

- Add GA4 wrapper and event map.
- Add event instrumentation: product views, filters, tool starts/completions, generate lead, WhatsApp click, marketplace click, article CTA click.
- Add rate limiting/protection for lead endpoint.
- Run Lighthouse/mobile QA/browser QA.
- Validate accessibility and reduced motion.
- Validate schema, sitemap, robots, redirects.
- Scan for exposed secrets.

Acceptance:

- Mandatory checks pass.
- No PII is sent to analytics.
- Performance targets are practical: LCP <= 2.5s, INP <= 200ms, CLS <= 0.1.

### Phase 12 - Deployment and Handover

Tasks:

- Keep feature branches previewed on Vercel.
- Use `develop` or staging branch for UAT.
- Inventory DNS before production connection.
- Connect `vaniabilliard.com` only after checklist passes.
- Set canonical apex domain and redirect `www`.
- Verify HTTPS, Search Console, GA4, sitemap submission.
- Document lead SOP, content SOP, product update SOP, sales handoff SOP, rollback.

Acceptance:

- Production domain is live only after readiness checklist passes.
- Rollback plan is documented.
- Handover docs exist.

## 5. Suggested Implementation Order

Immediate next sprint:

1. Phase 1 foundation alignment.
2. Phase 3 homepage rebuild to PRD order.
3. Phase 4 room simulator MVP.
4. Phase 6 lead capture MVP.
5. Phase 5 catalog/product pages.

Rationale: the highest-value funnel is table decision tool -> lead capture -> WhatsApp. Catalog and accessories should follow once the capture system is ready.

## 6. Definition of MVP Done

MVP is done when:

- Homepage matches final positioning and 70:30 focus.
- Table catalog and product detail work.
- Room simulator works.
- Table-count estimator works or is explicitly deferred with stakeholder approval.
- Lead capture works and generates lead ID.
- WhatsApp message includes lead context and correct number.
- Accessories hub works with marketplace links.
- Trust pages, FAQ, contact, privacy, and terms exist.
- SEO foundation works.
- Analytics events are implemented without PII.
- Mobile UX, accessibility, build, lint, typecheck, and tests pass.
- Preview/staging are noindex.
- Production domain is connected only after readiness checklist.
