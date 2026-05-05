import { type FormEvent, useId, useMemo, useState } from "react";
import axios, { isAxiosError } from "axios";
import { useNavigate } from "react-router-dom";
import { AUTH_TOKEN_STORAGE_KEY } from "../auth/storage";

const GENERIC_ERROR =
  "Something went wrong. Please try again in a few moments.";
const INVALID_CREDENTIALS = "Invalid email or password";

function isValidEmail(value: string): boolean {
  const trimmed = value.trim();
  if (!trimmed) return false;
  // Practical email shape check (not full RFC 5322).
  return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(trimmed);
}

type LoginSuccessBody = { token: string };

export function LoginPage() {
  const navigate = useNavigate();
  const baseId = useId();
  const emailId = `${baseId}-email`;
  const passwordId = `${baseId}-password`;
  const emailErrorId = `${baseId}-email-error`;
  const passwordErrorId = `${baseId}-password-error`;
  const apiErrorId = `${baseId}-api-error`;

  const apiBaseUrl = (
    import.meta.env.REACT_APP_API_BASE_URL ?? ""
  ).replace(/\/$/, "");

  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [emailTouched, setEmailTouched] = useState(false);
  const [passwordTouched, setPasswordTouched] = useState(false);
  const [isLoading, setIsLoading] = useState(false);
  const [submitAttempted, setSubmitAttempted] = useState(false);
  const [apiError, setApiError] = useState<string | null>(null);

  const emailTrimmed = email.trim();
  const passwordNonEmpty = password.length > 0;
  const emailFormatOk = isValidEmail(email);

  const emailError = useMemo(() => {
    if (!emailTouched && !submitAttempted) return null;
    if (!emailTrimmed) return "Email is required.";
    if (!emailFormatOk) return "Enter a valid email address.";
    return null;
  }, [emailTrimmed, emailFormatOk, emailTouched, submitAttempted]);

  const passwordError = useMemo(() => {
    if (!passwordTouched && !submitAttempted) return null;
    if (!passwordNonEmpty) return "Password is required.";
    return null;
  }, [passwordNonEmpty, passwordTouched, submitAttempted]);

  const submitDisabled =
    !emailTrimmed ||
    !passwordNonEmpty ||
    !emailFormatOk ||
    !apiBaseUrl ||
    isLoading;

  async function onSubmit(e: FormEvent) {
    e.preventDefault();
    setSubmitAttempted(true);
    setEmailTouched(true);
    setPasswordTouched(true);
    setApiError(null);

    if (!apiBaseUrl) {
      setApiError("API base URL is not configured. Set REACT_APP_API_BASE_URL.");
      return;
    }

    const fieldErrorsPresent = !emailTrimmed || !passwordNonEmpty || !emailFormatOk;
    if (fieldErrorsPresent) return;

    setIsLoading(true);
    try {
      const { data } = await axios.post<LoginSuccessBody>(
        `${apiBaseUrl}/auth/login`,
        { email: emailTrimmed, password },
        { headers: { "Content-Type": "application/json" } },
      );

      if (!data?.token || typeof data.token !== "string" || data.token.length === 0) {
        setApiError(GENERIC_ERROR);
        return;
      }

      localStorage.setItem(AUTH_TOKEN_STORAGE_KEY, data.token);
      navigate("/dashboard", { replace: true });
    } catch (err: unknown) {
      if (!isAxiosError(err)) {
        setApiError(GENERIC_ERROR);
        return;
      }

      const status = err.response?.status;
      if (status === 401) {
        setApiError(INVALID_CREDENTIALS);
        return;
      }
      if (typeof status === "number" && status >= 500) {
        setApiError(GENERIC_ERROR);
        return;
      }
      setApiError(GENERIC_ERROR);
    } finally {
      setIsLoading(false);
    }
  }

  return (
    <main className="min-h-screen flex items-center justify-center px-4 py-10">
      <div className="w-full max-w-md rounded-2xl border border-neutral-200 bg-white p-6 shadow-sm sm:p-8">
        <h1 className="text-2xl font-semibold tracking-tight text-neutral-900">
          Sign in
        </h1>
        <p className="mt-2 text-sm text-neutral-600">
          Use your work email and password to continue.
        </p>

        <form className="mt-8 space-y-5" onSubmit={onSubmit} noValidate>
          <div>
            <label
              htmlFor={emailId}
              className="block text-sm font-medium text-neutral-800"
            >
              Email
            </label>
            <input
              id={emailId}
              name="email"
              type="email"
              autoComplete="email"
              inputMode="email"
              spellCheck={false}
              required
              aria-required="true"
              aria-invalid={emailError ? "true" : "false"}
              aria-describedby={emailError ? emailErrorId : undefined}
              className={`mt-1 block w-full rounded-lg border px-3 py-2 text-sm shadow-sm outline-none transition focus:ring-2 ${
                emailError
                  ? "border-red-300 focus:border-red-400 focus:ring-red-200"
                  : "border-neutral-300 focus:border-indigo-500 focus:ring-indigo-200"
              }`}
              value={email}
              onChange={(ev) => setEmail(ev.target.value)}
              onBlur={() => setEmailTouched(true)}
            />
            {emailError ? (
              <p id={emailErrorId} className="mt-2 text-sm text-red-700" role="alert">
                {emailError}
              </p>
            ) : null}
          </div>

          <div>
            <label
              htmlFor={passwordId}
              className="block text-sm font-medium text-neutral-800"
            >
              Password
            </label>
            <input
              id={passwordId}
              name="password"
              type="password"
              autoComplete="current-password"
              required
              aria-required="true"
              aria-invalid={passwordError ? "true" : "false"}
              aria-describedby={passwordError ? passwordErrorId : undefined}
              className={`mt-1 block w-full rounded-lg border px-3 py-2 text-sm shadow-sm outline-none transition focus:ring-2 ${
                passwordError
                  ? "border-red-300 focus:border-red-400 focus:ring-red-200"
                  : "border-neutral-300 focus:border-indigo-500 focus:ring-indigo-200"
              }`}
              value={password}
              onChange={(ev) => setPassword(ev.target.value)}
              onBlur={() => setPasswordTouched(true)}
            />
            {passwordError ? (
              <p
                id={passwordErrorId}
                className="mt-2 text-sm text-red-700"
                role="alert"
              >
                {passwordError}
              </p>
            ) : null}
          </div>

          {apiError ? (
            <p id={apiErrorId} className="text-sm text-red-700" role="alert">
              {apiError}
            </p>
          ) : null}

          <button
            type="submit"
            disabled={submitDisabled}
            aria-busy={isLoading}
            className="inline-flex w-full items-center justify-center gap-2 rounded-lg bg-indigo-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:cursor-not-allowed disabled:opacity-50"
          >
            {isLoading ? (
              <>
                <span
                  className="h-4 w-4 animate-spin rounded-full border-2 border-white/40 border-t-white"
                  aria-hidden="true"
                />
                <span>Signing in…</span>
              </>
            ) : (
              "Sign in"
            )}
          </button>
        </form>
      </div>
    </main>
  );
}
