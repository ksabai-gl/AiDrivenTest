export function SignInPage() {
  return (
    <main>
      <h1>Sign In</h1>
      <form aria-label="Sign in form">
        <div>
          <label htmlFor="username">Username</label>
          <input id="username" name="username" type="text" autoComplete="username" />
        </div>
        <div>
          <label htmlFor="email">Email</label>
          <input id="email" name="email" type="email" autoComplete="email" />
        </div>
        <div>
          <label htmlFor="password">Password</label>
          <input id="password" name="password" type="password" autoComplete="current-password" />
        </div>
        <div>
          <label htmlFor="confirmPassword">Confirm Password</label>
          <input
            id="confirmPassword"
            name="confirmPassword"
            type="password"
            autoComplete="new-password"
          />
        </div>
        <button type="button">Sign in</button>
      </form>
    </main>
  );
}
