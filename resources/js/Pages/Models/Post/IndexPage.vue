<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
defineProps({
    header: String
})
</script>

<template>
    <visitor-layout :header="header"></visitor-layout>
</template>
