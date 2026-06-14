import React, { useState } from 'react';

const DashboardPage: React.FC = () => {
  const email = localStorage.getItem('userEmail') ?? 'Guest';
  const [tourOpen, setTourOpen] = useState(false);

  return (
    <main className="min-h-screen flex items-center justify-center bg-gray-50 px-4">
      <div className="w-full max-w-md bg-white rounded-2xl shadow-md p-8 text-center">
        <h1 className="text-2xl font-bold text-gray-900 mb-2">Dashboard</h1>
        <p className="text-gray-600 mb-6">
          Signed in as <span className="font-medium text-gray-900">{email}</span>
        </p>
        <button
          type="button"
          onClick={() => setTourOpen(true)}
          className="rounded-lg bg-indigo-600 px-4 py-2 text-sm font-semibold text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
        >
          Start Tour
        </button>

        {tourOpen && (
          <div
            role="dialog"
            aria-labelledby="tour-title"
            className="mt-6 rounded-lg border border-indigo-200 bg-indigo-50 px-4 py-3 text-left"
          >
            <h2 id="tour-title" className="text-sm font-semibold text-indigo-900 mb-1">
              Welcome tour
            </h2>
            <p className="text-sm text-indigo-800">
              Step 1: Explore your dashboard. More steps coming soon.
            </p>
            <button
              type="button"
              onClick={() => setTourOpen(false)}
              className="mt-3 text-sm font-medium text-indigo-700 hover:text-indigo-900"
            >
              Close
            </button>
          </div>
        )}
      </div>
    </main>
  );
};

export default DashboardPage;
