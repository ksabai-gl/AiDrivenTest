/// <reference types="vitest/config" />
import { defineConfig, type Plugin } from 'vite';
import react from '@vitejs/plugin-react';
import { buildHealthResponse } from './fixedassets-api/healthResponse.mjs';

/** Serves GET /health during vite dev/preview so local probes match fixedassets-api (MAD-102). */
function fixedassetsHealthPlugin(): Plugin {
  const mount = (server: { middlewares: { use: Function } }) => {
    server.middlewares.use('/health', (req: { method?: string }, res: { statusCode: number; setHeader: Function; end: Function }, next: Function) => {
      if (req.method && req.method !== 'GET') {
        next();
        return;
      }
      res.statusCode = 200;
      res.setHeader('Content-Type', 'application/json; charset=utf-8');
      res.setHeader('Cache-Control', 'no-store');
      res.end(JSON.stringify(buildHealthResponse()));
    });
  };
  return {
    name: 'fixedassets-health',
    configureServer: mount,
    configurePreviewServer: mount,
  };
}

export default defineConfig({
  plugins: [react(), fixedassetsHealthPlugin()],
  test: {
    globals: true,
    environment: 'jsdom',
    setupFiles: './src/test/setup.ts',
    coverage: {
      provider: 'v8',
      reporter: ['text', 'json-summary'],
      include: ['src/pages/Dashboard.tsx', 'src/components/GlobalLogicLogo.tsx'],
    },
  },
});