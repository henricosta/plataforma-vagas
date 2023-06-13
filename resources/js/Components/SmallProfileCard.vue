<script setup>
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    user: Object
})

function truncate(str, maximum_length) {
    if (str.length > maximum_length) {
        return str.slice(0, maximum_length) + '...'
    }
    return str
}
</script>

<template>
    <Link :href="route('get.user', props.user.id)">
        <div class="flex items-center w-96 h-24 mb-3 border rounded-md shadow-sm p-4 cursor-pointer hover:bg-gray-50">
            <div>
                <div v-if="props.user.profile_image" class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <img :src="props.user.profile_image" alt="profile image">
                </div>
                <div v-else class="relative w-10 h-10 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                    <svg class="absolute w-12 h-12 text-gray-400 -left-1" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>
            <div class="ml-4">
                <h1 class="text-lg"><strong>{{ truncate(props.user.nome_completo, 40) }}</strong></h1>
                <p class="text-sm text-gray-600">{{ truncate(props.user.email, 30) }}</p>
            </div>
        </div>
    </Link>
</template>

<style scoped>

</style>
