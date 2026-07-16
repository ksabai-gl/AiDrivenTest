import { beforeEach, describe, expect, it } from 'vitest';
import { clearSession, isAuthenticated, setSession } from './auth';

describe('auth helpers (MAD-114)', () => {
  beforeEach(() => {
    sessionStorage.clear();
  });

  it('isAuthenticated returns false without session', () => {
    expect(isAuthenticated()).toBe(false);
  });

  it('setSession makes isAuthenticated true', () => {
    setSession('demo');
    expect(isAuthenticated()).toBe(true);
  });

  it('clearSession removes session', () => {
    setSession('demo');
    clearSession();
    expect(isAuthenticated()).toBe(false);
  });
});
