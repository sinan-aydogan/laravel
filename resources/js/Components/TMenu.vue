<script setup>
import { ref, onMounted } from "vue"
import Menu from "@/sources/menu.js"
import TMenuItem from "@/Components/TMenuItem.vue";
import { useStore } from "@/stores/useMenu.js"
import { storeToRefs } from "pinia"

const menu = useStore();
const { activeLink, showMenu } = storeToRefs(menu)

const { links } = Menu()

onMounted(() => {
    let current = route().current()

    links.value.find(i => {
        if (i.link === current) {
            menu.setActiveLink(i.id)
        }

        if (i['items']) {
            i.items.find(j => {
                if (j.link === current) {
                    menu.setActiveLink(j.id.split('-')[0])
                }
            })
        }
    })

})
</script>

<template>
    <!-- Menu Wrapper -->
    <div class="flex flex-col flex-shrink-0 bg-slate-800 w-[16rem] text-slate-100 border-r dark:border-slate-400/50 transition-all duration-300"
        :class="showMenu ? 'ml-0' : '-ml-[16rem]'">
        <!-- Logo -->
        <div class="flex justify-center items-center h-16">
            <span class="text-xl">
                Jetstream Eğitimi
            </span>
        </div>

        <!-- Menu -->
        <div class="flex flex-col space-y-2 flex-grow mt-10 overflow-y-auto">
            <!-- Root Links -->
            <template v-for="root in links">
                <t-menu-item :item="root" />

                <!-- Sub Links -->
                <div v-if="root['items'] && activeLink === root.id" class="space-y-2 bg-slate-500/25">
                    <template v-for="sub in root.items">
                        <t-menu-item :item="sub" sub-link />
                    </template>
                </div>
            </template>
        </div>
        <!-- User Info -->
        <div class="flex items-center bg-slate-800/50 h-16 px-4 space-x-4">
            <!-- Avatar -->
            <img src="https://i.pravatar.cc/150" class="w-10 h-10 rounded-full" />
            <!-- User Info -->
            <div class="flex space-x-4 items-center">
                <span class="font-semibold">Sinan AYDOĞAN</span>
                <font-awesome-icon icon="fa-solid fa-right-from-bracket" class="hover:text-rose-500 cursor-pointer" />
            </div>
        </div>
    </div>
</template>
