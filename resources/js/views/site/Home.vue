<template>
    <main>
        <div class="relative px-6 lg:px-8 w-100">
            <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
                <div class="text-center">
                    <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Sua plataforma de organização de
                        tarefas</h1>
                    <p class="mt-6 text-lg leading-8 text-gray-600">Após criar sua conta, basta realizar o login e você já
                        poderá a começar a organizar suas tarefas.</p>
                    <div class="mt-10 flex items-center justify-center gap-x-6">
                        <router-link :to="{ name: 'cadastro' }"
                            class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cadastrar</router-link>
                        <router-link :to="{ name: 'saiba-mais' }"
                            class="text-sm font-semibold leading-6 text-gray-900">Saiba mais <span
                                aria-hidden="true">→</span></router-link>
                    </div>
                </div>
            </div>
        </div>
    </main>
</template>

<script>
export default {}
</script>