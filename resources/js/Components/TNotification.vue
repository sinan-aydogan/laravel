<script setup>
import { useNotification } from "@/stores/useNotification.js";
import TNotification from "@/Components/TNotification.vue"
import { storeToRefs } from "pinia";

// Notification
const notification = useNotification();

const { notifications } = storeToRefs(notification)

const notificationStyle = {
    info: 'bg-sky-500/90 dark:bg-sky-900/95 dark:border dark:border-sky-500',
    success: 'bg-emerald-500/90 dark:bg-emerald-900/95 dark:border dark:border-emerald-500',
    danger: 'bg-rose-500/90 dark:bg-rose-900/95 dark:border dark:border-rose-500',
    warning: 'bg-amber-500/90 dark:bg-amber-900/95 dark:border dark:border-amber-500',
    default: 'bg-slate-500/90 dark:bg-slate-900/95 dark:border dark:border-slate-500',
}
</script>

<template>
    <div class="fixed right-0 bottom-0">
        <!-- Body -->
        <transition-group name="fade">
            <template v-for="i in notifications" :key="i.id">
                <div v-if="i.id === i._token" class="relative flex mr-10 mb-8 p-4 rounded-lg text-white select-none"
                    :class="notificationStyle[i.type]">
                    <!-- Message -->
                    <span v-text="i.content"></span>
                    <!-- Delete Button -->
                    <font-awesome-icon @click="notification.delete(i)" icon="fa-solid fa-xmark"
                        mask="fa-solid fa-circle" transform="shrink-2"
                        class="absolute -top-2 -right-2 cursor-pointer hover:scale-110 active:scale-90 transition"
                        size="lg" />
                </div>
            </template>
        </transition-group>
    </div>
</template>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: all 500ms ease-in-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
    transform: translateY(30px);
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
    transform: translateY(0);
}
</style>
