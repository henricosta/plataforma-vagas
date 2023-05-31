<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import Section from '@/Components/Section.vue';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import {Head, router, useForm, usePage} from '@inertiajs/vue3';
import { onMounted, reactive, ref, watch, watchEffect } from 'vue';

const props = defineProps({
    success: {
        type: Boolean,
        default: false,
    }
})

const estados = [
    {"nome": "Acre", "sigla": "AC"},
    {"nome": "Alagoas", "sigla": "AL"},
    {"nome": "Amapá", "sigla": "AP"},
    {"nome": "Amazonas", "sigla": "AM"},
    {"nome": "Bahia", "sigla": "BA"},
    {"nome": "Ceará", "sigla": "CE"},
    {"nome": "Distrito Federal", "sigla": "DF"},
    {"nome": "Espírito Santo", "sigla": "ES"},
    {"nome": "Goiás", "sigla": "GO"},
    {"nome": "Maranhão", "sigla": "MA"},
    {"nome": "Mato Grosso", "sigla": "MT"},
    {"nome": "Mato Grosso do Sul", "sigla": "MS"},
    {"nome": "Minas Gerais", "sigla": "MG"},
    {"nome": "Pará", "sigla": "PA"},
    {"nome": "Paraíba", "sigla": "PB"},
    {"nome": "Paraná", "sigla": "PR"},
    {"nome": "Pernambuco", "sigla": "PE"},
    {"nome": "Piauí", "sigla": "PI"},
    {"nome": "Rio de Janeiro", "sigla": "RJ"},
    {"nome": "Rio Grande do Norte", "sigla": "RN"},
    {"nome": "Rio Grande do Sul", "sigla": "RS"},
    {"nome": "Rondônia", "sigla": "RO"},
    {"nome": "Roraima", "sigla": "RR"},
    {"nome": "Santa Catarina", "sigla": "SC"},
    {"nome": "São Paulo", "sigla": "SP"},
    {"nome": "Sergipe", "sigla": "SE"},
    {"nome": "Tocantins", "sigla": "TO"}

]

const state = reactive({
    cidades: []
})
const estado = ref('Estado')
const isCidadeDisabled = ref(true)
const isSuccessMessagingShowing = ref(false)

async function getCidades(sigla) {
    try {
        const response = await fetch(route('get.cidades', { sigla }))
        const data = await response.json()
        state.cidades = Object.values(data)
    } catch (err) {
        console.error(err)
    }
}

onMounted(() => {
    getCidades('CE')
    if (props.success) {
        isSuccessMessagingShowing.value = true
        setTimeout(() => {
          isSuccessMessagingShowing.value = false
        }, 3000);
    }
});

watch(estado, (newVal, oldVal) => {
    state.cidades = getCidades(estado.value);
    isCidadeDisabled.value = false
})

const form = useForm({
    titulo: '',
    descricao: '',
    modalidade: 0,
    cidade_id: 0,
    num_vagas: 0
})

function submit() {
    try {
        form.modalidade = Number(form.modalidade)
        form.num_vagas = Number(form.num_vagas)
        form.post(route('empresa.create.vaga'), {
            onFinish: () => form.reset(),
        })
    } catch (err) {
        console.log(err)
    }
}


</script>

<template>
    <Head title="Profile" />
    <AuthenticatedLayout>
        <div class="py-12">
            <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <Section titulo="Nova vaga">
                    <form @submit.prevent="submit" class="mt-2">
                        <div>
                            <InputLabel for="titulo" value="Titulo da vaga" />

                            <TextInput
                                id="titulo"
                                type="text"
                                class="mt-1 block w-full"
                                v-model="form.titulo"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.titulo" />
                        </div>
                        <div class="mt-3">
                            <InputLabel for="descricao" value="Descrição" />
                            <textarea v-model="form.descricao" id="descricao" rows="4" class="block p-2.5 w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escreva a descrição da vaga..."></textarea>
                            <InputError class="mt-2" :message="form.errors.descricao"/>
                        </div>
                        <div class="mt-4 w-2/5">
                            <div>
                                <select v-model="form.modalidade" id="modalidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0" selected disabled>Modalidade</option>
                                    <option value="1">Presencial</option>
                                    <option value="2">Híbrido</option>
                                    <option value="3">Remoto</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <select id="estado" v-model="estado" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option selected disabled>Estado</option>
                                    <option v-for="estado in estados" :value="estado.sigla" :key="estado.sigla">{{ estado.nome }}</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <select v-bind:disabled="isCidadeDisabled" v-model="form.cidade_id" id="cidade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="0" selected disabled>Cidade</option>
                                    <option v-for="cidade in state.cidades" :value="cidade.id" :key="cidade.id">{{ cidade.nome }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">
                            <InputLabel for="numero_vagas" value="Número de vagas" />

                            <TextInput
                                id="numero_vagas"
                                type="number"
                                class="mt-1 block w-40"
                                v-model="form.num_vagas"
                                required
                                autofocus
                                autocomplete="username"
                            />

                            <InputError class="mt-2" :message="form.errors.titulo" />
                        </div>
                        <div class="flex items-center justify-end mt-8">
                            <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Publicar vaga
                            </PrimaryButton>
                        </div>
                    </form>
                </Section>
            </div>
        </div>
        <div v-if="isSuccessMessagingShowing" id="mensagem-sucesso" class="top-2 p-6 border border-indigo-500 rounded-lg bg-white">
            <h1>Vaga adicionada com sucesso</h1>
        </div>
    </AuthenticatedLayout>
</template>

<style>
#mensagem-sucesso {
    position: fixed;
    left: 50%;
    transform: translate(-50%, 0);
}
</style>
