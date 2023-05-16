<script setup>
defineProps({
    vaga: Object,
})
</script>

<template>
<!--    Todo: Definir uma altura máxima para a página e se o texto ultrapassar, colocar uma barra de rolagem-->
<!--    Todo: Fixar ela na janela do navegador e não permitir que a rolagem suma com a página-->
    <div class="shadow mx-6 my-3 border rounded-3xl w-1/2">
        <div class="m-14">
            <h1 class="text-4xl mb-5">{{ vaga.titulo }}</h1>
            <p class="text-gray-500">{{ vaga.nome_empresa }}</p>
            <hr class="my-6">
            <p>{{ vaga.descricao }}</p>
        </div>
    </div>
</template>

<style scoped>

</style>
