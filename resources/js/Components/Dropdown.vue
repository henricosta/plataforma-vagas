<script setup lang="ts">
// TODO: Fechar dropdown quando outra parte da tela for clicada
import {ref} from "vue";

defineProps<{
    buttonText: string,
    options: string[]
}>()

const isOpen = ref(false)

</script>

<template>
    <div class="inline-block mx-4">
        <div @click="isOpen = !isOpen" class="border p-4">{{buttonText}}</div>
        <div id="dropdown-content" v-show="isOpen" class="bg-gray-100 absolute">
            <div v-for="item in options" class="dropdown-content-item hover:bg-gray-300">{{item}}</div>
        </div>
    </div>
</template>

<style scoped>
.dropdown-content-item {
    padding: 1rem;
}
</style>
