/**
 * MAD-88 — App routing for forgot-password flow
 */
import { render, screen } from '@testing-library/react';
import { MemoryRouter } from 'react-router-dom';
import { describe, expect, it } from 'vitest';
import App from './App';

function renderAppAt(path: string) {
  return render(
    <MemoryRouter initialEntries={[path]}>
      <App />
    </MemoryRouter>
  );
}

describe('App — MAD-88 routing', () => {
  it('renders ForgotPassword at /forgot-password', () => {
    renderAppAt('/forgot-password');
    expect(
      screen.getByRole('heading', { level: 1, name: /forgot password/i })
    ).toBeInTheDocument();
  });

  it('REGRESSION: renders Login at /login', () => {
    renderAppAt('/login');
    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();
  });

  it('REGRESSION: renders Dashboard at /dashboard', () => {
    renderAppAt('/dashboard');
    expect(
      screen.getByRole('heading', { level: 1, name: /dashboard/i })
    ).toBeInTheDocument();
  });

  it('REGRESSION: redirects / to login', () => {
    renderAppAt('/');
    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();
  });
});
