<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch, onMounted } from 'vue';


// Definir las props que recibimos desde el controlador
const props = defineProps<{
    subcategorias: any
}>();

console.log(props.subcategorias);

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'inventario',
        href: '/inventario/subcategorias',
    },
];
</script>

<template>

    <Head title="Subcategorias" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
                            estado
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="subcategoria in props.subcategorias" :key="subcategoria.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td  scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                           {{  subcategoria.id }}
                        </td>
                        <td class="px-6 py-4">
                            {{  subcategoria.nombre }}
                        </td>
                        <td class="px-6 py-4">
                            {{  subcategoria.descripcion }}
                        </td>
                        <td class="px-6 py-4">
                            {{  subcategoria.estado }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </AppLayout>
</template>
