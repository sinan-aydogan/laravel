<script setup>
defineProps({
    id: String,
    label: String,
    errors: {
        type: [Object, Array],
        default: () => []
    },
    modelValue: [String, Number, Date],
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
            <input type="text" class="input" :value="modelValue"
                @input="$emit('update:modelValue', $event.target.value)" :class="icon ? 'pl-10' : ''" />
            <!-- Clearable Button -->
            <div v-if="modelValue && clearable" class="absolute right-3 top-2.5 cursor-pointer"
                @click="$emit('update:modelValue', '')">
                <font-awesome-icon icon="fa-solid fa-xmark" transform="shrink-2" mask="fa-solid fa-circle" />
            </div>
        </div>
        <!-- Error -->
        <div v-if="errors.length > 0 || $page.props.errors[id]" class="flex flex-col">
            <!-- Frontend Errors -->
            <div v-if="errors.length > 0">
                <template v-for="i in errors">
                    <span class="input-error">
                        {{ i.hasOwnProperty('$message') ? i.$message : i }}
                    </span>
                </template>
            </div>

            <!-- Backend Error -->
            <span v-else v-text="$page.props.errors[id]" class="input-error"></span>
        </div>
    </div>
</template>
