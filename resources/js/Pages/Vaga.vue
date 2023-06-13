<script setup>
import PageVaga from '@/Components/Vagas/PageVaga.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import Section from '@/Components/Section.vue';
import SmallVagaCard from '@/Components/SmallVagaCard.vue';
import { onMounted, ref } from 'vue';
import Columnlayout from '@/Layouts/Columnlayout.vue';
import UserLayout from "@/Layouts/UserLayout.vue";
import EmpresaLayout from "@/Layouts/EmpresaLayout.vue";
import RightColumn from '@/Components/RightColumn.vue';

const props = defineProps({
    vaga: Object,
    guard: String,
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
    <UserLayout v-if="props.guard === 'web'">
        <Columnlayout>
            <template #esquerda>
                <PageVaga :vaga="props.vaga" />
            </template>
            <template #direita>
                <RightColumn>
                    <h1 class="text-2xl">Vagas dessa empresa em aberto.</h1>
                    <hr class="mt-2 mb-3">
                    <SmallVagaCard v-if="vagas.length > 0" v-for="v in vagas" :id="v.id" :titulo="v.titulo"
                        :descricao="v.descricao" :nome_empresa="v.empresa.nome_empresa" :cidade="v.cidade.nome"
                        :modalidade="v.modalidade" />
                </RightColumn>
            </template>
        </Columnlayout>
    </UserLayout>
    <EmpresaLayout v-else-if="props.guard === 'empresa'">
        <Columnlayout>
            <template #esquerda>
                <PageVaga :vaga="props.vaga" />
            </template>
            <template #direita>
                <RightColumn>
                    <h1 class="text-2xl">Vagas dessa empresa em aberto.</h1>
                    <hr class="mt-2 mb-3">
                    <SmallVagaCard v-if="vagas.length > 0" v-for="v in vagas" :id="v.id" :titulo="v.titulo"
                        :descricao="v.descricao" :nome_empresa="v.empresa.nome_empresa" :cidade="v.cidade.nome"
                        :modalidade="v.modalidade" />
                </RightColumn>
            </template>
        </Columnlayout>
    </EmpresaLayout>
    <GuestLayout v-else>
        <Columnlayout>
            <template #esquerda>
                <PageVaga :vaga="props.vaga" />
            </template>
            <template #direita>
                <RightColumn>
                    <h1 class="text-2xl">Vagas dessa empresa em aberto.</h1>
                    <hr class="mt-2 mb-3">
                    <SmallVagaCard v-if="vagas.length > 0" v-for="v in vagas" :id="v.id" :titulo="v.titulo"
                        :descricao="v.descricao" :nome_empresa="v.empresa.nome_empresa" :cidade="v.cidade.nome"
                        :modalidade="v.modalidade" />
                </RightColumn>
            </template>
        </Columnlayout>
    </GuestLayout>
</template>

<style></style>
