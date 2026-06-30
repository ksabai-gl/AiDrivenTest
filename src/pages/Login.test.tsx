/**
 * MAD-88 — Forgot password link on login screen
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-88
 */
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import { describe, expect, it } from 'vitest';
import Login from './Login';
import ForgotPassword from './ForgotPassword';

function renderLoginAt(path = '/login') {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/forgot-password" element={<ForgotPassword />} />
        <Route path="/dashboard" element={<div>Dashboard page</div>} />
      </Routes>
    </MemoryRouter>
  );
}

describe('Login — MAD-88 forgot password', () => {
  it('renders a Forgot password? link on the login form', () => {
    renderLoginAt();
    const link = screen.getByRole('link', { name: /forgot password\?/i });
    expect(link).toBeVisible();
    expect(link).toHaveAttribute('href', '/forgot-password');
  });

  it('navigates to forgot-password when the link is clicked', async () => {
    const user = userEvent.setup();
    renderLoginAt();

    await user.click(screen.getByRole('link', { name: /forgot password\?/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: /forgot password/i })
    ).toBeInTheDocument();
    expect(screen.getByLabelText(/forgot password form/i)).toBeInTheDocument();
  });
});

describe('Login — regression (MBA-29)', () => {
  it('REGRESSION: renders username and password fields', () => {
    renderLoginAt();
    expect(screen.getByLabelText(/username/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/^password$/i)).toBeInTheDocument();
  });

  it('REGRESSION: login form submit navigates to dashboard', async () => {
    const user = userEvent.setup();
    renderLoginAt();

    await user.click(screen.getByRole('button', { name: /^login$/i }));

    expect(screen.getByText('Dashboard page')).toBeInTheDocument();
  });

  it('REGRESSION: Sign in heading is unchanged', () => {
    renderLoginAt();
    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();
  });
});
