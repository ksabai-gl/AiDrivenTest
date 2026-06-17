import { useState } from 'react';
import { SignInPage } from './components/SignInPage';
import { ForgotPasswordPage } from './components/ForgotPasswordPage';
import { DashboardPage } from './components/DashboardPage';

type View = 'sign-in' | 'forgot-password' | 'dashboard';

export function App() {
  const [view, setView] = useState<View>('sign-in');

  if (view === 'forgot-password') {
    return <ForgotPasswordPage onBack={() => setView('sign-in')} />;
  }

  if (view === 'dashboard') {
    return <DashboardPage />;
  }

  return (
    <SignInPage
      onResetPassword={() => setView('forgot-password')}
      onLogin={() => setView('dashboard')}
    />
  );
}
