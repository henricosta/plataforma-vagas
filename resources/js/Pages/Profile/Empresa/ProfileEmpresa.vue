<script setup>
import Section from '@/Components/Section.vue';
import { Link, usePage } from '@inertiajs/vue3'
import { Head } from '@inertiajs/vue3';
import EmpresaLayout from "@/Layouts/EmpresaLayout.vue";

defineProps({
    nome: String,
    vagas: Array
})

const empresa = usePage().props.auth.user

</script>

<template>
    <Head title="Profile" />

    <EmpresaLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <Section>
                    <div
                        class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                        <img v-if="empresa.profile_image" :src="empresa.profile_image" alt="profile image">
                        <svg v-else class="absolute w-full h-full text-gray-400 mt-12" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="flex items-center">
                        <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{ empresa.nome_empresa }}</div>
                        <Link :href="route('empresa.edit')" class="ml-4 mb-2 py-2 px-3 rounded-md border bg-gray-200 shadow-sm text-sm hover:bg-gray-400">Editar informações</Link>
                    </div>
                </Section>
                <Section titulo="Sobre">
                    <p v-if="empresa.descricao" class="text-gray-600">{{ empresa.descricao }}</p>
                    <p v-else class="text-gray-600">A empresa ainda não possui uma descrição...</p>
                </Section>
                <Section titulo="Informações">
                    <p><strong>Email:</strong> {{ empresa.email }}</p>
                    <p><strong>Telefone:</strong> {{ empresa.telefone }}</p>
                    <p><strong>CNPJ:</strong> {{ empresa.cnpj }}</p>
                    <p><strong>CEP:</strong> {{ empresa.cep }}</p>
                </Section>
                <Section>
                    <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Vagas abertas</h4>

                    <Link :href="route('empresa.create.vaga')">
                        <button id="adicionar-vaga" class="ml-3 text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-full text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Adicionar vaga</button>
                    </Link>
                    <div v-if="vagas.length < 1">
                        <p class="text-gray-600">A empresa não possui nenhuma vaga publicada</p>
                    </div>
                </Section>
                <Section>
                    <Link :href="route('empresa.logout')" method="post" as="button">
                        <button class="bg-gray-800 rounded-md text-white px-3 py-2">Logout</button>
                    </Link>
                </Section>
            </div>
        </div>
    </EmpresaLayout>
</template>

<style>

</style>
