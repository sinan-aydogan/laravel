<script setup>
defineProps({
    label: String,
    errors: [Object, Array],
    modelValue: [String, Number, Date, Boolean],
    options: [Array, Object],
    valueKey: {
        type: String,
        default: 'id'
    },
    labelKey: {
        type: String,
        default: 'label'
    },
    placeholder: {
        type: String,
        default: 'Seçiniz'
    },
    icon: String,
    clearable: Boolean
})
</script>

<template>

    <div class="input-wrapper">
        <!-- Label -->
        <label class="input-label">{{ label }}</label>
        <!-- Input -->
        <div class="relative">

            <!-- Icon -->
            <font-awesome-icon v-if="icon" :icon="icon" class="absolute left-3 top-3" />
            <!-- Input--->
            <select class="input" @change="$emit('update:modelValue', $event.target.value)" placeholder="selam">
                <option value="" class="text-slate-400">{{ placeholder }}</option>
                <!-- Options -->
                <template v-for="i in options">
                    <option :value="i[valueKey]" :selected="modelValue === i[valueKey] ? 'selected' : null">{{
                            i[labelKey]
                    }}</option>
                </template>
            </select>
            <!-- Clearable Button -->
            <div v-if="modelValue && clearable" class="absolute right-8 top-2.5 cursor-pointer"
                @click="$emit('update:modelValue', '')">
                <font-awesome-icon icon="fa-solid fa-xmark" transform="shrink-2" mask="fa-solid fa-circle" />
            </div>
        </div>
        <!-- Error -->
        <div v-if="errors">
            <template v-for="i in errors">
                <span class="input-error">
                    {{ i }}
                </span>
            </template>
        </div>
    </div>
</template>
