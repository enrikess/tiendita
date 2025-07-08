<script setup lang="ts">
import { computed, ref } from 'vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from '@/components/ui/table';
import { Pagination } from '@/components/ui/pagination'
// Recibir los proveedores como prop desde el componente padre
const props = defineProps<{
  paginaActual: number,
  totalPages: number
}>()

const emit = defineEmits<{
    'update:paginaActual': [pagina: number]
}>()

function manejarCambioDePagina(nuevaPagina: number) {
    emit('update:paginaActual',nuevaPagina);
}

</script>

<template>
    <Pagination
    :paginaActual="props.paginaActual"
    :totalPages="props.totalPages ?? 1"
    @update:paginaActual="manejarCambioDePagina"
    />
</template>
