import globalLogicLogo from '../assets/globalogic-logo.svg';

type SignInPageProps = {
  onResetPassword?: () => void;
};

export function SignInPage({ onResetPassword }: SignInPageProps) {
  return (
    <main>
      <div
        style={{
          display: 'flex',
          justifyContent: 'center',
          marginBottom: '1.5rem',
        }}
      >
        <img
          src={globalLogicLogo}
          alt="GlobalLogic logo"
          style={{ maxWidth: '200px', width: '100%', height: 'auto' }}
        />
      </div>
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
        <button type="button" onClick={onResetPassword}>Reset password</button>
      </form>
    </main>
  );
}
