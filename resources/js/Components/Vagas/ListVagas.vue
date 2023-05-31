<script setup>

import CardVaga from "@/Components/Vagas/CardVaga.vue";

const props = defineProps({
    vagas: Object,
    updateVagaFocus: Function
})

</script>

<template>
    <div>
        <!-- A key desse v-for não pode ser o id da vaga, mas sim o index 
                para a funcionalidade de selecionar vaga funcionar da forma correta.
            -->
        <div v-for="(vaga, index) in props.vagas" :key="index">
            <CardVaga :titulo="vaga.titulo" :nome_empresa="vaga.empresa.nome" :descricao="vaga.descricao"
                :num_vagas="vaga.num_vagas" :modalidade="vaga.modalidade" :cidade="vaga.nome_cidade"
                @click="updateVagaFocus(index)" />
        </div>
    </div>
</template>

<style scoped></style>
