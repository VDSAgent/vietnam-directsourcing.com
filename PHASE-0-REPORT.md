# Phase 0 report: probe and feature check

Test copy, Odoo saas~19.4+e, 28 Oct 2026. Read-only: nothing was configured, installed, published or sent.
Files: `probes/copy-phase0-2026-10-28.json` (probe), `probes/copy-phase0-website1-guard-2026-10-28.json` (booking-site baseline).
Both were run twice; the second run was byte-identical.

## 1. Where the plan and the database differ

| Plan said | The copy shows | What it changes |
|---|---|---|
| eCommerce is the main app missing; installing it changes every website | `website_sale` and `delivery` (and `website_sale_dashboard`) were installed on **23 Sep 2026**; `website_sale_mass_mailing` is installed too | Phase 1 has no eCommerce install. The booking site already carries the shop routes (§3), so protecting it is the first job |
| Studio is installed | `web_studio` is **not** installed | Nothing depends on it (API, website editor, inherited views); removed from the plan |
| Hide prices with "Prevent sale of zero-priced products" | The setting is **Hide Add To Cart** (`prevent_sale`) with **Prevent Sale For** = 0 price products / Specific categories | §2.2 and §2.7 rewritten (§2 below) |
| Carton unit: category Unit, ratio 12; product has `uom_po_id` | No unit categories. A unit has **Reference Unit** (`relative_uom_id`) and **Contains** (`relative_factor`); products have `uom_id` and packagings `uom_ids`; no `uom_po_id` | §2.4 and §6 rewritten |
| `hs_code`, `country_of_origin` "if present" | **Not present on any model** (Intrastat modules are not installed) | Decision: custom fields or specification text (§5 #12) |
| Probe reads payment provider `state` | No such field; mode is `is_published` and `is_live`. The probe dropped it silently | Probe fixed; it now also lists any requested field this version lacks (empty now) |

## 2. Feature check

| Plan section | Result on 19.4 |
|---|---|
| §2.2 hide prices | No "hide prices from public users" switch. Native route is the zero-price one: public pricelist at 0, **Hide Add To Cart** on, mode "0 price products". Grid hides the price and shows **Contact us** instead of Add to cart; the product page price block is switched by `combination_info['hide_price']` (class `d-none`; the `0.00` is still in the HTML). The button goes to the website setting `contact_us_link_url`. **Ecommerce Access = Logged in users** appears to limit the shop to signed-in users (read from the option and the templates, not tested because switching it is a change), so it is not used. Structured data for products is generated in code, so it can only be checked on a rendered product in Phase 2 |
| §2.7 no card for indent | "Specific categories" mode exists but is exclusive with "0 price products" on one website. So: Factory-direct items get price 0 in the trade pricelists and stay on Contact us for everyone. Deposits are native: `prepayment_percent` (company, quotation template, order) with `require_payment`. Providers can also be limited by `minimum_amount`, `maximum_amount`, `available_pricelist_ids` |
| §2.7 payments today | 26 providers listed, **none published, none live**. Only `payment_custom` is installed (Wire Transfer, Pay on Invoice, Cash on Delivery); `payment_stripe` is not installed |
| §2.6 dropship, 3PL | `stock_dropshipping` and `delivery_starshipit` are available, not installed (installs need Rod's go). Routes today: Receive in 1 step, Deliver in 1 step, Manufacture, Buy. One warehouse (`WH`) |
| §2.8 taxes | Company in Vietnam, USD, chart `l10n_vn`, no tax ID on the record. Taxes: 6 Vietnamese sales, 16 purchase. No fiscal positions. Fiscal positions have a Foreign Tax ID (`foreign_vat`); `l10n_au` and `l10n_nz` exist but are not installed. Whether a foreign-VAT position pulls in `l10n_au` by itself is untested (would be a module install) |
| Currencies | USD, AUD, CAD, GBP, VND active (NZD not; the plan only needs AUD and USD) |
| Pricelists | `Default (USD)` and `VDS Rate Card (USD)`, both on website 1, not selectable |
| Catalogue | 21 product templates (14 active), all services, none published; 0 eCommerce categories; 0 sales orders; no carton units |
| Delivery | One carrier, "Standard delivery" (fixed price, all websites) |
| Sales teams | `VDS Sourcing`, `Website` |

## 3. Booking site (website 1) baseline

All 13 must-keep checks pass on the copy: `/quote` view 4394 (form class `s_website_form`, send button `s_website_form_send`, live page has both), `/rfi-thank-you` 200, booking pages 200, logo served (72,893 bytes), no `tel:` links, no phone-like text on any public page, no "Contact Us" in any header, cart and wishlist icons hidden while the cart is empty. View sources are recorded as hashes.

Four things the plan did not know about (all existed before Phase 0; nothing was changed):

1. **The shop routes are public.** `/shop` and `/shop/cart` return 200 (an empty "Products" page) and `/shop` is in the sitemap.
2. **Free sign-up is open.** `/web/signup` serves a Name/Email/Password form and the login page links to it (website 1 is set to "Free sign up"). Customer accounts are shared across websites (`specific_user_account` is off), so such an account would also work on website 2.
3. `/terms` serves Odoo's placeholder "Standard terms and conditions of sale", and the sitemap lists it.
4. A public **Submit a Ticket** form (with attachment upload) is at `/helpdesk/customer-care-1`.

Also: the copy's `robots.txt` contains `Disallow: /` under a "custom" block. Do not assume production matches; website 2's own robots.txt is a Phase 4/6 check.

## 4. What changed on the copy

Nothing configured. Reads only (JSON-2 `fields_get`, `search_count`, `search_read`; public GET requests; no form submitted). No backup was needed because no record was edited. Verified afterwards: sales orders still 0, visitor records unchanged (101), no view, setting, website or user written. The one record created is **Odoo's own sitemap cache file** (`ir.attachment` 1132, `/sitemap-1-<hash>.xml`), written when `/sitemap.xml` was fetched; Odoo does this for any crawler and had made earlier copies on 27 and 28 Oct.

## 5. Plan and scripts changed in this commit

- `BUILD-PLAN.md`: rule 4, §2.1, §2.2, §2.4, §2.5, §2.6, §2.7, §2.8, Phase 0/1 rows, §5 (new decisions 11–13), §6 mapping.
- `scripts/odoo_probe.py`: 19.4 field names (payment providers, units, warehouses, company prepayment), `prevent_*` website settings, `fields_not_in_this_version` report.
- `scripts/website1_guard.py` (new): the booking-site baseline above; run it with the probe at the start and end of every phase; the diff must be empty.

## 6. Needed from Rod before Phase 1

1. **Go for Phase 1** on the copy: create website 2; 301 redirects for `/shop`, `/shop/cart`, `/shop/wishlist` on website 1; currencies and cartons; categories; sales team; enabling Dropshipping (installs `stock_dropshipping`). No eCommerce install is needed.
2. **Free sign-up on website 1** (§3 #2): switch to invitation only? This is the live booking site, so check production first.
3. **HS code and country of origin**: custom fields or text.
4. Whether `/terms` and the public helpdesk page (§3 #3, #4) should stay as they are. Outside the shop plan, so they are left alone unless Rod says otherwise.
