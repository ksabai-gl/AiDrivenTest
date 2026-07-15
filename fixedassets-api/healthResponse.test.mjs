import test from 'node:test';
import assert from 'node:assert/strict';
import { buildHealthResponse } from './healthResponse.mjs';

test('GET /health payload reports fixedassets-api healthy', () => {
  const body = buildHealthResponse();
  assert.equal(body.status, 'ok');
  assert.equal(body.service, 'fixedassets-api');
  assert.equal(body.checks.liveness, 'up');
  assert.ok(typeof body.timestamp === 'string' && body.timestamp.length > 0);
});
