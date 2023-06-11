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
    guard: String,
})
const vagas = ref(0)
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
        console.log('logging error')
        console.log(err.response.data.error.error_message)
    })
}
onBeforeMount(() => {
    getVagas({ busca: '', modalidade: 0, data: 0, estado: 0, page: 1, cidade_id: 0 })
})
</script>

<template>
    <UserLayout v-if="props.guard == 'web'">
        <FormBuscaVaga @submit="getVagas" />
        <LayoutVagas v-if="vagas" :vagas="vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </UserLayout>
    <GuestLayout v-else>
        <FormBuscaVaga @submit="getVagas"/>
        <LayoutVagas v-if="vagas" :vagas="vagas" :previous-page-url="props.previousPageUrl" :next-page-url="props.nextPageUrl" :total-pages="props.totalPages" :current-page="props.currentPage" />
    </GuestLayout>
</template>
