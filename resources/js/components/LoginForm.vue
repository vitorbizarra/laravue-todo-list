<template>
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

        <div>
            <button v-if="!loading" type="submit"
                class="group relative flex mx-auto w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white transition ease-in-out delay-150 hover:bg-indigo-500 duration-300">
                Entrar
            </button>
            <button v-if="loading" disabled type="button"
                class="group relative flex mx-auto w-full justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white transition ease-in-out delay-150 hover:bg-indigo-500 duration-300">
                <svg aria-hidden="true" role="status" class="inline w-4 h-5 mr-3 text-white animate-spin"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="#E5E7EB" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentColor" />
                </svg>
            </button>
        </div>
    </form>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
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
            this.loading = true;
            const response = await this.$store.dispatch('login', this.form);

            if (response) {
                this.loading = false;
                this.error.message = response;
            }
        },
        hasError() {
            return (this.error.message != null);
        }
    }
}
</script>