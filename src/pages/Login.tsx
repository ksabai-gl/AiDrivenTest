import React, { useState, useEffect, useRef } from 'react';
import { useNavigate, useLocation } from 'react-router-dom';
import axios from 'axios';
import styles from './Login.module.css';

const EMAIL_REGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const isValidEmail = (value: string): boolean => EMAIL_REGEX.test(value);

interface LocationState {
  from?: string;
}

const Login: React.FC = () => {
  const navigate = useNavigate();
  const location = useLocation();

  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const [isLoading, setIsLoading] = useState(false);
  const [errorMessage, setErrorMessage] = useState<string | null>(null);
  const [emailError, setEmailError] = useState<string | null>(null);

  const passwordRef = useRef<HTMLInputElement>(null);

  // AC-B03: redirect away if already authenticated
  useEffect(() => {
    if (localStorage.getItem('authToken')) {
      navigate('/dashboard', { replace: true });
    }
  }, [navigate]);

  // AC-C01 / AC-C04: inline email validation on change
  const handleEmailChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    const value = e.target.value;
    setEmail(value);
    if (value && !isValidEmail(value)) {
      setEmailError('Please enter a valid email address');
    } else {
      setEmailError(null);
    }
  };

  // AC-A02 / AC-A03 / AC-C01: button disabled logic
  const isSubmitDisabled =
    !email.trim() || !password.trim() || !isValidEmail(email) || isLoading;

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    if (isSubmitDisabled) return;

    setIsLoading(true);
    setErrorMessage(null);

    try {
      const baseUrl = process.env.REACT_APP_API_BASE_URL ?? '';
      // AC-C09: POST with { email, password }, Content-Type: application/json (axios default)
      const response = await axios.post(`${baseUrl}/api/auth/login`, { email, password });

      // AC-B01 / AC-A04: store JWT and navigate
      localStorage.setItem('authToken', response.data.token);
      const from = (location.state as LocationState)?.from ?? '/dashboard';
      navigate(from, { replace: true });
    } catch (err) {
      if (axios.isAxiosError(err) && err.response?.status === 401) {
        // AC-A05 / AC-C03 / AC-B02: 401 — show message, no token stored
        setErrorMessage('Invalid email or password. Please try again.');
      } else {
        // AC-C07: network / 5xx
        setErrorMessage('An unexpected error occurred. Please try again later.');
      }
      // AC-A06: clear password and refocus
      setPassword('');
      passwordRef.current?.focus();
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <main className={styles.container}>
      <div className={styles.card} role="main">
        <h1 className={styles.title}>Sign In</h1>

        <form onSubmit={handleSubmit} noValidate aria-label="Login form">
          {/* Email field */}
          <div className={styles.field}>
            <label htmlFor="email" className={styles.label}>
              Email
            </label>
            <input
              id="email"
              type="email"
              className={`${styles.input} ${emailError ? styles.inputError : ''}`}
              value={email}
              onChange={handleEmailChange}
              autoComplete="email"
              aria-describedby={emailError ? 'email-error' : undefined}
              aria-invalid={!!emailError}
              disabled={isLoading}
            />
            {/* AC-C01: inline email validation message */}
            {emailError && (
              <span id="email-error" className={styles.fieldError} role="alert">
                {emailError}
              </span>
            )}
          </div>

          {/* Password field — AC-C08: type="password" */}
          <div className={styles.field}>
            <label htmlFor="password" className={styles.label}>
              Password
            </label>
            <input
              id="password"
              type="password"
              className={styles.input}
              value={password}
              onChange={(e) => setPassword(e.target.value)}
              autoComplete="current-password"
              ref={passwordRef}
              disabled={isLoading}
            />
          </div>

          {/* AC-A05 / AC-C03 / AC-C07: API error message */}
          {errorMessage && (
            <p className={styles.errorMessage} role="alert" aria-live="assertive">
              {errorMessage}
            </p>
          )}

          {/* AC-A02 / AC-A03 / AC-C06: disabled + loading state */}
          <button
            type="submit"
            className={styles.button}
            disabled={isSubmitDisabled}
            aria-busy={isLoading}
          >
            {isLoading ? 'Signing in…' : 'Login'}
          </button>
        </form>
      </div>
    </main>
  );
};

export default Login;
