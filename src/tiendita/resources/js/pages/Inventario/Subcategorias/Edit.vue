<script setup lang="ts">
import { Button } from "@/components/ui/button"
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch } from 'vue';

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    subcategorias?: {
        id: number,
        categoria_id: number,
        nombre: string,
        descripcion: string,
        estado: boolean,
    }, errors: {
        type: Object,
        categoria_id: number,
        nombre: string,
        descripcion: string,
        default: () => ({})
    },
    categorias: {
        type: any,

    }
}>();

const form = ref({
    categoria_id: props.subcategorias?.categoria_id || null,
    nombre: props.subcategorias?.nombre || '',
    descripcion: props.subcategorias?.nombre || '',
    estado: props.subcategorias?.estado || true
});


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Inventario',
        href: '/inventario/subcategorias',
    },
    {
        title: 'Crear',
        href: '/inventario/subcategorias/Create',
    },
];

function submitForm() {
    router.put(route('inventario.subcategorias.update', props.subcategorias?.id), form.value);
};

const handleCancel = () => {
    router.get(route('inventario.subcategorias.index'));
};

</script>
<template>

    <Head title="Subcategorias" />
    <AppLayout :breadcrumbs="breadcrumbs">

        <form @submit.prevent="submitForm" class="space-y-4">
            <div class="mb-5">
                <label for="categoria_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria
                    ID</label>
                <select id="countries" v-model="form.categoria_id" :class="[props.errors.categoria_id ?
                    'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500' :
                    'shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light'
                ]">
                    <option :value="null">--Seleccione Categoria--</option>
                    <option v-for="categoria in props.categorias" :value="categoria.id">{{ categoria.nombre }}</option>
                </select>
                <p class="mt-2 text-sn text-red-600 dark:text-red-500">{{ props.errors.categoria_id }}</p>

            </div>
            <div class="mb-5">
                <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre</label>
                <input type="text" id="nombre" v-model="form.nombre" :class="[props.errors.nombre ?
                    'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500' :
                    'shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light'
                ]" placeholder="Nombre de la subcategoria" />
                <p class="mt-2 text-sn text-red-600 dark:text-red-500">{{ props.errors.nombre }}</p>
            </div>
            <div class="mb-5">
                <label for="descripcion"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descripción</label>
                <input type="text" id="descripcion" v-model="form.descripcion" :class="[props.errors.descripcion ?
                    'bg-red-50 border border-red-500 text-red-900 placeholder-red-700 text-sm rounded-lg focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 block w-full p-2.5 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500' :
                    'shadow-xs bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-xs-light'
                ]" placeholder="Descripción de la subcategoria" />
                <p class="mt-2 text-sn text-red-600 dark:text-red-500">{{ props.errors.descripcion }}</p>
            </div>
            <div class="flex items-start mb-5">
                <label class="inline-flex items-center mb-5 cursor-pointer">
                    <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Estado
                        Activo </span>
                    <input id="estado" type="checkbox" class="sr-only peer" value="" v-model="form.estado">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600 dark:peer-checked:bg-blue-600">
                    </div>

                </label>
            </div>
            <button type="submit"
                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 me-2">Guardar</button>
            <button type="button"
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 "
                @click="handleCancel">Cancelar</button>
        </form>

    </AppLayout>
</template>