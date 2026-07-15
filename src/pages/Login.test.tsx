/**
 * MAD-80 - Remind me checkbox on login screen (UI-only)
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-80
 */
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import { describe, expect, it } from 'vitest';
import Login from './Login';

function renderLoginAt(path = '/login') {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<div>Dashboard page</div>} />
      </Routes>
    </MemoryRouter>
  );
}

describe('Login - MAD-80 Remind me', () => {
  it('renders a Remind me checkbox on the login form', () => {
    renderLoginAt();
    const checkbox = screen.getByRole('checkbox', { name: /remind me/i });
    expect(checkbox).toBeVisible();
    expect(checkbox).not.toBeChecked();
  });

  it('toggles Remind me without blocking login (UI-only)', async () => {
    const user = userEvent.setup();
    renderLoginAt();
    const checkbox = screen.getByRole('checkbox', { name: /remind me/i });
    await user.click(checkbox);
    expect(checkbox).toBeChecked();
  });
});

describe('Login - regression (MBA-29 / NAV-001)', () => {
  it('REGRESSION: renders username and password fields', () => {
    renderLoginAt();
    expect(screen.getByPlaceholderText(/enter username/i)).toBeInTheDocument();
    expect(screen.getByPlaceholderText(/enter password/i)).toBeInTheDocument();
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