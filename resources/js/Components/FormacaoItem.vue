<script setup>
const props = defineProps({
    formacao: Object
})
</script>

<template>
    <hr>
    <div class="flex items-center justify-between mt-2">
        <h1 class="text-xl">{{ formacao.instituicao }}</h1>
        <slot></slot>
    </div>
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
    <div class="mb-2 mt-2 text-gray-700">{{ formacao.descricao }}</div>
</template>