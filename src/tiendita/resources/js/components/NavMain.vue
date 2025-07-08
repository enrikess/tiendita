<!-- NavMain.vue -->
<script setup lang="ts">
import { computed, ref } from 'vue';
import { Link, router } from '@inertiajs/vue3';
import { type NavItem } from '@/types';
import { ChevronDown } from 'lucide-vue-next';
import { usePage } from '@inertiajs/vue3';
import { onMounted } from 'vue';

const props = defineProps<{
  items: NavItem[];
}>();

// Objeto para rastrear qué submenús están abiertos
const openSubmenus = ref<Record<string, boolean>>({});

// Función para alternar un submenú
const toggleSubmenu = (title: string) => {
    //console.log(openSubmenus.value[title]);
    openSubmenus.value[title] = !openSubmenus.value[title];
};

// Comprobar si una ruta está activa
const isActive = (href: string) => {
    if (!href) return false;
    // Obtener la URL actual
    const currentUrl = usePage().url;

    // ✅ Separar la ruta base de los query parameters
    const currentPath = currentUrl.split('?')[0]; // /compras/estado_compras
    const hrefPath = href.split('?')[0]; // /compras/estado_compras

    // Dividir las URLs en segmentos (sin query params)
    const currentSegments = currentPath.split('/').filter(Boolean);
    const hrefSegments = hrefPath.split('/').filter(Boolean);


    // Si es la raíz ("/")
    if (hrefPath === '/' || hrefPath === '') {
        return currentUrl === '/' || currentUrl === '';
    }

    // ✅ Comparación exacta de rutas (sin query params)
    if (currentPath === hrefPath) {
        return true;
    }

    // Para enlaces de primer nivel, verificar si coinciden los primeros segmentos
    if (hrefSegments.length > 0 && currentSegments.length > 0) {
        // Primero compara el primer segmento para destacar el menú principal
        if (currentSegments[0] === hrefSegments[0]) {
            // Si es una URL de menú principal sin subdirectorios
            if (hrefSegments.length === 1) {
                return true;
            }
            if (hrefSegments.length === 2) {
                // Si hay más segmentos, verificar si el segundo segmento coincide
                return currentSegments.length >= 2 && currentSegments[1] === hrefSegments[1];
            }
        }
    }
    return false;
};

onMounted(() => {
  props.items.forEach(item => {
    if (item.children && item.children.some(child => isActive(child.href))) {
      openSubmenus.value[item.title] = true;
    }
  });
});
</script>
<button style="

"></button>
<template>
  <div class="space-y-1">
    <div v-for="(item, index) in items" :key="index">
      <!-- Item con submenú -->
      <div v-if="item.children && item.children.length" class="menu-item">
        <button
          @click="toggleSubmenu(item.title)"
          class="w-full flex items-center px-3 py-2 text-sm font-medium rounded-md"
          :class="[
            isActive(item.href || '') ?
              'bg-primary/10 text-primary font-medium' :
              'text-muted-foreground hover:bg-muted hover:text-foreground'
          ]"
        >
          <component :is="item.icon" class="h-5 w-5 mr-2" />
          <span>{{ item.title }}</span>
          <ChevronDown
            class="ml-auto h-4 w-4 transition-transform"
            :class="{ 'rotate-180': openSubmenus[item.title] }"
          />
        </button>

        <!-- Submenú -->
        <div
          v-if="openSubmenus[item.title]"
          class="pl-8 mt-1 space-y-1"
        >
          <Link
            v-for="(subItem, subIndex) in item.children"
            :key="subIndex"
            :href="subItem.href"
            class="flex items-center px-3 py-2 text-sm rounded-md"
            :class="[
              isActive(subItem.href) ?
                'bg-primary/10 text-primary font-medium' :
                'text-muted-foreground hover:bg-muted hover:text-foreground'
            ]"
          >
            <component :is="subItem.icon" class="h-4 w-4 mr-2" v-if="subItem.icon" />
            {{ subItem.title }}
          </Link>
        </div>
      </div>

      <!-- Item sin submenú -->
      <Link
        v-else
        :href="item.href || ''"
        class="flex items-center px-3 py-2 text-sm font-medium rounded-md"
        :class="[
          isActive(item.href || '') ?
            'bg-primary/10 text-primary font-medium' :
            'text-muted-foreground hover:bg-muted hover:text-foreground'
        ]"
      >
        <component :is="item.icon" class="h-5 w-5 mr-2" />
        {{ item.title }}
      </Link>
    </div>
  </div>
</template>
