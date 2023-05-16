<script setup>

import CardVaga from "@/Components/Vagas/CardVaga.vue";

defineProps({
    vagas: Object,
    updateVagaFocus: Function
})

</script>

<template>
    <div>
        <div v-for="(vaga, index) in vagas" :key="index">
            <CardVaga :titulo="vaga.titulo" :nome_empresa="vaga.nome_empresa" :descricao="vaga.descricao" @click="updateVagaFocus(index)"/>
        </div>
    </div>
</template>

<style scoped>

</style>
