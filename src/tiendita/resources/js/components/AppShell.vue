<script setup lang="ts">
// Importamos SidebarProvider que maneja el estado y contexto del sidebar
import { SidebarProvider } from '@/components/ui/sidebar';
// Importamos usePage para acceder a los datos compartidos desde Laravel
import { usePage } from '@inertiajs/vue3';
// Importamos el tipo SharedData que define la estructura de datos de la página
import { SharedData } from '@/types';

/**
 * Props del componente AppShell
 * @property {string} variant - Determina el tipo de layout a utilizar:
 *   - 'header': Layout simple con estructura de columna y sin sidebar
 *   - 'sidebar': Layout con barra lateral (valor por defecto)
 */
interface Props {
    variant?: 'header' | 'sidebar';
}

// Definimos las props utilizando TypeScript para validación de tipos
defineProps<Props>();

// Obtenemos el estado inicial del sidebar desde los datos compartidos por Laravel
// Este valor viene del backend y determina si el sidebar debe estar abierto inicialmente
const isOpen = usePage<SharedData>().props.sidebarOpen;
</script>

<template>
    <!-- Layout sin sidebar: se usa cuando variant === 'header' -->
    <div v-if="variant === 'header'" class="flex min-h-screen w-full flex-col">
        <!-- Slot para insertar contenido desde componentes padres -->
        <slot />
    </div>

    <!-- Layout con sidebar: se usa cuando variant !== 'header' (por defecto) -->
    <SidebarProvider v-else :default-open="isOpen">
        <!--
            Slot para insertar contenido desde componentes padres
            Típicamente aquí irán:
            - <AppSidebar /> (el sidebar)
            - <AppContent /> (el contenido principal)
        -->
        <slot />
    </SidebarProvider>
</template>
