<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import Section from '@/Components/Section.vue';
import EmpresaLayout from '@/Layouts/EmpresaLayout.vue';
import { onMounted, ref } from 'vue';
import SmallProfileCard from '@/Components/SmallProfileCard.vue';

const props = defineProps({
    vaga: Object
})

const form = useForm({
    titulo: props.vaga.titulo,
    descricao: props.vaga.descricao,
    num_vagas: props.vaga.num_vagas,
    modalidade: props.vaga.modalidade,
    estado: props.vaga.cidade.uf,
    cidade: props.vaga.cidade.nome,
});

function submit() {
    form.post(route('vaga.update'))
}

onMounted(() => {
    console.log(props.vaga)
})

</script>

<template>
    <EmpresaLayout>
        <div class="py-12">
            <div class="flex justify-around">
                <div class="pl-8 space-y-6 flex-grow mr-8">
                    <Section titulo="Informações da vaga">
                        <form @submit.prevent="submit" class="mt-6 space-y-6">
                            <div>
                                <InputLabel for="titulo" value="Titulo da vaga" />
                
                                <TextInput
                                    id="titulo"
                                    type="text"
                                    class="mt-1 block w-full"
                                    v-model="form.titulo"
                                    required
                                    autofocus
                                    autocomplete="name"
                                />
                
                                <InputError class="mt-2" :message="form.errors.nome_empresa" />
                            </div>
                
                            <div class="mt-3">
                                <InputLabel for="descricao" value="Descrição da vaga" />
                                <textarea v-model="form.descricao" id="descricao" rows="4" class="block p-2.5 w-full text-sm border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" placeholder="Escreva uma breve descrição da empresa."></textarea>
                                <InputError class="mt-2" :message="form.errors.descricao"/>
                            </div>
                
                            <div class="flex items-center gap-4">
                                <PrimaryButton :disabled="form.processing">Atualizar vaga</PrimaryButton>
                
                                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                                </Transition>
                            </div>
                        </form>
                    </Section>
                </div>
                <Section titulo="Candidatos" class="mr-8">
                    <hr class="mt-2 mb-3">
                    <SmallProfileCard v-if="props.vaga.candidatos.length > 0" v-for="c in props.vaga.candidatos" :user="c"></SmallProfileCard>
                    <p v-else class="text-gray-600" >Ainda não existem candidatos para a vaga.</p>
                </Section>
            </div>
        </div>
    </EmpresaLayout>
</template>
