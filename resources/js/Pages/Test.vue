<script setup>
import { provide, ref } from "vue"
import TA from "@/Components/TA.vue"

const mesaj = ref('Merhaba Dünya Biz Dostuz');
provide('mesaj', mesaj)
const bildirim = (mesaj) => {
    alert(mesaj)
}
</script>
<template>
    <t-content-card @tiklama="bildirim($event)" v-model="mesaj">
    </t-content-card>
</template>
