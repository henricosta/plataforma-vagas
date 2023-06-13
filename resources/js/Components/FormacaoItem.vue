<script setup>
const props = defineProps({
    formacao: Object
})
</script>

<template>
    <hr>
    <h1 class="mt-2 text-xl">{{ formacao.instituicao }}</h1>
    <div class="flex justify-between items-center">
        <div class="flex">
            <p class="text-gray-700">{{ formacao.diploma }} -</p>
            <p class="ml-1">{{ formacao.area }}</p>
        </div>
        <div class="flex text-sm text-gray-500">
            <div>Início {{ formacao.inicio }}</div>
            <span>|</span>
            <div>Término {{ formacao.termino }}</div>
        </div>
    </div>
    <div class="mb-2">{{ formacao.descricao }}</div>
</template>