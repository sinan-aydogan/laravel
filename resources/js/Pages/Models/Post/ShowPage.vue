<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
import { Inertia } from "@inertiajs/inertia";
import TButton from "@/Components/TButton.vue";

defineProps({
    header: String,
    post: String
})

const handleDelete = (id) => {
    Inertia.delete(route('post.destroy', id))
}
</script>

<template>
    <visitor-layout :header="header">

        <template #actionArea>
            <t-button label="Düzenle" color="blue" icon="fa-solid fa-pen-to-square"
                :link="route('post.edit', post.id)" />
            <t-button label="Sil" color="red" icon="fa-solid fa-trash" @click="handleDelete(post.id)" />
        </template>
        <div class="flex flex-col space-y-4">
            <!-- Code -->
            <div class="flex space-x-2">
                <span class="font-semibold">Code:</span>
                <span v-text="post.code"></span>

                <!-- Status -->
                <div>
                    <span class="px-4 py-2 rounded-lg" :class="{
                        'text-emerald-600 bg-emerald-100': post.status,
                        'text-rose-600 bg-rose-100': !post.status
                    }">
                        {{ post.status ? 'Yayında' : 'Yayında Değil' }}
                    </span>
                </div>
            </div>
            <!-- Summary -->
            <div class="space-x-2">
                <span class="font-semibold">Özet:</span>
                <span v-text="post.summary"></span>
            </div>
            <!-- Authors -->
            <div>
                <template v-for="i in post.authors">
                    <div class="
                flex
                space-x-2
                items-center
                border
                px-4
                py-2
                first:rounded-t-lg
                last:rounded-b-lg
                ">
                        <font-awesome-icon icon="fa-solid fa-user" />
                        <span>{{ i.name }}</span>
                    </div>
                </template>
            </div>
        </div>
    </visitor-layout>
</template>
