<script setup>
import Section from '../Section.vue';

defineProps({
    nome_completo: String,
    email: String,
    telefone: String
})
</script>

<template>
    <Section>
        <div
            class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
        </div>
        <div>
            <div class="mb-3 text-4xl font-extrabold dark:text-white">{{ nome_completo }}</div>
            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                <li>Email: {{ email }}</li>
                <li v-if="telefone">Telefone: {{ telefone }}</li>
            </ul>
        </div>
    </Section>
</template>