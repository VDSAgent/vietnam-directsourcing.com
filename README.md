# [BRAND] wholesale shop on Odoo: build pack

A B2B shop for a Vietnam-sourced product range sold to Australian and New Zealand businesses.
It is built as a second website in the existing Vietnam Direct Sourcing Odoo database (Custom plan).

| File | What it is |
|---|---|
| `BUILD-PLAN.md` | Decisions, target design, phases with stop points, tests, open decisions. Start here |
| `scripts/odoo_probe.py` | Read-only inventory of the database's configuration; run before and after every phase |
| `data/product-import-template.csv` | Product data template (column → Odoo field mapping in BUILD-PLAN §6) |
| `BUILD-LOG.md` | Where Claude Code records every step, probe diff and approval |
| `probes/` | Probe outputs (configuration only) |

## Start (paste into Claude Code)

> Clone branch `odoo-shop/build-pack` of https://github.com/VDSAgent/vietnam-directsourcing.com into a new folder (`git clone -b odoo-shop/build-pack --single-branch <url> vds-odoo-shop`). Read `BUILD-PLAN.md` fully and follow its rules. Do Phase 0 only: I have made a temporary test copy of our Odoo database (it is only for testing; the shop will run in our main VDS database). Run `scripts/odoo_probe.py` on production and on the copy (API key from my Odoo user, in environment variables only, never in files), check which features this Odoo version has for the points listed in Phase 0, update the plan where the version differs, commit, and report back to me. Make no changes to either database in Phase 0.
