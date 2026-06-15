export function SignInPage() {
  return (
    <>
      <header style={{ display: 'flex', justifyContent: 'flex-end', padding: '12px 16px' }}>
        <button type="button" aria-label="Logout" style={{ background: 'none', border: 'none', cursor: 'pointer' }}>
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round">
            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
            <polyline points="16 17 21 12 16 7" />
            <line x1="21" y1="12" x2="9" y2="12" />
          </svg>
        </button>
      </header>
      <main>
        <h1>Login</h1>
        <form aria-label="Login form">
          <div>
            <label htmlFor="username">Username</label>
            <input id="username" name="username" type="text" autoComplete="username" />
          </div>
          <div>
            <label htmlFor="password">Password</label>
            <input id="password" name="password" type="password" autoComplete="current-password" />
          </div>
          <button type="button">Login</button>
          <button type="button">Sign in</button>
          <button type="button">Reset password</button>
        </form>
      </main>
    </>
  );
}
