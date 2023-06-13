<script setup>
import { computed } from '@vue/reactivity';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    id: Number,
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
    <Link :href="route('get.vaga', props.id)">
        <div class="mb-3 border rounded-md shadow-sm p-4 cursor-pointer hover:bg-gray-50">
            <h1 class="text-lg"><strong>{{ truncate(props.titulo, 40) }}</strong></h1>
            <p class="text-sm text-gray-600">{{ props.nome_empresa ? props.nome_empresa + ' - ' : '' }}{{ props.cidade }} ({{ computedModalidade }})</p>
            <p class="mt-2 text-sm text-gray-600">{{ truncate(props.descricao, 50) }}</p>
        </div>
    </Link>
</template>

<style scoped>

</style>
