<script setup>

</script>
<!-- TODO: Remover a borda do input quando em foco-->
<template>
    <form action="" class="flex justify-center">
        <div class="py-8 flex">
            <input type="text" name="" id="input-field" class="pl-6 placeholder-gray-400 bg-indigo-50 rounded-l-2xl border-blue-700 text-lg focus:border-transparent border-1" placeholder="Ex: Desenvolvedor Web">
            <button type="submit" class="bg-blue-600 text-gray-50 px-4 py-4 rounded-r-2xl">Buscar vaga</button>
        </div>
    </form>
</template>

<style scoped>
#input-field {
    width: 32rem;
}
</style>
