<script setup>

import Header from "@/Components/Header.vue";
import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";

defineProps({
    vagas: Object,
    isLogged: Boolean
})

</script>

<template>
    <Header :isLogged="isLogged"/>
    <FormBuscaVaga />
    <LayoutVagas :vagas="vagas"/>
</template>
