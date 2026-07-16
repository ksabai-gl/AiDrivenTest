/// <reference types="vitest/config" />
import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

export default defineConfig({
  plugins: [react()],
  test: {
    globals: true,
    environment: 'jsdom',
    setupFiles: './src/test/setup.ts',
    coverage: {
      provider: 'v8',
      reporter: ['text', 'json-summary'],
      include: [
        'src/pages/Dashboard.tsx',
        'src/pages/Login.tsx',
        'src/App.tsx',
        'src/components/GlobalLogicLogo.tsx',
        'src/components/RequireAuth.tsx',
      ],
    },
  },
});
