export function DashboardPage() {
  return (
    <main className="min-h-screen flex items-center justify-center p-4">
      <div className="rounded-2xl border border-neutral-200 bg-white px-8 py-6 shadow-sm">
        <h1 className="text-xl font-semibold text-neutral-900">Dashboard</h1>
        <p className="mt-2 text-sm text-neutral-600">
          You are signed in. Protected content lives here.
        </p>
      </div>
    </main>
  );
}
