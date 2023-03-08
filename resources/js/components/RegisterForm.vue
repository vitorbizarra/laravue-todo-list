<template>
    <form class="mt-8 space-y-6" @submit.prevent="submitRegisterForm($event)">
        <div v-if="this.error.message" class="w-100 bg-red-500 px-2 py-4 rounded shadow">
            <p class="text-white">
                {{ this.error.message }}
            </p>
        </div>
        <div class="shadow-sm">
            <div class="mb-4">
                <label for="first_name" class="sr-only">Nome</label>
                <input id="first_name" name="name" type="text" required
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Nome" v-model="form.first_name" />
            </div>
            <div class="mb-4">
                <label for="last_name" class="sr-only">Sobrenome</label>
                <input id="last_name" name="last_name" type="text" required
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Sobrenome" v-model="form.last_name" />
            </div>
            <div class="mb-4">
                <label for="email-address" class="sr-only">Email</label>
                <input id="email-address" name="email" type="email" required
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Email" v-model="form.email" />
            </div>
            <div class="mb-4">
                <label for="password" class="sr-only">Senha</label>
                <input id="password" name="password" type="password" required
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Senha" v-model="form.password" />
            </div>
            <div>
                <label for="password_confirmation" class="sr-only">Confirme a senha</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required
                    class="relative block w-full appearance-none rounded-md border border-gray-300 px-3 py-2 text-gray-900 placeholder-gray-500 focus:z-10 focus:border-indigo-500 focus:outline-none focus:ring-indigo-500 sm:text-sm"
                    placeholder="Confirme a senha" v-model="form.password_confirmation" />
            </div>
        </div>

        <div>
            <button type="submit"
                class="group relative flex mx-auto w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white transition ease-in-out delay-150 hover:bg-indigo-500 duration-300">
                Cadastrar
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            form: {
                first_name: null,
                last_name: null,
                email: null,
                password: null,
                password_confirmation: null,
            },
            error: {
                message: null
            }
        };
    },
    methods: {
        async submitRegisterForm() {
            const response = await this.$store.dispatch('register', this.form);

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