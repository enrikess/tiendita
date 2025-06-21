<script setup lang="ts">
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import ProveedorForm from '@/components/Proveedores/ProveedorForm.vue';
import { router } from '@inertiajs/vue3';



const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/proveedores',
    },
    {
        title: 'Crear',
        href: '/proveedores/create',
    },
];

const handleSubmit = (formData: any) => {
    router.post('/proveedores', formData, {
        onSuccess: () => {
            // Notificación o redirección si es necesario
        }
    });
};

const handleCancel = () => {
    router.get('/proveedores');
};
</script>

<template>
    <Head title="Crear proveedor" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <ProveedorForm @submit="handleSubmit" @cancel="handleCancel" />
        </div>
    </AppLayout>
</template>
