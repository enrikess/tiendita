<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import ProveedorTable from '@/components/Proveedores/ProveedorTable.vue';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import { defineProps, computed, ref, watch, onMounted } from 'vue';
import { Pagination } from '@/components/ui/pagination';
import { Alert } from '@/components/ui/alert';
import { PerPageSelect } from '@/components/ui/PerPageSelect';
import ProveedorModalEliminar from '@/components/Proveedores/ProveedorModalEliminar.vue';
import EstadoComprasTable from '@/components/compra/EstadoCompras/EstadoComprasTable.vue';
import EstadoComprasPagination from '@/components/compra/EstadoCompras/EstadoComprasPagination.vue';


const page = usePage();

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    estadoCompras: {
        data: Array<any>,
        per_page?: number,
        current_page?: number,
        last_page?: number,
        links?: Array<{
            url: string | null,
            label: string,
            active: boolean
        }>,
        // Puedes agregar otros campos como meta si los usas
    }
}>();


//Manejando Pagina actual
const paginaActual = ref(props.estadoCompras.current_page ?? 1);
watch(
    () => props.estadoCompras.current_page,
    (nuevo) => {
        return paginaActual.value = nuevo ?? 1;
    }
);
watch(paginaActual, (nuevoValor) => {
    router.get(
        route('compras.estadoCompras.index'),
        { page: nuevoValor, per_page: perPageSelected.value },
        { preserveState: true }
    );
})

const perPageSelected = ref(props.estadoCompras.per_page ?? 10);

watch(paginaActual, (nuevoValor) => {
    router.get(
        route('compras.proveedores.index'),
        { page: nuevoValor, per_page: perPageSelected.value },
        { preserveState: true }
    );
})


const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Estado Compra',
        href: '/compras/estado_compras',
    },
];
</script>

<template>

    <Head title="Estado Compras" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 bg-white dark:bg-gray-900 p-6 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Estado de Compras</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Aquí puedes gestionar los estados de compras de tu tienda.
                    </p>
                </div>
                <div>
                    <Link :href="route('compras.proveedores.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <PlusCircleIcon class="h-5 w-5 mr-2" />
                    Nuevo Estado de compras
                    </Link>
                </div>
            </div>

            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4 shadow">
                <EstadoComprasTable
                :estadoCompras="props.estadoCompras.data"

                />
                <div v-if="props.estadoCompras.links && props.estadoCompras.links.length" class="mt-4 flex justify-center">
                    <EstadoComprasPagination
                    v-model:paginaActual="paginaActual"
                    :totalPages="props.estadoCompras.last_page ?? 1" />
                </div>
            </div>

        </div>
    </AppLayout>

</template>
