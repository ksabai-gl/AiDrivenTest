import { render, screen } from '@testing-library/react';
import { MemoryRouter } from 'react-router-dom';
import { describe, expect, it } from 'vitest';
import App from './App';

function renderAt(path: string) {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <App />
    </MemoryRouter>,
  );
}

describe('App routing after login removal (MAD-76)', () => {
  it('renders the Dashboard at the root path "/" (redirect repointed to /dashboard)', () => {
    renderAt('/');
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });

  it('renders the Dashboard at "/dashboard"', () => {
    renderAt('/dashboard');
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });

  it('redirects unknown paths to the Dashboard via the catch-all route', () => {
    renderAt('/some/unknown/path');
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });

  it('no longer renders the Login screen at "/login" (bug fix: route removed)', () => {
    renderAt('/login');
    expect(screen.queryByText(/sign in/i)).not.toBeInTheDocument();
    expect(
      screen.queryByRole('button', { name: /login/i }),
    ).not.toBeInTheDocument();
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });
});
