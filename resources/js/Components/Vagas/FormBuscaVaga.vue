<script setup>

import {router} from "@inertiajs/vue3";
import {reactive} from "vue";
import SelectInput from "../SelectInput.vue";
import TextInput from "../TextInput.vue";
import PrimaryButton from "../PrimaryButton.vue";

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
    busca: '',
    modalidade: 0
})

function submit() {
    console.log('logando busca')
    console.log(form.busca)
    router.get('/vagas/busca', form)
}

function updateModalidade(value) {
    form.modalidade = value
    router.get('/vagas/busca', form)
}

</script>
<template>
    <form @submit.prevent="submit" id="formulario-busca-vaga">
        <!-- Input de busca -->
        <div class="flex justify-center">
            <div class="py-8 flex">
                <TextInput v-model="form.busca" type="text" placeholder="Ex: Desenvolvedor web" class="w-96 rounded-r-none px-4" ></TextInput>
                <PrimaryButton type="submit" class="px-4 py-4 rounded-l-none">Buscar vaga</PrimaryButton>
            </div>
        </div>
        <!-- Filtros de vaga -->
        <div class="border-b-2 border-t-2 py-4">
            <SelectInput @change="updateModalidade" :selected="form.modalidade" v-for="item in placeholder" :filter="item.filter" :text="item.text" :options="item.options"/>
        </div>
    </form>
</template>

<style scoped>
#input-field {
    width: 32rem;
}
</style>
