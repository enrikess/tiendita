<script setup lang="ts">
/*
ProveedorForm.vue
Formulario reutilizable para crear o editar proveedores.
Props:
  - proveedor: objeto con los datos del proveedor (opcional, para edición)
  - isEditing: booleano para indicar si es edición o creación
Emits:
  - submit: envía los datos del formulario al padre
  - cancel: notifica cancelación al padre
*/

import { ref, watch } from 'vue';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';

const props = defineProps({
  proveedor: {
    type: Object,
    default: () => ({
      ruc: '',
      razon_social: '',
      nombre_comercial: '',
      direccion: '',
      telefono: '',
      email: '',
      persona_contacto: '',
      estado: true
    })
  },
  isEditing: {
    type: Boolean,
    default: false
  }
});

// Permite emitir eventos personalizados 'submit' y 'cancel' al componente padre
const emit = defineEmits(['submit', 'cancel']);

// Estado reactivo del formulario, inicializado con los datos del proveedor recibido por props
const form = ref({ ...props.proveedor });

// Si cambian los datos del proveedor (por ejemplo, al editar), actualiza el formulario
watch(() => props.proveedor, (nuevo) => {
  form.value = { ...nuevo };
}, { deep: true });

// Variable reactiva para indicar si el formulario se está enviando (útil para mostrar loading o deshabilitar botones)
const isSubmitting = ref(false);

// Función que se ejecuta al enviar el formulario
// 1. Marca el formulario como "enviando"
// 2. Emite el evento 'submit' con los datos al padre
// 3. Marca el formulario como "no enviando" (en un caso real, esto debería hacerse tras la respuesta del servidor)
const submitForm = () => {
  isSubmitting.value = true;
  emit('submit', { ...form.value });
  isSubmitting.value = false;
};
</script>

<template>
  <!-- Formulario de proveedor: incluye todos los campos requeridos -->
  <form @submit.prevent="submitForm" class="space-y-4">
    <div class="grid gap-1">
      <Label for="ruc" class="block text-sm font-medium">RUC</Label>
      <Input type="text" id="ruc" v-model="form.ruc" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="RUC del proveedor" />
    </div>
    <div class="grid gap-2">
      <Label for="razon_social" class="block text-sm font-medium">Razón Social</Label>
      <Input type="text" id="razon_social" v-model="form.razon_social" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required placeholder="Razón social" />
    </div>
    <div class="grid gap-2">
      <Label for="nombre_comercial" class="block text-sm font-medium">Nombre Comercial</Label>
      <Input type="text" id="nombre_comercial" v-model="form.nombre_comercial" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Nombre comercial" />
    </div>
    <div class="grid gap-2">
      <Label for="direccion" class="block text-sm font-medium">Dirección</Label>
      <Input type="text" id="direccion" v-model="form.direccion" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Dirección" />
    </div>
    <div class="flex gap-4">
        <div class="w-1/2">
            <Label for="telefono" class="block text-sm font-medium">Teléfono</label>
            <Input type="tel" id="telefono" v-model="form.telefono" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Teléfono" />
        </div>
        <div class="w-1/2">
            <Label for="email" class="block text-sm font-medium">Email</label>
            <Input type="email" id="email" v-model="form.email" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Correo electrónico" />
        </div>
    </div>
    <div class="grid gap-2">
      <Label for="persona_contacto" class="block text-sm font-medium">Persona de Contacto</Label>
      <Input type="text" id="persona_contacto" v-model="form.persona_contacto" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Persona de contacto" />
    </div>
    <div class="flex items-center">
      <Input type="checkbox" id="estado" v-model="form.estado" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" />
      <Label for="estado" class="ml-2 block text-sm">Proveedor Activo</Label>
    </div>
    <div class="flex justify-end space-x-3 pt-4">
      <!-- Botón para cancelar y emitir evento al padre -->
      <button type="button" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" @click="$emit('cancel')">Cancelar</button>
      <!-- Botón para guardar o actualizar -->
      <button type="submit" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" :disabled="isSubmitting">
        <span v-if="isSubmitting">Guardando...</span>
        <span v-else>{{ isEditing ? 'Actualizar' : 'Guardar' }}</span>
      </button>
    </div>
  </form>
</template>
