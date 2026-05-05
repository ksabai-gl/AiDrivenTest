# Pull request — Login authentication UI (MBA-20)

## GitHub

- **Repository:** `ksabai-gl/AiDrivenTest`
- **Branch:** `feature/login-page-authentication-ui` → **base:** `main`
- **Commits on branch (vs `origin/main`):**
  - `558d531` feat(auth): migrate to Vite, login JWT flow & expanded tests [MBA-20]
  - `682a048` feat(auth): add login page with JWT auth, validation, and tests

## Summary

Replaces the prior CRA/Jest setup with **Vite + React 18 + TypeScript + Tailwind**, implements the **login page** from `.kiro/orchestration/run-001/jira-spec-login-page.md` (fallback when Jira MBA-20 is not readable via API): client validation, `POST ${REACT_APP_API_BASE_URL}/auth/login` via axios, JWT in `localStorage` under `token`, redirect to `/dashboard`, and accessible error messaging. Adds **Vitest** + Testing Library tests (9) with coverage configuration.

## Changed files (high level)

| Area | Files |
|------|--------|
| App shell | `index.html`, `src/main.tsx`, `src/App.tsx`, `src/index.css`, `vite.config.ts`, `tailwind.config.js`, `postcss.config.js` |
| Auth / pages | `src/auth/storage.ts`, `src/pages/Login.tsx`, `src/pages/Dashboard.tsx` |
| Tests | `src/pages/__tests__/Login.test.tsx`, `src/test/setup.ts`, `vitest.config.ts` |
| Tooling | `package.json`, `package-lock.json`, `tsconfig.json`, `tsconfig.node.json`, `src/vite-env.d.ts` |
| Docs / orchestration | `.kiro/orchestration/run-001/jira-spec-login-page.md`, `06-test-generation.md` |
| MCP bundles | `.kiro/settings/mcp-bundles/*` |
| Hygiene | `.gitignore` (excludes `.env`, `coverage/`, `.cursor/`, `*.tsbuildinfo`, `.kiro/settings/mcp.json`), `.env.example` |

## Pre-PR validation

- `npm test` — pass (9 tests)
- `npm run build` — pass

## Related

- **Jira:** [MBA-20](https://globallogic-team-ioe3w3ht.atlassian.net/browse/MBA-20)
- **Spec:** `.kiro/orchestration/run-001/jira-spec-login-page.md`

## Security / hygiene

- **Do not commit** workspace `.env` or `.kiro/settings/mcp.json` (tokens). Both are listed in `.gitignore` for this branch.
- Use `.env.example` for non-secret variable names only.

## PR metadata (from bridge `pr-config`)

- **Labels (requested):** `needs-review`
- **Reviewers:** none configured in embedded `pr-config.json`
- **Draft:** no

---

_PR documentation generated for orchestration run `run-001`._
