<script setup>

import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
import Dropdown from "@/Components/Dropdown.vue";

const placeholder = [
    {
        filter: 'modalidade',
        text: 'Modalidade',
        options: [
            {
                id: 1,
                nome: 'Presencial'
            },
            {
                id: 2,
                nome: 'Remoto'
            },
            {
                id: 3,
                nome: 'Híbrido'
            }
        ]
    }
]

const form = reactive({
    busca: null,
    modalidade: 0
})

function submit() {
    router.get('/vagas/busca', form)
}

function updateModalidade(value) {
    form.modalidade = value
    router.get('/vagas/busca', form)
}

</script>
<!-- TODO: Enviar filtros junto com o input -->
<template>
    <form @submit.prevent="submit" id="formulario-busca-vaga">
        <div class="flex justify-center">
            <div class="py-8 flex">
                <input type="text" id="input-field" class="pl-6 placeholder-gray-400 bg-indigo-50 rounded-l-2xl border-blue-700 text-lg focus:border-transparent border-1" placeholder="Ex: Desenvolvedor Web" v-model="form.busca">
                <button type="submit" class="bg-blue-600 text-gray-50 px-4 py-4 rounded-r-2xl">Buscar vaga</button>
            </div>
        </div>
        <div class="border-b-2 border-t-2 py-4">
            <Dropdown @change="updateModalidade" :selected="form.modalidade" v-for="item in placeholder" :filter="item.filter" :text="item.text" :options="item.options"/>
        </div>
    </form>
</template>

<style scoped>
#input-field {
    width: 32rem;
}
</style>
