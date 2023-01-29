<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TTable from "@/Components/TTable.vue";
import TModal from "@/Components/TModal.vue";
import TButton from "@/Components/TButton.vue";
import { computed, ref, watch } from "vue";
import TTextInput from "@/Components/TTextInput.vue";
import TSelectInput from "@/Components/TSelectInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { helpers, required, minValue } from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";

defineProps({
    transactions: Object,
    products: Array,
    warehouses: Array
})

const headers = [
    {
        id: 'type',
        label: 'İşlem Türü'
    },
    {
        id: 'quantity',
        label: 'Miktar'
    },
    {
        id: 'product',
        label: 'Ürün'
    },
    {
        id: 'warehouse',
        label: 'Depo'
    }
]

/*Type*/
const types = [
    {
        id: 'incoming',
        label: 'Malzeme Girişi'
    },
    {
        id: 'outgoing',
        label: 'Malzeme Çıkışı'
    }
]

/*Modal*/
const modalType = ref('create')
const showModal = ref(false)
const modalTexts = computed(()=>{
    switch (modalType.value){
        case 'create':
            return {
                title: 'Yeni Ürün Oluştur',
                button: form.processing ? 'Oluşturuluyor' : 'Oluştur'
            };
        case 'update':
            return {
                title: 'Ürünü Güncelle',
                button: form.processing ? 'Güncelleniyor' : 'Güncelle'
            };
        case 'delete':
            return {
                title: 'Ürünü Sil',
                button: form.processing ? 'Siliniyor' : 'Sil'
            };
    }
})

/*Form*/
const form = useForm({
    product_id: null,
    warehouse_id: null,
    quantity: 0,
    type: 'incoming'
})
const rules = ref({
    product_id: { required: helpers.withMessage('Ürün gereklidir', required) },
    warehouse_id: { required: helpers.withMessage('Depo gereklidir', required) },
    quantity: { minValue: helpers.withMessage('İşlem miktarı gereklidir', minValue(1)) },
    type: { required: helpers.withMessage('İşlem türü gereklidir', required) },
})

const v$ = useVuelidate(rules, form)

/*Select Row*/
const selectedRow = ref({});
const selectRow = (row)=>{
    showModal.value = true
    selectedRow.value = row
    form.id = row.id
    form.name = row.name
}

const checkModal = () => {
    if(!form.hasErrors){
        showModal.value = false;
        form.reset()
        v$.value.$reset()
        deleteImage()
    }
}

/*Submit*/
const handleSubmit = async ()=>{
    const isValidated = await v$.value.$validate()

    if (!isValidated) return



    if(modalType.value === 'create'){
        /*Create*/
        form.post(route('product.store'), {
            onSuccess: () => {
                checkModal()
            },
        });
    }else{
        /*Update*/
        form.put(route('product.update',{'id' : form.id}), {
            onSuccess: () => {
                checkModal()
            },
        });
    }
}

/*Watch showModal*/
watch(showModal, ()=>{
    if(!showModal.value){
        form.reset()
    }
})
/*Show Delete Confirm Modal*/
const showDeleteConfirmModal = (row)=>{
    modalType.value = 'delete'
    showModal.value = true
    form.id = row.id
}


/*Handle Delete*/
const handleDelete = ()=>{
    form.delete(route('transaction.destroy', {id: form.id}),{
        onFinish: () => {
            checkModal()
        },
    })
}
</script>

<template>
    <visitor-layout>

        <!--Create Transaction-->
        <template #actionArea>
            <t-button @click="showModal = true; modalType = 'create'" label="Stok Hareketi Oluştur" icon="fa-solid fa-plus"/>
        </template>

        <t-table :data="transactions" :headers="headers">

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

    <t-modal v-model="showModal">
        <div class="flex flex-col space-y-2">
            <!--Type-->
            <t-select-input label="İşlem" v-model="form.type" :options="types"  id="type" :errors="v$.type.$errors"/>
            <!--Warehouse-->
            <t-select-input label="Depo" v-model="form.warehouse_id" :options="warehouses" label-key="name" id="warehouse_id" :errors="v$.warehouse_id.$errors"/>
            <!--Product-->
            <t-select-input label="Ürün" v-model="form.product_id" :options="products" label-key="name" id="product_id" :errors="v$.product_id.$errors"/>
            <!--Quantity-->
            <t-text-input type="number" label="Miktar" v-model="form.quantity" id="quantity" :errors="v$.quantity.$errors"/>
        </div>


        <!--Submit-->
        <div class="flex w-full justify-end space-x-2 mt-4">
            <t-button
                label="Vazgeç"
                color="slate"
                @click="showModal = false"
            />
            <t-button
                @click="modalType !=='delete' ? handleSubmit() : handleDelete()"
                :disabled="(!form.isDirty || (form.product_id === selectedRow.product_id && form.warehouse_id === selectedRow.warehouse_id && form.quantity === selectedRow.quantity && form.type === selectedRow.type)) && modalType !=='delete'"
                :label="modalTexts.button"
                :color="modalType ==='delete' ? 'red' : 'blue'"
            />
        </div>
    </t-modal>
</template>
