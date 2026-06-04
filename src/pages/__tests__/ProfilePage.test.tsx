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
