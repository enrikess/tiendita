<script setup lang="ts">
import { PerPageSelect } from '@/components/ui/PerPageSelect'
import { watch } from 'vue';
// Recibir los proveedores como prop desde el componente padre
const props = defineProps<{
    optionsPerPage: number[],
    perPageSelected: number
}>()



const emit = defineEmits<{
    (e: 'update:porPagina', value: number): void
}>();

function cambiaPorPagina(perPage:any){
    emit('update:porPagina', perPage);
}

</script>

<template>
    <PerPageSelect
        :options="optionsPerPage"
        :perPage="perPageSelected"
        @update:perPage="cambiaPorPagina"
    />
</template>
