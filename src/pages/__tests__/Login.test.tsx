/**
 * Jira: MBA-29 - Login Button -> Navigate to Empty Dashboard
 * Field-level rendering and submit behaviour for the Login page.
 */
import { describe, it, expect, vi, afterEach } from 'vitest';
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter } from 'react-router-dom';

const navigateMock = vi.fn();

vi.mock('react-router-dom', async () => {
  const actual = await vi.importActual<typeof import('react-router-dom')>(
    'react-router-dom',
  );
  return { ...actual, useNavigate: () => navigateMock };
});

import Login from '../Login';

function renderLogin() {
  return render(
    <MemoryRouter>
      <Login />
    </MemoryRouter>,
  );
}

afterEach(() => {
  navigateMock.mockReset();
});

describe('Login page - rendering', () => {
  it('renders the sign-in heading', () => {
    renderLogin();
    expect(
      screen.getByRole('heading', { name: /sign in/i }),
    ).toBeInTheDocument();
  });

  it('renders username and password fields with correct input types', () => {
    renderLogin();
    const username = screen.getByPlaceholderText(/enter username/i);
    const password = screen.getByPlaceholderText(/enter password/i);
    expect(username).toHaveAttribute('type', 'text');
    expect(password).toHaveAttribute('type', 'password');
  });

  it('renders the Login submit button', () => {
    renderLogin();
    expect(screen.getByRole('button', { name: /login/i })).toBeInTheDocument();
  });

  it('fields default to empty values', () => {
    renderLogin();
    expect(screen.getByPlaceholderText(/enter username/i)).toHaveValue('');
    expect(screen.getByPlaceholderText(/enter password/i)).toHaveValue('');
  });
});

describe('Login page - submit (AC-1)', () => {
  it('navigates to /dashboard when the Login button is clicked', async () => {
    const user = userEvent.setup();
    renderLogin();
    await user.click(screen.getByRole('button', { name: /login/i }));
    expect(navigateMock).toHaveBeenCalledTimes(1);
    expect(navigateMock).toHaveBeenCalledWith('/dashboard');
  });

  it('navigates with valid input entered', async () => {
    const user = userEvent.setup();
    renderLogin();
    await user.type(screen.getByPlaceholderText(/enter username/i), 'jdoe');
    await user.type(screen.getByPlaceholderText(/enter password/i), 'secret');
    await user.click(screen.getByRole('button', { name: /login/i }));
    expect(navigateMock).toHaveBeenCalledWith('/dashboard');
  });

  it('navigates even with empty/invalid input (no auth validation in scope)', async () => {
    // Documents current behaviour: credential validation is intentionally out
    // of scope for MBA-29, so empty input still navigates.
    const user = userEvent.setup();
    renderLogin();
    await user.click(screen.getByRole('button', { name: /login/i }));
    expect(navigateMock).toHaveBeenCalledWith('/dashboard');
  });
});
