/**
 * MAD-88 — Forgot password screen
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-88
 */
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import { describe, expect, it } from 'vitest';
import ForgotPassword from './ForgotPassword';
import Login from './Login';

function renderForgotPasswordAt(path = '/forgot-password') {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/forgot-password" element={<ForgotPassword />} />
      </Routes>
    </MemoryRouter>
  );
}

describe('ForgotPassword — MAD-88', () => {
  it('renders heading, subtitle, and email field', () => {
    renderForgotPasswordAt();

    expect(
      screen.getByRole('heading', { level: 1, name: /forgot password/i })
    ).toBeInTheDocument();
    expect(
      screen.getByText(/enter your email to receive reset instructions/i)
    ).toBeInTheDocument();
    expect(screen.getByLabelText(/^email$/i)).toHaveAttribute('type', 'email');
  });

  it('renders Back to login link pointing to /login', () => {
    renderForgotPasswordAt();
    const backLink = screen.getByRole('link', { name: /back to login/i });
    expect(backLink).toHaveAttribute('href', '/login');
  });

  it('navigates back to login when Back to login is clicked', async () => {
    const user = userEvent.setup();
    renderForgotPasswordAt();

    await user.click(screen.getByRole('link', { name: /back to login/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();
  });

  it('accepts email input', async () => {
    const user = userEvent.setup();
    renderForgotPasswordAt();

    const email = screen.getByLabelText(/^email$/i);
    await user.type(email, 'user@example.com');
    expect(email).toHaveValue('user@example.com');
  });
});
