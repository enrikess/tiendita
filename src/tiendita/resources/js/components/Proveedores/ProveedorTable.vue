<script setup>
import { ref } from 'vue';
import { Table, TableHead, TableBody, TableRow, TableCell } from '@/components/ui/table';

// Datos de ejemplo
const proveedores = ref([
  { id: 1, nombre: 'Proveedor A', telefono: '123-456-7890', email: 'proveedora@ejemplo.com', activo: true },
  { id: 2, nombre: 'Proveedor B', telefono: '987-654-3210', email: 'proveedorb@ejemplo.com', activo: false },
  // más datos...
]);

const isLoading = ref(false);
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
      <TableRow v-for="proveedor in proveedores" :key="proveedor.id" striped hover>
        <TableCell>{{ proveedor.id }}</TableCell>
        <TableCell nowrap>{{ proveedor.nombre }}</TableCell>
        <TableCell>{{ proveedor.telefono }}</TableCell>
        <TableCell>{{ proveedor.email }}</TableCell>
        <TableCell align="center">
          <span
            class="px-2 py-1 rounded text-xs font-medium"
            :class="proveedor.activo ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
          >
            {{ proveedor.activo ? 'Activo' : 'Inactivo' }}
          </span>
        </TableCell>
        <TableCell align="right">
          <div class="flex justify-end space-x-2">
            <button class="p-1 text-blue-600 hover:bg-blue-100 rounded">
              <span class="sr-only">Editar</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
              </svg>
            </button>
            <button class="p-1 text-red-600 hover:bg-red-100 rounded">
              <span class="sr-only">Eliminar</span>
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </button>
          </div>
        </TableCell>
      </TableRow>
    </TableBody>
  </Table>
</template>
