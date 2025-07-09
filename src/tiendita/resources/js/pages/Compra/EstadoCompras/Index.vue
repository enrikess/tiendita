<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem, type EstadoCompra } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { PlusCircleIcon } from '@heroicons/vue/24/outline';
import { defineProps, ref, watch } from 'vue';
import EstadoComprasPorPagina  from '@/components/compra/EstadoCompras/EstadoComprasPorPagina.vue';
import EstadoComprasTable from '@/components/compra/EstadoCompras/EstadoComprasTable.vue';
import EstadoComprasPagination from '@/components/compra/EstadoCompras/EstadoComprasPagination.vue';


// Definir las props que recibimos desde el controlador
const props = defineProps<{
    estadoCompras: {
        data: Array<EstadoCompra>,
        per_page?: number,
        current_page?: number,
        last_page?: number,
        links?: Array<{
            url: string | null,
            label: string,
            active: boolean
        }>,
        // Puedes agregar otros campos como meta si los usas
    },
        flash: {
        success:string,
        error:string,
        message:string,
        default: () => ({})
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
        route('compras.estado_compras.index'),
        { page: nuevoValor, per_page: perPageSelected.value },
        { preserveState: true }
    );
})

const optionsPerPage = [5, 10, 15, 20];
const perPageSelected = ref(props.estadoCompras.per_page ?? 10);

function cambiaPorPagina(porPagina: number){
    perPageSelected.value = porPagina;
}

watch(perPageSelected,(nuevoPerPage)=>{
    router.get(
        route('compras.estado_compras.index'),
        { page: 1, per_page: nuevoPerPage },
        { preserveState: true }
    );
})

function editarEstadoCompras(estadoCompra:EstadoCompra) {
    router.get(
        route('compras.estado_compras.edit',estadoCompra.id)
    );
}



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
                    <Link :href="route('compras.estado_compras.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <PlusCircleIcon class="h-5 w-5 mr-2" />
                    Nuevo Estado de compras
                    </Link>
                </div>
            </div>
            <div v-if="props.flash.success" class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">{{ props.flash.success }}</span>
                </div>
            </div>
            <div class="flex justify-end mb-2">
                <label class="mr-2">Mostrar</label>

                <EstadoComprasPorPagina
                :optionsPerPage="optionsPerPage"
                :perPageSelected="perPageSelected"
                @update:porPagina="cambiaPorPagina"
                class="border rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
                <span class="ml-2">por página</span>
            </div>
            <div class="bg-gray-50 dark:bg-gray-800 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4 shadow">
                <EstadoComprasTable
                :estadoCompras="props.estadoCompras.data"
                @editar="editarEstadoCompras"
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
