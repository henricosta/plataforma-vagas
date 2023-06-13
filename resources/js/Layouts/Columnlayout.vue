<script setup>

</script>

<template>
    <div class="py-12">
            <div class="flex justify-around">
                <!-- Coluna maior da esquerda -->
                <div class="pl-8 space-y-6 flex-grow mr-8">
                    <slot name="esquerda"></slot>
                </div>
                <!-- Coluna da direita -->
                <div class="mr-8">
                    <slot name="direita"></slot>
                </div>
            </div>
        </div>
</template>
