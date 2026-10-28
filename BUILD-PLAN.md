# Wholesale shop on Odoo: build plan for Claude Code

Owner: Rod (Vietnam Direct Sourcing). Written by the cloud session, 28 Oct 2026 (Da Nang time).
Reader: Rod's local Claude Code session, which has access to the Odoo database.

The brand doesn't exist yet. Build the whole structure now with placeholders (`[BRAND]`, `[LOGO]`, `[PRODUCT]`) so that the brand, theme and products can be dropped in later without rework.

## 0. Rules

1. **One database; test on a temporary copy.** The business runs on the existing VDS database only; the shop is a second website inside it. For Phases 1–5, make a throwaway test copy (odoo.com/my/databases → Duplicate, marked for testing, so no emails go out and payments stay in test mode) and build there. Why:
   - installing eCommerce, Inventory and Purchase changes menus, settings and the header on the live booking site straight away
   - apps can't be cleanly uninstalled
   - test orders and payments would otherwise land in the real books

   Touch production only in Phase 6, after Rod approves, by re-running the same scripts. Delete the copy after go-live.
2. **Script it.**
   - Do configuration through the external API (XML-RPC; the database is on the Custom plan) with idempotent scripts in `scripts/`, so the same scripts run on the copy and then on production.
   - Anything that can only be done in the UI goes into `BUILD-LOG.md` with the exact clicks.
   - Commit both.
3. **Inventory before and after.**
   - Run `scripts/odoo_probe.py` at the start and end of every phase and keep the JSON in `probes/` (it reads configuration only, no customer data).
   - The diff must show only what the phase intended.
4. **The existing website must not change.** Its theme, menus, pages, appointments, CRM pipelines and the enquiries@ flow stay exactly as they are; the probe diff proves it. Installing eCommerce adds things to every website, and §2.1 lists them.
5. **No secrets in files.**
   - The API key lives in environment variables only.
   - Create it in Odoo under your user → Preferences → Account Security → New API Key.
6. **Approval needed for these:**
   - no third-party Odoo apps without Rod's approval (Odoo Online allows standard apps and data-only modules anyway)
   - nothing published, no live payments, no DNS changes and no emails to real contacts without Rod's approval
7. **Stop after each phase.** Show Rod the BUILD-LOG entry, the probe diff and screenshots, then wait for approval.

## 1. Decisions (Rod, 28 Oct 2026)

| Topic | Decision |
|---|---|
| Database | The existing VDS Odoo database (behind book.vietnam-directsourcing.com), Custom plan. The shop uses the apps already set up there (CRM, contacts, accounting) |
| Website | A second website in that database, on its own subdomain (placeholder `shop.vietnam-directsourcing.com` until the brand domain exists) with its own built-in theme |
| Business | VDS sources a specific product range from Vietnam, sells it under its own brand to ANZ businesses |
| Customers | Wholesale (B2B) only |
| Visibility | Catalogue public (for Google and the brand); prices and ordering only for approved trade accounts |
| Fulfilment | Both: **Ready stock** from an Australian warehouse/3PL, and **Factory direct (indent)** made and shipped from Vietnam |
| Payment | Card (Stripe) and invoice / bank transfer |
| Currency | AUD and USD pricelists |
| Selling company | Vietnam Direct Sourcing LLC (the existing company); the shop is a VDS business unit, not a separate legal entity |
| Future | More brand websites in the same database, all selling as VDS LLC (§2.0) |
| Design | A built-in Odoo theme, customised (colours, fonts, header, footer, pages) |
| Brand, logo, products | Not ready: placeholders |

## 2. Target design

### 2.0 One database, several brand websites
This shop is the first of possibly several brand websites, all run from the VDS database and selling as Vietnam Direct Sourcing LLC. Build it so the next brand is a new website, not a new setup.

| Shared by all brand websites (set up once) | Per website (repeat for each brand) |
|---|---|
| Company VDS LLC, contacts, CRM, accounting, taxes and fiscal positions | Domain, theme, pages, menus, legal pages |
| Stripe and bank-transfer providers, payment terms | eCommerce categories; products (`website_id` set to that site) |
| Warehouses / 3PL, routes, factories (vendors), units of measure | Public "prices hidden" pricelist |
| Trade pricelists "Trade AUD" and "Trade USD" (not tied to a website; prices are per product) | Sales team "Wholesale – [BRAND]" and its application form |
| The trade-account approval checklist | Email wording and the "[BRAND] is a trading name of Vietnam Direct Sourcing LLC" line |

