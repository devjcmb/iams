<template>
  <form>
    <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

    <p v-if="errors.length">
        <ul>
            <li v-for="error in errors"><small class="text-danger">{{ error.message }}</small></li>
        </ul>
    </p>
    
    <div class="form-floating">
      <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" v-model="email">
      <label for="floatingInput">Email address</label>
    </div>

    <div class="form-floating">
      <input type="password" class="form-control" id="floatingPassword" placeholder="Password" v-model="password">
      <label for="floatingPassword">Password</label>
    </div>

    <button class="w-100 btn btn-lg btn-primary" type="submit" @click="handleSubmit">Sign in</button>

  </form>
</template>

<script>

import AuthService from "../services/AuthService.ts";

export default {
    data(){
        return {
            email : "test@email.com",
            password : "password",
            errors: []
        }
    },
    methods : {
        handleSubmit(e){
            e.preventDefault()

            this.errors = [];

            let data = {
                'email': this.email,
                'password': this.password
            };

            if (this.password.length > 0) {

                let axios = AuthService.login(data);

                axios.then((response) => {

                    localStorage.setItem('token', response.data.data.token)

                    if (localStorage.getItem('token') != null){
                        window.location.href = "/"
                    }
                }).catch(err => {
                    this.errors.push(err.response.data.errors)
                });

            }
        }
    }
 }
</script>
