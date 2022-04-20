<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New IP Address</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-dark" @click="this.$router.go(-1);">Back</button>
          </div>
        </div>
      </div>

    <form>
        <p v-if="errors.length">
            <ul>
                <li v-for="error in errors"><small class="text-danger">{{ error }}</small></li>
            </ul>
        </p>
        
        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" class="form-control" placeholder="192.168.1.1" v-model="name">
        </div>


        <div class="mb-3">
            <label class="form-label">Label</label>
            <input type="text" class="form-control" placeholder="Test Label" v-model="label">
        </div>

        <button class="btn btn-lg btn-primary float-end" type="submit" @click="handleSubmit">Add</button>

    </form>
</template>

<script>
import IpAddressService from "../../services/IpAddressService.ts";

export default {
    data(){
        return {
            name: "",
            label : "",
            errors: []
        }
    },
    methods : {
        handleSubmit(e){
            e.preventDefault()

            this.errors = [];

            let data = {
                'name': this.name,
                'label': this.label
            };

            let axios = IpAddressService.create(data);

            axios.then((response) => {
                console.log(response.data)
                this.$router.go(-1)
            }).catch(err => {
                this.errors.push(err.response.data.message)
            });

        
        }
    }
 }
</script>
