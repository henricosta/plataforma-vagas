<script setup>
import PrimaryButton from './PrimaryButton.vue';
import { Link } from '@inertiajs/vue3';

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
                        <Link :href="route('empresa.register')" class="px-2">Para empresas</Link>
                    </div>
                </div>
                <!-- Botões da direita -->
                <div class="flex items-center mr-8">
                    <div>
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
