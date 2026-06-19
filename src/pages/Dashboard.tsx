type AccountSummary = {
  id: string;
  name: string;
  maskedNumber: string;
  balance: number;
  currency: string;
};

type Transaction = {
  id: string;
  description: string;
  date: string;
  amount: number;
  currency: string;
};

// Static sample data stands in for the authenticated account API, which is a
// separate backend story. It keeps the post-login Dashboard from rendering blank.
const accounts: AccountSummary[] = [
  { id: 'chk-001', name: 'Everyday Checking', maskedNumber: '\u2022\u2022\u2022\u20224821', balance: 4250.75, currency: 'USD' },
  { id: 'sav-001', name: 'Savings', maskedNumber: '\u2022\u2022\u2022\u20229034', balance: 18230.1, currency: 'USD' },
  { id: 'crd-001', name: 'Platinum Credit Card', maskedNumber: '\u2022\u2022\u2022\u20221290', balance: -642.18, currency: 'USD' },
];

const recentTransactions: Transaction[] = [
  { id: 'txn-1', description: 'Grocery Mart', date: '2026-06-17', amount: -82.34, currency: 'USD' },
  { id: 'txn-2', description: 'Payroll Deposit', date: '2026-06-15', amount: 3200, currency: 'USD' },
  { id: 'txn-3', description: 'Electric Utility', date: '2026-06-14', amount: -119.2, currency: 'USD' },
  { id: 'txn-4', description: 'Coffee House', date: '2026-06-13', amount: -5.75, currency: 'USD' },
];

function formatCurrency(amount: number, currency: string): string {
  return new Intl.NumberFormat('en-US', { style: 'currency', currency }).format(amount);
}

export default function Dashboard() {
  const totalBalance = accounts.reduce((sum, account) => sum + account.balance, 0);
  const primaryCurrency = accounts[0]?.currency ?? 'USD';

  return (
    <main className="page">
      <header className="dashboard__header">
        <div className="brand">
          <span className="brand__logo" aria-hidden="true">GL</span>
          <span className="brand__name">GlobalLogic</span>
        </div>
        <h1 className="dashboard__title">Dashboard</h1>
      </header>

      <section className="dashboard__body" aria-label="Dashboard content">
        <section className="dashboard__summary" aria-label="Total balance">
          <p className="dashboard__summary-label">Total balance</p>
          <p className="dashboard__summary-value">
            {formatCurrency(totalBalance, primaryCurrency)}
          </p>
        </section>

        <section aria-label="Accounts">
          <h2 className="dashboard__section-title">Accounts</h2>
          <ul className="account-list">
            {accounts.map((account) => (
              <li key={account.id} className="account-card">
                <div className="account-card__info">
                  <span className="account-card__name">{account.name}</span>
                  <span className="account-card__number">{account.maskedNumber}</span>
                </div>
                <span
                  className={
                    'account-card__balance' +
                    (account.balance < 0 ? ' account-card__balance--negative' : '')
                  }
                >
                  {formatCurrency(account.balance, account.currency)}
                </span>
              </li>
            ))}
          </ul>
        </section>

        <section aria-label="Recent transactions">
          <h2 className="dashboard__section-title">Recent transactions</h2>
          <ul className="transaction-list">
            {recentTransactions.map((txn) => (
              <li key={txn.id} className="transaction">
                <div className="transaction__info">
                  <span className="transaction__description">{txn.description}</span>
                  <span className="transaction__date">{txn.date}</span>
                </div>
                <span
                  className={
                    'transaction__amount' +
                    (txn.amount < 0 ? ' transaction__amount--debit' : ' transaction__amount--credit')
                  }
                >
                  {formatCurrency(txn.amount, txn.currency)}
                </span>
              </li>
            ))}
          </ul>
        </section>

        <nav className="dashboard__actions" aria-label="Quick actions">
          <button type="button" className="button">Transfer</button>
          <button type="button" className="button">Pay bills</button>
          <button type="button" className="button">Statements</button>
        </nav>
      </section>
    </main>
  );
}
