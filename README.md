# AiDrivenTest - Mobile Banking App

React + TypeScript + Vite scaffold for the Mobile Banking App.

## MBA-29 - Login Button Navigates to Empty Dashboard

Clicking the **Login** button on the sign-in screen navigates the user to an
empty placeholder **Dashboard** screen. Navigation is intentionally decoupled
from authentication so credential validation can be added later.

## Getting started

```bash
npm install
npm run dev
```

Then open the printed local URL. You will land on `/login`; click **Login** to
navigate to `/dashboard`.

## Scripts

- `npm run dev` - start the Vite dev server
- `npm run build` - type-check and build for production
- `npm run preview` - preview the production build
- `npm run lint` - type-check only

## Routes

| Path | Screen |
|------------|---------------------------|
| `/login`   | Login page (default)      |
| `/dashboard` | Empty dashboard screen  |
