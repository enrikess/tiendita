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
import { router } from '@inertiajs/vue3';

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
  },
  errors: {
    type: Object,
    default: () => ({})
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

  // Asegúrate de que estado sea explícitamente un booleano antes de enviarlo
  const formData = {
    ...form.value,
    estado: Boolean(form.value.estado)
  };

  emit('submit', formData);
  isSubmitting.value = false;
};

// Función para cancelar y emitir el evento al padre
const handleCancel = () => {
  emit('cancel');  // Emite el evento cancel para que el padre lo maneje
};
</script>

<template>
  <!-- Formulario de proveedor: incluye todos los campos requeridos -->
  <form @submit.prevent="submitForm" class="space-y-4">
    <div class="grid gap-1">
      <Label for="ruc" class="block text-sm font-medium">RUC</Label>
      <Input type="text" id="ruc" v-model="form.ruc" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.ruc}" placeholder="RUC del proveedor" />
      <p v-if="errors.ruc" class="mt-1 text-sm text-red-600">{{ errors.ruc }}</p>
    </div>
    <div class="grid gap-2">
      <Label for="razon_social" class="block text-sm font-medium">Razón Social</Label>
      <Input type="text" id="razon_social" v-model="form.razon_social" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.razon_social}" placeholder="Razón social" />
      <p v-if="errors.razon_social" class="mt-1 text-sm text-red-600">{{ errors.razon_social }}</p>
    </div>
    <div class="grid gap-2">
      <Label for="nombre_comercial" class="block text-sm font-medium">Nombre Comercial</Label>
      <Input type="text" id="nombre_comercial" v-model="form.nombre_comercial" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.nombre_comercial}" placeholder="Nombre comercial" />
      <p v-if="errors.nombre_comercial" class="mt-1 text-sm text-red-600">{{ errors.nombre_comercial }}</p>
    </div>
    <div class="grid gap-2">
      <Label for="direccion" class="block text-sm font-medium">Dirección</Label>
      <Input type="text" id="direccion" v-model="form.direccion" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.direccion}" placeholder="Dirección" />
      <p v-if="errors.direccion" class="mt-1 text-sm text-red-600">{{ errors.direccion }}</p>
    </div>
    <div class="flex gap-4">
        <div class="w-1/2">
            <Label for="telefono" class="block text-sm font-medium">Teléfono</Label>
            <Input type="tel" id="telefono" v-model="form.telefono" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.telefono}" placeholder="Teléfono" />
            <p v-if="errors.telefono" class="mt-1 text-sm text-red-600">{{ errors.telefono }}</p>
        </div>
        <div class="w-1/2">
            <Label for="email" class="block text-sm font-medium">Email</Label>
            <Input type="email" id="email" v-model="form.email" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.email}" placeholder="Correo electrónico" />
            <p v-if="errors.email" class="mt-1 text-sm text-red-600">{{ errors.email }}</p>
        </div>
    </div>
    <div class="grid gap-2">
      <Label for="persona_contacto" class="block text-sm font-medium">Persona de Contacto</Label>
      <Input type="text" id="persona_contacto" v-model="form.persona_contacto" class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" :class="{'border-red-500': errors.persona_contacto}" placeholder="Persona de contacto" />
      <p v-if="errors.persona_contacto" class="mt-1 text-sm text-red-600">{{ errors.persona_contacto }}</p>
    </div>
    <div class="flex items-center">
      <!-- Reemplazamos el componente Input por un checkbox nativo -->
      <Input
        type="checkbox"
        id="estado"
        :checked="form.estado"
        @change="form.estado = $event.target.checked"
        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
      />
      <Label for="estado" class="ml-2 block text-sm">Proveedor Activo</Label>
      <p v-if="errors.estado" class="ml-2 text-sm text-red-600">{{ errors.estado }}</p>
    </div>
    <div class="flex justify-end space-x-3 pt-4">
      <!-- Botón para cancelar y emitir evento al padre -->
      <button type="button" class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" @click="handleCancel">Cancelar</button>
      <!-- Botón para guardar o actualizar -->
      <button type="submit" class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500" :disabled="isSubmitting">
        <span v-if="isSubmitting">Guardando...</span>
        <span v-else>{{ isEditing ? 'Actualizar' : 'Guardar' }}</span>
      </button>
    </div>
  </form>
</template>
