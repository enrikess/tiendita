<script setup lang="ts">
import { defineProps, defineEmits, ref, watch } from 'vue';


const props = defineProps<{
  perPage: number
  options: number[]
}>();


const emit = defineEmits<{
    (e: 'update:perPage', value: number): void
}>();

const localPerPage = ref(props.perPage);


watch(localPerPage, (nuevo) => {
  emit('update:perPage', nuevo);
});
watch(() => props.perPage, (nuevo) => {
  localPerPage.value = nuevo;
});


</script>

<template>
  <select v-model="localPerPage">
    <option v-for="opt in options" :key="opt" :value="opt">{{ opt }}</option>
  </select>
</template>
