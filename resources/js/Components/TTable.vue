<script setup>
import { computed } from "vue"
import { Link } from "@inertiajs/inertia-vue3"
const props = defineProps({
    data: [Array, Object],
    headers: [Array, Object]
})

const tableData = computed(() => {
    if (props.data.hasOwnProperty('data')) {
        return props.data.data
    } else {
        return props.data
    }
})
</script>

<template>
    <!-- TODO: current_page, first_page_url, links, next_page_url, per_page, prev_page_url, to, total-->
    <!-- Table -->
    <div class="flex w-full">
        <table class="w-full">
            <!-- Header -->
            <thead>
                <!-- Columns -->
                <template v-for="i in headers">
                    <th class="bg-slate-200 first:rounded-tl-lg last:rounded-tr-lg p-2">
                        {{ i.label }}
                    </th>
                </template>
            </thead>
            <tbody>
                <!-- Record -->
                <template v-for="row in tableData">
                    <tr class="odd:bg-slate-300 group">
                        <!-- Columns -->
                        <template v-for="column in headers">
                            <td class="p-2 group-last:first:rounded-bl-lg group-last:last:rounded-br-lg">
                                {{ row[column.id] }}
                            </td>
                        </template>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
    <!-- Paginate -->
    <div v-if="data.hasOwnProperty('data')" class="flex space-x-1 justify-center items-center mt-4 mb-2">
        <template v-for="i in data.links">
            <Link :href="i.url"
                class="flex border rounded-md min-w-[1.5rem] h-7 justify-center items-center p-2 hover:bg-blue-500/25 hover:border-blue-500 hover:text-blue-500"
                :class="i.active ? 'bg-blue-500 text-white border-transparent' : ''">
            <span v-html="i.label"></span>
            </Link>
        </template>
    </div>
</template>
