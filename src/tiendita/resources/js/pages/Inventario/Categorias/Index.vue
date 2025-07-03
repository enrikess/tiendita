<script setup lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import { Head, Link, router, useForm, usePage } from '@inertiajs/vue3';
import { defineProps, computed, ref, watch, onMounted } from 'vue';
import CategoriaTable  from "@/components/Inventario/Categorias/CategoriaTable.vue";

// Definir las props que recibimos desde el controlador
    const props = defineProps<{
        categorias: any;
    }>();

console.log(props.categorias);

    const categorias = computed(()=> props.categorias.data ?? []);



    const paginaActual = props.categorias.current_page;


    const cantidadPaginas = computed(()=> {
        const paginas = [];
        for (let index = 0; index < props.categorias.last_page; index++) {
            paginas.push(index+1);

        }
        return paginas;
    })

    function cambiarPagina(pagina: Number){
        router.get(
            route('iventario.categorias.index'),
            {page: String(pagina)}
            //{ page: nuevoValor },
            //{ preserveState: true }
        );
    }

    const breadcrumbs: BreadcrumbItem[] = [
        {
            title: 'inventario',
            href: '/inventario/categorias',
        },
    ];
</script>

<template>
    <Head title="Categorias" />

    <AppLayout :breadcrumbs="breadcrumbs">

        <div class="relative overflow-x-auto">
            <CategoriaTable :categoriasData="categorias" />
        </div>

        <nav aria-label="Page navigation example">
            <ul class="inline-flex -space-x-px text-sm">
                <li >
                <a href="#" class="flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Previous</a>
                </li>
                <li v-for="pagina in cantidadPaginas">
                <a @click="cambiarPagina(pagina)" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    {{ pagina }}
                </a>
                </li>
                <li>
                <a href="#" class="flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">Next</a>
                </li>
            </ul>
        </nav>
    </AppLayout>
</template>
