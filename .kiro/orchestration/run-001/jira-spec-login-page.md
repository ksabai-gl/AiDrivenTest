# Jira Spec — Login Page (React.js)

## Ticket Metadata

| Field | Value |
|-------|-------|
| Project | MBA |
| Issue Type | Story |
| Priority | 6 - Undefined |
| Module | authentication |
| Entity | login |
| Feature Type | crud, integration, validation |
| Source References | INPUT_FILE: jiradoc.md — Jira Documentation: Login Page (React.js) |

---

## 1. User Story

As a registered user,
I want a secure and responsive login interface,
So that I can authenticate with my credentials and access the application.

---

## 2. Background

The application requires a frontend authentication entry point built with React.js. The login page serves as the primary access gate, collecting user credentials (email and password) and submitting them to the backend Auth API.

- **Entity:** Login form / session management
- **Module:** User Authentication
- **API endpoint:** Auth API (POST /auth/login) returning JWT on success (200 OK) or 401 Unauthorized on failure
- **Session storage:** JWT stored in `localStorage` or HttpOnly cookie
- **Related modules:** React Router (navigation), Axios (HTTP client), Auth API (backend)
- **Existing behavior:** No existing login UI; this is a greenfield implementation

---

## 3. Scope

**In Scope:**
- Login UI component with Email and Password input fields
- Client-side validation (email format, empty-field detection)
- "Login" button disabled state when fields are empty
- Mobile-responsive layout
- API integration via Axios (POST to Auth API)
- JWT storage on successful login (localStorage or HttpOnly cookie)
- Error handling for 401 Unauthorized with user-friendly alert/message
- Navigation to authenticated route on success using `useNavigate`

**Out of Scope:**
- Registration / sign-up flow
- Password reset / forgot-password flow
- OAuth or social login providers
- Backend Auth API implementation
- Role-based access control (RBAC) post-login
- Persistent session refresh / token renewal logic

---

## 4. Acceptance Criteria

### Section A — Primary Entity CRUD (Login Form Component)

**AC-A01 — Render Login Form**
- Given the user navigates to the `/login` route
- When the page loads
- Then the login form renders with an Email input, a Password input, and a "Login" button

**AC-A02 — Mandatory Fields Enforced (Disabled Button)**
- Given the login form is displayed
- When either the Email or Password field is empty
- Then the "Login" button is disabled and cannot be submitted

**AC-A03 — Enable Button When Fields Are Populated**
- Given both Email and Password fields contain non-empty values
- When the user types into both fields
- Then the "Login" button becomes enabled

**AC-A04 — Successful Login Navigation**
- Given valid credentials are entered
- When the Auth API returns 200 OK with a JWT
- Then the JWT is stored and the user is redirected to the authenticated route via `useNavigate`

**AC-A05 — Failed Login Error Display**
- Given invalid credentials are entered
- When the Auth API returns 401 Unauthorized
- Then a user-friendly error message is displayed on the form (no page reload)

**AC-A06 — Form State Reset on Error**
- Given a failed login attempt has occurred
- When the error message is displayed
- Then the Password field is cleared and focus returns to the Password input

---

### Section B — Related Entity (Session / Token Storage)

**AC-B01 — JWT Stored on Success**
- Given the Auth API returns 200 OK with a JWT token
- When the login response is processed
- Then the JWT is stored in `localStorage` under the key `authToken` (or in an HttpOnly cookie if configured)

**AC-B02 — No Token Stored on Failure**
- Given the Auth API returns 401 Unauthorized
- When the login response is processed
- Then no token is written to `localStorage` or cookies

**AC-B03 — Existing Token Redirects Away from Login**
- Given a valid JWT already exists in `localStorage`
- When the user navigates to `/login`
- Then the user is redirected to the authenticated home route without showing the login form

---

### Section C — Integration / Validation / Defaults

**AC-C01 — Email Format Validation**
- Given the user has entered a value in the Email field
- When the value does not match a valid email format (e.g., missing `@` or domain)
- Then an inline validation message is shown: "Please enter a valid email address"
- And the "Login" button remains disabled

**AC-C02 — Valid Email Format Accepted**
- Given the user enters a properly formatted email (e.g., `user@example.com`)
- When the Email field loses focus or the form is submitted
- Then no email validation error is shown

**AC-C03 — Invalid Credentials Rejected**
- Given the user submits the form with credentials not recognized by the Auth API
- When the API returns 401 Unauthorized
- Then the error message "Invalid email or password. Please try again." is displayed

**AC-C04 — Validation Consistency Across Interactions**
- Given the login form is displayed
- When the user clears a previously valid field
- Then the button disabled state and validation messages update immediately (controlled component behavior)

