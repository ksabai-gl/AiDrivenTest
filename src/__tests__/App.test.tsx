import React from 'react';
import { render, screen } from '@testing-library/react';
import App from '../App';

function renderAppAt(path: string) {
  window.history.pushState({}, 'Test', path);
  return render(<App />);
}

afterEach(() => {
  localStorage.clear();
  window.history.pushState({}, 'Test', '/');
});

describe('App routing', () => {
  it('should redirect unauthenticated users from /dashboard to /login', () => {
    renderAppAt('/dashboard');

    expect(screen.getByRole('heading', { name: /sign in/i })).toBeInTheDocument();
  });

  it('should render dashboard when token is present', () => {
    localStorage.setItem('token', 'jwt-abc');
    renderAppAt('/dashboard');

    expect(screen.getByRole('heading', { name: /dashboard/i })).toBeInTheDocument();
  });
});
