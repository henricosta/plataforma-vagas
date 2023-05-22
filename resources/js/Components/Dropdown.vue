<script setup>
// TODO: Usar props para renderizar o conteúdo do dropdown
import {ref} from "vue";

const isOpen = ref(false)

</script>

<template>
    <div class="inline-block mx-4">
        <button @click="isOpen = !isOpen" class="border p-4 w-40">Modalidade</button>
        <div id="dropdown-content" v-show="isOpen" class="bg-gray-100 w-40 absolute">
            <div class="dropdown-content-item hover:bg-gray-300">Presencial</div>
            <div class="dropdown-content-item hover:bg-gray-300">Remoto</div>
            <div class="dropdown-content-item hover:bg-gray-300">Híbrido</div>
        </div>
    </div>
</template>

<style scoped>
.dropdown-content-item {
    padding: 1rem;
}
</style>
