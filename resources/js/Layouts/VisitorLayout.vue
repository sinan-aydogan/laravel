<script setup>
import { ref, onUpdated, onMounted, watch } from "vue";
import { Head, Link, usePage } from "@inertiajs/inertia-vue3";
import { useI18n } from "vue-i18n";
import Langs from "../Langs/langs";
import { Inertia } from "@inertiajs/inertia";
import TDarkModeChanger from "@/Components/TDarkModeChanger.vue";
import TMenu from "@/Components/TMenu.vue";
import { useStore } from "@/stores/useMenu.js"
import { useNotification } from "@/stores/useNotification.js";
import TNotification from "@/Components/TNotification.vue"

const menu = useStore();

const { t, locale } = useI18n();
const { langs } = Langs();

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
    header: String,
});

// Notification
const notification = useNotification();

const addNotification = () => {
    let message = usePage().props.value.flash.message

    if (message) {
        notification.add({
            type: message.type,
            content: message.content,
            _token: message._token
        })
    }

}

const showLangs = ref(false);

const updateLang = () => {
    if (usePage().props.value.lang) {
        locale.value = usePage().props.value.lang
    }
}

onMounted(() => {
    addNotification();
    updateLang();
})
onUpdated(() => {
    // addNotification();
    updateLang();
})

/*Tracking Flash Notification*/
watch(()=>usePage().props.value.flash.message,()=>{
    addNotification()
})

const changeLang = (lang) => {
    locale.value = lang;
    showLangs.value = false;
    Inertia.post(route('update-lang'), {
        lang: lang
    })
};


</script>

<template>

    <Head title="Welcome" />

    <!-- Container -->
    <div class="flex w-screen h-screen bg-slate-200 dark:bg-slate-600 overflow-hidden">
        <!-- SideBar -->
        <t-menu />
        <!-- Content Wrapper -->
        <div class="flex flex-col w-full overflow-y-scroll text-slate-700 dark:text-slate-100">
            <!-- Top Bar -->
            <div
                class="flex justify-between bg-white dark:bg-slate-800 w-full h-16 items-center p-4 dark:text-slate-100">
                <!-- Search -->
                <div class="flex space-x-4 items-center">
                    <!-- Menu Toggle -->
                    <font-awesome-icon icon="bars" size="xl" class="cursor-pointer" @click="menu.toggleMenu()" />
                    <input type="text"
                        class="hidden md:block border dark:border-transparent border-slate-300 bg-slate-100 rounded-lg dark:bg-slate-500" />
                </div>
                <div class="flex items-center space-x-4">
                    <!-- Auth Links -->
                    <div v-if="!$page.props.user">
                        <Link :href="route('login')" class="underline">
                        {{ $t("auth.login") }}
                        </Link>

                        <Link v-if="canRegister" :href="route('register')" class="ml-4 underline">
                        {{ $t("auth.register") }}
                        </Link>
                    </div>

                    <!-- Dil değiştirme -->
                    <div class="relative">
                        <span @click="showLangs = true" v-text="$t('langs.' + locale)"></span>
                        <div v-if="showLangs" class="absolute flex flex-col">
                            <template v-for="i in langs">
                                <span class="p-2 border cursor-pointer" @click="changeLang(i.id)" v-if="locale !== i.id"
                                    v-text="$t('langs.' + i.id)"></span>
                            </template>
                        </div>
                    </div>

                    <!-- Dark Mode Changer -->
                    <t-dark-mode-changer />
                </div>
            </div>
            <!-- Header -->
            <div class="flex justify-between items-center p-4 dark:bg-white/10">
                <!-- Header Text -->
                <span class="text-xl font-semibold">
                    <slot v-if="$slots.hasOwnProperty('header')" name="header" />
                    <span v-else v-text="header" />
                </span>

                <!-- Action Area -->
                <div class="flex justify-end space-x-2">
                    <slot name="actionArea" />
                </div>
            </div>
            <!-- Content -->
            <div class="p-4 bg-white dark:bg-slate-600">
                <slot />
            </div>
        </div>
    </div>

    <!-- Notification -->
    <teleport to="body">
        <t-notification />
    </teleport>
</template>
