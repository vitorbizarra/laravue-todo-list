<template>
    <div class="px-4 md:pt-6 md:px-12">
        <h1 class="mb-6 text-4xl font-bold tracking-tight text-gray-900">Minha Conta</h1>
        <div class="space-y-2 text-xl">
            <div>
                <span class="text-black font-bold">Nome:</span> {{ this.user.first_name }}
            </div>
            <div>
                <span class="text-black font-bold">Sobrenome:</span> {{ this.user.last_name }}
            </div>
            <div>
                <span class="text-black font-bold">Email:</span> {{ this.user.email }}
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: this.$store.getters.user
        }
    },
    methods: {
        async submitRegisterForm() {
            const response = await this.$store.dispatch('register', this.form);

            if (response) {
                this.error.message = response;
            }
        },
    }
}
</script>