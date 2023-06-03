<script setup>

import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";

defineProps({
    vagas: Object,
    nextPageUrl: String,
    previousPageUrl: String,
    isLogged: Boolean,
    totalPages: Number,
    currentPage: Number,
})

</script>

<template>
    <DefaultLayout :is-logged="isLogged">
        <FormBuscaVaga />
        <LayoutVagas :vagas="vagas" :previous-page-url="previousPageUrl" :next-page-url="nextPageUrl" :total-pages="totalPages" :current-page="currentPage" />
    </DefaultLayout>
</template>
