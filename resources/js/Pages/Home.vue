<script setup>

import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

defineProps({
    vagas: Object,
    isLogged: Boolean
})

</script>

<template>
    <DefaultLayout :is-logged="isLogged">
        <FormBuscaVaga />
        <LayoutVagas :vagas="vagas"/>
    </DefaultLayout>
</template>
