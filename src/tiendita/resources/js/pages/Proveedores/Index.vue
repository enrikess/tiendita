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


const page = usePage();

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    proveedores: {
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

//Usa ref cuando necesitas leer y modificar el valor.
//Usa computed cuando solo necesitas leer un valor derivado de otros reactivos.

const proveedoresActivos = computed(() => props.proveedores.data ?? []);
// Puedes cambiar paginaActual.value cuando quieras
const paginaActual = ref(props.proveedores.current_page ?? 1);

// perPage.value se actualiza solo si cambian las props
//const perPage = computed(() => props.proveedores.per_page ?? 10);
const perPageSelected = ref(props.proveedores.per_page ?? 10);


const perPageOptions = [5, 10, 25, 50, 100];

// Sincroniza los refs cuando cambian las props
watch(
    () => props.proveedores.per_page,
    (nuevo) => {
        return perPageSelected.value = nuevo ?? 10;
    }
);

watch(
    () => props.proveedores.current_page,
    (nuevo) => {
        return paginaActual.value = nuevo ?? 1;
    }
);

watch(paginaActual, (nuevoValor) => {
    router.get(
        route('compras.proveedores.index'),
        { page: nuevoValor, per_page: perPageSelected.value },
        { preserveState: true }
    );
})


watch(perPageSelected, (nuevoValor) => {
    router.get(
        route('compras.proveedores.index'),
        { page: 1, per_page: nuevoValor },
        { preserveState: true }
    );
});

const hasFlash = computed(() => {
  const flash = page.props.flash as { success?: string; error?: string } | undefined;
  return !!(flash?.success || flash?.error);
});

const flashMessage = computed(() => {
    const flash = page.props.flash as { success?: string; error?: string } | undefined;
    return flash?.success || flash?.error || '';
});

const flashType = computed(() => {
    const flash = page.props.flash as { success?: string; error?: string } | undefined;
    return flash?.success ? 'success' : 'error';
});

function editarProveedor(proveedor: any) {
    // Aquí pones la lógica para editar, por ejemplo:
    // router.visit(route('compras.proveedores.edit', proveedor.id));
    console.log('Editar proveedor:', proveedor.id);
    router.visit(route('compras.proveedores.edit', { id: proveedor.id }));

}


const mostrarModalEliminar = ref(false);
const proveedorAEliminar = ref<Object | undefined>(undefined);


function eliminarProveedor(proveedor: any) {
    proveedorAEliminar.value = proveedor;
    mostrarModalEliminar.value = true;
    console.log('Eliminar proveedor:', proveedor);
}

function confirmarElimProveedor(proveedor: any) {
    mostrarModalEliminar.value = false;
    router.post(
        route('compras.proveedores.dltlogico', { id: proveedor.id, page: paginaActual.value })
    );

}

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/compras/proveedores',
    },
];
</script>

<template>

    <Head title="Proveedores" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 bg-white dark:bg-gray-900 p-6 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Proveedores</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Aquí puedes gestionar los proveedores de tu tienda.
                    </p>
                </div>
                <div>
                    <Link :href="route('compras.proveedores.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <PlusCircleIcon class="h-5 w-5 mr-2" />
                    Nuevo Proveedor
                    </Link>
                </div>
            </div>
            <Alert
                v-if="hasFlash"
                :flashMessage="flashMessage"
                :flashType="flashType"
            />
            <div class="flex justify-end mb-2">
                <label class="mr-2">Mostrar</label>
                <PerPageSelect
                v-model:perPage="perPageSelected"
                :options="perPageOptions"
                    class="border rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                <span class="ml-2">por página</span>
            </div>
            <div
                class="bg-gray-50 dark:bg-gray-800 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border p-4 shadow">
                <ProveedorTable
                :proveedores="proveedoresActivos"
                @editar="editarProveedor"
                @eliminar="eliminarProveedor" />
                <div v-if="props.proveedores.links && props.proveedores.links.length" class="mt-4 flex justify-center">
                    <Pagination
                    v-model:paginaActual="paginaActual"
                    :totalPages="props.proveedores.last_page ?? 1" />
                </div>
            </div>
        </div>
    </AppLayout>
    <ProveedorModalEliminar
        v-if="mostrarModalEliminar"
        v-model="mostrarModalEliminar"
        :proveedor="proveedorAEliminar"
        @eliminar="confirmarElimProveedor"
    />
</template>
