<script setup>

import CardVaga from "@/Components/Vagas/CardVaga.vue";
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    vagas: Object,
    previousPageUrl: String,
    nextPageUrl: String,
    currentPage: Number,
    updateVagaFocus: Function,
    totalPages: Number,
})

function getPageLink(i) {
    return props.nextPageUrl.slice(0, -1) + String(i)
}

</script>

<template>
    <div class="w-2/5">
        <div class="lista bg-gray-200 shadow-inner">
            <!-- A key desse v-for não pode ser o id da vaga, mas sim o index
                                para a funcionalidade de selecionar vaga funcionar da forma correta.
                            -->
            <div v-for="(vaga, index) in props.vagas" :key="index">
                <CardVaga :titulo="vaga.titulo" :nome_empresa="vaga.empresa.nome_empresa" :descricao="vaga.descricao"
                    :num_vagas="vaga.num_vagas" :modalidade="vaga.modalidade" :cidade="vaga.nome_cidade"
                    @click="updateVagaFocus(index)" />
            </div>
        </div>
        <!-- Botões de navegação -->
        <div class="flex justify-center -ml-2">
            <div class="flex justify-between w-1/2 mt-4 mb-8">
                
                <Link :href="previousPageUrl"
                    class="text-white bg-gray-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
                <span class="sr-only">Icon description</span>
                </Link>
                
                <div v-if="vagas.length > 10">
                    <ul v-if="totalPages > 1" class="flex items-center">
                        <li v-if="totalPages > 5" v-for="i in 5" class="px-1">
                            <div class="flex align-middle justify-center items-center w-7 h-7 rounded-full" :class="{'bg-gray-400': currentPage === i}">
                                <Link :href="getPageLink(i)">{{ i }}</Link>
                            </div>
                        </li>
                        <li v-else v-for="i in totalPages" class="px-1">
                            <div class="flex align-middle justify-center items-center w-7 h-7 rounded-full" :class="{'bg-gray-400': currentPage === i}">
                                <Link :href="getPageLink(i)">{{ i }}</Link>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <Link :href="nextPageUrl" type="button"
                    class="text-white bg-gray-900 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
                <span class="sr-only">Icon description</span>
                </Link>
            </div>
        </div>
    </div>
</template>

<style scoped>
.lista {
    max-height: 145vh;
    overflow: auto
}
</style>
