import React from 'react';

const DISPLAY_NAME = 'Alex Demo';

const ProfilePage: React.FC = () => (
  <main className="min-h-screen flex items-center justify-center bg-gray-50 px-4">
    <div className="w-full max-w-md bg-white rounded-2xl shadow-md p-8 text-center">
      <h1 className="text-2xl font-bold text-gray-900 mb-6">Profile</h1>
      <div
        className="mx-auto mb-4 flex h-24 w-24 items-center justify-center rounded-full bg-indigo-100"
        role="img"
        aria-label="User avatar"
      >
        <svg className="h-12 w-12 text-indigo-600" viewBox="0 0 24 24" fill="currentColor" aria-hidden>
          <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
        </svg>
      </div>
      <p className="text-lg font-medium text-gray-900">{DISPLAY_NAME}</p>
    </div>
  </main>
);

export default ProfilePage;
