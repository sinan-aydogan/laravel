<script setup>
import { inject } from "vue"
const mesaj = inject('mesaj')

</script>

<template>
    <div @click="$emit('mesaj', mesaj)" class="bg-green-500 text-white p-2 rounded-lg">
        Ben <b>A</b> komponentiyim
    </div>
</template>