Conventions:
- SKUs carry a brand prefix (`BRD-001-AU`).
- Scripts take the website and brand as parameters, so the build scripts run again for brand 2.
- Customer logins: decide in Phase 2 whether a trade account works across all brand sites or per site. That is Odoo's "shared customer accounts" website setting; per site suits distinct brands.

### 2.1 Website, domain, and protecting the booking site
- Create website 2 "[BRAND] Trade" (Website → Configuration → Websites) with company Vietnam Direct Sourcing LLC, language English (AU), and its own theme (select website 2 first, then pick the theme).
- Domain: CNAME `shop` → `<database>.odoo.com` at the DNS host (Hostinger), then add the domain in odoo.com/my/databases → Domain names (SSL is automatic), and set it on website 2. Only in Phase 6, with Rod.
- **Installing eCommerce affects every website.** On website 1 (booking site), after the install:
  - remove the "Shop" menu item if one was added
  - hide the cart and wishlist icons in its header (Edit → Theme/Customize on website 1 only)
  - add 301 redirects `/shop` → `/` and `/shop/cart` → `/` scoped to website 1 (Website → Configuration → Redirects)
- Every shop product, eCommerce category and page has **website = website 2**. A product without a website shows on all websites.

### 2.2 Who sees what
| Visitor | Sees | Can |
|---|---|---|
| Public (not logged in) | Catalogue, product pages, specs, MOQ, lead time; **no prices** | Apply for a trade account; send a trade enquiry |
| Approved trade account (portal user) | Their pricelist (AUD or USD) | Order Ready-stock products online; request Factory-direct quotes; see orders, invoices, re-order in My Account |

How to hide prices:
- Prefer a native "hide prices from public users" setting if this Odoo version has one (check in Phase 0).
- Otherwise use the standard pattern:
  - the website's default pricelist for public visitors gives every product a price of 0
  - website setting **Prevent sale of zero-priced products** is on (shows a "Contact us" button instead of Add to cart), pointing to the Trade enquiries page
  - trade pricelists are assigned per customer
- Verify in the page source that public product pages carry no price (or `0`) in their structured data.

Accounts: sign-up "On invitation" (no free sign-up). Checkout requires login.

### 2.3 Trade account flow (uses the existing CRM)
1. **Apply.** "Apply for a trade account" page: a website form that creates a CRM lead in a new sales team **"Wholesale – [BRAND]"**. It is separate from the VDS sourcing pipeline and from enquiries@.
   - Fields: business name, ABN or NZBN, contact name, email, phone, website, business type (retailer / distributor / hospitality / other), state or region, products of interest, expected order volume, how they heard about us.
2. **Approve.** Staff check the ABN/NZBN and approve, following a checklist in BUILD-LOG:
   - create or merge the company contact
   - set the pricelist (Trade AUD for Australia, Trade USD otherwise)
   - set payment terms (card or pre-payment by default; credit terms such as 14 or 30 days only for accounts Rod approves)
   - set the fiscal position (see §2.8) and the tag "Trade – approved"
3. **Invite.** Send the portal invitation (Contacts → Action → Grant portal access).
4. **Decline.** The lead is marked lost with a reason; an email template sends a polite decline.

### 2.4 Catalogue structure
- **Two channels, kept as separate product records** (routes and lead times differ; the same item can exist in both, SKU suffix `-AU` / `-FD`):
  - **Ready stock (ships from Australia):** ribbon "Ready stock"; customer lead time 2–5 business days; Add to cart.
  - **Factory direct (indent):** ribbon "Factory direct"; MOQ and lead time shown; **no card checkout** (see §2.7).
- **eCommerce categories** (website 2): placeholders by range; real ones once the range is known.
- **Sales unit:** sell in cartons. Create units of measure such as "Carton of 12" (category Unit, bigger than the reference, ratio 12), so quantities can only be whole cartons. Show units per carton, MOQ, carton size and weight, origin "Vietnam" and HS code in the product's specification section.
- **Factory and cost:** each product's vendor line (Purchase tab) holds the factory, factory price in USD, minimum quantity and lead time. This drives purchase orders.
- Product data comes from `data/product-import-template.csv`; the column → field mapping is in §6.

