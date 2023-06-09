<script setup>

import {router} from "@inertiajs/vue3";
import {reactive, ref} from "vue";
import SelectInput from "../SelectInput.vue";
import TextInput from "../TextInput.vue";
import PrimaryButton from "../PrimaryButton.vue";
import axios from "axios";

const estados = [
    {nome: "Acre", value: "AC"},
    {nome: "Alagoas", value: "AL"},
    {nome: "Amapá", value: "AP"},
    {nome: "Amazonas", value: "AM"},
    {nome: "Bahia", value: "BA"},
    {nome: "Ceará", value: "CE"},
    {nome: "Distrito Federal", value: "DF"},
    {nome: "Espírito Santo", value: "ES"},
    {nome: "Goiás", value: "GO"},
    {nome: "Maranhão", value: "MA"},
    {nome: "Mato Grosso", value: "MT"},
    {nome: "Mato Grosso do Sul", value: "MS"},
    {nome: "Minas Gerais", value: "MG"},
    {nome: "Pará", value: "PA"},
    {nome: "Paraíba", value: "PB"},
    {nome: "Paraná", value: "PR"},
    {nome: "Pernambuco", value: "PE"},
    {nome: "Piauí", value: "PI"},
    {nome: "Rio de Janeiro", value: "RJ"},
    {nome: "Rio Grande do Norte", value: "RN"},
    {nome: "Rio Grande do Sul", value: "RS"},
    {nome: "Rondônia", value: "RO"},
    {nome: "Roraima", value: "RR"},
    {nome: "Santa Catarina", value: "SC"},
    {nome: "São Paulo", value: "SP"},
    {nome: "Sergipe", value: "SE"},
    {nome: "Tocantins", value: "TO"}
]
const cidades = ref([])
const modalidades = [
    {nome: 'Presencial', value: 1},
    {nome: 'Híbrido', value: 2},
    {nome: 'Remoto', value: 3},
]
const datas = [
    {nome: 'Últimas 24 horas', value: 1},
    {nome: 'Últimos 7 dias', value: 2},
    {nome: 'Últimos 30 dias', value: 3},
    {nome: 'Últimos 3 meses', value: 4},
]

async function getCidades(sigla) {
    try {
        const response = await fetch(route('get.cidades', { sigla }))
        const data = await response.json()
        cidades.value = Object.values(data)
    } catch (err) {
        console.error(err)
    }
}

const form = reactive({
    busca: '',
    modalidade: 0,
    data: 0,
    estado: '0',
    cidade_id: 0,
    page: 1
})

const emit = defineEmits(["submit"])

// TODO: Transformar tudo em uma só função
function updateModalidade(value) {
    form.modalidade = value
    emit("submit", form)
}

function updateData(value) {
    form.data = value
    emit("submit", form)
}

function updateEstado(value) {
    form.estado = value
    form.cidade_id = '0'
    emit("submit", form)
    getCidades(value)
}

function updateCidade(value) {
    form.cidade_id = value
    emit('submit', form)
}

function submitForm() {
    emit("submit", form)
}

</script>
<template>
    <form @submit.prevent="submitForm" id="formulario-busca-vaga">
        <!-- Input de busca -->
        <div class="flex justify-center">
            <div class="py-8 flex">
                <TextInput v-model="form.busca" type="text" placeholder="Ex: Desenvolvedor web" class="w-96 rounded-r-none px-4" ></TextInput>
                <PrimaryButton type="submit" class="px-4 py-4 rounded-l-none">Buscar vaga</PrimaryButton>
            </div>
        </div>
        <!-- Filtros de vaga -->
        <div class="border-b-2 border-t-2 py-4 flex justify-center">
            <SelectInput @change="updateEstado" :selected="form.estado" filter_name="estado" text="Estado" :options="estados"/>
            <SelectInput v-if="cidades.length > 0"  @change="updateCidade" :selected="form.cidade_id" filter_name="cidade" text="Cidade" :options="cidades"/>
            <SelectInput @change="updateModalidade" :selected="form.modalidade" filter_name="modalidade" text="Modalidade" :options="modalidades"/>
            <SelectInput @change="updateData" :selected="form.data" filter_name="data" text="Data de publicação" :options="datas"/>
        </div>
    </form>
</template>

<style scoped>
#input-field {
    width: 32rem;
}
</style>
