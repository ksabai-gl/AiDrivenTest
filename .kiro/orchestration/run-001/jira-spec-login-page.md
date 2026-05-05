# Jira spec (draft): Login Page — React

| Field | Value |
|-------|-------|
| Project | MBA |
| Issue Type | Story (steering default); `.env` has `JIRA_ISSUE_TYPE=Task` — reconcile at publish |
| Priority | 6 - Undefined |
| Module | Web — React SPA |
| Entity | User authentication (login session) |
| Feature Type | authentication, validation, ui |

## User Story

As a **signed-out user**,  
I want **a responsive login page with email and password and clear feedback when sign-in fails**,  
So that **I can authenticate and access protected areas of the application**.

## Scope

**In Scope**

- Email and password fields with client-side validation (required / empty check, email format).
- Submit control disabled while required fields are empty; loading spinner for the login API call.
- `POST /auth/login` via axios; on 200 OK store JWT in `localStorage` and redirect to `/dashboard` with `useNavigate`.
- Error copy: “Invalid email or password” on 401; generic message on 5xx; mobile-responsive layout; accessible labels and keyboard navigation.

**Out of Scope**

- Backend auth implementation, refresh tokens, SSO, MFA, password reset, and fine-grained RBAC on routes beyond post-login redirect.

## Acceptance Criteria

**AC-01 — Client-side validation**

- Given the login page is shown  
- When the user leaves email or password empty or enters a non-email string in the email field  
- Then the client blocks invalid submission and shows appropriate validation feedback.

**AC-02 — Submit and loading**

- Given the form is rendered  
- When either email or password is empty  
- Then the login action is disabled  
- When the user triggers login with valid non-empty values  
- Then a loading spinner is shown for the duration of the API request.

**AC-03 — Success path**

- Given valid credentials  
- When `POST ${REACT_APP_API_BASE_URL}/auth/login` returns 200 OK with `{ token }`  
- Then the JWT is stored in `localStorage` and the app navigates to `/dashboard`.

**AC-04 — Error paths**

- Given invalid credentials  
- When the API returns 401 (e.g. with `{ message }`)  
- Then the UI shows **Invalid email or password**  
- When the API returns a 5xx error  
- Then the UI shows a generic error and the loading state is cleared.

**AC-05 — Responsive and accessible**

- Given mobile through desktop widths  
- When the user uses keyboard and assistive technology  
- Then layout remains usable with proper labels and a sensible focus order.

## Technical Notes

- Stack: React 18, TypeScript, Tailwind CSS.
- Libraries: `axios`, `react-router-dom` (`useNavigate` for redirect).
- API: `POST ${REACT_APP_API_BASE_URL}/auth/login` — success body `{ token }`; use env-based base URL.
- State: `email`, `password`, `isLoading`, `error` (or equivalent) via `useState`.

## Dependencies

| Dependency | Module / Package | Type | Notes |
|------------|------------------|------|-------|
| Auth API | Backend `/auth/login` | Required | Contract and `${REACT_APP_API_BASE_URL}` |
| HTTP client | axios | Required | Login POST |
| Routing | react-router-dom | Required | Redirect after success |

---

*Draft phase — no Jira issue created yet.*
