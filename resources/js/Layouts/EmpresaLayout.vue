<script setup>
import EmpresaHeader from '@/Components/EmpresaHeader.vue';
import { usePage } from '@inertiajs/vue3';

const empresa = usePage().props.auth.user

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <EmpresaHeader :profile_image="empresa.profile_image"/>
        <slot></slot>
    </div>
</template>
