import http from 'node:http';
import { buildHealthResponse } from './healthResponse.mjs';

const port = Number(process.env.PORT || process.env.FIXEDASSETS_API_PORT || 8080);

function sendJson(res, statusCode, payload) {
  const body = JSON.stringify(payload);
  res.writeHead(statusCode, {
    'content-type': 'application/json; charset=utf-8',
    'cache-control': 'no-store',
  });
  res.end(body);
}

const server = http.createServer((req, res) => {
  const host = req.headers.host || 'localhost';
  const url = new URL(req.url || '/', `http://${host}`);

  if (req.method === 'GET' && url.pathname === '/health') {
    sendJson(res, 200, buildHealthResponse());
    return;
  }

  sendJson(res, 404, { status: 'error', message: 'not found' });
});

server.listen(port, () => {
  console.log(`fixedassets-api listening on :${port}`);
});
