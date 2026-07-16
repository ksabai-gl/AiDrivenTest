import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { beforeEach, describe, expect, it } from 'vitest';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import Login from './Login';

function renderLogin(initialPath = '/login') {
  return render(
    <MemoryRouter initialEntries={[initialPath]}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<div>Dashboard page</div>} />
      </Routes>
    </MemoryRouter>
  );
}

describe('Login - credential validation (MAD-111)', () => {
  beforeEach(() => {
    sessionStorage.clear();
  });

  it('stays on login and shows error when username and password are empty', async () => {
    const user = userEvent.setup();
    renderLogin();

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByRole('alert')).toHaveTextContent(
      /username and password are required/i
    );
    expect(screen.getByRole('heading', { name: /sign in/i })).toBeInTheDocument();
    expect(screen.queryByText('Dashboard page')).not.toBeInTheDocument();
    expect(sessionStorage.getItem('auth.session')).toBeNull();
  });

  it('stays on login when only username is provided', async () => {
    const user = userEvent.setup();
    renderLogin();

    await user.type(screen.getByPlaceholderText(/enter username/i), 'demo');
    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByRole('alert')).toBeInTheDocument();
    expect(sessionStorage.getItem('auth.session')).toBeNull();
    expect(screen.queryByText('Dashboard page')).not.toBeInTheDocument();
  });

  it('sets session and navigates to dashboard with valid credentials', async () => {
    const user = userEvent.setup();
    renderLogin();

    await user.type(screen.getByPlaceholderText(/enter username/i), 'demo');
    await user.type(screen.getByPlaceholderText(/enter password/i), 'secret');
    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByText('Dashboard page')).toBeInTheDocument();
    const session = sessionStorage.getItem('auth.session');
    expect(session).toBeTruthy();
    expect(JSON.parse(session as string).username).toBe('demo');
  });
});
