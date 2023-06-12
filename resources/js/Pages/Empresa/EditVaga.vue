<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import EmpresaLayout from '@/Layouts/EmpresaLayout.vue';
import { onMounted, ref } from 'vue';
import SmallProfileCard from '@/Components/SmallProfileCard.vue';
import axios from 'axios';

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

const empresa = usePage().props.auth.user

const props = defineProps({
    vaga: Object
})

const cidades = ref([]);

const form = useForm({
    id: props.vaga.id,
    empresa_id: empresa.id,
    titulo: props.vaga.titulo,
    descricao: props.vaga.descricao,
    num_vagas: props.vaga.num_vagas,
    modalidade: props.vaga.modalidade,
    estado: props.vaga.cidade.uf,
    cidade_id: props.vaga.cidade.id,
});

function submit() {
    form.post(route('vaga.update', { id: form.id }))
}

onMounted(() => {
    getCidades()
})

function getCidades() {
    axios.get(route('get.cidades', { uf: form.estado })).then(res => {
        cidades.value = res.data
    }).catch(err => {
        console.log(err.message)
    })
}

</script>

<template>
    <EmpresaLayout>
        <div class="py-12">
            <div class="flex justify-around">
                <div class="pl-8 space-y-6 flex-grow mr-8">
                    <Section titulo="Informações da vaga">
                        <form @submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="titulo" value="Titulo da vaga" />
                
                                <TextInput
                                    id="titulo"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.titulo"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                
                                <InputError class="mt-2" :message="form.errors.nome_empresa" />
                            </div>
                
                            <div class="mt-3">
                                <InputLabel for="descricao" value="Descrição da vaga" />
                                <textarea v-model="form.descricao" id="descricao" rows="4" class="block p-2.5 w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escreva uma breve descrição da empresa."></textarea>
                                <InputError class="mt-2" :message="form.errors.descricao"/>
                            </div>
                            
                            <div>
                                <InputLabel for="modalidae" value="Modalidade" />
                                <select v-model="form.modalidade" id="modalidade" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-purple-900 focus:border-purple-900 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option value="1">Presencial</option>
                                    <option value="2">Híbrido</option>
                                    <option value="3">Remoto</option>
                                </select>
                            </div>

                            <!-- Estado e cidade -->
                            <div class="mt-3">
                                <InputLabel for="estado" value="Estado" />
                                <select @change="getCidades" id="estado" v-model="form.estado" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="estado in estados" :value="estado.sigla" :key="estado.sigla">{{ estado.nome }}</option>
                                </select>
                            </div>
                            <div class="mt-4">
                                <InputLabel for="cidade" value="Cidade" />
                                <select v-bind:disabled="cidades.length == 0" v-model="form.cidade_id" id="cidade" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option v-for="c in cidades" :value="c.id" :key="c.id">{{ c.nome }}</option>
                                </select>
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

                                <InputError class="mt-2" :message="form.errors.num_vagas" />
                            </div>

                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Atualizar vaga</PrimaryButton>
                
                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                                </Transition>
                            </div>
                        </form>
                    </Section>
                </div>
                <Section titulo="Candidatos" class="mr-8">
                    <hr class="mt-2 mb-3">
                    <SmallProfileCard v-if="props.vaga.candidatos.length > 0" v-for="c in props.vaga.candidatos" :user="c"></SmallProfileCard>
                    <p v-else class="text-gray-600" >Ainda não existem candidatos para a vaga.</p>
                </Section>
            </div>
        </div>
    </EmpresaLayout>
</template>
