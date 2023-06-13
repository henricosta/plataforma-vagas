<script setup>
import EmpresaLayout from '@/Layouts/EmpresaLayout.vue';
import Section from '@/Components/Section.vue';
import SmallProfileCard from '@/Components/SmallProfileCard.vue';
import { Link } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps({
    vagas: Array
})

onMounted(() => {
    console.log(props.vagas)
})

function formatDate(dateString) {
    const options = {
    day: 'numeric',
    month: 'numeric',
    year: '2-digit'
    };
    const date = new Date(dateString);
    return date.toLocaleDateString(undefined, options);
}

function formatModalidade(value) {
  return value === 1 ? 'Presencial' : value === 2 ? 'Híbrido' : 'Remoto';
}

</script>

<template>
    <EmpresaLayout>
        <div class="pb-8">
            <div v-if="props.vagas.length > 0" v-for="v in props.vagas" class="mt-8 mx-8">
                <Section>
                    <div class="flex items-center">
                        <h1 class="text-2xl">{{ v.titulo }} ({{ formatModalidade(v.modalidade) }})</h1>
                        <a :href="route('vaga.edit', { id: v.id })">
                            <button class="bg-gray-800 text-white rounded-lg px-3 py-2 ml-2 text-sm hover:bg-gray-600" >Editar vaga</button>
                        </a>
                    </div>
                    <p class="text-gray-600">Publicada em {{ formatDate(v.created_at) }}</p>
                    <hr class="my-3">
                    <div class="grid grid-cols-3 max-h-96 overflow-auto">
                        <SmallProfileCard v-if="v.candidatos.length > 0" v-for="c in v.candidatos" :user="c" />
                        <p v-else class="text-sm">Nenhum candidato</p>
                    </div>
                </Section>
            </div>
            <div v-else class="mx-8 flex justify-center">
                <Section class="w-1/2 text-center">
                    <h1 class="text-xl">A empresa não tem nenhuma vaga publicada.</h1>
                </Section>
            </div>
        </div>
    </EmpresaLayout>
</template>

<style>

</style>
