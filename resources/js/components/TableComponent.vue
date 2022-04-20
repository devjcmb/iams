<template>
    <table class="table">
        <thead>
            <tr>
            <th v-for="header in headers" scope="col">{{header}}</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="item in data">
                <th v-for="i in item" scope="row">{{i}}</th>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        headers: {},
        data: Array
    },
    mounted() {
        console.log(this.data)
    }
}
</script>