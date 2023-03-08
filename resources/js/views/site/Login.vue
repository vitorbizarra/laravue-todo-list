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
                    <router-link :to="{ name: 'cadastro' }" class="font-medium text-indigo-600 hover:text-indigo-500">Crie
                        uma agora mesmo!</router-link>
                </p>
            </div>
            <login-form-component></login-form-component>
        </div>
    </div>
</template>
  
<script>
export default {}
</script>