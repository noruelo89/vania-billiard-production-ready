import { cookies } from 'next/headers';
import { createHmac, randomUUID, timingSafeEqual } from 'node:crypto';

export const ADMIN_COOKIE = 'vania_admin_session';
const SESSION_TTL_SECONDS = 60 * 60 * 12;

function adminPassword() {
  return process.env.ADMIN_PASSWORD || 'vania-admin-2026';
}

function sessionSecret() {
  return process.env.ADMIN_SESSION_SECRET || adminPassword();
}

function sign(value: string) {
  return createHmac('sha256', sessionSecret()).update(value).digest('hex');
}

function safeEqual(a: string, b: string) {
  if (a.length !== b.length) return false;
  return timingSafeEqual(Buffer.from(a), Buffer.from(b));
}

export async function isAdminAuthenticated() {
  const value = (await cookies()).get(ADMIN_COOKIE)?.value || '';
  const [issuedAt, nonce, signature] = value.split('.');
  if (!issuedAt || !nonce || !signature) return false;

  const timestamp = Number(issuedAt);
  if (!Number.isFinite(timestamp)) return false;
  if (Date.now() - timestamp > SESSION_TTL_SECONDS * 1000) return false;

  return safeEqual(signature, sign(`${issuedAt}.${nonce}`));
}

export async function setAdminSession() {
  const issuedAt = String(Date.now());
  const nonce = randomUUID();
  const payload = `${issuedAt}.${nonce}`;
  (await cookies()).set(ADMIN_COOKIE, `${payload}.${sign(payload)}`, {
    httpOnly: true,
    sameSite: 'lax',
    secure: process.env.NODE_ENV === 'production',
    path: '/',
    maxAge: SESSION_TTL_SECONDS,
  });
}

export async function clearAdminSession() {
  (await cookies()).delete(ADMIN_COOKIE);
}

export function verifyAdminPassword(value: string) {
  return safeEqual(value, adminPassword());
}
