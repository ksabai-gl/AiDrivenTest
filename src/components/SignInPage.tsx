type SignInPageProps = {
  onResetPassword?: () => void;
  onLogin?: () => void;
};

export function SignInPage({ onResetPassword, onLogin }: SignInPageProps) {
  return (
    <main>
      <h1 style={{ textAlign: 'center' }}>GlobalLogic</h1>
      <h2>Login</h2>
      <form aria-label="Login form">
        <div>
          <label htmlFor="username">Username</label>
          <input id="username" name="username" type="text" autoComplete="username" />
        </div>
        <div>
          <label htmlFor="password">Password</label>
          <input id="password" name="password" type="password" autoComplete="current-password" />
        </div>
        <button type="button" onClick={onLogin}>Login</button>
        <button type="button">Sign in</button>
        <button type="button" onClick={onResetPassword}>Reset password</button>
      </form>
    </main>
  );
}
