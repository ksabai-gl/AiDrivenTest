/**
 * Jira: MBA-29 - Login Button -> Navigate to Empty Dashboard
 * Verifies the placeholder dashboard renders (AC-2).
 */
import { describe, it, expect } from 'vitest';
import { render, screen } from '@testing-library/react';
import Dashboard from '../Dashboard';

describe('Dashboard page', () => {
  it('renders the Dashboard heading', () => {
    render(<Dashboard />);
    expect(
      screen.getByRole('heading', { name: /dashboard/i }),
    ).toBeInTheDocument();
  });

  it('renders the placeholder content (empty dashboard acceptable)', () => {
    render(<Dashboard />);
    expect(
      screen.getByText(/your account overview will appear here/i),
    ).toBeInTheDocument();
  });

  it('exposes an accessible dashboard content region', () => {
    render(<Dashboard />);
    expect(
      screen.getByRole('region', { name: /dashboard content/i }),
    ).toBeInTheDocument();
  });
});
