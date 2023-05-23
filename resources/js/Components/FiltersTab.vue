<script setup>

import Dropdown from "@/Components/Dropdown.vue";

const placeholder = [
    {
        buttonText: 'Modalidade',
        options: ['Presencial', 'Remoto', 'Híbrido']
    },
    {
        buttonText: 'Data de publicação',
        options: ['Hoje', 'Últimos 3 dias', 'Última semana', 'Últimos 15 dias', 'Último mês']
    },
    {
        buttonText: 'Jornada',
        options: ['Período integral', 'Parcial manhã', 'Parcial tarde', 'Parcial noite', 'Noturno']
    },
]

</script>

<template>
    <div class="border-b-2 border-t-2 py-4">
        <Dropdown v-for="item in placeholder" :button-text="item.buttonText" :options="item.options"/>
    </div>
</template>

<style scoped>

</style>
