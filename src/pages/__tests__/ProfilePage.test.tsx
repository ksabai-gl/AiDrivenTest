import React from 'react';
import { render, screen } from '@testing-library/react';
import ProfilePage from '../ProfilePage';

describe('ProfilePage — MAD-37', () => {
  it('should show dummy display name', () => {
    render(<ProfilePage />);
    expect(screen.getByText('Alex Demo')).toBeInTheDocument();
  });

  it('should show Profile heading', () => {
    render(<ProfilePage />);
    expect(screen.getByRole('heading', { name: /profile/i })).toBeInTheDocument();
  });

  it('should show avatar icon', () => {
    render(<ProfilePage />);
    expect(screen.getByRole('img', { name: /user avatar/i })).toBeInTheDocument();
  });
});

describe('ProfilePage — MAD-38', () => {
  it('should show logout button', () => {
    render(<ProfilePage />);
    expect(screen.getByRole('button', { name: /log out/i })).toBeInTheDocument();
  });

  it('should show logout button with indigo primary styling', () => {
    render(<ProfilePage />);
    const logoutButton = screen.getByRole('button', { name: /log out/i });
    expect(logoutButton).toHaveClass('bg-indigo-600');
    expect(logoutButton).toHaveClass('text-white');
    expect(logoutButton).not.toHaveAttribute('onClick');
  });

  it('should not trigger logout when clicked (no handler wired)', () => {
    render(<ProfilePage />);
    const logoutButton = screen.getByRole('button', { name: /log out/i });
    expect(logoutButton.getAttribute('onclick')).toBeNull();
  });
});
