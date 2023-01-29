<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TTable from "@/Components/TTable.vue";

defineProps({
    stockCards: Object
})

const headers = [
    {
        id: 'product',
        label: 'Ürün'
    },
    {
        id: 'warehouse',
        label: 'Depo'
    },
    {
        id: 'quantity',
        label: 'Miktar'
    }
]
</script>

<template>
    <visitor-layout>
        <t-table :data="stockCards" :headers="headers">

            <!--Warehouse-->
            <template #warehouse="{props}">
                <p v-if="props.warehouse.hasOwnProperty('name')" v-text="props.warehouse.name"></p>
            </template>

            <!--Product-->
            <template #product="{props}">
                <p v-if="props.product.hasOwnProperty('name')" v-text="props.product.name"></p>
            </template>
        </t-table>
    </visitor-layout>
</template>
