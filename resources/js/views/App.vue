<template>
    <div>
        <navbar-component></navbar-component>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App",
    created() {
        this.$store.dispatch('initState');
    },
    computed: {
        isAuthenticated() {
            return this.$store.getters.isAuthenticated;
        }
    }
}
</script>