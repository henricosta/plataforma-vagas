<script setup>
import {Head, useForm, usePage} from '@inertiajs/vue3';
import { onMounted, ref } from "vue";
import { Link } from '@inertiajs/vue3';
import UserLayout from "@/Layouts/UserLayout.vue";
import Section from '@/Components/Section.vue';
import SmallVagaCard from '@/Components/SmallVagaCard.vue'
import RightColumn from '@/Components/RightColumn.vue';
import FormacaoItem from '@/Components/FormacaoItem.vue'
import Modal from '@/Components/Modal.vue';
import InputLabel from '@/Components/InputLabel.vue';

const props = defineProps({ 
    vagas: Array,
    competencias: Array,
    formacoes: Array
})

const user = usePage().props.auth.user

const competenciaForm = useForm({
    competencia: ''
})
const formacaoForm = useForm({
    id: '',
    instituicao: '',
    diploma: '',
    area: '',
    inicio: '',
    termino: '',
    descricao: ''
})

const deleteButton = ref(false)
const competenciaModal = ref(false)
const formacaoModal = ref(false)

const showFormacaoModal = (f) => {
    if (!f) {
        deleteButton.value = false

        formacaoForm.instituicao = ''
        formacaoForm.diploma = ''
        formacaoForm.area = ''
        formacaoForm.inicio = ''
        formacaoForm.termino = ''
        formacaoForm.descricao = ''

        formacaoModal.value = true
    } else {
        deleteButton.value = true

        formacaoForm.id = f.id
        formacaoForm.instituicao = f.instituicao
        formacaoForm.diploma = f.diploma
        formacaoForm.area = f.area
        formacaoForm.inicio = f.inicio
        formacaoForm.termino = f.termino
        formacaoForm.descricao = f.descricao
    
        formacaoModal.value = true
    }
}

const submitCompetencia = () => {
    competenciaModal.value = false
    competenciaForm.post(route('competencia.create'));
};
const submitFormacao = () => {
    formacaoModal.value = false
    console.log(deleteButton.value)
    if(deleteButton.value) {
        formacaoForm.post(route('formacao.edit'));
    } else {
        formacaoForm.post(route('formacao.create'));
    }
}

</script>

