<script setup>
defineProps({
    titulo: String
})
</script>

<template>
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <h4 v-if="titulo" class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">{{ titulo }}</h4>
        <slot />
    </div>
</template>