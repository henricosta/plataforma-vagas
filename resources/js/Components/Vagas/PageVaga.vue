<script setup>
import PrimaryButton from '../PrimaryButton.vue';

defineProps({
    vaga: Object,
})

// TODO: Implementar função
const candidatar = () => {

}
</script>

<template>
    <div>
        <div class="bg-white shadow mx-6 my-3 border rounded-lg">
            <div class="m-14">
                <h2 class="text-3xl mb-2">{{ vaga.titulo }}</h2>
                <p class="text-gray-800">{{ vaga.empresa.nome }} - {{ vaga.nome_cidade }} ({{ modalidade == 1 ? 'Presencial' :
                    modalidade == 2 ? 'Híbrido' : 'Remoto' }})</p>
                <PrimaryButton class="px-2 py-3 mt-4">Candidatar-se</PrimaryButton>
                <p class="mt-5"><strong>Descrição da vaga</strong></p>
                <hr class="my-1">
                <p>{{ vaga.descricao }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
