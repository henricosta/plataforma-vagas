<script setup>

import FormBuscaVaga from "@/Components/Vagas/FormBuscaVaga.vue";
import LayoutVagas from "@/Layouts/LayoutVagas.vue";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import UserLayout from "@/Layouts/UserLayout.vue";
import { onBeforeMount, onMounted, ref } from "vue";

const props = defineProps({
    vagas: Object,
    nextPageUrl: String,
    previousPageUrl: String,
    totalPages: Number,
    currentPage: Number,
    auth: String,
})
const vagas = ref([])
function getVagas(formData) {
    console.log(formData)
    axios.get('vagas/busca', {
        params: formData
    })
    .then(res => {
        console.log(res.data)
        vagas.value = res.data.vagas
    })
    .catch(err => {
        console.log(err)
    })
}
onBeforeMount(() => {
    getVagas({ busca: '', modalidade: 0, data: 0, estado: '0'})
})
</script>

<template>
    <UserLayout v-if="props.auth == 'web'">
        <FormBuscaVaga @submit="getVagas" />
        <LayoutVagas :vagas="vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </UserLayout>
    <GuestLayout v-else>
        <FormBuscaVaga @submit="getVagas"/>
        <LayoutVagas :vagas="vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </GuestLayout>
</template>