**AC-C05 — Mobile-Responsive Layout**
- Given the login page is accessed on a viewport width ≤ 768px
- When the page renders
- Then the form stacks vertically, inputs are full-width, and the button is accessible without horizontal scrolling

**AC-C06 — Loading State During API Call**
- Given the user clicks the "Login" button
- When the Axios request is in-flight
- Then the button shows a loading indicator and is disabled to prevent duplicate submissions

**AC-C07 — Network Error Handling**
- Given the Auth API is unreachable (network error or 5xx)
- When the Axios request fails
- Then the error message "An unexpected error occurred. Please try again later." is displayed

**AC-C08 — Password Field Masked**
- Given the login form is rendered
- When the user types in the Password field
- Then the input type is `password` and characters are masked at all times

**AC-C09 — Axios Request Structure**
- Given the user submits valid-format credentials
- When Axios posts to the Auth API
- Then the request body is `{ email, password }` with `Content-Type: application/json`

**AC-C10 — useNavigate Redirect Target**
- Given a successful login
- When `useNavigate` is called
- Then the user is redirected to `/dashboard` (or the originally requested protected route if applicable)

---

## 5. Technical Notes

### Component Structure

```
• Login component: src/pages/Login.jsx (or Login.tsx)
• Form state managed via React useState hook
• Submission handler calls Axios POST to Auth API endpoint
```

### State Fields

```
• email: string — controlled input, validated for format
• password: string — controlled input, type="password"
• isLoading: boolean — true while Axios request is in-flight
• errorMessage: string | null — displayed below the form on API error
```

### API Integration

```
• Method: POST
• Endpoint: /api/auth/login (or as configured in .env: REACT_APP_API_BASE_URL)
• Request body: { email: string, password: string }
• Success (200): response.data.token → store in localStorage key "authToken"
• Failure (401): display "Invalid email or password. Please try again."
• Failure (network/5xx): display "An unexpected error occurred. Please try again later."
```

### Validation Logic

```
• Email format: /^[^\s@]+@[^\s@]+\.[^\s@]+$/ regex check
• Button disabled when: email.trim() === '' || password.trim() === '' || !isValidEmail(email) || isLoading
```

### Navigation

```
• useNavigate from react-router-dom
• On success: navigate('/dashboard') or navigate(location.state?.from || '/dashboard')
• On existing token at mount: useEffect → navigate('/dashboard')
```

### Error Codes / Messages

```
• 401 Unauthorized: "Invalid email or password. Please try again." — displayed on ErrorMessage component
• Network/5xx: "An unexpected error occurred. Please try again later." — displayed on ErrorMessage component
• Empty fields: button disabled (no error message shown until submission attempted)
• Invalid email format: "Please enter a valid email address" — inline below Email field
```

### Key Libraries

```
• react (useState, useEffect)
• react-router-dom (useNavigate, useLocation)
• axios (HTTP client)
• CSS Module / Tailwind / styled-components (responsive layout — per project convention)
```

---

## 6. Dependencies

| Dependency | Module / Package | Type | Notes |
|------------|------------------|------|-------|
| Auth API | Backend authentication service | Required | Provides POST /auth/login endpoint returning JWT |
| react-router-dom | Frontend routing | Required | useNavigate for post-login redirect |
| axios | HTTP client | Required | Handles API call, error interception |
| React (useState, useEffect) | React core | Required | Form state and side-effect management |
| CSS framework / module | UI styling | Required | Responsive layout (Tailwind, CSS Modules, or project convention) |
| localStorage / HttpOnly cookie | Browser storage | Required | JWT persistence across sessions |

---

## 7. Attachments

| Document | File |
|----------|------|
| Design Document | TICKET-ID_design_document.png |
| Task List | TICKET-ID_task_list.png |

> Note: Replace `TICKET-ID` with the actual Jira key after ticket creation (e.g., `MBA-101_design_document.png`).

---

## 8. Clarifications

### AC-B01 — JWT Storage Strategy
The source document lists both `localStorage` and HttpOnly cookie as options. `localStorage` is simpler to implement but is vulnerable to XSS. HttpOnly cookies are more secure but require backend `Set-Cookie` support. The implementation team should confirm the storage strategy before development begins. This AC covers both options; the chosen approach should be documented in Technical Notes once decided.

### AC-C10 — Redirect Target After Login
The source document does not specify the post-login route. `/dashboard` is assumed. If the app supports protected-route redirect (i.e., user was redirected to `/login` from a protected page), `react-router-dom`'s `location.state.from` pattern should be used to return the user to their original destination.

### AC-A06 — Password Clear on Error
Clearing the password field on a failed attempt is a security best practice to prevent credential leakage. This behavior should be confirmed with the UX team if a different pattern is preferred.
