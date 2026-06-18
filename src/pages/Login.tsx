import { FormEvent } from 'react';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const navigate = useNavigate();

  const handleLogin = (event: FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    navigate('/dashboard');
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
          <button className="button" type="submit">
            Login
          </button>
        </form>
      </section>
    </main>
  );
}
