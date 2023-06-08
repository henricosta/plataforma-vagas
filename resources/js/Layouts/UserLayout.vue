<script setup>
import UserHeader from '@/Components/UserHeader.vue';

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <UserHeader />
        <slot></slot>
    </div>
</template>
