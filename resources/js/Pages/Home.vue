<script setup>

import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
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
    <GuestLayout v-else>
        <FormBuscaVaga />
        <LayoutVagas :vagas="props.vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </GuestLayout>
</template>
