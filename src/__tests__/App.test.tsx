/**
 * Jira: MBA-29 - Login Button -> Navigate to Empty Dashboard
 * Routing + end-to-end navigation tests against the real Router (AC-1/2/3).
 */
import { describe, it, expect, vi, afterEach } from 'vitest';
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter } from 'react-router-dom';
import App from '../App';

function renderApp(initialEntries: string[] = ['/']) {
  return render(
    <MemoryRouter initialEntries={initialEntries}>
      <App />
    </MemoryRouter>,
  );
}

afterEach(() => {
  vi.restoreAllMocks();
});

describe('App routing', () => {
  it('redirects root "/" to the Login page', () => {
    renderApp(['/']);
    expect(
      screen.getByRole('heading', { name: /sign in/i }),
    ).toBeInTheDocument();
  });

  it('redirects unknown routes to the Login page', () => {
    renderApp(['/does-not-exist']);
    expect(
      screen.getByRole('heading', { name: /sign in/i }),
    ).toBeInTheDocument();
  });

  it('renders the Login page at /login', () => {
    renderApp(['/login']);
    expect(
      screen.getByRole('heading', { name: /sign in/i }),
    ).toBeInTheDocument();
  });

  it('renders the Dashboard page at /dashboard', () => {
    renderApp(['/dashboard']);
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });
});

describe('Login -> Dashboard navigation (AC-1, AC-2, AC-3)', () => {
  it('navigates to the empty Dashboard when Login is clicked', async () => {
    const user = userEvent.setup();
    renderApp(['/login']);

    await user.click(screen.getByRole('button', { name: /login/i }));

    // AC-1 + AC-2: Dashboard screen is displayed after navigation.
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
    expect(
      screen.getByText(/your account overview will appear here/i),
    ).toBeInTheDocument();
  });

  it('produces no console errors during navigation (AC-3)', async () => {
    const errorSpy = vi.spyOn(console, 'error').mockImplementation(() => {});
    const user = userEvent.setup();
    renderApp(['/login']);

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(screen.getByRole('heading', { name: /dashboard/i })).toBeInTheDocument();
    expect(errorSpy).not.toHaveBeenCalled();
  });
});
