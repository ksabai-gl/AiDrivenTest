import { render, screen } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { MemoryRouter } from 'react-router-dom';
import { describe, it, expect } from 'vitest';
import App from './App';

describe('App — login navigation (MBA-21 / AC-D01)', () => {
  it('navigates from Login to Dashboard when the Login button is clicked', async () => {
    const user = userEvent.setup();

    render(
      <MemoryRouter initialEntries={['/login']}>
        <App />
      </MemoryRouter>
    );

    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();

    await user.click(screen.getByRole('button', { name: /login/i }));

    expect(
      screen.getByRole('heading', { level: 1, name: /dashboard/i })
    ).toBeInTheDocument();
    expect(
      screen.queryByRole('heading', { level: 1, name: /sign in/i })
    ).not.toBeInTheDocument();
  });

  it('redirects root path to the login screen', () => {
    render(
      <MemoryRouter initialEntries={['/']}>
        <App />
      </MemoryRouter>
    );

    expect(
      screen.getByRole('heading', { level: 1, name: /sign in/i })
    ).toBeInTheDocument();
  });
});
