<script setup>
import { router } from '@inertiajs/core';
import PrimaryButton from '../PrimaryButton.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const props = defineProps({
    vaga: Object,
    candidatado: {
        type: Boolean,
        default: false
    }
})

function isOverflowing() {
    const desc = document.getElementById('descricao-vaga');

    if(desc.scrollHeight > desc.clientHeight) {
        console.log('overflowing')
    }
}

onMounted(() => {
    
})

const candidatado = ref(0)

function removerCandidatura() {
    axios.post('/candidatar', { vaga_id: props.vaga.id, action: 'remove' })
        .then(res => {
            if (res.data.success) {
                candidatado.value = 0
            } else {
                alert(res.data.message)
            }
        })
}

function candidatar() {
    axios.post('/candidatar', { vaga_id: props.vaga.id, action: 'create' })
        .then(res => {
            console.log(res.data)
            if (res.data.redirect) {
                router.get(route('register'))
            }
            if (res.data.success) {
                candidatado.value = 1
            } else {
                alert(res.data.message)
            }
        })
}
</script>

<template>
    <div class=" bg-white shadow-sm mx-6 border rounded-lg">
        <div class="m-14">
            <h2 class="text-3xl mb-2">{{ props.vaga.titulo }}</h2>
            <p class="text-gray-800">{{ props.vaga.empresa.nome_empresa }} - {{ props.vaga.nome_cidade }} ({{ modalidade
                == 1 ? 'Presencial' :
                modalidade == 2 ? 'Híbrido' : 'Remoto' }})</p>
            <PrimaryButton v-if="!candidatado" @click="candidatar" class="px-2 py-3 mt-4">Candidatar-se</PrimaryButton>
            <button v-else
                @click="removerCandidatura"
                class="inline-flex items-center px-4 py-3 mt-4 bg-white border rounded-md font-semibold text-xs text-red-600 uppercase tracking-widest hover:bg-gray-700 hover:text-white focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Remover Candidatura
            </button>
            <p class="mt-5"><strong>Descrição da vaga</strong></p>
            <hr class="my-1">
            <p id="descricao-vaga" class="descricao">{{ props.vaga.descricao }}</p>
        </div>
    </div>
</template>

<style scoped>
.descricao {
    max-height: 80vh;
    overflow: auto;
}

</style>
