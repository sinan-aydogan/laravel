<script setup>
import { inject } from "vue"

const mesaj = inject('mesaj')

defineProps({
    title: String,
    modelValue: String
})
</script>

<template>
    <div class="flex flex-col border p-2 rounded-lg">
        <!-- header -->
        <div class="mb-4" @click="$emit('update:modelValue', 'Yaz Geldi')">
            <h3 class="font-bold">
                <span v-text="modelValue"></span>
                <slot name="title" />
            </h3>
        </div>
        <!-- Content -->
        <div class="mb-4">
            <slot name="description" />
        </div>
        <!-- Footer -->
        <div class="flex justify-end mr-4">
            <slot name="footer" />
        </div>
    </div>
</template>
