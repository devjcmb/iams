import { createWebHistory, createRouter } from "vue-router";
import Auth from "../views/Auth.vue"
import Dashboard from "../views/Dashboard.vue";
import IpAddresses from "../views/IpAddresses.vue";
import IpAddressesCreate from "../views/IpAddresses/IpAddressesCreate.vue";
import IpAddressesEdit from "../views/IpAddresses/IpAddressesEdit.vue";
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
        {
            path: "ip-addresses/create",
            name: "IpAddressesCreate",
            component: IpAddressesCreate,
        },
        {
            path: "ip-addresses/:id",
            name: "IpAddressesEdit",
            component: IpAddressesEdit,
        },  
    ],
  },
  {
    path: "/auth",
    name: "Auth",
    component: Auth,
    children: [
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
    if (to.name == 'Login' && AuthService.checkAuth()) {
        return { name: 'Dashboard' }
    } else if ( !AuthService.checkAuth() && to.name !== 'Login' ) {
      // redirect the user to the login page
      return { name: 'Login' }
    }
})

export default router;