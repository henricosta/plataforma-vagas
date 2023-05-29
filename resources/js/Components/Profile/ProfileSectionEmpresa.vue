<script setup>
import Section from '../Section.vue';

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
        <div>
            <div class="mb-3 text-4xl font-extrabold dark:text-white">{{ nome }}</div>
        </div>
    </Section>
</template>