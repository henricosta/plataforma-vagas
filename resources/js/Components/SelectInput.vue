<script setup>

import {computed} from "vue";

const emit = defineEmits(['change'])

const props = defineProps({
    filter_name: String,
    text: String,
    selected: Number,
    options: Array,
})

const selectOption = computed({
    get() {
        return props.selected
    },
    set(novoValor) {
        emit("change", novoValor)
    }
})

</script>

<template>
    <div class="inline-block mx-4">
        <select :name="props.filter_name" id="" form="formulario-busca-vaga" v-model="selectOption">
            <option value="0" disabled selected>{{ props.text }}</option>
            <option v-if="props.filter_name == 'cidade'" v-for="cidade in props.options" :value="cidade.id">{{cidade.nome}}</option>
            <option v-else v-for="item in props.options" :value="item.value">{{item.nome}}</option>
        </select>
    </div>
</template>

<style scoped>

</style>
