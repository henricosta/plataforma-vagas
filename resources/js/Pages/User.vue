<script setup>
import GuestLayout from "@/Layouts/GuestLayout.vue";
import Section from "@/Components/Section.vue";
import { onBeforeMount } from "vue";

const props = defineProps({
    user: Object
})

onBeforeMount(() => {
    console.log(props.user)
})

</script>

<template>
    <GuestLayout>
        <div class="py-12">
            <div class="flex justify-around">
                <!-- Informações do perfil -->
                <div class="pl-8 space-y-6 flex-grow mr-8">
                    <Section>
                        <div class="mb-8 relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
                            <img v-if="user.profile_image" :src="user.profile_image" alt="" srcset="">
                            <svg v-else class="absolute w-full h-full text-gray-400 mt-12" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </div>
                        <div>
                            <div class="flex items-center">
                                <div class="mb-3 text-4xl font-extrabold dark:text-white" >{{ user.nome_completo }}</div>
                                <Link :href="route('profile.edit')" class="ml-4 mb-2 py-2 px-3 rounded-md border bg-gray-200 shadow-sm text-sm hover:bg-gray-400">Editar perfil</Link>
                            </div>
                            <ul class="max-w-md space-y-1 text-gray-500 list-none list-inside dark:text-gray-400">
                                <li>Email: {{ user.email }}</li>
                                <li v-if="user.telefone" >Telefone: {{ user.telefone }}</li>
                            </ul>
                        </div>
                    </Section>
                    <Section>
                        <div>
                            <h4 class="inline-block mb-2 text-lg font-semibold text-gray-900 dark:text-white">Competências</h4>
                        </div>
                        <div>
                            <ul v-if="props.competencias" class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">
                                <li v-for="c in props.competencias" style="text-transform: capitalize">{{c.competencia}}</li>
                            </ul>
                            <div v-else class="text-gray-500">Você ainda não adicionou nenhuma competência</div>
                        </div>
                    </Section>
                </div>
            </div>
        </div>
    </GuestLayout>
</template>
