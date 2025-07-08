<script setup lang="ts">
import { Head, useForm, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { router } from '@inertiajs/vue3';
import { computed, defineProps, ref } from 'vue';
import { Input } from '@/components/ui/input';
import { Checkbox } from '@/components/ui/checkbox';
import { Label } from '@/components/ui/label';


const props = defineProps({
    estadoCompra: {
        type: Object,
        default: () => ({
            codigo: '',
            nombre: '',
            descripcion: '',
            estado: true,
        })
    },
    errors: {
        type: Object,
        default: () => ({})
    }
});

console.log(props.estadoCompra, "crear estado compra");

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Estado Compras',
        href: '/compras/estado_compras',
    },
    {
        title: 'Crear',
        href: '/compras/estado_compras/create',
    },
];




const form = ref({
    codigo: props.estadoCompra?.codigo || '',
    nombre: props.estadoCompra?.nombre || '',
    descripcion: props.estadoCompra?.descripcion || '',
    estado: props.estadoCompra?.estado ?? true,
});

const isSubmitting = ref(false);

// Accede a los errores de validación

const handleSubmit = () => {
    isSubmitting.value = true;
    console.log(form);
    //form.post(route('compras.estado_compras.store'));
    router.post(route('compras.estado_compras.store'), form.value,{
        onFinish: () => {
            isSubmitting.value = false;
        }
    });

};

const handleCancel = () => {
    router.get(route('compras.estado_compras.index'));  // Este método ya está correcto
};
</script>

<template>

    <Head title="Crear proveedor" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6  bg-white dark:bg-gray-900 p-6 shadow">

            <!-- Header -->
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-gray-800 dark:text-white">
                    Crear Nuevo Estado de Compra
                </h1>
                <p class="text-gray-600 dark:text-gray-400 mt-1">
                    Completa la información del nuevo estado de compra
                </p>
            </div>

            <!-- ✅ Formulario para Estado de Compra -->
            <form @submit.prevent="handleSubmit" class="space-y-4">

                <!-- Código -->
                <div class="grid gap-1">
                    <Label for="codigo" class="block text-sm font-medium">Código</Label>
                    <Input
                        type="text"
                        id="codigo"
                        v-model="form.codigo"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': props.errors.codigo }"
                        placeholder="Ingrese el código del estado"
                    />
                    <p v-if="props.errors.codigo" class="mt-1 text-sm text-red-600">
                        {{ props.errors.codigo }}
                    </p>

                </div>

                <!-- Nombre -->
                <div class="grid gap-2">
                    <Label for="nombre" class="block text-sm font-medium">Nombre</Label>
                    <Input
                        type="text"
                        id="nombre"
                        v-model="form.nombre"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': props.errors.nombre }"
                        placeholder="Ingrese el nombre del estado"
                    />
                    <p v-if="props.errors.nombre" class="mt-1 text-sm text-red-600">
                        {{ props.errors.nombre }}
                    </p>
                </div>

                <!-- Descripción -->
                <div class="grid gap-2">
                    <Label for="descripcion" class="block text-sm font-medium">Descripción</Label>
                    <Input
                        id="descripcion"
                        v-model="form.descripcion"
                        class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500"
                        :class="{ 'border-red-500': props.errors.descripcion }"
                        placeholder="Descripción del estado"
                    />
                    <p v-if="props.errors.descripcion" class="mt-1 text-sm text-red-600">
                        {{ props.errors.descripcion }}
                    </p>
                </div>

                <!-- Estado activo -->
                <div class="flex items-center">
                    <Checkbox
                        id="estado"
                        v-model="form.estado"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <Label for="estado" class="ml-2 block text-sm">Estado Activo</Label>
                </div>

                <!-- Botones -->
                <div class="flex justify-end space-x-3 pt-4">
                    <button
                        type="button"
                        class="px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        @click="handleCancel"
                        :disabled="isSubmitting"
                    >
                        Cancelar
                    </button>

                    <button
                        type="submit"
                        class="px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                        :disabled="isSubmitting"
                    >
                        <span v-if="isSubmitting">Guardando...</span>
                        <span v-else>Crear</span>
                    </button>
                </div>
            </form>
        </div>
    </AppLayout>
</template>
