<script setup>
import { Link } from '@inertiajs/inertia-vue3'
defineProps({
    label: String,
    link: String,
    design: {
        type: String,
        default: 'solid'
    },
    color: {
        type: String,
        default: 'blue'
    },
    icon: String
})
</script>

<template>
    <component @click="$emit('clicked')" :is="link ? Link : 'button'" :href="link" class="btn" :class="[
        'btn-' + design,
        'btn-' + color
    ]">
        <!-- Icon -->
        <div v-if="icon || $slots.hasOwnProperty('icon')">
            <slot v-if="$slots.hasOwnProperty('icon')" name="icon" />
            <font-awesome-icon v-else :icon="icon" />
        </div>
        <!-- Label -->
        <div v-if="label || $slots.hasOwnProperty('label')">
            <slot v-if="$slots.hasOwnProperty('label')" name="label" />
            <span v-text="label" />
        </div>
    </component>
</template>
