import type { ReactNode } from 'react';
import { Navigate, useLocation } from 'react-router-dom';

export default function RequireAuth({ children }: { children: ReactNode }) {
  const location = useLocation();
  const hasSession = Boolean(sessionStorage.getItem('auth.session'));
  if (!hasSession) {
    return <Navigate to="/login" replace state={{ from: location }} />;
  }
  return <>{children}</>;
}
