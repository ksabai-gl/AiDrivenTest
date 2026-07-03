export default function GlobalLogicLogo({ className = 'brand__logo' }: { className?: string }) {
  return (
    <span className={className} aria-hidden="true">
      <svg width="32" height="32" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" role="presentation">
        <rect x="0" y="0" width="28" height="28" rx="8" fill="#3a6ff7" />
        <path d="M13.05 8.2c-2.65 0-4.8 2.1-4.8 4.75 0 2.65 2.15 4.75 4.8 4.75 1.55 0 2.9-.7 3.8-1.9l-1.35-.95c-.55.7-1.4 1.1-2.45 1.1-1.75 0-3.15-1.35-3.15-3 0-1.7 1.4-3 3.15-3 1.05 0 1.9.4 2.45 1.1l1.35-.95c-.9-1.2-2.25-1.9-3.8-1.9Z" fill="white" fillOpacity="0.95" />
      </svg>
    </span>
  );
}
