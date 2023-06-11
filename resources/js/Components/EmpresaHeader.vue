<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    profile_image: String,
})

</script>

<template>
    <header>
        <nav class="bg-white border-b border-gray-100">
            <div class="flex flex-wrap justify-between text-gray-800 h-16">
                <div class="flex">
                    <!-- Logo -->
                    <div class="flex shrink-0 items-center mx-10">
                        <Link href="/" class="text-gray-900">
                        HOME
                        </Link>
                    </div>
                    <!-- Navigation Links -->
                    <div class="flex items-center">
                        <Link href="/" class="px-2">Vagas abertas</Link>
                    </div>
                </div>
                <!-- Botões da direita -->
                <div class="flex items-center mr-8">
                    <div>
                        <Link href="/empresa/profile">
                            <div v-if="props.profile_image" class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <img :src="props.profile_image" alt="profile image">
                            </div>
                            <div v-else class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                                <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>

                        </Link>
                    </div>
                </div>
            </div>
        </nav>
    </header>
</template>

<style scoped></style>
