<script setup>

import { computed } from "vue"
import { Link } from '@inertiajs/inertia-vue3'
import { useStore } from "@/stores/useMenu.js"
import { storeToRefs } from "pinia"

const menu = useStore();
const { activeLink, showMenu } = storeToRefs(menu)

const props = defineProps({
    item: Object,
    subLink: Boolean
})

const itemType = computed(() => {
    let elementType;
    if (props.item.type === 'dropdown') {
        elementType = 'div'
    } else if (props.item.type === 'link') {
        elementType = 'a'
    } else {
        elementType = Link
    }

    return elementType
})
const isCurrent = computed(() => {
    let status;

    if (props.item.type === 'route') {
        status = route().current(props.item.link)
    }
    return status
});

const itemLink = computed(() => {
    let link;

    if (props.item.type === 'link') {
        link = props.item.link
    } else if (props.item.type === 'route') {
        link = route(props.item.link)
    }

    return link
})
</script>

<template>
    <component :is="itemType" :href="itemLink" :target="item['target']" @click="menu.setActiveLink(item.id)"
        class="flex justify-between items-center" :class="[
            subLink ? '' : 'px-4 py-2 hover:bg-sky-500 cursor-pointer',
            isCurrent ? 'bg-sky-500' : '',
            activeLink === item.id ? 'bg-sky-500' : ''
        ]">
        <!-- Link Info -->
        <div class="flex space-x-4 items-center cursor-pointer" :class="[
            subLink ? 'pl-8 py-2 hover:bg-sky-500/50 w-full' : ''
        ]">
            <!-- Icon -->
            <font-awesome-icon v-if="item['icon']" :icon="item.icon" />
            <!-- Label -->
            <span v-text="item.label" />
        </div>
        <!-- Dropdown Icon -->
        <font-awesome-icon v-if="item['items']" icon="fa-soli fa-chevron-down" />
    </component>
</template>
