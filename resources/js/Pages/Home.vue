<script setup>

import Header from "@/Components/Header.vue";
import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";

defineProps({
    vagas: Object,
})

</script>

<template>
    <Header />
    <FormBuscaVaga />
    <LayoutVagas :vagas="vagas"/>
</template>
