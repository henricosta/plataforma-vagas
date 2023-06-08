<script setup>
import GuestHeader from '@/Components/GuestHeader.vue';

defineProps({
    isLogged: Boolean
})

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <GuestHeader ></GuestHeader>
        <slot></slot>
    </div>
</template>
