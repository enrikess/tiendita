<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import ProveedorForm from '@/components/Proveedores/ProveedorForm.vue';
import { router } from '@inertiajs/vue3';
import { computed } from 'vue';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/compras/proveedores',
    },
    {
        title: 'Crear',
        href: '/compras/proveedores/create',
    },
];

// Accede a los errores de validación
const errors = computed(() => usePage().props.errors);

const handleSubmit = (formData: any) => {
    router.post('/compras/proveedores', formData, {
        onSuccess: () => {
            // Notificación o redirección si es necesario
        }
    });
};

const handleCancel = () => {
    router.get('/compras/proveedores');  // Este método ya está correcto
};
</script>

<template>
    <Head title="Crear proveedor" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- Eliminamos el bloque de errores generales y pasamos los errores al formulario -->
            <ProveedorForm
              @submit="handleSubmit"
              @cancel="handleCancel"
              :errors="errors"
            />
        </div>
    </AppLayout>
</template>

