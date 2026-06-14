import React from 'react';
import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import DashboardPage from '../DashboardPage';

afterEach(() => {
  localStorage.clear();
});

describe('DashboardPage — MAD-36', () => {
  describe('AC — user display', () => {
    it('should show Guest when no userEmail is stored', () => {
      render(<DashboardPage />);

      expect(screen.getByText(/signed in as/i)).toBeInTheDocument();
      expect(screen.getByText('Guest')).toBeInTheDocument();
    });

    it('should show stored user email from login', () => {
      localStorage.setItem('userEmail', 'user@example.com');
      render(<DashboardPage />);

      expect(screen.getByText('user@example.com')).toBeInTheDocument();
    });
  });

  describe('AC — Start Tour', () => {
    it('should render Start Tour button', () => {
      render(<DashboardPage />);

      expect(screen.getByRole('button', { name: /start tour/i })).toBeInTheDocument();
    });

    it('should open tour dialog when Start Tour is clicked', async () => {
      render(<DashboardPage />);

      await userEvent.click(screen.getByRole('button', { name: /start tour/i }));

      expect(screen.getByRole('dialog')).toBeInTheDocument();
      expect(screen.getByText(/welcome tour/i)).toBeInTheDocument();
      expect(screen.getByText(/step 1/i)).toBeInTheDocument();
    });

    it('should close tour dialog when Close is clicked', async () => {
      render(<DashboardPage />);

      await userEvent.click(screen.getByRole('button', { name: /start tour/i }));
      await userEvent.click(screen.getByRole('button', { name: /close/i }));

      expect(screen.queryByRole('dialog')).not.toBeInTheDocument();
    });
  });
});
