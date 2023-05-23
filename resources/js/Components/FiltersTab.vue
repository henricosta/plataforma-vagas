<script setup>

import Dropdown from "@/Components/Dropdown.vue";

defineProps({
    dropdownItems: Array
})

</script>

<template>
    <div class="border-b-2 border-t-2 py-4">
        <Dropdown v-for="item in dropdownItems" :filter="item.filter" :text="item.text" :options="item.options"/>
    </div>
</template>

<style scoped>

</style>
