import React from 'react';
import { render, screen, waitFor } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import '@testing-library/jest-dom';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import axios from 'axios';
import Login from '../Login';

jest.mock('axios');
const mockedAxios = axios as jest.Mocked<typeof axios>;

// Helper: render Login inside a router, optionally with location state and initial localStorage
function renderLogin(options: { from?: string; authToken?: string } = {}) {
  if (options.authToken) {
    localStorage.setItem('authToken', options.authToken);
  }
  const initialEntries = options.from
    ? [{ pathname: '/login', state: { from: options.from } }]
    : ['/login'];

  return render(
    <MemoryRouter initialEntries={initialEntries}>
      <Routes>
        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<div>Dashboard</div>} />
        <Route path="/protected" element={<div>Protected</div>} />
      </Routes>
    </MemoryRouter>,
  );
}

const VALID_EMAIL = 'user@example.com';
const VALID_PASSWORD = 'secret123';

afterEach(() => {
  jest.restoreAllMocks();
  localStorage.clear();
});

// ─── AC-A01: Render ───────────────────────────────────────────────────────────

describe('Login form rendering', () => {
  it('should render email input, password input, and Login button', () => {
    renderLogin();

    expect(screen.getByLabelText(/email/i)).toBeInTheDocument();
    expect(screen.getByLabelText(/password/i)).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /login/i })).toBeInTheDocument();
  });

  it('should render password input with type="password" so characters are masked', () => {
    renderLogin();

    expect(screen.getByLabelText(/password/i)).toHaveAttribute('type', 'password');
  });
});

// ─── AC-A02 / AC-A03 / AC-C01: Button disabled logic ─────────────────────────

describe('Login button disabled state', () => {
  it('should be disabled when both email and password are empty', () => {
    renderLogin();

    expect(screen.getByRole('button', { name: /login/i })).toBeDisabled();
  });

  it('should be disabled when email is filled but password is empty', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);

    expect(screen.getByRole('button', { name: /login/i })).toBeDisabled();
  });

  it('should be disabled when password is filled but email is empty', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);

    expect(screen.getByRole('button', { name: /login/i })).toBeDisabled();
  });

  it('should be disabled when email format is invalid even if password is filled', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/email/i), 'not-an-email');
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);

    expect(screen.getByRole('button', { name: /login/i })).toBeDisabled();
  });

  it('should be enabled when both email (valid format) and password are filled', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);

    expect(screen.getByRole('button', { name: /login/i })).toBeEnabled();
  });
});

// ─── AC-C01 / AC-C02 / AC-C04: Email validation messages ─────────────────────

describe('Email format validation', () => {
  it('should show inline error when email format is invalid', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/email/i), 'bademail');

    expect(screen.getByText('Please enter a valid email address')).toBeInTheDocument();
  });

  it('should not show email error when email format is valid', async () => {
    renderLogin();
    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);

    expect(screen.queryByText('Please enter a valid email address')).not.toBeInTheDocument();
  });

  it('should clear email error immediately when field is corrected', async () => {
    renderLogin();
    const emailInput = screen.getByLabelText(/email/i);
    await userEvent.type(emailInput, 'bad');
    expect(screen.getByText('Please enter a valid email address')).toBeInTheDocument();

    await userEvent.clear(emailInput);
    await userEvent.type(emailInput, VALID_EMAIL);

    expect(screen.queryByText('Please enter a valid email address')).not.toBeInTheDocument();
  });
});

// ─── AC-A04 / AC-B01 / AC-C09 / AC-C10: Successful login ─────────────────────

describe('Successful login', () => {
  it('should store JWT in localStorage and navigate to /dashboard on 200 response', async () => {
    mockedAxios.post.mockResolvedValueOnce({ data: { token: 'jwt-token-abc' } });
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(localStorage.getItem('authToken')).toBe('jwt-token-abc');
      expect(screen.getByText('Dashboard')).toBeInTheDocument();
    });
  });

  it('should navigate to location.state.from when provided after successful login', async () => {
    mockedAxios.post.mockResolvedValueOnce({ data: { token: 'jwt-token-xyz' } });
    renderLogin({ from: '/protected' });

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(screen.getByText('Protected')).toBeInTheDocument();
    });
  });

  it('should POST { email, password } to the auth endpoint', async () => {
    mockedAxios.post.mockResolvedValueOnce({ data: { token: 'tok' } });
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(mockedAxios.post).toHaveBeenCalledWith(
        expect.stringContaining('/api/auth/login'),
        { email: VALID_EMAIL, password: VALID_PASSWORD },
      );
    });
  });
});

// ─── AC-A05 / AC-C03 / AC-B02: 401 failure ───────────────────────────────────

describe('Failed login — 401 Unauthorized', () => {
  beforeEach(() => {
    mockedAxios.isAxiosError = jest.fn().mockReturnValue(true) as typeof axios.isAxiosError;
  });

  it('should display "Invalid email or password" error message on 401', async () => {
    mockedAxios.post.mockRejectedValueOnce({
      isAxiosError: true,
      response: { status: 401 },
    });
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(
        screen.getByText('Invalid email or password. Please try again.'),
      ).toBeInTheDocument();
    });
  });

  it('should not store any token in localStorage on 401', async () => {
    mockedAxios.post.mockRejectedValueOnce({
      isAxiosError: true,
      response: { status: 401 },
    });
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(localStorage.getItem('authToken')).toBeNull();
    });
  });
});

// ─── AC-C07: Network / 5xx error ─────────────────────────────────────────────

describe('Failed login — network or 5xx error', () => {
  it('should display generic error message on network failure', async () => {
    mockedAxios.isAxiosError = jest.fn().mockReturnValue(false) as typeof axios.isAxiosError;
    mockedAxios.post.mockRejectedValueOnce(new Error('Network Error'));
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(
        screen.getByText('An unexpected error occurred. Please try again later.'),
      ).toBeInTheDocument();
    });
  });
});

// ─── AC-A06: Form state reset on error ───────────────────────────────────────

describe('Form state reset after failed login', () => {
  it('should clear the password field after a failed login attempt', async () => {
    mockedAxios.isAxiosError = jest.fn().mockReturnValue(true) as typeof axios.isAxiosError;
    mockedAxios.post.mockRejectedValueOnce({
      isAxiosError: true,
      response: { status: 401 },
    });
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    await waitFor(() => {
      expect(screen.getByLabelText(/password/i)).toHaveValue('');
    });
  });
});

// ─── AC-C06: Loading state ────────────────────────────────────────────────────

describe('Loading state during API call', () => {
  it('should show "Signing in…" and disable the button while request is in-flight', async () => {
    let resolvePost!: (value: unknown) => void;
    mockedAxios.post.mockReturnValueOnce(
      new Promise((resolve) => {
        resolvePost = resolve;
      }),
    );
    renderLogin();

    await userEvent.type(screen.getByLabelText(/email/i), VALID_EMAIL);
    await userEvent.type(screen.getByLabelText(/password/i), VALID_PASSWORD);
    await userEvent.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByRole('button', { name: /signing in/i })).toBeDisabled();

    // Clean up — resolve the promise so the component settles
    resolvePost({ data: { token: 'tok' } });
    await waitFor(() => expect(localStorage.getItem('authToken')).toBe('tok'));
  });
});

// ─── AC-B03: Existing token redirects away ────────────────────────────────────

describe('Existing auth token', () => {
  it('should redirect to /dashboard on mount when authToken already exists in localStorage', async () => {
    renderLogin({ authToken: 'existing-token' });

    await waitFor(() => {
      expect(screen.getByText('Dashboard')).toBeInTheDocument();
    });
  });
});
