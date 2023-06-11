<script setup>
import UserHeader from '@/Components/UserHeader.vue';
import {usePage} from "@inertiajs/vue3";

const user = usePage().props.auth.user

</script>

<template>
    <div class="min-h-screen bg-gray-100">
        <UserHeader :profile_image="user.profile_image" />
        <slot></slot>
    </div>
</template>
