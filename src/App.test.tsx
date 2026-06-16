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
