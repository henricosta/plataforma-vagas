<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ProfileSectionEmpresa from '@/Components/Profile/ProfileSectionEmpresa.vue';
import Section from '@/Components/Section.vue';
import { Link, usePage } from '@inertiajs/vue3'
import {Head, useForm} from '@inertiajs/vue3';
import {reactive, ref} from "vue";
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
                <ProfileSectionEmpresa :nome="empresa.nome_empresa"></ProfileSectionEmpresa>
                <Section titulo="Sobre">
                    <p v-if="!empresa.descricao" class="text-gray-600">A empresa ainda não possui uma descrição...</p>
                    <p v-else class="text-gray-600">{{ empresa.descricao }}</p>
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
            </div>
        </div>
    </EmpresaLayout>
</template>

<style>

</style>
