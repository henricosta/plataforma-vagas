<script setup>

import CardVaga from "@/Components/Vagas/CardVaga.vue";

const props = defineProps({
    vagas: Object,
    updateVagaFocus: Function
})

// TODO: adicionar svg icones paginacao
</script>

<template>
    <div class="w-2/5">
        <!-- A key desse v-for não pode ser o id da vaga, mas sim o index
                para a funcionalidade de selecionar vaga funcionar da forma correta.
            -->
        <div v-for="(vaga, index) in props.vagas" :key="index">
            <CardVaga :titulo="vaga.titulo" :nome_empresa="vaga.empresa.nome" :descricao="vaga.descricao"
                :num_vagas="vaga.num_vagas" :modalidade="vaga.modalidade" :cidade="vaga.nome_cidade"
                @click="updateVagaFocus(index)" />
        </div>
        <div class="flex justify-center -ml-24">
            <div class="flex justify-between w-1/2 mt-4 mb-8">
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Icon description</span>
                </button>
                <button type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    <svg aria-hidden="true" class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Icon description</span>
                </button>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
