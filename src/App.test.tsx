import { render, screen } from '@testing-library/react';
import { beforeEach, describe, expect, it } from 'vitest';
import { MemoryRouter } from 'react-router-dom';
import App from './App';

describe('App - RequireAuth gate (MAD-111)', () => {
  beforeEach(() => {
    sessionStorage.clear();
  });

  it('redirects unauthenticated /dashboard to /login', () => {
    render(
      <MemoryRouter initialEntries={['/dashboard']}>
        <App />
      </MemoryRouter>
    );

    expect(screen.getByRole('heading', { name: /sign in/i })).toBeInTheDocument();
    expect(
      screen.queryByRole('heading', { level: 1, name: 'Dashboard' })
    ).not.toBeInTheDocument();
  });

  it('allows /dashboard when auth.session is present', () => {
    sessionStorage.setItem(
      'auth.session',
      JSON.stringify({ username: 'demo', at: Date.now() })
    );

    render(
      <MemoryRouter initialEntries={['/dashboard']}>
        <App />
      </MemoryRouter>
    );

    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();
  });
});
