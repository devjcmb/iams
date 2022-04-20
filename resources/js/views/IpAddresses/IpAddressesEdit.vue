<template>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Create New IP Address</h1>
      </div>

    <form>
        <p v-if="errors.length">
            <ul>
                <li v-for="error in errors"><small class="text-danger">{{ error }}</small></li>
            </ul>
        </p>

        <div class="mb-3">
            <label class="form-label">Label</label>
            <input type="text" class="form-control" placeholder="Test Label" v-model="label">
        </div>

        <button class="btn btn-lg btn-warning float-end" type="submit" @click="handleSubmit">Update</button>

    </form>
</template>

<script>
import IpAddressService from "../../services/IpAddressService.ts";

export default {
    data(){
        return {
            label : "",
            errors: []
        }
    },
    methods : {
        handleSubmit(e){
            e.preventDefault()

            this.errors = [];

            let data = {
                'label': this.label
            };

            let axios = IpAddressService.update(this.$router.currentRoute.value.params.id, data);

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
