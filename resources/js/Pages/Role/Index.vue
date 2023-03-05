<script setup>
import { computed, ref, watch } from "vue";
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TButton from "@/Components/TButton.vue";
import TModal from "@/Components/TModal.vue";
import TTextInput from "@/Components/TTextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";

// Validation
import { useVuelidate } from "@vuelidate/core"
import { required, helpers } from "@vuelidate/validators"
import TTable from "@/Components/TTable.vue";
import TBadge from "@/Components/TBadge.vue";

defineProps({
    tableData: {
        type: Object,
        default: ()=>{}
    },
    permissions: {
        type: Array,
        default: ()=>[]
    }
})

/*Headers*/
const headers = [
    {
        id: 'name',
        label: 'Rol Adı'
    },
    {
        id: 'permissions',
        label: 'İzinler'
    },
    {
        id: 'actions',
        label: 'İşlemler'
    }
]

/*Modal*/
const modalType = ref('create');
const showModal = ref(false);
const modalTexts = computed(()=>{
    switch (modalType.value){
        case 'create':
            return {
                title: 'Yeni Rol Oluştur',
                button: form.processing ? 'Oluşturuluyor' : 'Oluştur'
            };
        case 'update':
            return {
                title: 'Rolü Güncelle',
                button: form.processing ? 'Güncelleniyor' : 'Güncelle'
            };
        case 'delete':
            return {
                title: 'Rolü Sil',
                button: form.processing ? 'Siliniyor' : 'Sil'
            };
    }
})

/*Form*/
const form = useForm({
    id: '',
    code: '',
    name: '',
    permissions: []
})

const rules = ref({
    code: { required: helpers.withMessage('Rol kısaltması gereklidir', required) },
    name: { required: helpers.withMessage('Rol adı gereklidir', required) },
})

const v$ = useVuelidate(rules, form)

/*Select Row*/
const selectedRow = ref({});
const selectRow = (row)=>{
    showModal.value = true
    selectedRow.value = row
    form.id = row.id
    form.code = row.code,
    form.name = row.name,
    form.permissions = row.permissions
}

const checkModal = () => {
    if(!form.hasErrors){
        showModal.value = false;
        form.reset()
        v$.value.$reset()
    }
}

/*Submit*/
const handleSubmit = async ()=>{
    const isValidated = await v$.value.$validate()

    if (!isValidated) return



    if(modalType.value === 'create'){
        /*Create*/
        form.post(route('role.store'), {
            onSuccess: () => {
                checkModal()
            },
        });
    }else{
        /*Update*/
        form.put(route('role.update',{'id' : form.id}), {
            onSuccess: () => {
                checkModal()
            },
        });
    }
}

/*Permission*/
const updatePermissionList = (permission)=>{
    /*Check*/
    if(form.permissions.includes(permission)){
        form.permissions.splice(form.permissions.findIndex((i)=>i===permission),1)
    }else{
        form.permissions.push(permission)
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
    form.delete(route('warehouse.destroy', {id: form.id}),{
        onFinish: () => {
            checkModal()
        },
    })
}
</script>

<template>
    <visitor-layout>
        <template #actionArea>
            <t-button @click="showModal = true; modalType = 'create'" label="Yeni Rol Ekle" icon="fa-solid fa-plus"/>
        </template>

        <!--Table-->
        <t-table :data="tableData" :headers="headers">
            <!--Role Name-->
            <template #name="{props}">
                <span v-text="props.name" class="flex w-64"></span>
            </template>

            <!--Permissions-->
            <template #permissions="{props}">
                <div class="flex flex-wrap gap-2">
                    <template v-for="permission in props.permissions" :key="permission.id">
                        <t-badge>
                            {{permission.name}}
                        </t-badge>
                    </template>
                </div>
            </template>

            <!--Actions-->
            <template #actions="{props}">
                <div class="flex w-full justify-end pr-6 space-x-2">
                    <t-button @click="showDeleteConfirmModal(props)" icon="fa-solid fa-trash" color="red"/>
                    <t-button @click="selectRow(props); modalType = 'update'" icon="fa-solid fa-pen-to-square"/>
                </div>
            </template>
        </t-table>

        <!--Modal-->
        <t-modal :title="modalTexts.title" v-model="showModal">
            <!--Form-->
            <div v-if="modalType !== 'delete'">
                <!--Role Code-->
                <t-text-input v-model="form.code" label="Rol Kısaltması" id="code" :errors="v$.code.$errors" class="mb-4"/>

                <!--Role Name-->
                <t-text-input v-model="form.name" label="Rol Adı" id="name" :errors="v$.name.$errors"/>

                <!--Permissions-->
                <span class="flex mt-4 mb-2">İzinler</span>
                <div class="flex flex-wrap w-fit gap-2">
                    <template v-for="permission in permissions" :key="permission.id">
                        <t-badge selectable :id="permission.id" :label="permission.name" @clicked="updatePermissionList($event)"/>
                    </template>
                </div>
            </div>
            <div v-else>
                Depo silinecektir onaylıyor musunuz?
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
                    :disabled="(!form.isDirty || form.name === selectedRow.name) && modalType !=='delete'"
                    :label="modalTexts.button"
                    :color="modalType ==='delete' ? 'red' : 'blue'"
                />
            </div>
        </t-modal>
    </visitor-layout>
</template>
