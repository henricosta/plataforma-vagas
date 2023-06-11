<script setup>
import DeleteUserForm from './Partials/DeleteUserForm.vue';
import UpdatePasswordForm from './Partials/UpdatePasswordForm.vue';
import { Head } from '@inertiajs/vue3';
// TODO: Usar empresa layout
import GuestLayout from '@/Layouts/GuestLayout.vue';
import UpdateEmpresaInformationForm from './Partials/UpdateEmpresaInformationForm.vue';
import DeleteEmpresaForm from './Partials/DeleteEmpresaForm.vue'
import UpdateEmpresaPassword from './Partials/UpdateEmpresaPasswordForm.vue'

</script>

<template>
    <Head title="Profile" />
    <GuestLayout>
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
    </GuestLayout>
</template>
