<script setup lang="ts">
import { computed, ref } from 'vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from '@/components/ui/table';
import { Pagination } from '@/components/ui/pagination'
// Recibir los proveedores como prop desde el componente padre
const props = defineProps<{
  paginaActual: number,
  totalPages: number
}>()

const paginaActual = ref(props.paginaActual ?? 1);
</script>

<template>
    <Pagination
    v-model:paginaActual="paginaActual"
    :totalPages="props.totalPages ?? 1"
    />
</template>
