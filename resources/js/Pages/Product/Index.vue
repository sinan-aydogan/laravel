<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TTable from "@/Components/TTable.vue";
import { computed, ref, watch } from "vue";
import TButton from "@/Components/TButton.vue";
import TModal from "@/Components/TModal.vue";
import { useForm } from "@inertiajs/inertia-vue3";
import { helpers, required } from "@vuelidate/validators";
import { useVuelidate } from "@vuelidate/core";
import TTextInput from "@/Components/TTextInput.vue";

defineProps({
    products: Object
})

const headers = [
    {
        id: 'name',
        label: 'Ürün Adı'
    }
]

/*Modal*/
const showModal=ref(true)
const modalType=ref('create')
const modalTexts = computed(()=>{
    switch (modalType.value){
        case 'create':
            return {
                title: 'Yeni Depo Oluştur',
                button: form.processing ? 'Oluşturuluyor' : 'Oluştur'
            };
        case 'update':
            return {
                title: 'Depoyu Güncelle',
                button: form.processing ? 'Güncelleniyor' : 'Güncelle'
            };
        case 'delete':
            return {
                title: 'Depoyu Sil',
                button: form.processing ? 'Siliniyor' : 'Sil'
            };
    }
})

/*Form*/
const form = useForm({
    id: '',
    name: '',
    image: null
})

const rules = ref({
    name: { required: helpers.withMessage('Ürün adı gereklidir', required) },
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
    form.delete(route('product.destroy', {id: form.id}),{
        onFinish: () => {
            checkModal()
        },
    })
}

/*Product Image*/
const image = ref(null)
const imageUrl = ref('https://images.unsplash.com/photo-1628794577976-db3723221fff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YmxhbmslMjBwcm9kdWN0fGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=700&q=60')
const updateImage = ()=>{
    form.image = image.value.files[0]
    imageUrl.value = URL.createObjectURL(form.image)
}

const deleteImage = ()=>{
    image.value = null
    form.image = null
    imageUrl.value = 'https://images.unsplash.com/photo-1628794577976-db3723221fff?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8Mnx8YmxhbmslMjBwcm9kdWN0fGVufDB8fDB8fA%3D%3D&auto=format&fit=crop&w=700&q=60'
}
</script>

<template>
    <VisitorLayout>
        <template #actionArea>
            <t-button @click="showModal = true; modalType = 'create'" label="Yeni Ürün Ekle" icon="fa-solid fa-plus"/>
        </template>
        <t-table :data="products" :headers="headers"/>

        <!--Modal-->
        <t-modal :title="modalTexts.title" v-model="showModal">
            <!--Form-->
            <div v-if="modalType !== 'delete'">
                <t-text-input v-model="form.name" label="Ürün Adı" id="name" :errors="v$.name.$errors" />

                <div class="flex items-center space-x-4 mt-4">
                    <img :src="imageUrl" class="h-16 w-16 bg-slate-300 rounded-full">
                    <div class="flex space-x-2">
                        <t-button label="Dosya Seç" @click="image.click()"/>
                        <t-button icon="fa-solid fa-trash" color="red" @click="deleteImage"/>
                    </div>
                    <input type="file" ref="image" class="hidden mt-4" @input="updateImage">
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
    </VisitorLayout>
</template>
