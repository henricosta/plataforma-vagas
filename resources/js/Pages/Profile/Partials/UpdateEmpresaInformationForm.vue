<script setup>
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { ref } from 'vue';

const empresa = usePage().props.auth.user;

const form = useForm({
    profile_image: empresa.profile_image || null,
    nome_empresa: empresa.nome_empresa,
    email: empresa.email,
    telefone: empresa.telefone,
    cnpj: empresa.cnpj,
    cep: empresa.cep,
    nome_titular: empresa.nome_titular
});

const profileImageUrl = ref(form.profile_image)

function onImageChange(event) {
    const file = event.target.files[0]
    form.profile_image = file

    if(file) {
        profileImageUrl.value = URL.createObjectURL(file)
    } else {
        profileImageUrl.value = ''
    }
}

function submit() {
    console.log(form.profile_image)
    form.post(route('empresa.update'))
}

</script>

<template>
    <section>
        <div class="relative inline-flex items-center justify-center w-60 h-60 overflow-hidden bg-gray-100 rounded-full dark:bg-gray-600">
            <img v-if="form.profile_image" :src="profileImageUrl" alt="profile image">
            <span v-elses class="font-medium text-gray-600 dark:text-gray-300">JL</span>
        </div>
        <form @submit.prevent="submit" class="mt-6 space-y-6">
            <div>
                <label for="profile_image" class="block text-sm font-medium text-gray-700">Atualizar imagem de perfil da empresa</label>
                <input
                type="file"
                id="profile_image"
                accept="image/*"
                @change="onImageChange"
                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                >
            </div>
            <div>
                <InputLabel for="name" value="Nome da empresa" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nome_empresa"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.nome_empresa" />
            </div>

            <div>
                <InputLabel for="name" value="Nome do titular" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.nome_titular"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.nome_empresa" />
            </div>

            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>
            
            <div>
                <InputLabel for="telefone" value="Telefone" />

                <TextInput
                    id="telefone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.telefone"
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.telefone" />
            </div>

            <div>
                <InputLabel for="name" value="CNPJ" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cnpj"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.cnpj" />
            </div>

            <div>
                <InputLabel for="name" value="CEP" />

                <TextInput
                    id="name"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.cep"
                    required
                    autofocus
                    autocomplete="name"
                />

                <InputError class="mt-2" :message="form.errors.cep" />
            </div>

            <div v-if="mustVerifyEmail && user.email_verified_at === null">
                <p class="text-sm mt-2 text-gray-800">
                    Your email address is unverified.
                    <Link
                        :href="route('verification.send')"
                        method="post"
                        as="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                    >
                        Click here to re-send the verification email.
                    </Link>
                </p>

                <div
                    v-show="status === 'verification-link-sent'"
                    class="mt-2 font-medium text-sm text-green-600"
                >
                    A new verification link has been sent to your email address.
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Salvar</PrimaryButton>

                <Transition enter-from-class="opacity-0" leave-to-class="opacity-0" class="transition ease-in-out">
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600">Salvo.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>
