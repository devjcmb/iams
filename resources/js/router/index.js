import { createWebHistory, createRouter } from "vue-router";
import Auth from "../views/Auth.vue"
import Dashboard from "../views/Dashboard.vue";
import IpAddresses from "../views/IpAddresses.vue";
import AuditHistory from "../views/AuditHistory.vue";
import AuthService from "../services/AuthService.ts";
import { nextTick } from "vue";

const routes = [
  {
    path: "/",
    name: "Dashboard",
    component: Dashboard,
    // meta: {
    //     requiresAuth: true
    // }
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
            // meta: {
            //     requiresAuth: true
            // }
        }, 
    ],
  },
  {
    path: "/auth",
    name: "Auth",
    component: Auth,
    // children: [
    //     // {
    //     //   path: 'register',
    //     //   component: Register,
    //     // },
    //     {
    //       path: 'login',
    //       component: Login,
    //     },
    //   ],
  },
 
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

// router.beforeEach((to, from, next) => {

//     if (AuthService.checkAuth()) {
//         next();
//     }

//     return false
// })

export default router;