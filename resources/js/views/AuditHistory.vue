<template>
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Audit History</h1>
      </div>

      <div>
          <table-component :headers="headers" :data="data" :actions="actions"></table-component>
      </div>
</template>

<script>
import TableComponent from "./../components/TableComponent";
import AuditHistoryService from "../services/AuditHistoryService.ts";

export default {
    data() {
        return {
            headers: {
                title: "Title", 
                description: "Description", 
                dataa: "Data"
            },
            actions: [],
            data: [],
            errors: []
        }    
    },
    components: {
        TableComponent,
    },
    mounted() {
        let axios = AuditHistoryService.all();

        axios.then((response) => {
            let res = response.data.data;
            let filtered = {};
            this.data = res.map(function(a) {
                filtered = {
                    title: {value: a.title, hidden: false},
                    description: {value: a.description, hidden: false},
                    data: {value: a.data, hidden: false},
                }
                return filtered;
            });

        }).catch(err => {
            // this.errors.push(err.response.data.errors)
        });
    },
}
</script>