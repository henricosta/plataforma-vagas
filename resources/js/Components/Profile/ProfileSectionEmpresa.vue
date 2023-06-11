<script setup>
import Section from '../Section.vue';
import { Link, usePage } from '@inertiajs/vue3';

defineProps({
    nome: String,
})

const user = usePage().props.auth.user
</script>

<template>
    <Section>
        <div
            class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <img v-if="user.profile_image" :src="user.profile_image" alt="profile image">
            <svg v-else class="absolute w-full h-full text-gray-400 mt-12" fill="currentColor" viewBox="0 0 20 20"
                xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>
        <div class="flex items-center">
            <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{nome}}</div>
            <Link :href="route('empresa.edit')" class="ml-4 mb-2 py-2 px-3 rounded-md border bg-gray-200 shadow-sm text-sm hover:bg-gray-400">Editar informações</Link>
        </div>
    </Section>
</template>