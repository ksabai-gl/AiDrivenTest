import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import { describe, it, expect } from 'vitest';
import Login from './Login';
import Dashboard from './Dashboard';

function LoginWithRouter({ initialEntry = '/login' }: { initialEntry?: string }) {
  return (
    <MemoryRouter initialEntries={[initialEntry]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
      </Routes>
    </MemoryRouter>
  );
}

describe('Login — sign-in form (MBA-21)', () => {
  it('renders username and password fields with accessible labels', () => {
    render(<LoginWithRouter />);

    expect(screen.getByRole('textbox', { name: /username/i })).toBeInTheDocument();
    expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
  });

  it('renders the Login submit button', () => {
    render(<LoginWithRouter />);

    expect(screen.getByRole('button', { name: /login/i })).toHaveAttribute(
      'type',
      'submit'
    );
  });

  it('navigates to dashboard on form submit without requiring credentials (AC-D01)', async () => {
    const user = userEvent.setup();
    render(<LoginWithRouter />);

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: /dashboard/i })
    ).toBeInTheDocument();
  });

  it('allows empty username and password (no client-side validation)', async () => {
    const user = userEvent.setup();
    render(<LoginWithRouter />);

    expect(screen.getByRole('textbox', { name: /username/i })).toHaveValue('');
    expect(screen.getByLabelText(/password/i)).toHaveValue('');

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: /dashboard/i })
    ).toBeInTheDocument();
  });
});
