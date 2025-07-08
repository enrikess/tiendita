<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Subcategoria, type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch, onMounted } from 'vue';
import CategoriaTable from "@/components/Inventario/Categorias/CategoriaTable.vue";

interface subcategoriasPageProps extends ShareData {
    subcategorias: Subcategoria[];
}

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    categorias: any;
}>();
const categorias = computed(() => props.categorias.data ?? []);
const paginaActual = ref(props.categorias.current_page);
const perPage = ref(props.categorias.per_page);



const cantidadPaginas = computed(() => {
    const paginas = [];
    for (let index = 0; index < props.categorias.last_page; index++) {
        paginas.push(index + 1);
    }
    return paginas;
})

function cambiarPagina(pagina: any) {
    router.get(
        route('inventario.categorias.index'),
        {
            page: pagina,
            per_page: perPage.value
        }
    );
    paginaActual.value = pagina;
    console.log("pagina", pagina);
}

//COMBO DE POR PAGINA
const arrayPorPagina = [5, 10, 15, 20];

watch(perPage, (nuevoPerPage) => {
    router.get(
        route('inventario.categorias.index'),
        { per_page: nuevoPerPage }
    )
}

);

//breadcrums
const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'inventario',
        href: '/inventario/categorias',
    },
];
//metodo para eliminar

</script>

<template>

    <Head title="Categorias" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="flex h-full flex-1 flex-col gap-6 bg-white dark:bg-gray-900 p-6 shadow">

            <div class="flex justify-end mb-2">
                <label class="mr-2">Mostrar</label>
                    <select v-model="perPage" class="border rounded px-2 py-1 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option v-for="itemPorPagina in arrayPorPagina" :value="itemPorPagina">
                            {{itemPorPagina}}
                        </option>

                    </select>
                <span class="ml-2">por página</span>
            </div>


            <div class="relative overflow-x-auto">
                <CategoriaTable :categoriasData="categorias" />
            </div>

            <nav aria-label="Page navigation example">
                <ul class="inline-flex -space-x-px text-base h-10">
                    <li>
                        <button
                        :disabled="paginaActual <= 1"
                        @click="cambiarPagina(paginaActual-1)"
                        class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Anterior
                        </button>
                    </li>
                    <li v-for="pagina in cantidadPaginas">
                    <a
                    @click="cambiarPagina(pagina)"
                    :class="[
                        paginaActual === pagina ?
                        'flex items-center justify-center px-4 h-10 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' :
                        'flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white'
                    ]">
                    {{ pagina }}
                    </a>
                    </li>
                    <li>
                        <button
                        @click="cambiarPagina(paginaActual+1)"
                        :disabled="paginaActual >= props.categorias.last_page"
                        class="flex items-center justify-center px-4 h-10 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        Siguiente
                    </button>
                    </li>
                </ul>
            </nav>

        </div>
    </AppLayout>
</template>
