<template>
    <Disclosure as="nav" class="bg-white" v-slot="{ open }">
        <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
            <div class="relative flex h-16 items-center justify-between">
                <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                    <!-- Mobile menu button-->
                    <DisclosureButton
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-900 hover:bg-indigo-600 hover:text-white focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
                        <span class="sr-only">Open main menu</span>
                        <Bars3Icon v-if="!open" class="block h-6 w-6" aria-hidden="true" />
                        <XMarkIcon v-else class="block h-6 w-6" aria-hidden="true" />
                    </DisclosureButton>
                </div>
                <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                    <div class="flex flex-shrink-0 items-center">
                        <img class="block h-8 w-auto lg:hidden"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                        <img class="hidden h-8 w-auto lg:block"
                            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=500" alt="Your Company" />
                    </div>
                    <div class="hidden flex w-full sm:ml-6 sm:block">
                        <div class="flex space-x-4 justify-center">
                            <router-link v-for="item in navigation" :key="item.name" :to="{ name: item.href }"
                                :class="[(item.href == this.$route.name) ? 'shadow-md bg-indigo-600 text-white' : 'black hover:shadow', 'rounded-md px-3 py-2 font-medium transition ease-in-out duration-300']"
                                :aria-current="(item.href == this.$route.name) ? 'page' : undefined">{{ item.name
                                }}</router-link>
                        </div>
                    </div>
                </div>
                <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                    <button @click="logout"
                        class="black rounded-md px-3 py-2 font-medium hover:shadow-md hover:bg-indigo-600 hover:text-white transition ease-in-out duration-300">Logout</button>
                </div>
            </div>
        </div>

        <transition enter-active-class="transition duration-100 ease-out" enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100" leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100" leave-to-class="transform scale-95 opacity-0">
            <DisclosurePanel class="sm:hidden">
                <div class="space-y-1 px-2 pt-2 pb-3">
                    <router-link v-for="item in navigation" :key="item.name" as="a" :to="{ name: item.href }"
                        :class="[(item.href == this.$route.name) ? 'bg-indigo-600 text-white' : 'text-black hover:bg-indigo-600 hover:text-white', 'block rounded-md px-3 py-2 text-base font-medium']"
                        :aria-current="(item.href == this.$route.name) ? 'page' : undefined">{{ item.name }}</router-link>
                </div>
            </DisclosurePanel>
        </transition>
    </Disclosure>
</template>
  
<script setup>
import { Disclosure, DisclosureButton, DisclosurePanel } from '@headlessui/vue'
import { Bars3Icon, XMarkIcon, ArrowPathIcon } from '@heroicons/vue/24/outline'
import store from '../services/store';

const navigation = [
    { name: 'Dashboard', href: 'dashboard' },
    { name: 'Minha Conta', href: 'minha-conta' },
]


function logout() {
    store.dispatch('logout');
}
</script>