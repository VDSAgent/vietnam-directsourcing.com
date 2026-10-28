# [BRAND] wholesale shop on Odoo: build pack

A B2B shop for a Vietnam-sourced product range sold to Australian and New Zealand businesses.
It is built as a second website in the existing Vietnam Direct Sourcing Odoo database (Custom plan).

| File | What it is |
|---|---|
| `BUILD-PLAN.md` | Decisions, target design, phases with stop points, tests, open decisions. Start here |
| `scripts/odoo_probe.py` | Read-only inventory of the database's configuration; run before and after every phase |
| `scripts/website1_guard.py` | Read-only check that the booking site's must-keeps still hold (`/quote` form classes, `/rfi-thank-you`, booking pages, logo, no phone numbers, no Contact Us, shop exposure); run with the probe, the diff must be empty |
| `PHASE-0-REPORT.md` | Phase 0 result (28 Oct): where the database differs from the plan, feature check, booking-site baseline |
| `data/product-import-template.csv` | Product data template (column → Odoo field mapping in BUILD-PLAN §6) |
| `BUILD-LOG.md` | Where Claude Code records every step, probe diff and approval |
| `probes/` | Probe outputs (configuration only) |

## Context that is NOT in this repository
This repository is public. Rod's Odoo project notes (`VDS - Odoo/CLAUDE.md`, `Changelog.md`, `Build/Roadmap.md`) and the content rules (`VDS - Marketing/CLAUDE.md`) are given to the working session directly (uploaded), never committed here. Read them before Phase 0; where they conflict with this plan on Odoo facts, the notes win; on the shop design, this plan wins.

## Start
The session needs the test copy's `ODOO_URL`, `ODOO_DB` and `ODOO_API_KEY` as environment secrets and the copy's host in the allowed network domains. Then: read `BUILD-PLAN.md`, do Phase 0 only (read-only), commit the probe and report to this branch, and stop for Rod.
