<template>
    <table class="table table-hover">
        <thead>
            <tr>
            <th v-for="header in headers" scope="col">{{header}}</th>
            <th v-if="actions.length > 0" scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data" >
                <td v-for="i in item" scope="row" v-show="!isHidden(i)" >{{i.value}}</td>
                <td v-for="action in actions" scope="row">
                    <button v-if="action == 'Edit'" class="btn btn-warning" @click="onEditClicked(item)">Edit</button>
                </td>
            </tr>

        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        headers: {},
        data: Array,
        actions: []
    },
    mounted() {
        
    },
    methods: {
        onEditClicked(event) {
            this.$emit('editClicked', event)
        },

        isHidden(item) {
            if (item) {
                return item.hidden;
            }
            return true;
        }
    }
}
</script>