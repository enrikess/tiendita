<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
//import { Head } from '@inertiajs/vue3';
import ProveedorTable from '@/components/Proveedores/ProveedorTable.vue';
import { Button } from '@/components/ui/button';
//import { Link, route } from '@inertiajs/vue3';
import { Head, Link, useForm, usePage } from '@inertiajs/vue3';
// Definir las props que recibimos desde el controlador
defineProps<{
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/proveedores',
    },
];
</script>

<template>

    <Head title="Proveedores" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <h1 class="text-2xl font-bold">Proveedores</h1>
            <p class="text-gray-600 dark:text-gray-400">Aquí puedes gestionar los proveedores de tu tienda.</p>
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-2">
                        <Link
                            :href="route('compras.proveedores.create')"
                            class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition"
                        >Crear</Link>
                </div>
            </div>
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <!-- <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div> -->
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <ProveedorTable />
            </div>
        </div>
    </AppLayout>
</template>
