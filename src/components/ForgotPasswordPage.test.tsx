import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, expect, it, vi } from 'vitest';
import { ForgotPasswordPage } from './ForgotPasswordPage';

describe('ForgotPasswordPage', () => {
  it('should render without onBack prop', () => {
    render(<ForgotPasswordPage />);
    expect(screen.getByRole('heading', { name: /forgot password/i })).toBeVisible();
  });

  it('should call onBack when Back to login is clicked', async () => {
    const user = userEvent.setup();
    const onBack = vi.fn();
    render(<ForgotPasswordPage onBack={onBack} />);

    await user.click(screen.getByRole('button', { name: /back to login/i }));
    expect(onBack).toHaveBeenCalledTimes(1);
  });

  it('should not throw when Back clicked without onBack', async () => {
    const user = userEvent.setup();
    render(<ForgotPasswordPage />);
    await expect(
      user.click(screen.getByRole('button', { name: /back to login/i }))
    ).resolves.not.toThrow();
  });
});
