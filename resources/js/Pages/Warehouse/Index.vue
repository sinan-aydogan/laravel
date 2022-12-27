<script setup>
import {ref} from "vue";
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TButton from "@/Components/TButton.vue";
import TModal from "@/Components/TModal.vue";
import TTextInput from "@/Components/TTextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";

/*Modal*/
const showModal = ref(false);

/*Form*/
const form = useForm({
    name: ''
})

/*Submit*/
const handleSubmit = ()=>{
    form.post(route('warehouse.store'), {
        onFinish: visit => {
            showModal.value = false;
            form.reset()
        },
    });
}
</script>

<template>
    <visitor-layout>
        <template #actionArea>
            <t-button @click="showModal = true" label="Yeni Depo Ekle" icon="fa-solid fa-plus"/>
        </template>

        <!--Modal-->
        <t-modal title="Yeni Depo Oluşturma" v-model="showModal">
            <t-text-input v-model="form.name" label="Depo Adı"/>

            <!--Submit-->
            <div class="flex w-full justify-end">
                <t-button @click="handleSubmit" :disabled="!form.isDirty" :label="form.processing ? 'İşleniyor...' : 'Oluştur'" class="mt-4"/>
            </div>
        </t-modal>
    </visitor-layout>
</template>
