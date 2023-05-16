<script setup>

import ListVagas from "@/Components/Vagas/ListVagas.vue";
import PageVaga from "@/Components/Vagas/PageVaga.vue";
import {reactive} from "vue";

defineProps({
    vagas: Object,
})

const vagaOnFocus = reactive({ vagaIndex: 0 })

function updateVagaOnFocus(index) {
    vagaOnFocus.vagaIndex = index
}

</script>

<template>
<!--    Todo: procurar uma forma de fazer com que a vaga selecionada na lista seja a que apareca na página -->
<!--    Todo: Adicionar página de "nenhuma vaga encontrada"-->
    <div class="flex justify-center">
        <ListVagas :vagas="vagas" :update-vaga-focus="updateVagaOnFocus"/>
        <PageVaga :vaga="vagas[vagaOnFocus.vagaIndex]"/>
    </div>
</template>

<style scoped>

</style>
