<script setup>
import { ref } from "vue"
import { Inertia } from '@inertiajs/inertia';
import { onClickOutside } from '@vueuse/core'

const target = ref(null)

onClickOutside(target, (event) => searchText.value = '')

const props = defineProps({
    model: String,
    selectedModel: String,
    modelValue: Array,
    data: Array,
    selectedData: Array,
    labelKey: {
        type: String,
        default: 'name'
    },
    valueKey: {
        type: String,
        default: 'id'
    }
})

const searchText = ref('');

const selectItem = (id) => {

    if (props.modelValue.includes(id)) {
        let index = props.modelValue.findIndex(i => i === id)
        props.modelValue.splice(index, 1)
    } else {
        props.modelValue.push(id)
    }

    Inertia.reload({
        method: 'post',
        data: {
            selected: props.modelValue
        },
        only: [props.selectedModel],
    })
}

const handleSearch = () => {
    Inertia.reload({
        data: {
            searchText: searchText.value
        },
        only: [props.model]
    })
}
</script>

<template>
    <div class="relative flex flex-col">
        <!-- Input -->
        <input v-model="searchText" @input="handleSearch" type="text" class="border-slate-300 rounded-lg w-full pl-8" />

        <!-- Search Icon -->
        <font-awesome-icon icon="fa-solid fa-magnifying-glass" class="absolute mt-3 ml-3 text-slate-400" />

        <!-- Data List -->
        <div v-if="searchText" class="absolute z-10 bg-white mt-10 flex flex-col border rounded-lg min-w-[15rem]"
            ref="target">
            <template v-for="(i, index) in data">
                <div v-if="10 > index" @click="selectItem(i[valueKey])"
                    class="flex justify-between p-2 border-b last:border-b-0">
                    <span v-text="i[labelKey]"></span>
                    <div>
                        <font-awesome-icon icon="fa-solid fa-check" mask="fa-solid fa-circle" transform="shrink-3"
                            :class="modelValue.includes(i[valueKey]) ? 'text-emerald-500' : 'text-slate-400'" />
                    </div>
                </div>
            </template>
        </div>

        <!-- Selected Items -->
        <div class="flex gap-2 mt-2">
            <template v-for="i in selectedData">
                <div class="flex items-center space-x-2 border p-2 rounded-lg">
                    <span class="text-sm" v-text="i[labelKey]"></span>
                    <font-awesome-icon @click="selectItem(i[valueKey])" icon="fa-solid fa-xmark"
                        mask="fa-solid fa-circle"
                        class="text-rose-500 cursor-pointer hover:scale-110 active:scale-90 transition"
                        transform="shrink-3" />
                </div>
            </template>
        </div>
    </div>
</template>
