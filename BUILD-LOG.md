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
