<script setup lang="ts">

import { computed, ref, watch, defineProps } from 'vue';


const props = defineProps({
  proveedor: {
    type: Object,
    default: () => ({})
  },
  modelValue: Boolean,
});


// Permite emitir eventos personalizados 'submit' y 'cancel' al componente padre
const emit = defineEmits(['eliminar', 'update:modelValue']);

const mostrarModalEliminar = ref(props.modelValue);
const ProveedorAEliminar = computed(() => props.proveedor);

// Función para cancelar y emitir el evento al padre
const handleEliminar = (ProveedorAEliminar: any) => {
    emit("eliminar", ProveedorAEliminar);
}

const handleCancel = () => {
    emit('update:modelValue', false);
};
</script>

<template>
  <transition name="fade">
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-black/50">
      <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative">
        <h2 class="text-lg font-bold mb-2 text-gray-800">¿Eliminar proveedor?</h2>
        <p class="mb-6 text-gray-600">
          ¿Estás seguro de que deseas eliminar este proveedor con razon social: {{ProveedorAEliminar.razon_social}}
          y con identificador: {{ProveedorAEliminar.id}}?
        </p>
        <div class="flex justify-end gap-2">
          <button
            class="px-4 py-2 rounded bg-gray-200 text-gray-700 hover:bg-gray-300"
            @click="handleCancel"
          >
            Cancelar
          </button>
          <button
            class="px-4 py-2 rounded bg-red-600 text-white hover:bg-red-700"
            @click="handleEliminar(ProveedorAEliminar)"
          >
            Eliminar
          </button>
        </div>
      </div>
    </div>
  </transition>
</template>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity 0.2s;
}
.fade-enter-from, .fade-leave-to {
  opacity: 0;
}
</style>
