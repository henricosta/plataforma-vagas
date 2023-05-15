<script setup>

import CardVaga from "@/Components/Vagas/CardVaga.vue";

defineProps({
    vagas: Object
})

</script>

<template>
    <div v-for="vaga in vagas">
        <CardVaga :titulo="vaga.titulo" :nome_empresa="vaga.nome_empresa" :descricao="vaga.descricao"/>
    </div>
</template>

<style scoped>

</style>
