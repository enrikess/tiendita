<script setup lang="ts">
import { Button } from "@/components/ui/button"
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch } from 'vue';
import SubcategoriaTable from "@/components/Inventario/Subcategorias/SubcategoriaTable.vue";
import { CirclePlus } from 'lucide-vue-next';

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    subcategorias: any
    flash: {
        success: string,
        error: string,
        message: string,
        default: () => ({})
    }
}>();

console.log(props.subcategorias, "index");

const categorias = computed(() => props.subcategorias.data ?? []);
const paginaActual = ref(props.subcategorias.current_page);
const perPage = ref(props.subcategorias.per_page);
const cantidadPaginas = computed(() => {
    const paginas = [];
    for (let index = 0; index < props.subcategorias.last_page; index++) {
        paginas.push(index + 1);
    }
    return paginas;
})
function cambiarPagina(pagina: number) {
    router.get(
        route('inventario.subcategorias.index'),
        {
            page: String(pagina),
            per_page: perPage.value
        }
    );
    paginaActual.value = pagina;
    console.log(pagina), pagina;
}
//Combo por pagina
const arrayPorPagina = [5, 10, 15, 20];

watch(perPage, (nuevoPerpage) => {
    router.get(
        route('inventario.subcategorias.index'),
        { per_page: nuevoPerpage }
    )
    //perPage.value = nuevoPerpage;
}

)
//Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'inventario',
        href: '/inventario/subcategorias',
    },
];

//metodo para editar

function editarSubcategoria(subcategoria: any) {
    router.get(
        route('inventario.subcategorias.edit', subcategoria.id)
    );

}
</script>
<template>

    <Head title="Subcategorias" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6 p-6 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Subcategorias</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Aquí puedes gestionar las subcategorias de tu
                        tienda.
                    </p>
                </div>
                <div>
                    <Link :href="route('inventario.subcategorias.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <CirclePlus class="h-5 w-5 mr-2" />
                    Nueva Subcategoria
                    </Link>
                </div>
            </div>
            <div v-if="props.flash.success"
                class="flex items-center p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="shrink-0 inline w-4 h-4 me-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-menu">{{ props.flash.success }}</span>
                </div>
            </div>
            <div class="flex justify-end mb-2">
                <label class="mr-2">Mostrar</label>
                <select v-model="perPage"
                    class="border rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option v-for="itemPorPagina in arrayPorPagina" :value="itemPorPagina">
                        {{ itemPorPagina }}
                    </option>
                </select>
                <span class="ml-2">por página</span>
            </div>
            <div class="relative overflow-x-auto">
                <SubcategoriaTable :subcategorias="subcategorias.data" @editar="editarSubcategoria" />
            </div>
            <div class="flex justify-center">
                <nav aria-label="Page navigation example">
                    <ul class="inline-flex -space-x-px text-sm">
                        <li>
                            <button @click="cambiarPagina(paginaActual - 1)" :disabled="paginaActual === 1"
                                class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Anterior
                            </button>
                        </li>
                        <li v-for="pagina in cantidadPaginas">
                            <a @click="cambiarPagina(pagina)" :class="[
                                paginaActual === pagina ?
                                    'flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' :
                                    'flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                            ]">
                                {{ pagina }}
                            </a>
                        </li>
                        <li>
                            <button @click="cambiarPagina(paginaActual + 1)"
                                :disabled="paginaActual >= props.subcategorias.last_page"
                                class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Siguiente</button>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>

        <Transition name="fade">
            <div v-if="true"
                class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto overflow-x-hidden bg-black/50">
                <!-- Modal -->
                <div class="relative p-4 w-full max-w-md max-h-full z-60">
                    <div class="relative bg-white rounded-lg shadow-lg dark:bg-gray-700">

                        <!-- Botón cerrar -->
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Cerrar modal</span>
                        </button>

                        <!-- Contenido del modal -->
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>

                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                                ¿Estás seguro que deseas eliminar el estado de compra
                                <!-- <span class="font-semibold">{{ estadoCompraToDelete?.nombre }}</span>? -->
                            </h3>
                            <p class="mb-6 text-sm text-gray-400">
                                Esta acción no se puede deshacer.
                            </p>

                            <!-- Botones -->
                            <div class="flex justify-center gap-3">
                                <button type="button"
                                    class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center disabled:opacity-50 disabled:cursor-not-allowed">
                                    <span>Sí, eliminar</span>
                                </button>

                                <button type="button"
                                    class="py-2.5 px-5 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700 disabled:opacity-50 disabled:cursor-not-allowed">
                                    Cancelar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </Transition>

    </AppLayout>
</template>