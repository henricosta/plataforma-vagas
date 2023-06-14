<script setup>

import ListVagas from "@/Components/Vagas/ListVagas.vue";
import PageVaga from "@/Components/Vagas/PageVaga.vue";
import { reactive } from "vue";
import Section from "@/Components/Section.vue";

const props = defineProps({
    vagas: Array,
    previousPageUrl: String,
    nextPageUrl: String,
    totalPages: Number,
    currentPage: Number
})

const vagaOnFocus = reactive({ vagaIndex: 0 })

function updateVagaOnFocus(index) {
    vagaOnFocus.vagaIndex = index
}

</script>

<template>
    <div v-if="props.vagas.length" class="flex justify-center">
        <ListVagas :vagas="props.vagas" :update-vaga-focus="updateVagaOnFocus" :next-page-url="props.nextPageUrl"
            :previous-page-url="props.previousPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage"/>
        <div class="w-2/4">
            <PageVaga id="page-vaga" class="my-3" :vaga="props.vagas[vagaOnFocus.vagaIndex]"/>
        </div>
    </div>
    <div v-else class="flex justify-center mt-12">
        <Section class="w-1/2 flex justify-center text-gray-800">
            <h1 class="text-3xl">Nenhuma vaga encontrada</h1>
        </Section>
    </div>
</template>

<style scoped>
.follow-scroll {

}
</style>
