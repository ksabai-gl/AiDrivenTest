/**
 * Shared liveness payload for fixedassets-api /health (MAD-102).
 */
export function buildHealthResponse() {
  return {
    status: 'ok',
    service: 'fixedassets-api',
    checks: { liveness: 'up' },
    timestamp: new Date().toISOString(),
  };
}
