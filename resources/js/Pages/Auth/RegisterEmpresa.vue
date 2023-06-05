<script setup>
import FormEmpresa from '@/Components/FormEmpresa.vue'
import Header from '@/Components/Header.vue';
</script>

<template>
    <Header></Header>
    <div class="min-h-screen background-image">
        <div class="flex justify-center">
            <FormEmpresa/>
        </div>
    </div>
</template>

<style>
.background-image {
    background-image: url('@/assets/funcionarios.jpg');
    background-repeat: no-repeat;
    background-size: cover;
}
</style>