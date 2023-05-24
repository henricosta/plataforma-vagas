<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    status: {
        type: String,
    },
});
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
                        <div class="mb-3 text-4xl font-extrabold dark:text-white" >Nome completo</div>
                        <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                            <li>Email: asodfisdf@gmail.com</li>
                            <li>Telefone: (85)8567-4535</li>
                        </ul>
                    </div>
                </div>
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <h4 class="mb-2 text-lg font-semibold text-gray-900 dark:text-white">Competências</h4>
                    <ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                        <li>Docker</li>
                        <li>Github</li>
                        <li>Javascript</li>
                    </ul>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
