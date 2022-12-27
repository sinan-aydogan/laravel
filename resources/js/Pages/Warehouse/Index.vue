<script setup>
import {ref} from "vue";
import VisitorLayout from "@/Layouts/VisitorLayout.vue";
import TButton from "@/Components/TButton.vue";
import TModal from "@/Components/TModal.vue";
import TTextInput from "@/Components/TTextInput.vue";
import { useForm } from "@inertiajs/inertia-vue3";

// Validation
import { useVuelidate } from "@vuelidate/core"
import { required, helpers } from "@vuelidate/validators"

/*Modal*/
const showModal = ref(false);

/*Form*/
const form = useForm({
    name: ''
})

const rules = ref({
    name: { required: helpers.withMessage('Depo adı gereklidir', required) },
})

const v$ = useVuelidate(rules, form)

/*Submit*/
const handleSubmit = async ()=>{
    const isValidated = await v$.value.$validate()

    if (!isValidated) return

    form.post(route('warehouse.store'), {
        onFinish: visit => {
            if(!form.hasErrors){
                showModal.value = false;
                form.reset()
            }
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
            <t-text-input v-model="form.name" label="Depo Adı" id="name" :errors="v$.name.$errors" />

            <!--Submit-->
            <div class="flex w-full justify-end">
                <t-button @click="handleSubmit" :disabled="!form.isDirty" :label="form.processing ? 'İşleniyor...' : 'Oluştur'" class="mt-4"/>
            </div>
        </t-modal>
    </visitor-layout>
</template>
