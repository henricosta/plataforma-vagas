<script setup>
import PageVaga from '@/Components/Vagas/PageVaga.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Section from '@/Components/Section.vue';
import SmallVagaCard from '@/Components/SmallVagaCard.vue';
import { onMounted, ref } from 'vue';

const props = defineProps({
    vaga: Object
})

const vagas = ref([])

onMounted(() => {
    axios.get(route('empresa.vagas', { id: props.vaga.empresa_id }))
    .then(res => {
        vagas.value = res.data
        console.log(vagas.value)
    }).catch(err => {
        console.log(err)
    })
})

</script>

<template>
    <GuestLayout>
        <div class="flex justify-around mt-8">
            <PageVaga class="pl-8 space-y-6 flex-grow mr-8" :vaga="props.vaga" />
            <Section class="mr-8 mt-3 mb-3">
                <h1 class="text-2xl">Vagas dessa empresa em aberto.</h1>
                <hr class="mt-2 mb-3">
                <SmallVagaCard v-if="vagas.length > 0" v-for="v in vagas"
                    :id="v.id"
                    :titulo="v.titulo"
                    :descricao="v.descricao"
                    :nome_empresa="v.empresa.nome_empresa"
                    :cidade="v.cidade.nome"
                    :modalidade="v.modalidade"
                />
            </Section>
        </div>
    </GuestLayout>
</template>

<style>

</style>
