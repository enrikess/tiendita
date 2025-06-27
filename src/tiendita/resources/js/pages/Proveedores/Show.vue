<script setup lang="ts">
import { Head, Link, router, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { PencilSquareIcon, ArrowLeftIcon } from '@heroicons/vue/24/outline';

// Obtener los datos del proveedor desde la página
const props = defineProps({
  proveedor: {
    type: Object,
    required: true,
  }
});

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/compras/proveedores',
    },
    {
        title: 'Detalle',
        href: `/compras/proveedores/${props.proveedor.id}`,
    },
];

// Función para editar el proveedor
const editProveedor = () => {
  router.get(`/compras/proveedores/${props.proveedor.id}/editar`);
};

// Función para volver a la lista de proveedores
const volverALista = () => {
  router.get('/compras/proveedores');
};
</script>

<template>
    <Head :title="`Proveedor: ${proveedor.razon_social}`" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 rounded-xl bg-white dark:bg-gray-900 p-6 shadow">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-4">
                    <button
                        @click="volverALista"
                        class="p-2 bg-gray-100 dark:bg-gray-800 rounded-full text-gray-600 dark:text-gray-300 hover:bg-gray-200 dark:hover:bg-gray-700 transition"
                        title="Volver a la lista"
                    >
                        <ArrowLeftIcon class="h-5 w-5" />
                    </button>
                    <h1 class="text-2xl font-semibold text-gray-800 dark:text-white">Detalle del Proveedor</h1>
                </div>

                <button
                    @click="editProveedor"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition"
                >
                    <PencilSquareIcon class="h-5 w-5 mr-2" />
                    Editar Proveedor
                </button>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 p-6 rounded-lg shadow">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">ID</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.id }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">RUC</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.ruc }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Razón Social</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.razon_social }}</p>
                        </div>

                        <div v-if="proveedor.nombre_comercial">
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Nombre Comercial</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.nombre_comercial }}</p>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Email</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.email }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Teléfono</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.telefono }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Dirección</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.direccion || 'No disponible' }}</p>
                        </div>

                        <div>
                            <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Persona de contacto</h3>
                            <p class="mt-1 text-lg font-semibold text-gray-900 dark:text-white">{{ proveedor.persona_contacto || 'No disponible' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Información adicional -->
            <div class="mt-4">
                <h2 class="text-xl font-medium text-gray-800 dark:text-white mb-4">Información adicional</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Fecha de registro</h3>
                        <p class="mt-1 text-md font-semibold text-gray-900 dark:text-white">{{ proveedor.fecha_creo ? new Date(proveedor.fecha_creo).toLocaleDateString() : 'No disponible' }}</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Última actualización</h3>
                        <p class="mt-1 text-md font-semibold text-gray-900 dark:text-white">{{ proveedor.fecha_modifico ? new Date(proveedor.fecha_modifico).toLocaleDateString() : 'No disponible' }}</p>
                    </div>

                    <div class="bg-gray-50 dark:bg-gray-800 p-4 rounded-lg shadow">
                        <h3 class="text-sm font-medium text-gray-500 dark:text-gray-400">Estado</h3>
                        <p class="mt-1">
                            <span
                                :class="[
                                    'px-2 py-1 text-xs font-medium rounded-full',
                                    proveedor.estado
                                        ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200'
                                        : 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200'
                                ]"
                            >
                                {{ proveedor.estado ? 'Activo' : 'Inactivo' }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
