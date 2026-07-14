# Test Plan — MAD-97 E2E Sign in → Dashboard

**Jira Ticket:** MAD-97  
**Summary:** E2E test for login to dashboard flow  
**STLC Block:** 2 — Test Case Design (pure QA design)  
**Scope mode:** Story  
**RTM basis:** Candidate AC-01…03 (Test Intake / BPV) until PO publishes formal ACs on the ticket  
**App under test:** Mobile Banking App — `ksabai-gl/AiDrivenTest` (`main`)  
**Base URL:** `http://127.0.0.1:5173` (Vite `npm run dev` / ephemeral equivalent)  
**Routes:** `/` → `/login` (Sign in); `/login`; `/dashboard` (placeholder Dashboard)

## 2. Objectives

1. Prove the application opens on the **Sign in** entry with username, password, and **Login** (AC-01 / BF-01 / S-1…S-2).
2. Prove activating **Login** navigates to `/dashboard` and shows **Dashboard** plus the welcome placeholder (AC-02 / BF-02 / S-3), with credentials optional or ignored (MBA-29 navigation-only auth).
3. Prove a clean session can open `/dashboard` directly without redirect to `/login` (AC-03 / BF-03 / S-4).

## 3. In scope / out of scope

### In scope (from Capability inventory)

| Capability | Story IDs | AC / flow |
|------------|-----------|-----------|
| UI — Sign in entry & form | S-1, S-2 | AC-01 / BF-01 |
| UI — Dashboard after Login | S-3 | AC-02 / BF-02 |
| Workflow — Sign in → Dashboard | S-3 | AC-02 / BF-02 |
| Custom — Unguarded `/dashboard` deep-link | S-4 | AC-03 / BF-03 |

### Out of scope / N/A (no test cases)

- Real credential validation, SSO, session tokens, logout
- Route guards / RBAC (AC-03 documents *current* unguarded behavior)
- Dashboard account widgets / analytics content
- API, Database, Integration, Accessibility deep audit, SEO, Performance, Security beyond UI navigation
- Vitest / Jest / RTL unit specs

## 4. Test approach

| Item | Approach |
|------|----------|
| Level | UI E2E / functional (QA) — not unit |
| Design depth | Story mode: one functional case per AC + blank Login variant + AC-03 regression |
| Manual | Executable from `test-cases.md` against base URL |
| Automation | Cucumber + Selenium XPath (`java-selenium-cucumber`); tags `@MAD-97 @ui @smoke|@regression @AC-0x` |
| Evidence | Block 3 UI Testing screenshots/video for smoke/regression tags |
| Forbidden | Vitest, Jest, `npm test` as STLC runners |

## 5. Suite tag policy

| Tag | Policy for MAD-97 |
|-----|-------------------|
| `@smoke` | TC-001, TC-002 |
| `@regression` | TC-001–TC-004 |
| Domain | `@MAD-97` `@ui` plus `@AC-01` / `@AC-02` / `@AC-03` |

**Smoke suite:** TC-001, TC-002 (P1)  
**Regression suite:** TC-001–TC-004 (P1 + P2)

## 6. Priority scheme

| Priority | Label | MAD-97 use |
|----------|-------|------------|
| P1 | Critical | AC-01, AC-02 happy path |
| P2 | High | Blank Login variant, AC-03 deep-link |

## 7. Entry criteria

1. Block 1 Capability inventory approved (S-1…S-4 In Scope).
2. Candidate AC-01…03 accepted as trace basis.
3. Reachable `APP_BASE_URL` (local `:5173` or ephemeral).
4. Framework profile `java-selenium-cucumber` confirmed.

## 8. Exit criteria (Case Design)

1. `test-plan.md` and `test-cases.md` complete with Coverage summary.
2. Every In Scope capability exercised; every AC traced.
3. Every case has Priority, suite tags, and full-sentence steps.
4. Next agent: **Test Script Generation**.

## 9. Environment & test data

| Item | Value |
|------|--------|
| Install / start | `npm ci` then `npm run dev -- --host 127.0.0.1 --port 5173 --strictPort` |
| Ready URL | `http://127.0.0.1:5173/` |
| Credentials | Synthetic — username `test.user`, password `AnyPass1!`; **or blank** |
| Session | Clean browser / new session per deep-link case |
| Primary XPath hints | `//input[@name='username']`, `//input[@name='password']`, Login by text, headings **Sign in** / **Dashboard**, welcome placeholder text |

## 10. Risks & assumptions

| ID | Risk / assumption | Mitigation |
|----|-------------------|------------|
| A-01 | Formal ACs not yet on Jira | Trace to candidate AC-01…03 |
| A-02 | PO may later expect real auth | Keep real auth Out of Scope |
| A-03 | Framework gate | Persist `java-selenium-cucumber` |
| A-04 | AC-03 unguarded dashboard intentional | Drop TC-004 if PO rejects |

## 11. Traceability (summary)

| AC | Flow | Scenario | Test cases |
|----|------|----------|------------|
| AC-01 | BF-01 | TS-01 | TC-001 |
| AC-02 | BF-02 | TS-02 | TC-002, TC-003 |
| AC-03 | BF-03 | TS-03 | TC-004 |

## 12. Deliverables

| Artifact | Status |
|----------|--------|
| `test-plan.md` | This document |
| `test-cases.md` | Companion artifact |
| Automation scripts | Test Script Generation |
