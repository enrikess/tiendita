<script setup lang="ts">
import { computed } from 'vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from '@/components/ui/table';

// Recibir las subcategorias como prop desde el componente padre
const props = defineProps<{
    subcategorias: any,
    isLoading?: boolean
}>();

console.log(props.subcategorias);

const emit = defineEmits(['editar']);

function clickEditar(Subcategoria: any) {
    emit("editar", Subcategoria);
}

// Computed para saber si hay proveedores
const haySubcategorias = computed(() => props.subcategorias.length > 0);
</script>
<template>
    <Table hover bordered responsive>
        <TableHead sticky>
            <TableRow>
                <TableCell header>ID</TableCell>
                <TableCell header>Nombre</TableCell>
                <TableCell header>Descripción</TableCell>
                <TableCell header align="center">Estado</TableCell>
                <TableCell header align="right">Acciones</TableCell>
            </TableRow>
        </TableHead>
        <TableBody :loading="isLoading">
            <TableRow v-for="subcategoria in props.subcategorias" :key="subcategoria.id" striped hover>
                <TableCell>{{ subcategoria.id }}</TableCell>
                <TableCell>{{ subcategoria.nombre }}</TableCell>
                <TableCell>{{ subcategoria.descripcion }}</TableCell>
                <TableCell align="center">
                    <span class="px-2 py-1 rounded text-xs font-medium"
                        :class="subcategoria.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'">
                        {{ subcategoria.estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </TableCell>
                <TableCell align="right">
                    <div class="flex justify-end space-x-2">
                        <button class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                            @click="clickEditar(subcategoria)" title="Editar">
                            Editar
                        </button>
                        <button class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition" @click=""
                            title="Eliminar">
                            Eliminar
                        </button>
                    </div>
                </TableCell>
            </TableRow>
            <TableRow v-if="!haySubcategorias">
                <TableCell :colspan="6" class="text-center text-gray-500">
                    No se encontraron subcategorias
                </TableCell>
            </TableRow>
        </TableBody>
    </Table>
</template>
