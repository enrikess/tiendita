<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

// Definir las props que recibimos desde el controlador
defineProps<{
    canLogin: string;
    canRegister: string;
    timestamp?: string;
    userData?: {
        id: number;
        name: string;
        email: string;
        [key: string]: any;
    };
    statistics?: {
        visits: number;
        sales: number;
        revenue: number;
    };
}>();

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];
</script>

<template>
    <Head title="Dashboard" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="mb-6 rounded-lg bg-white p-4 shadow dark:bg-gray-800">
            <h2 class="mb-4 text-xl font-bold">Variables recibidas del controlador:</h2>

            <!-- Variables básicas -->
            <div class="mb-4 grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="rounded-md bg-gray-100 p-3 dark:bg-gray-700">
                    <span class="font-semibold">canLogin:</span> {{ canLogin }}
                </div>
                <div class="rounded-md bg-gray-100 p-3 dark:bg-gray-700">
                    <span class="font-semibold">canRegister:</span> {{ canRegister }}
                </div>
                <div class="rounded-md bg-gray-100 p-3 dark:bg-gray-700">
                    <span class="font-semibold">Timestamp:</span> {{ timestamp }}
                </div>
            </div>

            <!-- Datos de usuario -->
            <div v-if="userData" class="mb-4">
                <h3 class="mb-2 text-lg font-semibold">Datos del usuario:</h3>
                <div class="rounded-md bg-gray-100 p-3 dark:bg-gray-700">
                    <div><span class="font-semibold">ID:</span> {{ userData.id }}</div>
                    <div><span class="font-semibold">Nombre:</span> {{ userData.name }}</div>
                    <div><span class="font-semibold">Email:</span> {{ userData.email }}</div>
                </div>
            </div>

            <!-- Estadísticas -->
            <div v-if="statistics" class="mb-4">
                <h3 class="mb-2 text-lg font-semibold">Estadísticas:</h3>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-3">
                    <div class="rounded-md bg-blue-100 p-3 text-center dark:bg-blue-900">
                        <div class="text-2xl font-bold">{{ statistics.visits }}</div>
                        <div class="text-sm">Visitas</div>
                    </div>
                    <div class="rounded-md bg-green-100 p-3 text-center dark:bg-green-900">
                        <div class="text-2xl font-bold">{{ statistics.sales }}</div>
                        <div class="text-sm">Ventas</div>
                    </div>
                    <div class="rounded-md bg-purple-100 p-3 text-center dark:bg-purple-900">
                        <div class="text-2xl font-bold">${{ statistics.revenue.toLocaleString() }}</div>
                        <div class="text-sm">Ingresos</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div class="grid auto-rows-min gap-4 md:grid-cols-3">
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
                <div class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
                    <PlaceholderPattern />
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min">
                <PlaceholderPattern />
            </div>
        </div>
    </AppLayout>
</template>
