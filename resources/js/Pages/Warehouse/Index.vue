<script setup>
import { ref, watch } from "vue";
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TButton from "@/Components/TButton.vue";
import TModal from "@/Components/TModal.vue";
import TTextInput from "@/Components/TTextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";

// Validation
import { useVuelidate } from "@vuelidate/core"
import { required, helpers } from "@vuelidate/validators"
import TTable from "@/Components/TTable.vue";

defineProps({
    tableData: {
        type: Object,
        default: ()=>{}
    }
})

/*Headers*/
const headers = [
    {
        id: 'name',
        label: 'Depo Adı'
    },
    {
        id: 'actions',
        label: 'İşlemler'
    }
]

/*Modal*/
const modalType = ref('create');
const showModal = ref(false);

/*Form*/
const form = useForm({
    id: '',
    name: ''
})

const rules = ref({
    name: { required: helpers.withMessage('Depo adı gereklidir', required) },
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

/*Submit*/
const handleSubmit = async ()=>{
    const isValidated = await v$.value.$validate()

    if (!isValidated) return

    let checkModal = () => {
        if(!form.hasErrors){
            showModal.value = false;
            form.reset()
        }
    }

    if(modalType.value === 'create'){
        /*Create*/
        form.post(route('warehouse.store'), {
            onFinish: visit => {
                checkModal()
            },
        });
    }else{
        /*Update*/
        form.put(route('warehouse.update',{'id' : form.id}), {
            onFinish: visit => {
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

/*Handle Delete*/
const handleDelete = (row)=>{
    form.delete(route('warehouse.destroy', row))
}


</script>

<template>
    <visitor-layout>
        <template #actionArea>
            <t-button @click="showModal = true; modalType = 'create'" label="Yeni Depo Ekle" icon="fa-solid fa-plus"/>
        </template>

        <!--Table-->
        <t-table :data="tableData" :headers="headers">
            <template #actions="{props}">
                <div class="flex w-full justify-end pr-6 space-x-2">
                    <t-button @click="handleDelete(props)" icon="fa-solid fa-trash" color="red"/>
                    <t-button @click="selectRow(props); modalType = 'update'" icon="fa-solid fa-pen-to-square"/>
                </div>
            </template>
        </t-table>

        <!--Modal-->
        <t-modal title="Yeni Depo Oluşturma" v-model="showModal">
            <!--Form-->
            <div>
                <t-text-input v-model="form.name" label="Depo Adı" id="name" :errors="v$.name.$errors" />
            </div>
            <!--Submit-->
            <div class="flex w-full justify-end">
                <t-button
                    @click="handleSubmit"
                    :disabled="!form.isDirty ||form.name === selectedRow.name"
                    :label="form.processing ? 'İşleniyor...' : modalType === 'create' ? 'Oluştur' : 'Güncelle'"
                    class="mt-4"
                />
            </div>
        </t-modal>
    </visitor-layout>
</template>
