<script setup lang="ts">
import { computed } from 'vue';

const props = defineProps<{
  paginaActual: number
  totalPages: number
}>()
const emit = defineEmits<{
  (e: 'cambiarPagina', page: number): void
}>()

function goToPage(page: number) {
  if (page !== props.paginaActual && page >= 1 && page <= props.totalPages) {
    emit('cambiarPagina', page)
  }
}

// Genera un rango simple de páginas (puedes mejorar la lógica para mostrar ... si hay muchas páginas)
const cantidadPaginas = computed(() => {
  const pages = [];
  for (let i = 1; i <= props.totalPages; i++) {
    pages.push(i);
  }
  return pages;
});
</script>

<template>
  <div class="flex items-center justify-center gap-2">
    <button
      :disabled="paginaActual <= 1"
      @click="goToPage(paginaActual - 1)"
      class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition disabled:opacity-50"
    >
      Anterior
    </button>
    <button
      v-for="page in cantidadPaginas"
      :key="page"
      @click="goToPage(page)"
      :class="[
        'px-3 py-1 rounded transition',
        page === paginaActual
          ? 'bg-blue-600 text-white font-bold'
          : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600'
      ]"
      :disabled="page === paginaActual"
    >
      {{ page }}
    </button>
    <button
      :disabled="paginaActual >= totalPages"
      @click="goToPage(paginaActual + 1)"
      class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition disabled:opacity-50"
    >
      Siguiente
    </button>
  </div>
</template>
