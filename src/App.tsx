import { useState } from 'react';
import { SignInPage } from './components/SignInPage';
import { ForgotPasswordPage } from './components/ForgotPasswordPage';

type View = 'sign-in' | 'forgot-password';

export function App() {
  const [view, setView] = useState<View>('sign-in');

  if (view === 'forgot-password') {
    return <ForgotPasswordPage onBack={() => setView('sign-in')} />;
  }

  return <SignInPage onResetPassword={() => setView('forgot-password')} />;
}
