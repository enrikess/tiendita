<script setup>
import { computed } from 'vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from '@/components/ui/table';

// Recibir los proveedores como prop desde el componente padre
const props = defineProps({
  proveedores: {
    type: Array,
    default: () => []
  },
  isLoading: {
    type: Boolean,
    default: false
  }
});

const emit = defineEmits(['editar', 'eliminar']);
// Computed para saber si hay proveedores
const hayProveedores = computed(() => props.proveedores.length > 0);

</script>

<template>

  <Table hover bordered responsive>
    <TableHead sticky>
      <TableRow>
        <TableCell header>ID</TableCell>
        <TableCell header>Nombre</TableCell>
        <TableCell header>Teléfono</TableCell>
        <TableCell header>Email</TableCell>
        <TableCell header align="center">Estado</TableCell>
        <TableCell header align="right">Acciones</TableCell>
      </TableRow>
    </TableHead>

    <TableBody :loading="isLoading">
      <TableRow v-for="proveedor in props.proveedores" :key="proveedor.id" striped hover>
        <TableCell>{{ proveedor.id }}</TableCell>
        <TableCell nowrap>{{ proveedor.razon_social || proveedor.nombre }}</TableCell>
        <TableCell>{{ proveedor.telefono }}</TableCell>
        <TableCell>{{ proveedor.email }}</TableCell>
        <TableCell align="center">
          <span
            class="px-2 py-1 rounded text-xs font-medium"
            :class="proveedor.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
          >
            {{ proveedor.estado ? 'Activo' : 'Inactivo' }}
          </span>
        </TableCell>
        <TableCell align="right">
            <div class="flex justify-end space-x-2">
                <button
                class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                @click="$emit('editar', proveedor)"
                title="Editar"
                >
                Editar
                </button>
                <button
                class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 transition"
                @click="$emit('eliminar', proveedor)"
                title="Eliminar"
                >
                Eliminar
                </button>
            </div>
        </TableCell>
      </TableRow>
      <TableRow v-if="!hayProveedores">
        <TableCell colspan="6" class="text-center text-gray-500">
          No se encontraron proveedores
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
