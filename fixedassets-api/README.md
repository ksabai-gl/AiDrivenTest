# fixedassets-api

Minimal HTTP service that restores the `/health` liveness probe for MAD-102.

## Run

```bash
npm run fixedassets-api
```

Default port: `8080` (override with `PORT` or `FIXEDASSETS_API_PORT`).

## Probe

```bash
curl -s http://127.0.0.1:8080/health
```

Expected: HTTP 200 JSON `{ "status": "ok", "service": "fixedassets-api", ... }`.

## Test

```bash
npm run test:health
```
