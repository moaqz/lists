import { Headers, ofetch as fetcher } from "ofetch";

const BASE_URL = import.meta.env.VITE_API_BASE_URL;
const XSRF_HEADER_NAME = import.meta.env.VITE_XSRF_HEADER_NAME;
const XSRF_COOKIE_NAME = import.meta.env.VITE_XSRF_COOKIE_NAME;

function getCookie(name: string) {
  const cookie = document.cookie
    .split("; ")
    .find(item => item.startsWith(`${name}=`));

  if (!cookie) {
    return null;
  }

  return decodeURIComponent(cookie.split("=")[1]);
}

export const ofetch = fetcher.create({
  baseURL: BASE_URL,
  credentials: "include",
  headers: {
    Accept: "application/json",
  },
  async onRequest({ options }) {
    if (options.method === "GET") {
      return;
    }

    let csrfToken = getCookie(XSRF_COOKIE_NAME);
    if (!csrfToken) {
      await fetcher("/sanctum/csrf-cookie", {
        baseURL: BASE_URL,
        credentials: "include",
      });

      csrfToken = getCookie(XSRF_COOKIE_NAME);
    }

    options.headers = new Headers(options.headers);
    options.headers.set(XSRF_HEADER_NAME, csrfToken!);
  },
});
