/**
 * MBA-28 — Empty Dashboard Placeholder
 * Jira: https://globallogic-team-ioe3w3ht.atlassian.net/browse/MBA-28
 */
import { render, screen } from '@testing-library/react';
import { describe, expect, it } from 'vitest';
import { DashboardPage } from './DashboardPage';

describe('DashboardPage (MBA-28 empty dashboard)', () => {
  it('AC-D02: displays a Dashboard heading', () => {
    render(<DashboardPage />);

    expect(screen.getByRole('heading', { name: /^dashboard$/i })).toBeVisible();
  });

  it('AC-D02: does not display account data or widgets', () => {
    const { container } = render(<DashboardPage />);

    expect(screen.queryByText(/balance/i)).not.toBeInTheDocument();
    expect(screen.queryByText(/transaction/i)).not.toBeInTheDocument();
    expect(container.querySelectorAll('[data-widget]')).toHaveLength(0);
    expect(screen.getByLabelText(/dashboard content/i)).toBeEmptyDOMElement();
  });

  it('AC-D02: exposes a single top-level heading', () => {
    render(<DashboardPage />);

    expect(screen.getAllByRole('heading', { level: 1 })).toHaveLength(1);
  });

  it('AC-D02: does not render buttons or links', () => {
    render(<DashboardPage />);

    expect(screen.queryAllByRole('button')).toHaveLength(0);
    expect(screen.queryAllByRole('link')).toHaveLength(0);
  });

  it('AC-D02: uses a main landmark for the page shell', () => {
    render(<DashboardPage />);

    expect(screen.getByRole('main')).toBeVisible();
  });
});
