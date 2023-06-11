<script setup>
import { computed } from '@vue/reactivity';

const props = defineProps({
    titulo: String,
    nome_empresa: String,
    descricao: String,
    cidade: String,
    modalidade: String
})

const computedModalidade = computed(() => {
    let m = ''
    if (props.modalidade == 1) {
        m = 'Presencial'
    } else if (props.modalidade == 2) {
        m = 'Híbrido'
    } else {
        m = 'Remoto'
    }

    return m
})

function truncate(str, maximum_length) {
    if (str.length > maximum_length) {
        return str.slice(0, maximum_length) + '...'
    }
    return str
}
</script>

<template>
    <div class="w-80 border rounded-md shadow-sm p-4 cursor-pointer hover:bg-gray-50">
        <h1 class="text-lg"><strong>{{ props.titulo }}</strong></h1>
        <p class="text-sm text-gray-600">{{ props.nome_empresa }} - {{ props.cidade }} ({{ computedModalidade }})</p>
        <p class="mt-2 text-sm text-gray-600">{{ truncate(props.descricao, 50) }}</p>
    </div>
</template>

<style scoped>

</style>
