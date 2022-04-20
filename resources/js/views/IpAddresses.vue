<template>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">IP Addresses</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group me-2">
            <button type="button" class="btn btn-sm btn-success" @click="this.$router.push({path: '/ip-addresses/create'});">Add</button>
          </div>
        </div>
      </div>

     <router-view />

      <div>
          <table-component 
            :headers="headers" 
            :data="data"
            :actions="actions"
            @editClicked="editClicked">
        </table-component>
      </div>
</template>

<script>
import TableComponent from "./../components/TableComponent";
import IpAddressService from "../services/IpAddressService.ts";

export default {
    data() {
        return {
            headers: {
                name: "Name", 
                label: "Label"
            },
            actions: ['Edit'],
            data: [],
            errors: []
        }    
    },
    components: {
        TableComponent,
    },
    mounted() {
        let axios = IpAddressService.all();

        axios.then((response) => {
            let res = response.data.data;

            let filtered = {};
            this.data = res.map(function(a) {
                filtered = {
                    id: { value: a.id, hidden:true},
                    name: { value: a.name, hidden:false},
                    label: { value: a.pivot.label, hidden:false},
                }
                return filtered;
            });

        }).catch(err => {
            // this.errors.push(err.response.data.errors)
        });
    },
    methods: {
        editClicked(event) {
            this.$router.push({ name: 'IpAddressesEdit', params: { id: event.id.value }, query: {data: event.label.value} })
        }

        
    }
}
</script>