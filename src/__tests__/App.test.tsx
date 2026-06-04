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

  it('should render dashboard with user and Start Tour when token is present', () => {
    localStorage.setItem('token', 'jwt-abc');
    localStorage.setItem('userEmail', 'user@example.com');
    renderAppAt('/dashboard');

    expect(screen.getByRole('heading', { name: /dashboard/i })).toBeInTheDocument();
    expect(screen.getByText('user@example.com')).toBeInTheDocument();
    expect(screen.getByRole('button', { name: /start tour/i })).toBeInTheDocument();
  });
});
