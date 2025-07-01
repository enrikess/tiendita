<script setup lang="ts">
import { Head, usePage } from '@inertiajs/vue3';
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import ProveedorForm from '@/components/Proveedores/ProveedorForm.vue';
import { router } from '@inertiajs/vue3';
import { computed, defineProps, onMounted } from 'vue';
import { useToast } from "vue-toastification";

const toast = useToast();

const props = defineProps({
  proveedor: {
    type: Object,
    default: () => {}
  },
  isEditing: {
    type: Boolean,
    default: true
  },
  errors: {
    type: Object,
    default: () => ({})
  }
});

console.log(props.proveedor,"editar");

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Proveedores',
        href: '/compras/proveedores',
    },
    {
        title: 'Editar',
        href: `/compras/proveedores/${props.proveedor.id}/edit`,
    },
];


// Accede a los errores de validación
const errors = computed(() => usePage().props.errors);

const handleSubmit = (formData: any) => {

    router.put(route('compras.proveedores.update', props.proveedor.id), formData);

};

const handleCancel = () => {
    router.get(route('compras.proveedores.index'));  // Este método ya está correcto
};
</script>

<template>
    <Head title="Crear proveedor" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="flex h-full flex-1 flex-col gap-6  bg-white dark:bg-gray-900 p-6 shadow">
            <!-- Eliminamos el bloque de errores generales y pasamos los errores al formulario -->
            <ProveedorForm
            :proveedor="proveedor"
            :isEditing="true"
            @submit="handleSubmit"
            @cancel="handleCancel"
              :errors="errors"
            />
        </div>
    </AppLayout>
</template>

