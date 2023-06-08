<script setup>

import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";
import DefaultLayout from "@/Layouts/DefaultLayout.vue";
import UserLayout from "@/Layouts/UserLayout.vue";

const props = defineProps({
    vagas: Object,
    nextPageUrl: String,
    previousPageUrl: String,
    totalPages: Number,
    currentPage: Number,
    auth: String,
})

</script>

<template>
    <UserLayout v-if="props.auth == 'web'">
        {{ console.log(props.auth) }}
        <FormBuscaVaga />
        <LayoutVagas :vagas="props.vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </UserLayout>
    <DefaultLayout v-else :is-logged="true">
        <FormBuscaVaga />
        <LayoutVagas :vagas="props.vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </DefaultLayout>
</template>
