<script setup>
import Section from '../Section.vue';
import { Link } from '@inertiajs/vue3';

defineProps({
    nome: String,
})
</script>

<template>
    <Section>
        <div
            class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="font-medium text-gray-600 dark:text-gray-300">Empresa</span>
        </div>
        <div class="flex items-center">
            <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{nome}}</div>
            <Link :href="route('empresa.edit')" class="ml-4 mb-2 py-2 px-3 rounded-md border bg-gray-200 shadow-sm text-sm hover:bg-gray-400">Editar informações</Link>
        </div>
    </Section>
</template>