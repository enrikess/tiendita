<script setup lang="ts">

// Recibir los proveedores como prop desde el componente padre
const props = defineProps<{
    categoriasData: any
}>()


const emit = defineEmits(['editar', 'eliminar']);


</script>

<template>
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Id
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Nombre
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Descripción
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Estado
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="categoria in props.categoriasData" :key="categoria.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ categoria.id }}
                    </th>
                    <td class="px-6 py-4">
                        {{ categoria.nombre }}
                    </td>
                    <td class="px-6 py-4">
                        {{ categoria.descripcion }}
                    </td>
                    <td class="px-6 py-4">
                        <span
                            class="px-2 py-1 rounded text-xs font-medium"
                            :class="categoria.estado ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'"
                        >
                            {{ categoria.estado ? 'Activo' : 'Inactivo' }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <button
                        class="px-2 py-1 bg-blue-500 text-white rounded hover:bg-blue-600 transition"
                        @click="$emit('editar', categoria)"
                        title="Editar"
                        >
                        Editar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
</template>
