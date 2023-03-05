<script setup>
import { ref } from "vue";

const props = defineProps({
    id: String,
    label: String,
    selectable: {
        type: Boolean,
        default: false
    }
});

const emit = defineEmits(['clicked'])

const selected = ref(false)
const toggle = ()=>{
    selected.value = !selected.value
    emit('clicked', props.id)
}
</script>

<template>
    <div
        class="border rounded-lg p-1  w-fit"
        :class="[
            {'bg-slate-200/50': !selectable || (selectable && !selected)},
            {'cursor-pointer' : selectable},
            {'bg-green-200' : (selectable && selected)}
        ]"
        @click="toggle"
    >
        <span v-if="label" v-text="label"></span>
        <span v-else>
            <slot></slot>
        </span>
    </div>
</template>
