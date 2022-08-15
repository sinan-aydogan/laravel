<script setup>
const props = defineProps({
    label: String,
    errors: [Object, Array],
    modelValue: [Array, Object],
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

const emit = defineEmits(['update:modelValue'])

const addValue = (value) => {
    let i = props.modelValue

    if (!i.includes(value)) {
        i.push(value)
    } else {
        i.splice(i.findIndex(item => item === value), 1)
    }

    emit('update:modelValue', i)
}
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
                <input type="checkbox" class="input-checkbox" :class="icon ? 'pl-10' : ''"
                    :checked="modelValue.includes(i[valueKey])" :value="modelValue" @change="addValue(i[valueKey])"
                    :name="i[valueKey]" />
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
                    {{ i.hasOwnProperty('$message') ? i.$message : i }}
                </span>
            </template>
        </div>
    </div>
</template>
