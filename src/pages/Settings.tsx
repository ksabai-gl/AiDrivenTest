import { useNavigate } from 'react-router-dom';

export default function Settings() {
  const navigate = useNavigate();

  return (
    <main className="page">
      <header className="dashboard__header">
        <h1 className="dashboard__title">Settings</h1>
      </header>
      <section className="dashboard__body" aria-label="Settings content">
        <p className="dashboard__placeholder">Profile and account preferences.</p>
        <button
          type="button"
          className="button button--secondary"
          onClick={() => navigate('/dashboard')}
        >
          Back to Dashboard
        </button>
      </section>
    </main>
  );
}
