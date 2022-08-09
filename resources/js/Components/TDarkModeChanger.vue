<script setup>
import { useDark, useToggle } from '@vueuse/core'
const isDark = useDark({
    selector: 'html',
    attribute: 'class',
    valueDark: 'dark',
    valueLight: 'light',
})
const toggleDark = useToggle(isDark)
</script>
<template>
    <font-awesome-icon size="lg" @click="toggleDark()" :icon="'fa-solid ' + (isDark ? 'fa-sun' : 'fa-moon')"
        class="cursor-pointer select-none hover:scale-110 active:scale-90 transition"
        :class="isDark ? 'text-amber-500' : 'text-slate-700'" />
</template>
