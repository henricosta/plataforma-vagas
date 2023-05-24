<script setup>

// BUG: Quando uma vaga é selecionada a barra de rolagem volta para o topos

import ListVagas from "@/Components/Vagas/ListVagas.vue";
import PageVaga from "@/Components/Vagas/PageVaga.vue";
import {onBeforeUnmount, onMounted, reactive, ref} from "vue";

defineProps({
    vagas: Object,
})

const vagaOnFocus = reactive({ vagaIndex: 0 })

function updateVagaOnFocus(index) {
    vagaOnFocus.vagaIndex = index
}

onMounted(() => {
    window.addEventListener('scroll', handleScrolling)
})
onBeforeUnmount(() => {
    window.removeEventListener('scroll', handleScrolling)
})

const isFixed = ref(false)

function handleScrolling() {
    const pageVaga = document.getElementById('page-vaga').getBoundingClientRect();
    isFixed.value = pageVaga.height - window.scrollY < window.innerHeight;
}

</script>

<template>
<!--    TODO: Adicionar página de "nenhuma vaga encontrada"-->
    <div class="flex justify-center">
        <ListVagas :vagas="vagas" :update-vaga-focus="updateVagaOnFocus"/>
        <div class="w-2/4">
            <PageVaga  id="page-vaga" :vaga="vagas[vagaOnFocus.vagaIndex]" :class="{
                'fixed': isFixed,
                'bottom-0': isFixed,
                'w-2/4': isFixed
            }"/>
        </div>
    </div>
</template>

<style scoped>

</style>
