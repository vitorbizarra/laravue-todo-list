<template>
    <div class="flex">
        <div class="m-auto text-center py-44 md:py-64">
            <h1 class="text-base font-bold text-indigo-600 text-8xl">404</h1>
            <h2 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-5xl">Página não encontrada</h2>
            <div v-if="isAuthenticated">
                <p class="mt-6 text-base leading-7 text-gray-600">Desculpe por isso! Por favor, visite sua dashboard para
                    chegar onde você precisa ir.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <router-link :to="{ name: 'dashboard' }"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Me
                        leve até lá!</router-link>
                </div>
            </div>
            <div v-else>
                <p class="mt-6 text-base leading-7 text-gray-600">Desculpe por isso! Por favor, visite nossa homepage para
                    chegar onde você precisa ir.
                </p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <router-link :to="{ name: 'home' }"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Me
                        leve até lá!</router-link>
                </div>
            </div>
        </div>
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