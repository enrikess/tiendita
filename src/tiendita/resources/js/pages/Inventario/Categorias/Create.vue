<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Subcategoria, type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch, onMounted } from 'vue';


// Definir las props que recibimos desde el controlador
const props = defineProps<{
    categorias?: {
        type: Object,
        nombre: string,
        descripcion: string,
        estado: boolean
    },
    errors: {
        type: Object,
        nombre: string,
        descripcion: string,
        default: () => ({})
    },


}>();



const form = ref({
    nombre: props.categorias?.nombre || '',
    descripcion: props.categorias?.descripcion || '',
    estado: props.categorias?.estado || true
})

//breadcrums
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'inventario',
        href: '/inventario/categorias',
    },
    {
        title: 'Crear',
        href: '/inventario/categorias/create',
    },
];
//metodo para eliminar

function submitForm() {
    router.post(route('inventario.categorias.store'), form.value);
}



</script>

<template>

    <Head title="Categorias" />

    <AppLayout :breadcrumbs="breadcrumbs">

    <form @submit.prevent="submitForm" class="space-y-4">
        <div class="mb-5">
            <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
            <input type="text"
            id="nombre"
            v-model="form.nombre"
            :class="[props.errors.nombre ?
            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':
            'shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light'
            ]"
            placeholder="Nombre de la categoria" />
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ props.errors.nombre }}</p>

        </div>
        <div class="mb-5">
            <label for="descripcion" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripcion</label>
            <input type="text"
            id="descripcion"
            v-model="form.descripcion"
            :class="[props.errors.descripcion ?
            'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500':
            'shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light'
            ]"            placeholder="Descripción de la categoria"
            />
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ props.errors.descripcion }}</p>

        </div>
        <div class="flex items-start mb-5">
            <div class="flex items-center h-5">
            <input id="estado"
            type="checkbox"
            v-model="form.estado"
            class="w-4 h-4 border border-gray-300 rounded-sm bg-gray-50 focus:ring-3 focus:ring-blue-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800" />
            </div>
            <label for="estado" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Estado Activo</label>
        </div>
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Crear</button>
    </form>
    </AppLayout>
</template>
