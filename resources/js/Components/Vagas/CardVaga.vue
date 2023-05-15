<script setup>
import {computed} from "vue";

defineProps({
    titulo: String,
    nome_empresa: String,
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
    <a href="#" class="block max-w-lg p-8 border shadow h-full rounded-3xl my-3 mx-5">
        <h5 class="mb-2 text-2xl">{{ truncate(titulo, 50) }}</h5>
        <p class="mb-2 text-gray-500">{{ truncate(nome_empresa, 30) }}</p>
        <p class="text-sm" id="card-text">{{ truncate(descricao, 130) }}</p>
    </a>
</template>

<style scoped>

</style>
