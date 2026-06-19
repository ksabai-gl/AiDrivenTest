import { render, screen, within } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import Dashboard from './Dashboard';

describe('Dashboard — GlobalLogic header (MAD-74)', () => {
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

  it('REGRESSION: still renders the placeholder welcome content', () => {
    render(<Dashboard />);
    expect(screen.getByLabelText('Dashboard content')).toBeInTheDocument();
    expect(
      screen.getByText(/Your account overview will appear here/i)
    ).toBeInTheDocument();
  });

  it('REGRESSION: brand badge does not pollute the accessible heading name', () => {
    render(<Dashboard />);
    const heading = screen.getByRole('heading', { level: 1 });
    expect(heading).toHaveTextContent('Dashboard');
    expect(heading).not.toHaveTextContent('GlobalLogic');
  });
});

describe('Dashboard — empty placeholder (MBA-21 / AC-D02)', () => {
  it('shows a dashboard heading with no account data or transactional widgets', () => {
    render(<Dashboard />);

    expect(
      screen.getByRole('heading', { level: 1, name: 'Dashboard' })
    ).toBeInTheDocument();

    const content = screen.getByLabelText('Dashboard content');
    expect(content).toBeInTheDocument();
    expect(content.querySelector('[data-testid]')).toBeNull();
    expect(screen.queryByText(/balance/i)).not.toBeInTheDocument();
    expect(screen.queryByText(/transaction/i)).not.toBeInTheDocument();
    expect(screen.queryByRole('table')).not.toBeInTheDocument();
    expect(screen.queryByRole('list')).not.toBeInTheDocument();
  });
});
