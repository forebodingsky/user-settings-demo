import { createRouter, createWebHistory } from "vue-router";

const routes = [
  {
    path: '/',
    component: () => import("@/pages/HomePage.vue")
  },
  {
    path: '/users',
    component: () => import("@/pages/UsersPage.vue")
  },
];

export default createRouter({
  history: createWebHistory(),
  routes,
});
