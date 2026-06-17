import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, expect, it } from 'vitest';
import { App } from './App';

describe('App (MAD-72 view switching)', () => {
  it('should show ForgotPasswordPage after clicking Reset password', async () => {
    const user = userEvent.setup();
    render(<App />);

    expect(screen.getByRole('heading', { name: /login/i })).toBeVisible();
    await user.click(screen.getByRole('button', { name: /reset password/i }));

    expect(screen.getByRole('heading', { name: /forgot password/i })).toBeVisible();
    expect(screen.queryByRole('heading', { name: /^login$/i })).not.toBeInTheDocument();
  });

  it('should return to SignInPage when Back to login is clicked', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /reset password/i }));
    await user.click(screen.getByRole('button', { name: /back to login/i }));

    expect(screen.getByRole('heading', { name: /login/i })).toBeVisible();
  });
});

describe('MBA-28 — login navigates to dashboard', () => {
  /**
   * MBA-28 — Login Button Navigates to Dashboard
   * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MBA-28
   */
  it('AC-D01: should show Dashboard after clicking Login', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /^login$/i }));

    expect(screen.getByRole('heading', { name: /^dashboard$/i })).toBeVisible();
    expect(screen.queryByRole('form', { name: /login form/i })).not.toBeInTheDocument();
  });

  it('AC-D01: Sign in button does not navigate to Dashboard', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /sign in/i }));

    expect(screen.getByRole('form', { name: /login form/i })).toBeVisible();
    expect(screen.queryByRole('heading', { name: /^dashboard$/i })).not.toBeInTheDocument();
  });

  it('AC-D01: Login navigates with empty username and password', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /^login$/i }));

    expect(screen.getByRole('heading', { name: /^dashboard$/i })).toBeVisible();
  });

  it('AC-D02: Dashboard main content area is empty after Login', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /^login$/i }));

    expect(screen.getByLabelText(/dashboard content/i)).toBeEmptyDOMElement();
  });
});
