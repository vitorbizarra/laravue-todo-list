<template>
    <div class="flex min-h-full items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="w-full max-w-lg space-y-8">
            <div>
                <img class="mx-auto h-12 w-auto" src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
                    alt="Your Company" />
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">Realize o seu cadastro</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Já tem uma conta?
                    {{ ' ' }}
                    <router-link :to="{ name: 'login' }" class="font-medium text-indigo-600 hover:text-indigo-500">Faça o
                        login!</router-link>
                </p>
            </div>
            <register-form-component></register-form-component>
        </div>
    </div>
</template>
  
<script>
export default {}
</script>