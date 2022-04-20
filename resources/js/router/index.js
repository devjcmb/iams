import { createWebHistory, createRouter } from "vue-router";
import Auth from "../views/Auth.vue"
import Dashboard from "../views/Dashboard.vue";
import IpAddresses from "../views/IpAddresses.vue";
import AuditHistory from "../views/AuditHistory.vue";
import Login from "../views/Login.vue";
import AuthService from "../services/AuthService.ts";
import { nextTick } from "vue";

const routes = [
  {
    path: "/",
    name: "Dashboard",
    component: Dashboard,
    meta: {
        requiresAuth: true
    },
    children: [
        {
            path: "audit-history",
            name: "AuditHistory",
            component: AuditHistory,
          },
          {
            path: "ip-addresses",
            name: "IpAddresses",
            component: IpAddresses,
        }, 
    ],
  },
  {
    path: "/auth",
    name: "Auth",
    component: Auth,
    children: [
        // {
        //   path: 'register',
        //   component: Register,
        // },
        {
          path: 'login',
          name: "Login",
          component: Login,
        },
      ],
  },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

router.beforeEach(async (to, from) => {
    
    if (
      // make sure the user is authenticated
      !AuthService.checkAuth() &&
      // ❗️ Avoid an infinite redirect
      to.name !== 'Login'
    ) {
      // redirect the user to the login page
      return { name: 'Login' }
    }
  })

export default router;