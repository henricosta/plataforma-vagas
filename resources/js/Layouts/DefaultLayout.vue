<script setup lang="ts">

import Header from "@/Components/Header.vue";

defineProps({
    isLogged: Boolean
})

</script>

<template>
    <Header :isLogged="isLogged" />
    <slot></slot>
</template>
