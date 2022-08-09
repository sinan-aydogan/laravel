<script setup>
import TButton from "@/Components/TButton.vue"

defineProps({
    title: String,
    subTitle: String,
})
</script>

<template>
    <form @submit.prevent="$emit('submitted')">
        <!-- Header -->
        <div class="leading-3 mb-4">
            <!-- Title -->
            <h3 class="text-lg font-semibold">
                {{ title }}
            </h3>
            <!-- Sub-title -->
            <span class="text-xs text-slate-500">
                {{ subTitle }}
            </span>
        </div>
        <!-- Content -->
        <div class="grid grid-cols-6 gap-4">
            <slot />
        </div>
        <!-- Action Buttons Area -->
        <div class="mt-4">
            <slot v-if="$slots.hasOwnProperty('footer')" name="footer" />
            <div v-else class="flex justify-end space-x-2">
                <!-- Reset -->
                <t-button :label="t('command.reset')" @click.prevent="$emit('reset')" />
                <!-- Save -->
                <t-button :label="t('command.submit')" color="green" />
            </div>
        </div>
    </form>
</template>
