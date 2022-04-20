import { createWebHistory, createRouter } from "vue-router";
import Auth from "../views/Auth.vue"
import Dashboard from "../views/Dashboard.vue";


const routes = [
  {
    path: "/",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/auth",
    name: "Auth",
    component: Auth,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;