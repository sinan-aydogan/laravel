<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
import TTable from "@/Components/TTable.vue";
import TButton from "@/Components/TButton.vue";
import { Inertia } from "@inertiajs/inertia";

defineProps({
    header: String,
    postList: Object
})

// Table
const headers = [
    {
        id: 'name',
        label: 'Yazı Başlığı'
    },
    {
        id: 'status',
        label: 'Durum'
    },
    {
        id: 'action',
        label: 'Aksiyon'
    }
]

// Delete
const handleDelete = (id) => {
    Inertia.delete(route('post.destroy', id), {
        onBefore: visit => confirm("Öğe silinecektir, emin misiniz?"),
    })
}
</script>

<template>
    <visitor-layout :header="header">

        <template #actionArea>
            <t-button label="Yeni Yazı Ekle" icon="plus" color="green" :link="route('post.create')" />
        </template>
        <t-table :data="postList" :headers="headers">
            <template #status="{ props }">
                <div class="flex justify-center">
                    <font-awesome-icon :icon="'fa-solid ' + (props.status ? 'fa-check' : 'fa-xmark')"
                        mask="fa-solid fa-circle" transform="shrink-2"
                        :class="props.status ? 'text-emerald-500' : 'text-rose-500'" />
                </div>
            </template>

            <template #action="{ props }">
                <div class="flex space-x-2 justify-center">
                    <t-button icon="fa-solid fa-trash" color="red" @click="handleDelete(props.id)" />
                    <t-button icon="fa-solid fa-pen-to-square" color="blue" :link="route('post.edit', props.id)" />
                    <t-button icon="fa-solid fa-eye" color="slate" :link="route('post.show', props.id)" />
                </div>
            </template>
        </t-table>
    </visitor-layout>
</template>
