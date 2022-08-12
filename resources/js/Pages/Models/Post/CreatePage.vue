<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
import TButton from "@/Components/TButton.vue";

defineProps({
    header: String
})
</script>

<template>
    <visitor-layout :header="header">

        <template #actionArea>
            <t-button label="Yazı Listesine Geri Dön" icon="fa-solid fa-left-long" :link="route('post.index')" />
        </template>
    </visitor-layout>
</template>
