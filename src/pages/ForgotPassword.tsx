import { Link } from 'react-router-dom';

export default function ForgotPassword() {
  return (
    <main className="page page--centered">
      <section className="card" aria-labelledby="forgot-heading">
        <h1 id="forgot-heading" className="card__title">
          Forgot password
        </h1>
        <p className="card__subtitle">
          Enter your email to receive reset instructions.
        </p>
        <form className="form" aria-label="Forgot password form">
          <label className="field">
            <span className="field__label">Email</span>
            <input
              className="field__input"
              type="email"
              name="email"
              autoComplete="email"
              placeholder="Enter email"
            />
          </label>
          <Link to="/login" className="button button--secondary">
            Back to login
          </Link>
        </form>
      </section>
    </main>
  );
}
