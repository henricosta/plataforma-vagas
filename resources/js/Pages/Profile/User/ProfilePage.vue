<script setup>
import {Head, useForm, usePage} from '@inertiajs/vue3';
import { ref } from "vue";
import { Link } from '@inertiajs/vue3';
import UserLayout from "@/Layouts/UserLayout.vue";
import Section from '@/Components/Section.vue';
import SmallVagaCard from '@/Components/SmallVagaCard.vue'

// TODO: Criar componente para modal
const props = defineProps({
    competencias: Array,
    vagas: Array
})

const user = usePage().props.auth.user

const competenciaForm = useForm({
    competencia: ''
})

const submitCompetencia = () => {
    competenciaForm.post(route('competencia.create'));
};

const isModalOpen = ref(false)

function openModal() {
    isModalOpen.value = true
}

function closeModal(){
    isModalOpen.value = false
}

function closeModalOutside(event) {
    if (event.target == document.getElementById('modal-adicionar-competencia')) {
        closeModal()
    }
}

</script>

<template>
    <Head title="Profile" />

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
                    <Section>
                        <div>
                            <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Competências</h4>
                            <button @click="openModal" id="adicionar-competencia" type="button" class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Adicionar competência</button>
                        </div>
                        <div>
                            <ul v-if="props.competencias.length > 0" class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                <li v-for="c in props.competencias" style="text-transform: capitalize">{{c.competencia}}</li>
                            </ul>
                            <div v-else class="text-gray-500">Você ainda não adicionou nenhuma competência</div>
                        </div>
                    </Section>
                    <Section>
                        <Link :href="route('logout')" method="post" as="button">
                            <button class="bg-gray-800 rounded-md text-white px-3 py-2">Logout</button>
                        </Link>
                    </Section>
                </div>
                <!-- Lista de vagas -->
                <Section class="mr-8">
                    <h1 class="text-2xl">Minhas vagas</h1>
                    <hr class="mt-2 mb-3">
                    <SmallVagaCard v-if="props.vagas.length > 0" v-for="vaga in vagas"
                        :titulo="vaga.titulo"
                        :descricao="vaga.descricao"
                        :nome_empresa="vaga.empresa.nome_empresa"
                        :cidade="vaga.cidade.nome"
                        :modalidade="vaga.modalidade"
                    />
                </Section>
            </div>
        </div>
    </UserLayout>
    <div v-show="isModalOpen" @click="closeModalOutside">
        <div id="modal-adicionar-competencia" class="flex justify-center items-center fixed z-10 left-0 top-0 w-full h-full bg-gray-900 bg-opacity-50">
            <div id="modal-adicionar-competencia-content" class="bg-white w-96 inline-block align-middle rounded-2xl shadow-2xl">
                <form class="p-4" @submit.prevent="submitCompetencia">
                    <div class="flex justify-end">
                        <button @click="closeModal" class="block text-red-600">Fechar</button>
                    </div>
                    <label for="competencia-input" class="text-gray-500">Nova Competência</label>
                    <input id="competencia-input" type="text" class="w-full border rounded-lg" placeholder="Ex: Excel" v-model="competenciaForm.competencia">
                    <button class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Adicionar competência
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<style>

</style>
