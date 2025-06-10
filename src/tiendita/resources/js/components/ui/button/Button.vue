<script setup lang="ts">
import type { HTMLAttributes } from 'vue'
import { cn } from '@/lib/utils'
import { Primitive, type PrimitiveProps } from 'reka-ui'
import { type ButtonVariants, buttonVariants } from '.'

interface Props extends PrimitiveProps {
  variant?: ButtonVariants['variant']
  size?: ButtonVariants['size']
  class?: HTMLAttributes['class']
}

const props = withDefaults(defineProps<Props>(), {
  as: 'button',
})

// Definimos los eventos que este componente puede emitir
const emit = defineEmits(['click', 'hover', 'focus', 'blur'])

// Manejadores de eventos que emitirán al componente padre
const handleClick = (event: MouseEvent) => {
  emit('click', event)
}

const handleHover = (event: MouseEvent) => {
  emit('hover', event)
}

const handleFocus = (event: FocusEvent) => {
  emit('focus', event)
}

const handleBlur = (event: FocusEvent) => {
  emit('blur', event)
}
</script>

<template>
  <Primitive
    data-slot="button"
    :as="as"
    :as-child="asChild"
    :class="cn(buttonVariants({ variant, size }), props.class)"
    @click="handleClick"
    @mouseover="handleHover"
    @focus="handleFocus"
    @blur="handleBlur"
  >
    <slot />
  </Primitive>
</template>
