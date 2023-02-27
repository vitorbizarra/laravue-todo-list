<template>
    <div v-if="isAuthenticated">
        <app-navbar-component></app-navbar-component>
    </div>
    <div v-else>
        <site-navbar-component></site-navbar-component>
    </div>
</template>
  
<script>
export default {
    computed: {
        isAuthenticated() {
            return this.$store.getters.isAuthenticated;
        }
    }
}
</script>