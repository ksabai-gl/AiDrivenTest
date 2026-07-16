const SESSION_KEY = 'auth.session';

export function isAuthenticated(): boolean {
  return Boolean(sessionStorage.getItem(SESSION_KEY));
}

export function setSession(username: string): void {
  sessionStorage.setItem(SESSION_KEY, JSON.stringify({ username, at: Date.now() }));
}

export function clearSession(): void {
  sessionStorage.removeItem(SESSION_KEY);
}
