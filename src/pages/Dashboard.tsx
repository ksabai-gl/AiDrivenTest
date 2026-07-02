/**
 * Empty/placeholder dashboard. Account widgets and data binding are out of
 * scope for MBA-29 and will be added in future stories.
 */
export default function Dashboard() {
  return (
    <main className="page">
      <header className="dashboard__header">
        <div className="brand">
          <span className="brand__logo" aria-hidden="true">GL</span>
          <span className="brand__name">GlobalLogic</span>
        </div>
        <h1 className="dashboard__title">Dashboard</h1>
      </header>
      <section className="dashboard__body" aria-label="Dashboard content">
        <p className="dashboard__placeholder">
          Welcome. Your account overview will appear here.
        </p>
      </section>
    </main>
  );
}
