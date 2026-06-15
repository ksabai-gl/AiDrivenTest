# MAD-69 Reporter Environment Verification Checklist

If you still see `alert("success")` after this fix, follow these steps to confirm your environment matches the verified repository HEAD.

## Checklist

1. **URL tested** — Record the exact URL (e.g. `http://localhost:3000/login`).
2. **Branch and commit SHA** — Run `git rev-parse HEAD` and confirm you are on the correct branch.
3. **Hard refresh** — Clear browser cache or use Ctrl+Shift+R (Cmd+Shift+R on Mac).
4. **DevTools — Elements** — Confirm Sign in is `type="submit"` inside a `<form onSubmit={handleSubmit}>`, not an `onClick` alert stub.
5. **DevTools — Network** — On submit, confirm POST to `/auth/login` (not a placeholder handler).

## Expected behavior (verified HEAD)

- `handleSubmit` calls `authService.login()`
- JWT stored in `localStorage` under key `token`
- User redirected to `/dashboard`
- `window.alert` is never called

## Escalation

If all steps are confirmed and `alert("success")` persists on the verified commit, escalate as an environment/injection defect outside repository scope.

## Related tickets

- [MAD-69](https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-69) — Original bug report
- [MAD-70](https://globallogic-team-ioe3w3ht.atlassian.net/browse/MAD-70) — Implementation spec
