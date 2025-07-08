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
                    <Link :href="route('compras.proveedores.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <CirclePlus class="h-5 w-5 mr-2" />
                    Nueva Subcategoria
                    </Link>
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
                <SubcategoriaTable :subcategorias="subcategorias.data" />
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
    </AppLayout>
</template>