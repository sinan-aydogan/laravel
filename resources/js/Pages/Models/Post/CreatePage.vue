<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
import { ref } from "vue"

// Components
import TButton from "@/Components/TButton.vue";
import TForm from "@/Components/TForm.vue";
import TTextInput from "@/Components/TTextInput.vue";
import TTextAreaInput from "@/Components/TTextAreaInput.vue";
import TRadioInput from "@/Components/TRadioInput.vue";
import TSearchInput from "@/Components/TSearchInput.vue";
import { useForm } from '@inertiajs/inertia-vue3'

// Validation
import { useVuelidate } from "@vuelidate/core"
import { required, helpers } from "@vuelidate/validators"

defineProps({
    header: String,
    userList: Array,
    selectedUsers: Array
})

// Form

const form = useForm({
    name: '',
    summary: '',
    authors: [],
    status: true
})


// Rules
const authorsValidation = (value) => value.length > 0
const rules = ref({
    name: { required: helpers.withMessage('Yazı başlığı gereklidir', required) },
    summary: { required: helpers.withMessage('Yazı özeti gereklidir', required) },
    authors: { authorsValidation: helpers.withMessage('En az bir yazar eklemelisiniz', authorsValidation) }
})

const v$ = useVuelidate(rules, form)

const statusTypes = [
    {
        id: true,
        label: 'Yayında'
    },
    {
        id: false,
        label: 'Yayında Değil'
    }
]

const handleSubmit = async () => {
    const isValidated = await v$.value.$validate()
    if (!isValidated) return
    form.post(route('post.store'))
}
</script>

<template>
    <visitor-layout :header="header">

        <template #actionArea>
            <t-button label="Yazı Listesine Geri Dön" icon="fa-solid fa-left-long" :link="route('post.index')" />
        </template>

        <!-- Form -->
        <t-form @submited="handleSubmit" @reset="form.reset()">
            <!-- Title -->
            <t-text-input class="col-span-6" label="Yazı Başlığı" id="name" v-model="form.name"
                :errors="v$.name.$errors" />
            <!-- Summary -->
            <t-text-area-input class="col-span-6" id="summary" label="Yazı Metni" v-model="form.summary"
                :errors="v$.summary.$errors" />
            <!-- Author -->
            <t-search-input class="col-span-6" id="authors" v-model="form.authors" model="userList" :data="userList"
                selectedModel="selectedUsers" :selectedData="selectedUsers" :errors="v$.authors.$errors" />
            <!-- Status -->
            <t-radio-input class="col-span-6" id="status" label="Durum" v-model="form.status" :options="statusTypes" />
        </t-form>
    </visitor-layout>
</template>
