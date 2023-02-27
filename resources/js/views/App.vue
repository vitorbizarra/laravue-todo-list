<template>
    <div>
        <navbar-component></navbar-component>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "App",
    methods: {
        logout() {
            this.$store.dispatch('logout');
        }
    },
    computed: {
        isAuthenticated() {
            return this.$store.getters.isAuthenticated;
        }
    }
}
</script>