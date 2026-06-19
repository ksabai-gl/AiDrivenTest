import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, it, expect } from 'vitest';
import { MemoryRouter, Navigate, Route, Routes } from 'react-router-dom';
import Login from './Login';
import Dashboard from './Dashboard';

/**
 * MBA-29 — "Login Button - Navigate to Empty Dashboard".
 *
 * The story: clicking Login on the sign-in screen should land the user on an
 * (intentionally) empty Dashboard, confirming successful entry before account
 * features exist. These tests exercise the real Login -> /dashboard flow
 * through the router rather than rendering Dashboard in isolation.
 */
describe('Login navigation (MBA-29)', () => {
  const renderWithRouter = () =>
    render(
      <MemoryRouter initialEntries={['/login']}>
        <Routes>
          <Route path="/login" element={<Login />} />
          <Route path="/dashboard" element={<Dashboard />} />
          <Route path="*" element={<Navigate to="/login" replace />} />
        </Routes>
      </MemoryRouter>,
    );

  it('renders the Login button on the sign-in screen', () => {
    renderWithRouter();
    expect(
      screen.getByRole('button', { name: /login/i }),
    ).toBeInTheDocument();
  });

  it('navigates to the Dashboard route when Login is clicked', async () => {
    const user = userEvent.setup();
    renderWithRouter();

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' }),
    ).toBeInTheDocument();
  });

  it('lands on the empty Dashboard placeholder after login', async () => {
    const user = userEvent.setup();
    renderWithRouter();

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByLabelText('Dashboard content')).toBeInTheDocument();
    expect(
      screen.getByText(/Your account overview will appear here/i),
    ).toBeInTheDocument();
  });

  it('no longer shows the sign-in form once on the Dashboard', async () => {
    const user = userEvent.setup();
    renderWithRouter();

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(
      screen.queryByRole('heading', { level: 1, name: 'Sign in' }),
    ).not.toBeInTheDocument();
  });
});
