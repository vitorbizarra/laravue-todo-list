<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Realize o login</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Não tem uma conta?
                    {{ ' ' }}
                    <router-link :to="{ name: 'registrar' }" class="font-medium text-indigo-600 hover:text-indigo-500">Crie uma agora mesmo!</router-link>
                </p>
            </div>
            <form class="mt-8 space-y-6" @submit.prevent="submitLoginForm($event)">
                <div v-if="this.error.message" class="w-100 bg-red-500 px-2 py-4 rounded shadow">
                    <p class="text-white">
                        {{ this.error.message }}
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
                        class="group relative flex mx-auto w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white transition ease-in-out delay-150 hover:bg-indigo-500 duration-300">
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
                email: null,
                password: null,
            },
            error: {
                message: null
            }
        };
    },
    methods: {
        async submitLoginForm() {
            const response = await this.$store.dispatch('login', this.form);

            if (response) {
                this.error.message = response;
            }
        },
        hasError() {
            return (this.error.message != null);
        }
    }
}
</script>