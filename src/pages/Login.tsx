import axios from "axios";
import { FormEvent, useMemo, useState } from "react";
import { useNavigate } from "react-router-dom";
import { saveToken } from "../auth/storage";

interface LoginResponse {
  token: string;
}

const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const getApiBaseUrl = (): string => {
  const baseUrl = import.meta.env.REACT_APP_API_BASE_URL as string | undefined;

  if (!baseUrl) {
    throw new Error("REACT_APP_API_BASE_URL is not configured.");
  }

  return baseUrl;
};

const Login = () => {
  const navigate = useNavigate();
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [emailTouched, setEmailTouched] = useState(false);

  const hasEmailFormatError = useMemo(() => {
    return emailTouched && email.length > 0 && !emailRegex.test(email);
  }, [emailTouched, email]);

  const isSubmitDisabled = !email || !password || hasEmailFormatError || isLoading;

  const handleSubmit = async (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setEmailTouched(true);
    setError(null);

    if (!email || !password) {
      return;
    }

    if (!emailRegex.test(email)) {
      return;
    }

    setIsLoading(true);

    try {
      const apiBaseUrl = getApiBaseUrl();
      const response = await axios.post<LoginResponse>(`${apiBaseUrl}/auth/login`, {
        email,
        password
      });

      saveToken(response.data.token);
      navigate("/dashboard");
    } catch (err) {
      const status = axios.isAxiosError(err)
        ? err.response?.status
        : (err as { response?: { status?: number } })?.response?.status;

      if (status === 401) {
        setError("Invalid email or password");
      } else if ((status ?? 0) >= 500) {
        setError("Something went wrong. Please try again.");
      } else {
        setError("Unable to sign in. Please check your details and try again.");
      }
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <main className="flex min-h-screen items-center justify-center bg-slate-100 px-4 py-8">
      <section className="w-full max-w-md rounded-xl bg-white p-6 shadow sm:p-8">
        <h1 className="mb-6 text-2xl font-semibold text-slate-900">Login</h1>
        <form onSubmit={handleSubmit} className="space-y-4" noValidate>
          <div>
            <label htmlFor="email" className="mb-1 block text-sm font-medium text-slate-700">
              Email
            </label>
            <input
              id="email"
              name="email"
              type="email"
              inputMode="email"
              autoComplete="email"
              value={email}
              onChange={(event) => setEmail(event.target.value)}
              onBlur={() => setEmailTouched(true)}
              aria-invalid={hasEmailFormatError}
              aria-describedby={hasEmailFormatError ? "email-error" : undefined}
              className="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-blue-500 transition focus:ring-2"
            />
            {hasEmailFormatError ? (
              <p id="email-error" className="mt-1 text-sm text-red-600">
                Please enter a valid email address.
              </p>
            ) : null}
          </div>

          <div>
            <label htmlFor="password" className="mb-1 block text-sm font-medium text-slate-700">
              Password
            </label>
            <input
              id="password"
              name="password"
              type="password"
              autoComplete="current-password"
              value={password}
              onChange={(event) => setPassword(event.target.value)}
              className="w-full rounded-md border border-slate-300 px-3 py-2 text-sm text-slate-900 shadow-sm outline-none ring-blue-500 transition focus:ring-2"
            />
          </div>

          {error ? (
            <p role="alert" className="rounded-md bg-red-50 px-3 py-2 text-sm text-red-700">
              {error}
            </p>
          ) : null}

          <button
            type="submit"
            disabled={isSubmitDisabled}
            className="flex w-full items-center justify-center gap-2 rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white transition hover:bg-blue-700 disabled:cursor-not-allowed disabled:bg-blue-400"
          >
            {isLoading ? (
              <>
                <span
                  className="h-4 w-4 animate-spin rounded-full border-2 border-white border-t-transparent"
                  aria-hidden="true"
                />
                <span>Signing in...</span>
              </>
            ) : (
              "Login"
            )}
          </button>
        </form>
      </section>
    </main>
  );
};

export default Login;
