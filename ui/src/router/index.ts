import { type RouteRecordRaw, createRouter, createWebHistory } from "vue-router";

const routes: RouteRecordRaw[] = [
  {
    path: "/",
    name: "Home",
    component: () => import("~/views/HomeView.vue"),
  },
];

export const router = createRouter({
  routes,
  history: createWebHistory(),
});
