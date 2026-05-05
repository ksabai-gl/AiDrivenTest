# Login Page - Authentication UI & Validation

**Project:** MAD  
**Issue Type:** Story  
**Module:** authentication  
**Entity:** login-page  
**Feature Type:** validation,crud  
**Source References:** jiradoc-s.md

## User Story
As an end user,
I want a responsive login page with email/password validation,
So that I can authenticate and access protected areas securely.

## Scope
**In Scope:**
- Build login form with email and password fields.
- Add client-side validation for required fields and email format.
- Call `POST /auth/login`, handle loading and error states, store JWT, and redirect on success.
- Ensure responsive layout, accessible labels, and keyboard navigation.

**Out of Scope:**
- Backend authentication API implementation.
- Password reset, MFA, social login, or registration features.

## Acceptance Criteria
- Email and Password fields validate empty state and email format on the client.
- Login button stays disabled when required fields are empty and shows a spinner during API submission.
- App sends `POST ${REACT_APP_API_BASE_URL}/auth/login` via axios; on `200 OK`, stores `token` in `localStorage`.
- On `401`, show `Invalid email or password`; on `5xx`, show a generic error message.
- On successful login, navigate to `/dashboard` using `useNavigate`.
- Page is mobile responsive and supports accessible labels plus keyboard navigation.

## Technical Notes
- Stack: React 18, TypeScript, Tailwind CSS.
- Libraries: `axios`, `react-router-dom`.
- API response contract: `200 -> { token }`, `401 -> { message }`.
- Component state via `useState`: `email`, `password`, `isLoading`, `error`.

## Dependencies
| Dependency | Module / Package | Type | Notes |
|------------|------------------|------|-------|
| Authentication endpoint | backend-auth-service | Required | Valid credentials and JWT issuance |
| axios | frontend package | Required | HTTP client for login API call |
| react-router-dom | frontend package | Required | Redirect to dashboard after success |
| REACT_APP_API_BASE_URL | runtime environment | Required | Base URL configuration for auth API |
