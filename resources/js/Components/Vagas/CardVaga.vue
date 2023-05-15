<script setup>
defineProps({
    titulo: String,
    empresa: Object,
    descricao: String
})

function truncate(str, maximum_length) {
    if (str.length > maximum_length) {
        return str.slice(0, maximum_length) + '...'
    }
    return str
}

</script>

<template>
    <a href="#" class="block max-w-lg p-8 border shadow h-full">
        <h5 class="mb-2 text-2xl">{{ truncate(titulo, 60) }}</h5>
        <p class="mb-2 text-gray-500">{{ truncate(empresa.nome, 50) }}</p>
        <p class="text-sm" id="card-text">{{ truncate(descricao, 120) }}</p>
    </a>
</template>

<style scoped>

</style>
