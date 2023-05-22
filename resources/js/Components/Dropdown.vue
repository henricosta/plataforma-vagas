<script setup lang="ts">

defineProps<{
    buttonText: string,
    options: string[]
}>()

</script>

<template>
    <div class="inline-block mx-4">
        <select name="" id="">
            <option value="" disabled selected class="hidden">{{buttonText}}</option>
            <option v-for="item in options" value="">{{item}}</option>
        </select>
    </div>
</template>

<style scoped>

</style>
