import { FormEvent, useState } from 'react';
import { setSession } from '../auth/auth';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const navigate = useNavigate();
  const [error, setError] = useState<string | null>(null);

  const handleLogin = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setError(null);

    const form = event.currentTarget;
    const username = String(new FormData(form).get('username') ?? '').trim();
    const password = String(new FormData(form).get('password') ?? '');

    if (!username || !password) {
      setError('Username and password are required.');
      return;
    }

    setSession(username);
    navigate('/dashboard', { replace: true });
  };

  return (
    <main className="page page--centered">
      <section className="card" aria-labelledby="login-heading">
        <h1 id="login-heading" className="card__title">
          Sign in
        </h1>
        <form className="form" onSubmit={handleLogin}>
          <label className="field">
            <span className="field__label">Username</span>
            <input
              className="field__input"
              type="text"
              name="username"
              autoComplete="username"
              placeholder="Enter username"
            />
          </label>
          <label className="field">
            <span className="field__label">Password</span>
            <input
              className="field__input"
              type="password"
              name="password"
              autoComplete="current-password"
              placeholder="Enter password"
            />
          </label>
          {error ? (
            <p className="form__error" role="alert">
              {error}
            </p>
          ) : null}
          <button className="button" type="submit">
            Login
          </button>
        </form>
      </section>
    </main>
  );
}
