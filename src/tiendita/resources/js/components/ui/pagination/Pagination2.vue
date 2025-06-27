<script setup lang="ts">
const props = defineProps<{
  currentPage: number
  totalPages: number
}>()
const emit = defineEmits<{
  (e: 'update:page', page: number): void
}>()

function goToPage(page: number) {
  if (page !== props.currentPage && page >= 1 && page <= props.totalPages) {
    emit('update:page', page)
  }
}

// Genera un rango simple de páginas (puedes mejorar la lógica para mostrar ... si hay muchas páginas)
function pagesToShow() {
  const pages = []
  for (let i = 1; i <= props.totalPages; i++) {
    pages.push(i)
  }
  return pages
}
</script>

<template>
  <div class="flex items-center justify-center gap-2">
    <button
      :disabled="currentPage <= 1"
      @click="goToPage(currentPage - 1)"
      class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition disabled:opacity-50"
    >
      Anterior
    </button>
    <button
      v-for="page in pagesToShow()"
      :key="page"
      @click="goToPage(page)"
      :class="[
        'px-3 py-1 rounded transition',
        page === currentPage
          ? 'bg-blue-600 text-white font-bold'
          : 'bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600'
      ]"
      :disabled="page === currentPage"
    >
      {{ page }}
    </button>
    <button
      :disabled="currentPage >= totalPages"
      @click="goToPage(currentPage + 1)"
      class="px-3 py-1 rounded bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-200 hover:bg-gray-300 dark:hover:bg-gray-600 transition disabled:opacity-50"
    >
      Siguiente
    </button>
  </div>
</template>
