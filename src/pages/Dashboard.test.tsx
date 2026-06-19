import { render, screen, within } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import Dashboard from './Dashboard';

describe('Dashboard \u2014 GlobalLogic header (MAD-74)', () => {
  it('renders the GlobalLogic brand name in the header', () => {
    render(<Dashboard />);
    const header = screen.getByRole('banner');
    expect(within(header).getByText('GlobalLogic')).toBeInTheDocument();
  });

  it('renders the GL logo badge marked as decorative (aria-hidden)', () => {
    const { container } = render(<Dashboard />);
    const logo = container.querySelector('.brand__logo');
    expect(logo).toBeInTheDocument();
    expect(logo).toHaveTextContent('GL');
    expect(logo).toHaveAttribute('aria-hidden', 'true');
  });

  it('wraps branding in a .brand container inside the dashboard header', () => {
    const { container } = render(<Dashboard />);
    const header = container.querySelector('.dashboard__header');
    expect(header).toBeInTheDocument();
    const brand = header?.querySelector('.brand');
    expect(brand).toBeInTheDocument();
    expect(brand?.querySelector('.brand__name')).toHaveTextContent('GlobalLogic');
  });

  it('REGRESSION: still renders the Dashboard title', () => {
    render(<Dashboard />);
    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();
  });

  it('REGRESSION: brand badge does not pollute the accessible heading name', () => {
    render(<Dashboard />);
    const heading = screen.getByRole('heading', { level: 1 });
    expect(heading).toHaveTextContent('Dashboard');
    expect(heading).not.toHaveTextContent('GlobalLogic');
  });
});

describe('Dashboard \u2014 post-login content (MBA-29)', () => {
  it('renders account content instead of an empty placeholder', () => {
    render(<Dashboard />);
    const content = screen.getByLabelText('Dashboard content');
    expect(content).toBeInTheDocument();
    expect(
      within(content).getByRole('heading', { name: /Accounts/i })
    ).toBeInTheDocument();
    expect(within(content).getByText('Everyday Checking')).toBeInTheDocument();
    expect(within(content).getByText('Savings')).toBeInTheDocument();
  });

  it('renders a total balance summary', () => {
    render(<Dashboard />);
    const summary = screen.getByLabelText('Total balance');
    expect(summary).toBeInTheDocument();
    expect(within(summary).getByText(/Total balance/i)).toBeInTheDocument();
  });

  it('renders recent transactions', () => {
    render(<Dashboard />);
    expect(
      screen.getByRole('heading', { name: /Recent transactions/i })
    ).toBeInTheDocument();
    expect(screen.getByText('Payroll Deposit')).toBeInTheDocument();
  });

  it('renders quick action controls', () => {
    render(<Dashboard />);
    const actions = screen.getByLabelText('Quick actions');
    expect(within(actions).getByRole('button', { name: 'Transfer' })).toBeInTheDocument();
    expect(within(actions).getByRole('button', { name: 'Pay bills' })).toBeInTheDocument();
    expect(within(actions).getByRole('button', { name: 'Statements' })).toBeInTheDocument();
  });
});
