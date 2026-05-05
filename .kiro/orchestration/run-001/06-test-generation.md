# Test generation — run-001 (login feature)

## STEP 0 — Inventory & categorisation

| Source file | Test file | Category |
|-------------|-----------|----------|
| `src/pages/Login.tsx` | `src/pages/__tests__/Login.test.tsx` | **HAS_TESTS** |
| `src/App.tsx` | *(none)* | **NEEDS_TESTS** |
| `src/pages/Dashboard.tsx` | *(none)* | **NEEDS_TESTS** |
| `src/auth/storage.ts` | *(no dedicated file; constant exercised via Login tests)* | **EXCEPTION** — single exported constant; no standalone behaviors |
| `src/main.tsx` | *(none)* | **EXCEPTION** — bootstrap / DOM entry only |
| `src/vite-env.d.ts` | — | **EXCEPTION** — types only |
| `src/test/setup.ts` | — | **N/A** — Vitest setup |

**Tooling note:** This repo uses **Vitest** + Testing Library (not Jest). Coverage uses `@vitest/coverage-v8@3.2.4` and `vitest.config.ts` `coverage` options.

## STEP 1 — New test files (per §2.1 gate)

Stopped before creating new `__tests__` files until explicit **yes / skip / stop** for each candidate:

1. `src/pages/__tests__/Dashboard.test.tsx` for `Dashboard.tsx`
2. `src/App.test.tsx` or `src/__tests__/App.test.tsx` for `App.tsx` *(prefer co-location with existing patterns: suggest `src/__tests__/App.test.tsx` or add `src/__tests__/App.test.tsx` next to App — steering says beside module; **`src/App.test.tsx`** is unconventional in React repos; **`src/__tests__/App.test.tsx`** mirrors no pattern here — codebase uses `pages/__tests__/`. Recommendation: **`src/__tests__/App.test.tsx`** or **`src/App/__tests__`** — simplest: **`src/__tests__/App.test.tsx`**.)*

*(Agent will use **`src/__tests__/App.test.tsx`** only after approval.)*

## STEP 2 — `Login.tsx` verification

Existing tests mapped ACs. Gaps addressed in this run:

- Success body missing usable `token`
- Non-Axios throw → generic error
- Axios non-401 / non-5xx → generic error
- Missing `REACT_APP_API_BASE_URL`: `submit` stays disabled; `fireEvent.submit` exercises configuration error path

## STEP 3 — Coverage command

```bash
npx vitest run --coverage
```

*(No `test:coverage` script in `package.json` at generation time.)*

## STEP 4 — Quality gate (`Login.tsx` subject via `Login.test.tsx`)

```text
--- Quality gate: Login.tsx ---
Compile:  PASS  (npm run build — tsc -b && vite build)
Format:   N/A  (no format:check in package.json; §11 applied in edits)
Lint:     N/A  (no lint script)
Tests:    PASS  (9 tests — vitest run)
Coverage: src/pages/Login.tsx — Stmts 100% | Lines 100% | Branch 96.92% | Funcs 100% | §2.2 OK
--- end ---
```

## STEP 5 — Summary (partial pending §2.1 approvals)

| Source File | Test File | Status | Stmts% | Lines% | §2.2 |
|-------------|-----------|--------|--------|--------|------|
| `Login.tsx` | `pages/__tests__/Login.test.tsx` | Extended | 100% | 100% | OK |
| `App.tsx` | — | Pending approval | — | — | — |
| `Dashboard.tsx` | — | Pending approval | — | — | — |

**Overall coverage (current collect set):** Aggregate table includes unrouted modules at 0% until App/Dashboard tests exist; meaningful bar for **`Login.tsx`**: statements/lines meet **≥ 80%**.
