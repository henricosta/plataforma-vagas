<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';

// TODO: formatar input de CEP e CNPJ

const form = useForm({
    nome_titular: '',
    nome_empresa: '',
    cnpj: '',
    cep: '',
    email: '',
    telefone: '',
    num_funcionarios: 0,
    password: '',
    password_confirmation: '',
});

const telefoneInput = ref('')
const telefone = ref('');

function formatTelefone() {
    telefoneInput.value = telefone.value.replace(/\D/g, "")
    const rawNumber = telefone.value.replace(/\D/g, ""); // Remove non-digit characters
    let formattedNumber = "";

    if (rawNumber.length > 0) {
        formattedNumber = rawNumber
        
        if (rawNumber.length > 2) {
            formattedNumber = "(" + rawNumber.substring(0, 2) + ")"; // Add area code

            if (rawNumber.length > 2) {
                formattedNumber += " " + rawNumber.substring(2, 3); // Add first digit after area code

                if (rawNumber.length > 3) {
                    formattedNumber += "" + rawNumber.substring(3, 7); // Add first four digits

                    if (rawNumber.length > 7) {
                        formattedNumber += "-" + rawNumber.substring(7); // Add remaining digits
                    }
                }
            }
        }
    }

    telefone.value = formattedNumber;
}

const submit = () => {
    form.telefone = telefoneInput
    form.post(route('empresa.register'));
};

</script>

<template>
    <div class="bg-white px-6 py-4 shadow-md overflow-hidden rounded-lg w-1/2 mt-5">
        <div>
            <h1 class="text-3xl mb-6" id="titulo">Cadastre a sua empresa</h1>
        </div>
        <form @submit.prevent="submit">
            <!-- Nome da empresa -->
            <div>
                <InputLabel for="nome_titular" value="Seu nome completo" />

                <TextInput id="nome_titular" type="text" class="mt-1 block w-full" v-model="form.nome_titular" required
                    autofocus autocomplete="nome_titular" />

                <InputError class="mt-2" :message="form.errors.nome_titular" />
            </div>
            <!-- Nome do titular da empresa -->
            <div class="mt-4">
                <InputLabel for="nome_empresa" value="Nome da empresa" />

                <TextInput id="nome_empresa" type="text" class="mt-1 block w-full" v-model="form.nome_empresa" required
                    autofocus autocomplete="nome_empresa" />

                <InputError class="mt-2" :message="form.errors.nome_empresa" />
            </div>
            <!-- Agrupa os inputs de CNPJ e CEP e numero de funcionarios-->
            <div class="flex justify-between mt-4">
                <!-- CNPJ da empresa -->
                <div style="width: 35%;">
                    <InputLabel for="cnpj" value="CNPJ" />

                    <TextInput id="cnpj" type="text" class="mt-1 block w-full" v-model="form.cnpj" required autofocus
                        autocomplete="cnpj" />

                    <InputError class="mt-2" :message="form.errors.cnpj" />
                </div>
                <!-- CEP da empresa -->
                <div style="width: 25%;">
                    <InputLabel for="cep" value="CEP" />

                    <TextInput id="cep" type="text" class="mt-1 block w-full" v-model="form.cep" required autofocus
                        autocomplete="cep" />

                    <InputError class="mt-2" :message="form.errors.cep" />
                </div>
                <!-- Número de funcionarios da empresa -->
                <div style="width: 30%">
                    <InputLabel for="numero_funcionarios" value="Funcionários" />

                    <TextInput id="numero_vagas" type="number" class="mt-1 block w-full" v-model="form.num_funcionarios"
                        required autofocus autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.num_funcionarios" />
                </div>
            </div>
            <!-- Agrupa os inputs de Email, Telefone e Funcionarios -->
            <div class="flex justify-between mt-4">
                <!-- Email corporativo da empresa -->
                <div style="width: 60%;">
                    <InputLabel for="email" value="Email corporativo" />

                    <TextInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required
                        autocomplete="username" />

                    <InputError class="mt-2" :message="form.errors.email" />
                </div>
                <!-- Telefone -->
                <div style="width: 35%">
                    <InputLabel for="telefone" value="Telefone" />

                    <input
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 w-full"
                        type="text" id="telefone" placeholder="(99) 9999-9999" v-model="telefone"
                        @input="formatTelefone" 
                        @change="formatTelefone" />

                    <InputError class="mt-2" :message="form.errors.telefone" />
                </div>
            </div>
            <!-- Senha e confimação de senha -->
            <div class="mt-4">
                <InputLabel for="password" value="Senha" />

                <TextInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required
                    autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>
            <div class="mt-4">
                <InputLabel for="password_confirmation" value="Confirme a senha" />

                <TextInput id="password_confirmation" type="password" class="mt-1 block w-full"
                    v-model="form.password_confirmation" required autocomplete="new-password" />

                <InputError class="mt-2" :message="form.errors.password_confirmation" />
            </div>
            <!-- Botões -->
            <div class="flex items-center justify-end mt-4">
                <Link :href="route('empresa.login')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Já tem registro?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Registrar empresa
                </PrimaryButton>
            </div>
        </form>
    </div>
</template>

<style>
@import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@600&display=swap');

#titulo {
    font-family: 'Montserrat';
}
</style>