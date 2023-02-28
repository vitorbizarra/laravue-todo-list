<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-md space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Realize o login</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Ou
                    {{ ' ' }}
                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">crie sua conta</a>
                </p>
            </div>
            <form class="mt-8 space-y-6" action="" method="POST" @submit.prevent="submitLoginForm($event)">
                <div v-if="hasError" class="w-100 bg-red-400 px-2 py-4 rounded shadow border border-red-600">
                    <p class="text-white">
                        {{ this.$store.state.error.message }}
                    </p>
                </div>
                <div class="-space-y-px shadow-sm">
                    <div class="mb-4">
                        <label for="email-address" class="sr-only">Email</label>
                        <input id="email-address" name="email" type="email" autocomplete="email" required
                            class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Email" v-model="form.email" />
                    </div>
                    <div>
                        <label for="password" class="sr-only">Senha</label>
                        <input id="password" name="password" type="password" autocomplete="current-password" required
                            class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                            placeholder="Senha" v-model="form.password" />
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="text-sm">
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Esqueceu a senha?</a>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="group relative flex w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                        Entrar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
  
<script>
export default {
    data() {
        return {
            form: {
                email: "",
                password: "",
            }
        };
    },
    methods: {
        submitLoginForm() {
            this.$store.dispatch('login', this.form);
        },
    },
    computed: {
        hasError() {
            return (this.$store.getters.errors != null);
        }
    }
}
</script>