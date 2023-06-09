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
                        <a href="/" class="text-gray-900">
                        HOME
                        </a>
                    </div>
                    <!-- Navigation Links -->
                    <div class="flex items-center">
                        <a href="/" class="px-2">Buscar vagas</a>
                        <a :href="route('empresa.register')" class="px-2">Para empresas</a>
                    </div>
                </div>
                <!-- Botões da direita -->
                <div class="flex items-center mr-8">
                    <div>
                        <a href="/login" class="mr-5">Entrar</a>
                        <a href="/register">
                            <PrimaryButton class="py-3">Cadastre-se</PrimaryButton>
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style scoped></style>
