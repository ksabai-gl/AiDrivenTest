import { render, screen, within } from '@testing-library/react';
import userEvent from '@testing-library/user-event';
import { describe, it, expect } from 'vitest';
import { MemoryRouter, Route, Routes } from 'react-router-dom';
import Dashboard from './Dashboard';

function renderDashboardWithRouter(initialPath = '/dashboard') {
  return render(
    <MemoryRouter initialEntries={[initialPath]}>
      <Routes>
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/login" element={<div>Sign in</div>} />
      </Routes>
    </MemoryRouter>
  );
}

describe('Dashboard — GlobalLogic header (MAD-74)', () => {
  it('renders the GlobalLogic brand name in the header', () => {
    renderDashboardWithRouter();
    const header = screen.getByRole('banner');
    expect(within(header).getByText('GlobalLogic')).toBeInTheDocument();
  });

  it('renders the GL logo badge marked as decorative (aria-hidden)', () => {
    const { container } = renderDashboardWithRouter();
    const logo = container.querySelector('.brand__logo');
    expect(logo).toBeInTheDocument();
    expect(logo).toHaveTextContent('GL');
    expect(logo).toHaveAttribute('aria-hidden', 'true');
  });

  it('wraps branding in a .brand container inside the dashboard header', () => {
    const { container } = renderDashboardWithRouter();
    const header = container.querySelector('.dashboard__header');
    expect(header).toBeInTheDocument();
    const brand = header?.querySelector('.brand');
    expect(brand).toBeInTheDocument();
    expect(brand?.querySelector('.brand__name')).toHaveTextContent('GlobalLogic');
  });

  it('REGRESSION: still renders the Dashboard title', () => {
    renderDashboardWithRouter();
    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();
  });

  it('REGRESSION: still renders the placeholder welcome content', () => {
    renderDashboardWithRouter();
    expect(screen.getByLabelText('Dashboard content')).toBeInTheDocument();
    expect(
      screen.getByText(/Your account overview will appear here/i)
    ).toBeInTheDocument();
  });

  it('REGRESSION: brand badge does not pollute the accessible heading name', () => {
    renderDashboardWithRouter();
    const heading = screen.getByRole('heading', { level: 1 });
    expect(heading).toHaveTextContent('Dashboard');
    expect(heading).not.toHaveTextContent('GlobalLogic');
  });
});

describe('Dashboard — logout (MAD-95)', () => {
  it('renders a Log out button in the dashboard header', () => {
    renderDashboardWithRouter();
    expect(screen.getByRole('button', { name: /log out/i })).toBeInTheDocument();
  });

  it('navigates to /login when Log out is clicked', async () => {
    const user = userEvent.setup();
    renderDashboardWithRouter();
    await user.click(screen.getByRole('button', { name: /log out/i }));
    expect(screen.getByText('Sign in')).toBeInTheDocument();
  });
});
