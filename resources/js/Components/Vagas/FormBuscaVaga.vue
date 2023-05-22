<script setup>

import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
import FiltersTab from "@/Components/FiltersTab.vue";

const form = reactive({
    titulo: null
})

function submit() {
    router.get('/vagas/busca', form)
}

</script>
<!-- TODO: Enviar filtros junto com o input -->
<template>
    <form @submit.prevent="submit">
        <div class="flex justify-center">
            <div class="py-8 flex">
                <input type="text" id="input-field" class="pl-6 placeholder-gray-400 bg-indigo-50 rounded-l-2xl border-blue-700 text-lg focus:border-transparent border-1" placeholder="Ex: Desenvolvedor Web" v-model="form.titulo">
                <button type="submit" class="bg-blue-600 text-gray-50 px-4 py-4 rounded-r-2xl">Buscar vaga</button>
            </div>
        </div>
        <FiltersTab />
    </form>
</template>

<style scoped>
#input-field {
    width: 32rem;
}
</style>
