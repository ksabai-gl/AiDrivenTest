/**
 * MAD-71 — Login Screen automated tests
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-71
 * Traceability: AC-01 through AC-05
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

  it('AC-06: login form elements remain present with logo branding', () => {
    render(<SignInPage />);

    const form = screen.getByRole('form', { name: /login form/i });
    expect(form.querySelectorAll('input')).toHaveLength(2);
    expect(screen.getByRole('button', { name: /^login$/i })).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /sign in/i })).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /reset password/i })).toBeInTheDocument();
    expect(screen.queryAllByRole('link')).toHaveLength(0);
    expect(screen.queryAllByRole('textbox')).toHaveLength(1);
    expect(screen.getByRole('img', { name: /globallogic logo/i })).toBeInTheDocument();
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

describe('MBA-24 — GlobalLogic logo centered at top', () => {
  it('AC-01: logo is visible and horizontally centered at top of login screen', () => {
    render(<SignInPage />);

    const logo = screen.getByRole('img', { name: /globallogic logo/i });
    expect(logo).toBeVisible();
    expect(logo).toHaveAttribute('src');

    const container = logo.parentElement;
    expect(container).toHaveStyle({ display: 'flex', justifyContent: 'center' });
  });

  it('AC-02: logo uses the GlobalLogic brand asset', () => {
    render(<SignInPage />);

    const logo = screen.getByRole('img', { name: /globallogic logo/i });
    expect(logo.getAttribute('src')).toMatch(/globalogic-logo/i);
  });

  it('AC-03: login form appears below the logo and remains usable', () => {
    const { container } = render(<SignInPage />);

    const main = container.querySelector('main');
    expect(main).not.toBeNull();

    const children = Array.from(main!.children);
    const logoIndex = children.findIndex((el) => el.querySelector('img[alt="GlobalLogic logo"]'));
    const headingIndex = children.findIndex((el) => el.tagName === 'H1');
    const formIndex = children.findIndex((el) => el.getAttribute('aria-label') === 'Login form');

    expect(logoIndex).toBeGreaterThanOrEqual(0);
    expect(headingIndex).toBeGreaterThan(logoIndex);
    expect(formIndex).toBeGreaterThan(logoIndex);

    const logo = screen.getByRole('img', { name: /globallogic logo/i });
    expect(screen.getByLabelText(/username/i)).toBeVisible();
    expect(screen.getByLabelText(/^password$/i)).toBeVisible();
    expect(logo).toHaveStyle({ maxWidth: '200px' });
  });

  it('AC-04: logo has descriptive alt text for assistive technology', () => {
    render(<SignInPage />);

    expect(screen.getByAltText('GlobalLogic logo')).toBeInTheDocument();
  });
});
