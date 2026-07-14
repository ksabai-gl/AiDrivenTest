# Test Cases — MAD-97 E2E Sign in → Dashboard

## Document Information

**Jira Ticket:** MAD-97  
**STLC Block:** 2 — Test Case Design  
**Format:** Labeled metadata lines; full-sentence preconditions and steps  
**Scope mode:** Story  
**Total Test Cases:** 4  
**Product note:** Login is navigation-only (MBA-29); credentials are not validated.

## TC-001 — Application opens on Sign in with form controls

**Scenario:** TS-01 · **Priority:** P1 - Critical · **Requirement(s):** AC-01 · **Type:** UI / Functional  
**Tags:** `@MAD-97` `@ui` `@smoke` `@regression` `@AC-01` · **Automation:** Yes · **Owner:** UI Testing

**Preconditions:**
1. The Mobile Banking App is reachable at the configured base URL (for example `http://127.0.0.1:5173`).
2. The tester starts from a clean browser session with no residual navigation state required for this case.

**Test data:** None required beyond the base URL.

| Step | Action | Expected result |
|:----:|:-------|:----------------|
| 1 | The tester opens the application base URL in the browser. | The application loads without a crash and the browser settles on the Sign in entry. |
| 2 | The tester observes the landing heading and form. | A **Sign in** heading is visible and the Dashboard heading is not shown as the landing UI. |
| 3 | The tester inspects the Sign in form controls. | Username input, password input, and a **Login** control are visible and enabled. |

**Expected result:**
- Route is `/login` (or equivalent Sign in entry reached from `/`).
- Form controls `username`, `password`, and Login are present.

---

## TC-002 — Login with credentials navigates to Dashboard

**Scenario:** TS-02 · **Priority:** P1 - Critical · **Requirement(s):** AC-02 · **Type:** UI / Functional  
**Tags:** `@MAD-97` `@ui` `@smoke` `@regression` `@AC-02` · **Automation:** Yes · **Owner:** UI Testing

**Preconditions:**
1. The application base URL is reachable.
2. The tester is on the Sign in page (`/login`).

**Test data:** Username `test.user`; password `AnyPass1!` (values are synthetic and are not validated by the app).

| Step | Action | Expected result |
|:----:|:-------|:----------------|
| 1 | The tester enters username `test.user` into the username field. | The username field accepts the value. |
| 2 | The tester enters password `AnyPass1!` into the password field. | The password field accepts the value. |
| 3 | The tester activates the **Login** control. | The browser navigates to `/dashboard`. |
| 4 | The tester observes the Dashboard page. | The **Dashboard** heading and welcome placeholder text are visible. |

**Expected result:**
- Path contains `/dashboard`.
- Heading **Dashboard** is visible.
- Text *Welcome. Your account overview will appear here.* is visible.

---

## TC-003 — Blank credential Login navigates to Dashboard

**Scenario:** TS-02 · **Priority:** P2 - High · **Requirement(s):** AC-02 · **Type:** UI / Functional (navigation variant)  
**Tags:** `@MAD-97` `@ui` `@regression` `@AC-02` · **Automation:** Yes · **Owner:** UI Testing

**Preconditions:**
1. The application base URL is reachable.
2. The tester is on the Sign in page (`/login`).

**Test data:** Username blank; password blank (auth not validated — MBA-29 navigation-only).

| Step | Action | Expected result |
|:----:|:-------|:----------------|
| 1 | The tester leaves the username and password fields empty. | Both fields remain blank. |
| 2 | The tester activates the **Login** control. | The browser navigates to `/dashboard` without credential validation errors. |
| 3 | The tester observes the Dashboard page. | The **Dashboard** heading and welcome placeholder text are visible. |

**Expected result:**
- Blank Login still reaches `/dashboard` (navigation-only auth).
- Welcome placeholder is visible.

---

## TC-004 — Direct navigation to unguarded Dashboard deep-link

**Scenario:** TS-03 · **Priority:** P2 - High · **Requirement(s):** AC-03 · **Type:** UI / Regression  
**Tags:** `@MAD-97` `@ui` `@regression` `@AC-03` · **Automation:** Yes · **Owner:** UI Testing

**Preconditions:**
1. The application base URL is reachable.
2. The tester starts a clean browser session (no prior Login required for this case).

**Test data:** Direct URL `{baseUrl}/dashboard`.

| Step | Action | Expected result |
|:----:|:-------|:----------------|
| 1 | The tester navigates directly to `{baseUrl}/dashboard` without using Login. | The Dashboard page renders. |
| 2 | The tester inspects the browser location and page content. | The browser remains on `/dashboard` and does not redirect to `/login`. |
| 3 | The tester observes headings and body text. | The **Dashboard** heading and welcome placeholder text are visible. |

**Expected result:**
- Unguarded deep-link shows Dashboard (documents current behavior per AC-03).
- No redirect to `/login`.

---

## Scenarios index

| Scenario | Title | AC | Priority | Test cases |
|:--|:--|:--|:--|:--|
| TS-01 | Sign in entry and form controls | AC-01 | P1 - Critical | TC-001 |
| TS-02 | Login navigates to Dashboard (with and without credentials) | AC-02 | P1 / P2 | TC-002, TC-003 |
| TS-03 | Unguarded `/dashboard` deep-link | AC-03 | P2 - High | TC-004 |

## Traceability index

| AC | Flow | Scenario | Test cases | Automation |
|:--|:--|:--|:--|:--|
| AC-01 | BF-01 | TS-01 | TC-001 | Yes |
| AC-02 | BF-02 | TS-02 | TC-002, TC-003 | Yes |
| AC-03 | BF-03 | TS-03 | TC-004 | Yes |

## Coverage summary

**Total cases:** 4  
**P1:** 2 (TC-001, TC-002)  
**P2:** 2 (TC-003, TC-004)  
**Automated:** 4 / 4  
**Smoke:** TC-001, TC-002  
**Regression:** TC-001–TC-004  
**Out of scope capabilities with cases:** 0  
**Framework:** `java-selenium-cucumber` (XPath only) — Vitest/Jest forbidden for STLC
