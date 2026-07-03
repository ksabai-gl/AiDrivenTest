/**
 * Empty/placeholder dashboard. Account widgets and data binding are out of
 * scope for MBA-29 and will be added in future stories.
 */
import { useNavigate } from 'react-router-dom';
import GlobalLogicLogo from '../components/GlobalLogicLogo';

export default function Dashboard() {
  const navigate = useNavigate();

  const handleOpenSettings = () => {
    navigate('/settings');
  };

  return (
    <main className="page">
      <header className="dashboard__header">
        <div className="brand">
          <GlobalLogicLogo />
          <span className="brand__name">GlobalLogic</span>
        </div>
        <h1 className="dashboard__title">Dashboard</h1>
        <div className="dashboard__actions">
          <button
            type="button"
            className="profile-button"
            aria-label="Profile settings"
            onClick={handleOpenSettings}
          >
            <span className="profile-button__icon" aria-hidden="true">
              👤
            </span>
          </button>
        </div>
      </header>
      <section className="dashboard__body" aria-label="Dashboard content">
        <p className="dashboard__placeholder">
          Welcome. Your account overview will appear here.
        </p>
      </section>
    </main>
  );
}
