<template>
<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Test App</a>
  <div class="navbar-nav">
    <div class="nav-item text-nowrap">
      <a class="nav-link px-3" href="#" @click="logout">Sign out</a>
    </div>
  </div>
</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
              <span data-feather="home"></span>
                <router-link to="/ip-addresses">IP Addresses</router-link>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#">
              <span data-feather="home"></span>
                <router-link to="/audit-history">Audit History</router-link>
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <router-view />
    </main>
  </div>
</div>

</template>

<script>
import AuthService from "../services/AuthService.ts";

export default {
    mounted() {
        this.$router.push({ name: 'IpAddresses' })
    },
    methods: {
        logout() {
            let axios = AuthService.logout();

            axios.then((response) => {
                localStorage.removeItem('token');
                // remove ls entry
                this.$router.push({ name: 'Login'})

            }).catch(err => {
                this.errors.push(err.response.data.message)
            });
        }
    }
}
</script>