### 2.5 Pricelists
| Pricelist | Currency | Who | Content |
|---|---|---|---|
| Public (website 2 default) | AUD | not logged in | 0 for all products (prices hidden), unless a native hide-price setting exists |
| Trade AUD | AUD | Australian trade accounts | fixed price per product; optional quantity breaks (min quantity rules) |
| Trade USD | USD | NZ and other trade accounts | fixed price per product; optional quantity breaks |

- **Currencies:** activate AUD and USD.
- **Visibility:** trade pricelists are shared by all brand websites (not tied to a website, §2.0) and not selectable by visitors; the customer's assigned pricelist applies when they log in. Each website's default pricelist is its public "prices hidden" one.
- **Website 1:** confirm its pricelists and appointment prices are unchanged.

### 2.6 Fulfilment
- **Ready stock:**
  - a warehouse "AU – [3PL name]" (code `AU3P`) with the 3PL's address
  - stock comes in by purchase orders to the factory (receipts to the AU warehouse)
  - orders ship from it
  - the 3PL integration (Starshipit connector, email or CSV, or an API) is decided when the 3PL is chosen; until then, delivery orders are processed manually
- **Factory direct (indent):**
  - enable Dropshipping; route "Dropship" on Factory-direct products (vendor = factory)
  - a confirmed order creates a request for quotation (RFQ) to the factory, delivered to the customer's address; staff confirm it
  - the Incoterm (FOB Vietnam port vs CIF/DDP Australia) is on the order and invoice: Rod to decide (§5)
- **Lead times** come from product customer lead time (`sale_delay`) and vendor lead time.

