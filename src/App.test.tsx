import { render, screen, within } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter } from 'react-router-dom';
import { describe, it, expect } from 'vitest';
import App from './App';

// MBA-29: "Login Button - Navigate to Empty Dashboard".
// These tests cover the end-to-end behavior the ticket describes: clicking the
// Login button on the sign-in screen must land the user on the Dashboard route.
// The approved fix renders account content there, so we also assert the
// Dashboard is not blank after login (the originally reported symptom).

function renderAppAt(path: string) {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <App />
    </MemoryRouter>
  );
}

describe('Login \u2192 Dashboard navigation (MBA-29)', () => {
  it('shows the Sign in screen with a Login button at /login', () => {
    renderAppAt('/login');
    expect(
      screen.getByRole('heading', { level: 1, name: 'Sign in' })
    ).toBeInTheDocument();
    expect(screen.getByRole('button', { name: 'Login' })).toBeInTheDocument();
  });

  it('navigates to the Dashboard route when the Login button is clicked', async () => {
    const user = userEvent.setup();
    renderAppAt('/login');
    await user.click(screen.getByRole('button', { name: 'Login' }));
    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();
  });

  it('lands on a Dashboard that renders content, not a blank screen', async () => {
    const user = userEvent.setup();
    renderAppAt('/login');
    await user.click(screen.getByRole('button', { name: 'Login' }));
    const content = screen.getByLabelText('Dashboard content');
    expect(content).toBeInTheDocument();
    expect(
      within(content).getByRole('heading', { name: /Accounts/i })
    ).toBeInTheDocument();
    expect(within(content).getByText('Everyday Checking')).toBeInTheDocument();
  });

  it('leaves the Sign in screen after navigating to the Dashboard', async () => {
    const user = userEvent.setup();
    renderAppAt('/login');
    await user.click(screen.getByRole('button', { name: 'Login' }));
    expect(
      screen.queryByRole('heading', { level: 1, name: 'Sign in' })
    ).not.toBeInTheDocument();
  });
});

describe('App routing guards (MBA-29 regression)', () => {
  it('redirects the root path to the Sign in screen', () => {
    renderAppAt('/');
    expect(
      screen.getByRole('heading', { level: 1, name: 'Sign in' })
    ).toBeInTheDocument();
  });

  it('redirects unknown routes to the Sign in screen', () => {
    renderAppAt('/no-such-route');
    expect(
      screen.getByRole('heading', { level: 1, name: 'Sign in' })
    ).toBeInTheDocument();
  });

  it('renders the Dashboard directly when visiting /dashboard', () => {
    renderAppAt('/dashboard');
    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();
  });
});
