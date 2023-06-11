<script setup>
import { Head } from '@inertiajs/vue3';
import UpdateEmpresaInformationForm from '../Partials/UpdateEmpresaInformationForm.vue';
import DeleteEmpresaForm from '../Partials/DeleteEmpresaForm.vue'
import UpdateEmpresaPassword from '../Partials/UpdateEmpresaPasswordForm.vue'
import EmpresaLayout from "@/Layouts/EmpresaLayout.vue";

</script>

<template>
    <Head title="Profile" />
    <EmpresaLayout>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateEmpresaInformationForm class="max-w-xl"/>
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <UpdateEmpresaPassword class="max-w-xl" />
                </div>

                <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                    <DeleteEmpresaForm class="max-w-xl" />
                </div>
            </div>
        </div>
    </EmpresaLayout>
</template>