<template>
    <UserLayout>
        <div class="py-12">
            <div class="flex justify-around">
                <!-- Informações do perfil -->
                <div class="pl-8 space-y-6 flex-grow mr-8">
                    <Section>
                        <div class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <img v-if="user.profile_image" :src="user.profile_image" alt="" srcset="">
                            <svg v-else class="absolute w-full h-full text-gray-400 mt-12" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{ user.nome_completo }}</div>
                                <Link :href="route('profile.edit')" class="ml-4 mb-2 py-2 px-3 rounded-md border bg-gray-200 shadow-sm text-sm hover:bg-gray-400">Editar perfil</Link>
                            </div>
                            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                                <li>Email: {{ user.email }}</li>
                                <li v-if="user.telefone" >Telefone: {{ user.telefone }}</li>
                            </ul>
                        </div>
                    </Section>
                    <!-- Competencias -->
                    <Section>
                        <div>
                            <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Competências</h4>
                            <button @click="() => competenciaModal = true" id="adicionar-competencia" type="button" class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Adicionar competência</button>
                        </div>
                        <div>
                            <ul v-if="props.competencias.length > 0" class="space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                <li v-for="c in props.competencias" class="hover:bg-gray-100 flex items-center justify-between py-1 px-3 rounded-lg w-full" style="text-transform: capitalize">
                                    <p>{{ c.competencia }}</p>
                                    <Link :href="route('competencia.delete', { id: c.id })" as="button" method="delete">
                                        <button class="border py-1 px-3 rounded-lg hover:bg-red-600 hover:text-white">Deletar</button>
                                    </Link>
                                </li>
                            </ul>
                            <div v-else class="text-gray-500">Você ainda não adicionou nenhuma competência</div>
                        </div>
                    </Section>
                    <!-- Formações -->
                    <Section>
                        <div>
                            <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Formações</h4>
                            <button @click="() => showFormacaoModal()" id="adicionar-formacao" type="button" class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Adicionar formação</button>
                        </div>
                        <div>
                            <div v-if="props.formacoes.length > 0">
                                <FormacaoItem v-for="f in props.formacoes" :formacao="f">
                                    <button @click="() => showFormacaoModal(f)" class="px-3 py-1 text-sm bg-gray-300 rounded-md hover:bg-gray-400">Editar</button>
                                </FormacaoItem>
                            </div>
                            <div v-else class="text-gray-500">Você ainda não adicionou nenhuma formação.</div>
                        </div>
                    </Section>
                    <Section>
                        <Link :href="route('logout')" method="post" as="button">
                            <button class="bg-gray-800 rounded-md text-white px-3 py-2">Logout</button>
                        </Link>
                    </Section> 
                </div>
                
                <div>
                    <RightColumn class="mr-8">
                        <div class="max-h-screen overflow-auto">
                            <h1 class="text-2xl">Minhas vagas</h1>
                            <hr class="mt-2 mb-3">
                            <SmallVagaCard v-if="props.vagas.length > 0" v-for="vaga in vagas"
                                :id="vaga.id"
                                :titulo="vaga.titulo"
                                :descricao="vaga.descricao"
                                :nome_empresa="vaga.empresa.nome_empresa"
                                :cidade="vaga.cidade.nome"
                                :modalidade="vaga.modalidade"
                            />
                        </div>
                    </RightColumn>
                </div>
            </div>
        </div>
    </UserLayout>
    <Modal :show="formacaoModal">
        <form class="p-4" @submit.prevent="submitFormacao" method="POST">
            <div class="flex justify-between items-center mb-3">
                <p class="text-lg"><strong>Formação</strong></p>
                <button type="button" @click="() => formacaoModal = false" class="shadow-md rounded-md px-3 py-1 text-white bg-red-600">Fechar</button>
            </div>
            <InputLabel value="Instituição de ensino"/>
            <input type="text" class="w-full border rounded-md" placeholder="Ex: Universidade federal do rio de janeiro" v-model="formacaoForm.instituicao">
            
            <InputLabel value="Diploma" class="mt-2"/>
            <input type="text" class="w-full border rounded-md" placeholder="Ex: Bacharelado" v-model="formacaoForm.diploma">

            <InputLabel class="mt-2" value="Area"/>
            <input type="text" class="w-full border rounded-md" placeholder="Ex: Administração" v-model="formacaoForm.area">

            <InputLabel class="mt-2" value="Data de início"/>
            <input type="date" class="w-full border rounded-md" v-model="formacaoForm.inicio">

            <InputLabel class="mt-2" value="Data de término (ou previsão)"/>
            <input type="date" class="w-full border rounded-md" v-model="formacaoForm.termino">

            <InputLabel class="mt-2" value="Descrição"/>
            <textarea type="text" class="w-full border rounded-md" placeholder="Ex: Excel" v-model="formacaoForm.descricao"></textarea>

            <div class="flex justify-between">
                <button type="submit" class="rounded-lg bg-gray-800 text-white mt-3 px-3 py-2">
                    Salvar
                </button>

                <Link :href="route('formacao.delete', { id: formacaoForm.id })" method="delete" as="button">
                    <button v-if="deleteButton" @click="() => formacaoModal = false" type="button" class="rounded-lg bg-gray-600 text-white mt-3 px-3 py-2">
                        Deletar
                    </button>
                </Link>
            </div>
        </form>
    </Modal>
    <Modal :show="competenciaModal">
        <form class="p-4" @submit.prevent="submitCompetencia" method="POST">
            <div class="flex justify-between items-center mb-3">
                <p class="text-lg"><strong>Competência</strong></p>
                <button @click="() => competenciaModal = false" type="button" class="shadow-md rounded-md px-3 py-1 text-white bg-red-600">Fechar</button>
            </div>
            <input id="competencia-input" type="text" class="w-full border rounded-md" placeholder="Ex: Excel" v-model="competenciaForm.competencia">
            <button type="submit" class="rounded-lg bg-gray-800 text-white mt-3 px-3 py-2">
                Adicionar competência
            </button>
        </form>
    </Modal>
</template>

<style>

</style>
