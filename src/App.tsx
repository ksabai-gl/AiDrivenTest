import { Navigate, Route, Routes } from 'react-router-dom';
import Login from './pages/Login';
import Dashboard from './pages/Dashboard';
import Settings from './pages/Settings';

/**
 * Navigation is intentionally decoupled from authentication so credential
 * validation can be layered in later (see MBA-29 technical notes).
 */
export default function App() {
  return (
    <Routes>
      <Route path="/" element={<Navigate to="/login" replace />} />
      <Route path="/login" element={<Login />} />
      <Route path="/dashboard" element={<Dashboard />} />
      <Route path="/settings" element={<Settings />} />
      <Route path="*" element={<Navigate to="/login" replace />} />
    </Routes>
  );
}
