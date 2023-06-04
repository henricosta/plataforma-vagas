<script setup>
import ResponsiveNavLink from './ResponsiveNavLink.vue';
import NavLink from './NavLink.vue';
import SecondaryButton from './SecondaryButton.vue';
import PrimaryButton from './PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    isLogged: {
        type: Boolean,
        default: false
    }
})

</script>

<template>
    <header>
        <nav class="bg-white border-b border-gray-100">
            <div class="flex flex-wrap justify-between text-gray-800 h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center mx-10">
                        <Link href="/" class="text-gray-900">
                        HOME
                        </Link>
                    </div>
                    <!-- Navigation Links -->
                    <div class="flex items-center">
                        <Link href="/" class="px-2">Buscar vagas</Link>
                        <Link v-if="props.isLogged" href="/profile/vagas" class="px-2">Minhas vagas</Link>
                        <Link v-else :href="route('empresa.register')" class="px-2">Para empresas</Link>
                    </div>
                </div>
                <!-- Botões da direita -->
                <div class="flex items-center mr-8">
                    <div v-if="props.isLogged">
                        <Link href="/profile">

                        <div class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>

                        </Link>
                    </div>
                    <div v-else>
                        <Link href="/login" class="mr-5">Entrar</Link>
                        <Link href="/register">
                            <PrimaryButton class="py-3">Cadastre-se</PrimaryButton>
                        </Link>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style scoped></style>
