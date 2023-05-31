<script setup lang="ts">

import Header from "@/Components/Header.vue";

defineProps({
    isLogged: Boolean
})

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <Header :isLogged="isLogged" />
        <slot></slot>
    </div>
</template>
