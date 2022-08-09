<script setup>
defineProps({
    id: {
        type: String,
        default: () => {
            let i = new Date().getTime()

            return i.toString()
        }
    },
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
    icon: String,
    clearable: Boolean
})
</script>

<template>

    <div class="input-wrapper">
        <!-- Label -->
        <span class="input-label">{{ label }}</span>
        <!-- Input -->
        <div class="relative flex items-center space-x-2 min-h-[2.5rem]">

            <!-- Icon -->
            <font-awesome-icon v-if="icon" :icon="icon" class="absolute left-3 top-3" />
            <!-- Input--->
            <template v-for="i in options">
                <input type="radio" class="input-radio" :id="i[valueKey]"
                    :checked="modelValue === i[valueKey] ? 'selected' : null"
                    @change="$emit('update:modelValue', $event.target.id)" :name="id" />
                <!-- Label -->
                <label>{{ i[labelKey] }}</label>
            </template>

            <!-- Clearable Button -->
            <div v-if="modelValue && clearable" class="absolute right-3 top-2.5 cursor-pointer"
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
