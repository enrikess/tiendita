<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Subcategoria, type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch, onMounted } from 'vue';
import CategoriaTable from "@/components/Inventario/Categorias/CategoriaTable.vue";
import { CirclePlus } from 'lucide-vue-next';


interface subcategoriasPageProps extends ShareData {
    subcategorias: Subcategoria[];
}

// Definir las props que recibimos desde el controlador
const props = defineProps<{
    categorias: any,
    flash: {
        success:string,
        error:string,
        message:string,
        default: () => ({})
    }
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
            <div class="flex justify-between items-center">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Categorias</h1>
                    <p class="text-gray-600 dark:text-gray-400 mt-1">Aquí puedes gestionar las categorias de tu
                        tienda.
                    </p>
                </div>
                <div>
                    <Link :href="route('inventario.categorias.create')"
                        class="px-4 py-2 bg-blue-600 text-white rounded-md flex items-center hover:bg-blue-700 transition">
                    <CirclePlus class="h-5 w-5 mr-2" />
                    Nueva Categoria
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
