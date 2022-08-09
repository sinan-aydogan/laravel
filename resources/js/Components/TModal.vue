<script setup>
import { ref } from "vue"
import { onClickOutside } from '@vueuse/core'
defineProps({
    modelValue: Boolean,
    title: String
})

const emit = defineEmits(['update:modelValue'])

const target = ref(null)

onClickOutside(target, (event) => emit('update:modelValue', false))
</script>
<template>
    <!-- Wrapper -->
    <div class="modal-wrapper" v-if="modelValue">
        <!-- Modal -->
        <div class="modal" ref="target">
            <!-- Title -->
            <div v-if="title">
                <h3 class="text-xl font-semibold mb-4">
                    {{ title }}
                </h3>
            </div>
            <!-- Close Button -->
            <font-awesome-icon @click="$emit('update:modelValue', false)" icon="fa-solid fa-xmark"
                mask="fa-solid fa-circle" transform="shrink-4" size="xl" class="modal-close-btn" />
            <slot />
        </div>
    </div>
</template>
