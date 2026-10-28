# Build log

One entry per phase and per environment (copy / production). Record every UI-only step with exact
clicks so it can be replayed on production, plus the probe files compared and the result.

## Template
### Phase N, copy|production, YYYY-MM-DD
- Scripts run: `scripts/...` (commit ...)
- UI steps: 1. Website → ... → ...
- Probe diff: `probes/...-before.json` vs `probes/...-after.json`: intended changes only / website 1 unchanged
- Tests: ...
- Rod approved: yes/no (date)

### Phase 0, copy, 2026-10-28
- Scripts run: `scripts/odoo_probe.py` (patched first: 19.4 field names, `prevent_*` website settings, `fields_not_in_this_version` report) and the new `scripts/website1_guard.py`, against the test copy only. The copy's `ODOO_URL` was not in the session environment; the one host the credential proxy exposes was used, with a placeholder key (the proxy supplies the real one). The production database was never contacted.
- UI steps: none (read-only).
- Backups: none needed, no record was edited.
- Probe diff: first run, so this is the baseline: `probes/copy-phase0-2026-10-28.json` and `probes/copy-phase0-website1-guard-2026-10-28.json`. A second run of each was byte-identical.
- Tests: guard 13 of 13 must-keep checks pass (`/quote` form classes in the view source and the served page, `/rfi-thank-you`, booking pages, logo, no `tel:` links, no phone-like text, no Contact Us, cart and wishlist icons hidden). Three informational flags, all pre-existing: `/shop` is public and in the sitemap, `/web/signup` serves a sign-up form. After the run: sales orders 0, visitor records unchanged, no view, setting, website or user written. Side effect: Odoo's own sitemap cache attachment (`ir.attachment` 1132), written when `/sitemap.xml` was fetched.
- Result and plan changes: see `PHASE-0-REPORT.md`; `BUILD-PLAN.md` updated where the version or the database differs (§2.1, §2.2, §2.4 to §2.8, Phase 0/1, §5 #11 to #13, §6).
- Rod approved: no. Stopped after Phase 0, waiting for Rod.