### 2.7 Checkout and payment
| Case | How it works |
|---|---|
| Ready stock, card | Cart → checkout → Stripe (AUD or USD). Order confirmed and invoiced automatically. Stripe connected to VDS LLC's Stripe account, test mode until Phase 6 |
| Ready stock, bank transfer | "Bank transfer / on account" (Odoo's Wire Transfer provider). Order waits as a pending quotation; staff confirm on receipt of funds, or immediately for accounts with credit terms (invoice carries their payment terms). Bank details: AUD and USD accounts (Rod to supply) |
| Factory direct | No card checkout. The product's button leads to a **request a quote** (cart submitted as a quote request or the Trade enquiries form). Staff confirm MOQ, lead time, freight and Incoterm, then send an Odoo quotation with an **online prepayment** (suggested 30% deposit, balance before shipment). The buyer pays the deposit by card or transfer from the quotation link |

Phase 0 decides the mechanism that stops Factory-direct items being paid in full by card. In order of preference:
1. a native per-product or per-category setting, if this version has one
2. zero price in the trade pricelists plus the website-wide "Contact us" button pointing to the Trade enquiries page (indicative price and MOQ in the product text)
3. a Stripe maximum amount, with staff review

Pick the simplest that works on the copy and record why.

Payment terms to create: "Pre-payment", "14 days", "30 days end of month", and "30% deposit, 70% before shipment".

### 2.8 Taxes (accountant to confirm before go-live)
Not tax advice. These are questions for Rod's accountant or customs broker, with the matching Odoo setup:
- **Indent:** goods ship from Vietnam; the buyer is the importer and pays GST at the border. Invoice without Australian GST (fiscal position "Export – indent").
- **Ready stock in Australia, sold by a non-Australian company:**
  - Does VDS LLC need an ABN and GST registration (turnover threshold), and who is importer of record for 3PL stock?
  - If registered: Odoo's foreign-VAT fiscal position (Accounting → Fiscal positions → Foreign tax ID, country Australia) loads Australian GST 10% for this company. Prices to trade buyers are shown excluding GST.
- **NZ buyers:** exports from Australia (zero-rated); NZ GST at the NZ border.
- **Phase 0:** report the company's country, fiscal localisation and existing taxes before anything is created.

### 2.9 Shipping
- **Ready stock:**
  - delivery methods by zone and weight (metro or regional per state; NZ) as a start
  - pallets: "Freight quoted on confirmation" (price 0 at checkout, freight line added before confirmation)
  - a carrier connector once the 3PL is chosen
- **Factory direct:** freight is in the quotation per the Incoterm.

### 2.10 Documents and emails
- Odoo document layouts are per company. With VDS LLC selling, quotations and invoices show Vietnam Direct Sourcing LLC. Add "[BRAND] is a trading name of Vietnam Direct Sourcing LLC" where the brand appears on documents, or move to a separate company later (§5).
- Brand the website-2 emails: order confirmation, quotation, invoice, portal invitation, trade account approved/declined. Placeholders until the brand exists.

### 2.11 Design and pages (built-in theme)
- **Theme:** in Phase 4, shortlist three built-in themes suited to a product catalogue (for example Loftspace, Clean, Graphene; check what this version offers). Screenshot each on the copy with placeholder content and let Rod choose. Customise only through theme options (colours, fonts, buttons, header, footer); no custom module unless a need appears.
- **Pages (website 2), placeholder content until the brand exists:**
  - Home: range overview; "Ready stock" vs "Factory direct" explained; trade account call to action
  - Shop and category pages
  - Product page: specs table and channel ribbon
  - How ordering works: stock vs indent, payment, freight, lead times, MOQ
  - Apply for a trade account
  - Trade enquiries
  - About, Contact
  - Terms of Trade, Privacy Policy, Shipping & Returns: placeholders marked for legal review
  - Login / My Account
- **Header:** logo, search, account, cart (cart shown to logged-in buyers).
- **Footer:** "© [year] [BRAND], a trading name of Vietnam Direct Sourcing LLC", ABN when registered, policy links.

### 2.12 SEO and analytics
- Website 2 has its own sitemap and robots.txt. Website 1's sitemap must not list shop URLs (checked in the probe and by fetching both sitemaps).
- Product pages: unique title and meta description per product, alt text on images, no prices in structured data for public visitors (§2.2).
- Google Analytics 4 and Search Console for the new hostname (Phase 6), added only after Rod approves.

## 3. Phases (stop after each for Rod)

| Phase | Work | Output for Rod |
|---|---|---|
| **0. Probe and feature check** | Rod makes the temporary test copy (rule 1). Run the probe on production and the copy. Report: Odoo version; company country and localisation; installed apps; existing websites, pricelists, payment providers, taxes. Check which mechanisms this version has for §2.2 (hide prices), §2.7 (no card checkout for indent), §2.6 (Dropship, Starshipit), §2.8 (foreign VAT). Update this plan where the version differs. **No changes.** | Short report + updated plan |
| **1. Foundations (copy)** | Install eCommerce, Sales, Inventory, Purchase, Dropshipping (and Stripe/Wire Transfer providers, disabled). Create website 2 (no theme yet). Protect website 1 (§2.1). Currencies, units of measure, eCommerce categories (placeholders), sales team "Wholesale – [BRAND]" | Probe diff showing website 1 unchanged; website 2 skeleton |
| **2. Access and pricing (copy)** | Pricelists, hidden public prices, sign-up on invitation, checkout requires login, trade application form → CRM, approval checklist, email templates | Test: public sees no prices; a test trade account sees AUD prices; another sees USD |
| **3. Fulfilment, payments, taxes (copy)** | AU warehouse, Dropship route, payment terms, Stripe (test keys) and bank transfer, the indent quote mechanism, shipping methods, fiscal positions as far as the accountant has confirmed | Test orders (§4) |
| **4. Design and content (copy)** | Theme shortlist → Rod picks; theme options; header/footer; all pages with placeholders; 3 placeholder products per channel | Screenshots desktop + mobile |
| **5. End-to-end test (copy)** | All §4 scenarios, logged out and as test buyers | Test report |
| **6. Production** | After Rod approves: run the scripts on production, replay the UI steps from BUILD-LOG, probe diff against the copy. DNS and domain, Stripe live, real bank details. Website 2 stays unpublished (or password-protected) until brand and products are ready; then import products and go live | Go-live checklist signed off by Rod |

## 4. Test scenarios (Phase 3 and 5)

| # | As | Do | Expect |
|---|---|---|---|
| 1 | Public | Open home, shop, a product page | No prices, no Add to cart; "Apply for a trade account" visible; no price in page source structured data |
| 2 | Public | Submit the trade application | CRM lead in "Wholesale – [BRAND]"; acknowledgement email (on the copy: shows in the outgoing queue, not sent) |
| 3 | Staff | Approve it (checklist) | Portal invitation; partner has Trade AUD, payment terms, tag |
| 4 | Trade AUD buyer | Order 2 cartons of a Ready-stock product, pay by Stripe test card | AUD prices; order confirmed; invoice paid; delivery order from AU warehouse |
| 5 | Trade AUD buyer | Same, bank transfer | Pending quotation; staff confirm; invoice with payment terms |
| 6 | Trade USD buyer | Order Ready stock | USD prices and invoice |
| 7 | Trade buyer | Try to buy a Factory-direct product | No card checkout; quote request reaches CRM; staff send a quotation with 30% prepayment; deposit payable online; on confirmation an RFQ to the factory with the customer's delivery address |
| 8 | Trade buyer | Order half a carton / below MOQ | Not possible (carton unit); MOQ stated clearly |
| 9 | Anyone | Open book.vietnam-directsourcing.com, `/shop`, its sitemap | Unchanged booking site; `/shop` redirects to `/`; no cart icon; no shop URLs in its sitemap |
| 10 | Staff | Probe diff after each phase | Only intended changes; website 1 records identical |

## 5. Open decisions for Rod

| # | Decision | Needed by |
|---|---|---|
| 1 | Brand name, logo, colours, final domain | Phase 4 (placeholders until then) |
| 2 | Product range, factories, samples, product compliance per category (e.g. biosecurity import conditions for timber and bamboo, electrical safety marks, labelling) | Before products are imported |
| 3 | Indent terms: Incoterm (FOB Vietnam / CIF / DDP Australia), deposit %, MOQs | Phase 3 |
| 4 | Australian 3PL, its integration, importer of record | Phase 3 (manual processing until then) |
| 5 | Accountant: ABN/GST for VDS LLC on Australian stock sales; NZ treatment | Before go-live |
| 6 | Trade account rules: ABN/NZBN required? Who gets credit terms, and who approves? | Phase 2 |
| 7 | Stripe account for VDS LLC (AUD and USD); AUD and USD bank accounts for transfers | Phase 3 (test keys meanwhile) |
| 8 | Freight: zone rates vs quoted, especially pallets | Phase 3 |
| 9 | Documents show Vietnam Direct Sourcing LLC for every brand (one company), with a "trading name of" line per brand. The VDS site promises sourcing clients independence and no supplier commission, so keep the brand sites visibly separate from VDS's sourcing service. If a brand ever becomes its own registered company, it is added as a second company in the same database (Odoo multi-company), still one database | Before go-live |
| 10 | Terms of Trade and Privacy Policy written or checked by a lawyer (Australian Consumer Law, Privacy Act) | Before go-live |

## 6. Product data: CSV columns → Odoo

`data/product-import-template.csv` (one row per product per channel). Map by script; field names vary between Odoo versions, so confirm with `fields_get` first.

| CSV column | Odoo |
|---|---|
| sku | `product.template.default_code` |
| name | `name` |
| channel | ribbon (Ready stock / Factory direct), route (none / Dropship), eCommerce category |
| ecommerce_category | `public_categ_ids` (website 2 categories) |
| short_description | sales/eCommerce description field of this version |
| full_description | website description (product page body) |
| sales_unit, units_per_carton | `uom_id` and `uom_po_id` = the "Carton of N" unit |
| moq_cartons | shown in specs; enforced by staff on indent quotes |
| carton_weight_kg, carton_volume_m3 | `weight`, `volume` (per sales unit = per carton) |
| hs_code, country_of_origin | `hs_code`, `country_of_origin` (if present in this version) |
| factory, factory_price_usd, factory_moq, factory_lead_days | `seller_ids` (`product.supplierinfo`: partner, price, currency USD, `min_qty`, `delay`) |
| customer_lead_days | `sale_delay` |
| trade_price_aud, trade_price_usd | `product.pricelist.item` fixed prices in Trade AUD and Trade USD |
| barcode | `barcode` |
| image_files | `image_1920` (first) + extra product images |
| compliance_notes | internal note (not published) |

All products: `website_id` = website 2; `is_published` = false until Rod approves.
