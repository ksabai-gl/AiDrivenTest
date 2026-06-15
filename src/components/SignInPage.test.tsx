/**
 * MAD-71 — Sign-In Screen automated tests
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-71
 * Traceability: AC-01 through AC-06
 */
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, expect, it } from 'vitest';
import { SignInPage } from './SignInPage';

describe('SignInPage (MAD-71)', () => {
  it('AC-01: Username field is visible and accepts text entry', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const username = screen.getByLabelText(/username/i);
    expect(username).toBeVisible();
    expect(username).toHaveAttribute('type', 'text');

    await user.type(username, 'testuser');
    expect(username).toHaveValue('testuser');
  });

  it('AC-02: Email field is visible and accepts text entry', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const email = screen.getByLabelText(/^email$/i);
    expect(email).toBeVisible();
    expect(email).toHaveAttribute('type', 'email');

    await user.type(email, 'user@example.com');
    expect(email).toHaveValue('user@example.com');
  });

  it('AC-03: Password field is visible and masks entered characters', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const password = screen.getByLabelText(/^password$/i);
    expect(password).toBeVisible();
    expect(password).toHaveAttribute('type', 'password');

    await user.type(password, 'secret123');
    expect(password).toHaveValue('secret123');
  });

  it('AC-04: Confirm Password field is visible and masks entered characters', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const confirmPassword = screen.getByLabelText(/confirm password/i);
    expect(confirmPassword).toBeVisible();
    expect(confirmPassword).toHaveAttribute('type', 'password');

    await user.type(confirmPassword, 'secret123');
    expect(confirmPassword).toHaveValue('secret123');
  });

  it('AC-05: Sign in button is visible and enabled', () => {
    render(<SignInPage />);

    const signInButton = screen.getByRole('button', { name: /sign in/i });
    expect(signInButton).toBeVisible();
    expect(signInButton).toBeEnabled();
    expect(signInButton).toHaveAttribute('type', 'button');
  });

  it('AC-06: only the five specified elements are present', () => {
    render(<SignInPage />);

    const form = screen.getByRole('form', { name: /sign in form/i });
    expect(form.querySelectorAll('input')).toHaveLength(4);
    expect(screen.getByRole('button', { name: /sign in/i })).toBeInTheDocument();
    expect(screen.queryAllByRole('link')).toHaveLength(0);
    expect(screen.queryAllByRole('textbox')).toHaveLength(2);
  });
});
