# Test automation notes — MAD-97

**Jira:** MAD-97  
**Framework:** `java-selenium-cucumber` (XPath only)  
**Branch:** `stlc/MAD-97-ui-harness`  
**App base URL property:** `-Dapp.base.url=http://127.0.0.1:5173`  
**Evidence dir:** `-Dstlc.evidence.dir=<path>`  

## Case → script map

| Case ID | AC | Tags | Feature scenario | Glue / page objects |
|---------|----|------|------------------|---------------------|
| TC-001 | AC-01 | `@smoke` `@regression` | `login-to-dashboard-e2e-mad-97.feature` · TC-001 | `LoginFlowSteps` → `LoginPage` |
| TC-002 | AC-02 | `@smoke` `@regression` | same · TC-002 | `LoginFlowSteps` → `LoginPage` + `DashboardPage` |
| TC-003 | AC-02 | `@regression` | same · TC-003 (blank credentials) | `LoginFlowSteps` → `LoginPage` + `DashboardPage` |
| TC-004 | AC-03 | `@regression` | same · TC-004 (unguarded deep-link) | `LoginFlowSteps` → `DashboardPage` |

## Paths on branch

| Path | Role |
|------|------|
| `src/test/resources/features/login-to-dashboard-e2e-mad-97.feature` | BDD scenarios for TC-001…TC-004 |
| `src/test/java/com/stlc/ephemeral/LoginFlowSteps.java` | Step definitions |
| `src/test/java/com/stlc/ephemeral/pages/LoginPage.java` | XPath Sign in page object |
| `src/test/java/com/stlc/ephemeral/pages/DashboardPage.java` | XPath Dashboard page object |
| `src/test/java/com/stlc/ephemeral/UiEvidenceHooks.java` | Driver + evidence screenshots |
| `src/test/java/com/stlc/ephemeral/RunCucumberTest.java` | JUnit Cucumber runner |
| `pom.xml` | Maven + Selenium + Cucumber |

## How to execute

```bash
# App under test (separate terminal)
npm ci
npm run dev -- --host 127.0.0.1 --port 5173 --strictPort

# Smoke (TC-001, TC-002)
mvn test -Dcucumber.filter.tags=@smoke -Dapp.base.url=http://127.0.0.1:5173 -Dstlc.evidence.dir=./docs/QA/MAD-97/evidence

# Full regression (TC-001–TC-004)
mvn test -Dcucumber.filter.tags=@regression -Dapp.base.url=http://127.0.0.1:5173 -Dstlc.evidence.dir=./docs/QA/MAD-97/evidence
```

**Forbidden:** Vitest, Jest, `npm test` as STLC runners.

## Next agent

**UI Testing (Block 3)** — ephemeral runner clones harness branch, starts Vite, runs `@smoke` / `@ui`, stores evidence.
