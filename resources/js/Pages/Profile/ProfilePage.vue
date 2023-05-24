<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import {reactive, ref} from "vue";

interface User {
    id: number,
    nome_completo: string,
    email: string,
    telefone?: string,
    competencias?: string[]
}

defineProps<{
    status: string,
    user: User
}>()
//TODO: Add modal
const competenciaForm = reactive({
    novaCompetencia: ''
})

const isModalOpen = ref(false)

function openCloseModal() {
    isModalOpen.value = !isModalOpen
}

</script>

<template>
    <Head title="Profile" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Perfil</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <span class="font-medium text-gray-600 dark:text-gray-300">JL</span>
                    </div>
                    <div>
                        <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{user.nome_completo}}</div>
                        <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                            <li>Email: {{user.email}}</li>
                            <li v-if="user.telefone" >Telefone: {{user.telefone}}</li>
                        </ul>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <div>
                        <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Competências</h4>
                        <button id="adicionar-competencia" type="button" class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Adicionar competência</button>
                    </div>
                    <div>
                        <ul v-if="user.competencias?.length" class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                            <li v-for="competencia in user.competencias">{{competencia}}</li>
                        </ul>
                        <div v-else class="text-gray-500">Você ainda não adicionou nenhuma competência</div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
    <div id="modal-adicionar-competencia" class="flex justify-center items-center fixed z-10 left-0 top-0 w-full h-full bg-gray-900 bg-opacity-5">
        <div id="modal-adicionar-competencia-content" class="bg-white w-96 inline-block align-middle">
            <form class="p-4">
                <div class="flex justify-end">
                    <button class="block">Fechar</button>
                </div>
                <label for="competencia-input" class="text-gray-500">Nova Competência</label>
                <input id="competencia-input" type="text" class="w-full border rounded-lg" placeholder="Ex: Excel" :value="competenciaForm.novaCompetencia">
                <button class="mt-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Adicionar competência
                </button>
            </form>
        </div>
    </div>
</template>

<style>

</style>