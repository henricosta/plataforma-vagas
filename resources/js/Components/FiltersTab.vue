<script setup>

import Dropdown from "@/Components/Dropdown.vue";
</script>

<template>
    <div class="border-b-2 border-t-2 py-4">
        <Dropdown button-text="Modalidade" :options="['Presencial', 'Remoto', 'Híbrido']"/>
        <Dropdown button-text="Data de publicação" :options="['Hoje', 'Últimos 3 dias', 'Última semana', 'Últimos 15 dias', 'Último mês']"/>
        <Dropdown button-text="Jornada" :options="['Período integral', 'Parcial manhã', 'Parcial tarde', 'Parcial noite', 'Noturno']"/>
    </div>
</template>

<style scoped>

</style>
