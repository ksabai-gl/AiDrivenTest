type ForgotPasswordPageProps = {
  onBack?: () => void;
};

export function ForgotPasswordPage({ onBack }: ForgotPasswordPageProps) {
  return (
    <main>
      <h1>Forgot password</h1>
      <p>Enter your email to receive reset instructions.</p>
      <button type="button" onClick={onBack}>Back to login</button>
    </main>
  );
}
