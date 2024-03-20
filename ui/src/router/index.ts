import { type RouteRecordRaw, createRouter, createWebHistory } from "vue-router";
import { useAuthStore } from "~/stores/auth";

declare module "vue-router" {
  interface RouteMeta {
    requiresAuth: boolean;
  }
}

const AUTH_ROUTES = ["auth.login", "auth.register"];

const routes: RouteRecordRaw[] = [
  {
    path: "/register",
    name: "auth.register",
    component: () => import("~/views/Auth/RegisterView.vue"),
    meta: { requiresAuth: false },
  },
  {
    path: "/login",
    name: "auth.login",
    component: () => import("~/views/Auth/LoginView.vue"),
    meta: { requiresAuth: false },
  },
  {
    path: "/app",
    name: "app",
    component: () => import("~/views/AppView.vue"),
    meta: { requiresAuth: true },
  },
  {
    path: "/:pathMatch(.*)*",
    name: "notfound",
    component: () => import("~/views/NotFoundView.vue"),
    meta: { requiresAuth: false },
  },
];

const router = createRouter({
  routes,
  history: createWebHistory(),
});

router.beforeEach(async (to) => {
  const auth = useAuthStore();
  await auth.checkStatus();

  const requiresAuth = to.meta.requiresAuth;

  if (requiresAuth && !auth.isLoggedIn) {
    return {
      name: "auth.login",
      query: { redirect: to.fullPath },
    };
  }

  /**
   * Redirect to `/app` page if the route is not requiring authentication
   * but user is logged in and trying to access auth routes.
   */
  if (
    !requiresAuth
    && auth.isLoggedIn
    && AUTH_ROUTES.includes(to.name?.toString() ?? "")
  ) {
    return {
      name: "app",
    };
  }
});

export { router };
