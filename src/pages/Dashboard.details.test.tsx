import { render, screen, within } from '@testing-library/react';
import { describe, it, expect } from 'vitest';
import Dashboard from './Dashboard';

// MBA-29: deeper assertions on the post-login Dashboard so a regression to an
// "empty" or numerically wrong Dashboard is caught. Complements the render-level
// checks in Dashboard.test.tsx with balance math, formatting, and edge cases.

describe('Dashboard balance + formatting (MBA-29)', () => {
  it('shows the total balance as the sum of all account balances', () => {
    render(<Dashboard />);
    const summary = screen.getByLabelText('Total balance');
    // 4250.75 + 18230.10 + (-642.18) = 21838.67
    expect(within(summary).getByText('$21,838.67')).toBeInTheDocument();
  });

  it('formats positive account balances as USD currency', () => {
    render(<Dashboard />);
    expect(screen.getByText('$4,250.75')).toBeInTheDocument();
    expect(screen.getByText('$18,230.10')).toBeInTheDocument();
  });

  it('renders a negative account balance with the negative modifier class', () => {
    const { container } = render(<Dashboard />);
    const negative = container.querySelector('.account-card__balance--negative');
    expect(negative).toBeInTheDocument();
    expect(negative).toHaveTextContent('-$642.18');
  });

  it('renders one card per account, each with a masked account number', () => {
    const { container } = render(<Dashboard />);
    const cards = container.querySelectorAll('.account-card');
    expect(cards).toHaveLength(3);
    cards.forEach((card) => {
      const number = card.querySelector('.account-card__number');
      expect(number?.textContent ?? '').toMatch(/\u2022{3,}\d{4}$/);
    });
  });

  it('classifies deposits as credits and spending as debits', () => {
    const { container } = render(<Dashboard />);
    expect(
      container.querySelectorAll('.transaction__amount--credit').length
    ).toBeGreaterThanOrEqual(1);
    expect(
      container.querySelectorAll('.transaction__amount--debit').length
    ).toBeGreaterThanOrEqual(1);
  });

  it('lists every recent transaction', () => {
    const { container } = render(<Dashboard />);
    expect(
      container.querySelectorAll('.transaction-list .transaction')
    ).toHaveLength(4);
  });
});
