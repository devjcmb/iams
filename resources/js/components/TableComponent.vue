<template>
    <table class="table table-hover">
        <thead>
            <tr>
            <th v-for="header in headers" scope="col">{{header}}</th>
            <th v-for="action in actions" scope="col">{{action}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data">
                <td v-for="i in item" scope="row">{{i}}</td>
                <td v-for="action in actions" scope="row">{{action}}</td>
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
        
    }
}
</script>