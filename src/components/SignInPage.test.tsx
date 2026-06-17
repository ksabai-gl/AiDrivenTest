/**
 * MAD-71 — Login Screen automated tests
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-71
 * Traceability: AC-01 through AC-06
 */
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, expect, it, vi } from 'vitest';
import { SignInPage } from './SignInPage';

describe('SignInPage (MAD-71 login screen)', () => {
  it('AC-01: Username field is visible and accepts text entry', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const username = screen.getByLabelText(/username/i);
    expect(username).toBeVisible();
    expect(username).toHaveAttribute('type', 'text');

    await user.type(username, 'testuser');
    expect(username).toHaveValue('testuser');
  });

  it('AC-02: Password field is visible and masks entered characters', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    const password = screen.getByLabelText(/^password$/i);
    expect(password).toBeVisible();
    expect(password).toHaveAttribute('type', 'password');

    await user.type(password, 'secret123');
    expect(password).toHaveValue('secret123');
  });

  it('AC-03: Login button is visible and enabled', () => {
    render(<SignInPage />);

    const loginButton = screen.getByRole('button', { name: /^login$/i });
    expect(loginButton).toBeVisible();
    expect(loginButton).toBeEnabled();
    expect(loginButton).toHaveAttribute('type', 'button');
  });

  it('AC-04: Sign in button is visible and enabled', () => {
    render(<SignInPage />);

    const signInButton = screen.getByRole('button', { name: /sign in/i });
    expect(signInButton).toBeVisible();
    expect(signInButton).toBeEnabled();
    expect(signInButton).toHaveAttribute('type', 'button');
  });

  it('AC-05: Reset password button is visible and enabled', () => {
    render(<SignInPage />);

    const resetButton = screen.getByRole('button', { name: /reset password/i });
    expect(resetButton).toBeVisible();
    expect(resetButton).toBeEnabled();
    expect(resetButton).toHaveAttribute('type', 'button');
  });

  it('AC-06: only the five specified elements are present', () => {
    render(<SignInPage />);

    const form = screen.getByRole('form', { name: /login form/i });
    expect(form.querySelectorAll('input')).toHaveLength(2);
    expect(screen.getByRole('button', { name: /^login$/i })).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /sign in/i })).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /reset password/i })).toBeInTheDocument();
    expect(screen.queryAllByRole('link')).toHaveLength(0);
    expect(screen.queryAllByRole('textbox')).toHaveLength(1);
  });
});

describe('MBA-25 — GlobalLogic brand header', () => {
  /**
   * MBA-25 — Centered GlobalLogic text header on sign-in screen
   * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MBA-25
   * Traceability: AC-D01 through AC-D05
   */
  it('AC-D01: GlobalLogic header is visible above the login form', () => {
    render(<SignInPage />);

    const header = screen.getByRole('heading', { level: 1, name: /globallogic/i });
    const form = screen.getByRole('form', { name: /login form/i });

    expect(header).toBeVisible();
    expect(header).toHaveTextContent('GlobalLogic');
    expect(
      header.compareDocumentPosition(form) & Node.DOCUMENT_POSITION_FOLLOWING,
    ).toBe(Node.DOCUMENT_POSITION_FOLLOWING);
  });

  it('AC-D02: GlobalLogic header is horizontally centered', () => {
    render(<SignInPage />);

    const header = screen.getByRole('heading', { level: 1, name: /globallogic/i });
    expect(header).toHaveStyle({ textAlign: 'center' });
  });

  it('AC-D03: brand header uses primary heading semantics', () => {
    render(<SignInPage />);

    const headings = screen.getAllByRole('heading');
    expect(headings).toHaveLength(2);
    expect(headings[0]).toHaveTextContent('GlobalLogic');
    expect(headings[0].tagName).toBe('H1');
    expect(headings[1]).toHaveTextContent('Login');
    expect(headings[1].tagName).toBe('H2');
  });

  it('AC-D04: login form controls remain functional with new header', async () => {
    const user = userEvent.setup();
    render(<SignInPage />);

    await user.type(screen.getByLabelText(/username/i), 'testuser');
    await user.type(screen.getByLabelText(/^password$/i), 'secret123');

    expect(screen.getByLabelText(/username/i)).toHaveValue('testuser');
    expect(screen.getByLabelText(/^password$/i)).toHaveValue('secret123');
    expect(screen.getByRole('button', { name: /^login$/i })).toBeEnabled();
    expect(screen.getByRole('button', { name: /sign in/i })).toBeEnabled();
    expect(screen.getByRole('button', { name: /reset password/i })).toBeEnabled();
  });

  it('AC-D05: GlobalLogic text is present in rendered output', () => {
    render(<SignInPage />);

    expect(screen.getByText(/globallogic/i)).toBeInTheDocument();
  });
});

describe('MAD-72 — forgot password onclick', () => {
  it('should call onResetPassword when Reset password button is clicked', async () => {
    const user = userEvent.setup();
    const onResetPassword = vi.fn();
    render(<SignInPage onResetPassword={onResetPassword} />);

    await user.click(screen.getByRole('button', { name: /reset password/i }));
    expect(onResetPassword).toHaveBeenCalledTimes(1);
  });
});
