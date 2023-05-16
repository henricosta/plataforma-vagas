<script setup>
defineProps({
    vaga: Object,
})
</script>

<template>
    <div>
        <div class="shadow mx-6 my-3 border rounded-3xl">
            <div class="m-14">
                <h1 class="text-4xl mb-5">{{ vaga.titulo }}</h1>
                <p class="text-gray-500">{{ vaga.nome_empresa }}</p>
                <hr class="my-6">
                <p>{{ vaga.descricao }}</p>
            </div>
        </div>
    </div>
</template>

<style scoped>

</style>
