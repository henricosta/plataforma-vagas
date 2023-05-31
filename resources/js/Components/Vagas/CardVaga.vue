<script setup>
import {computed} from "vue";

defineProps({
    titulo: String,
    nome_empresa: String,
    descricao: String,
    cidade: String,
    num_vagas: Number,
    modalidade: String
})

function truncate(str, maximum_length) {
    if (str.length > maximum_length) {
        return str.slice(0, maximum_length) + '...'
    }
    return str
}
</script>

<template>
    <div class="bg-white block w-full max-w-lg p-8 border shadow h-full rounded-lg my-3 mx-5">
        <h5 class="mb-1 text-xl text-gray-900"><strong>{{ truncate(titulo, 50) }}</strong></h5>
        <p class="text-gray-800">{{ truncate(nome_empresa, 30) }}</p>
        <p class="mb-1 text-gray-600 text-sm">{{ cidade }} ({{ modalidade==1 ? 'Presencial' : modalidade==2 ? 'Híbrido' : 'Remoto' }})</p>
        <p class="text-sm" id="card-text">{{ truncate(descricao, 130) }}</p>
    </div>
</template>

<style scoped>

</style>
