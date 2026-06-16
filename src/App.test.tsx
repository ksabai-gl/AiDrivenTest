/**
 * MAD-72 — App view switching
 * MBA-24 — GlobalLogic logo integration at App level
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-72
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MBA-24
 */
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

describe('MBA-24 — GlobalLogic logo at App level', () => {
  it('MBA-24-INT-01: logo is visible when App renders the login screen', () => {
    render(<App />);

    expect(screen.getByRole('img', { name: /globallogic logo/i })).toBeVisible();
  });

  it('MBA-24-INT-02: centered GlobalLogic logo appears at top when login screen loads', () => {
    const { container } = render(<App />);
    const logo = screen.getByRole('img', { name: /globallogic logo/i });
    const main = container.querySelector('main');

    expect(logo).toBeVisible();
    expect(main?.firstElementChild).toContainElement(logo);
    expect(logo.parentElement).toHaveStyle({ justifyContent: 'center' });
  });

  it('MBA-24-REG-02: logo is not shown on the forgot password view', async () => {
    const user = userEvent.setup();
    render(<App />);

    await user.click(screen.getByRole('button', { name: /reset password/i }));

    expect(screen.queryByRole('img', { name: /globallogic logo/i })).not.toBeInTheDocument();
  });
});
