import { cookies } from 'next/headers';
import { createHash, timingSafeEqual } from 'node:crypto';

export const ADMIN_COOKIE = 'vania_admin_session';
const SESSION_TTL_SECONDS = 60 * 60 * 24 * 7;

function adminPassword() {
  return process.env.ADMIN_PASSWORD || 'vania-admin-2026';
}

function sessionValue() {
  return createHash('sha256').update(`vania:${adminPassword()}`).digest('hex');
}

export async function isAdminAuthenticated() {
  const value = (await cookies()).get(ADMIN_COOKIE)?.value || '';
  const expected = sessionValue();
  if (value.length !== expected.length) return false;
  return timingSafeEqual(Buffer.from(value), Buffer.from(expected));
}

export async function setAdminSession() {
  (await cookies()).set(ADMIN_COOKIE, sessionValue(), {
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
  return value === adminPassword();
}
