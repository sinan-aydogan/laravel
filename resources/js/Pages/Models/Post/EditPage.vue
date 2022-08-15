<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"
import { ref } from "vue"

// Components
import TButton from "@/Components/TButton.vue";
import TForm from "@/Components/TForm.vue";
import TTextInput from "@/Components/TTextInput.vue";
import TTextAreaInput from "@/Components/TTextAreaInput.vue";
import TSearchInput from "@/Components/TSearchInput.vue";
import TRadioInput from "@/Components/TRadioInput.vue";
import { useForm } from '@inertiajs/inertia-vue3'

// Validation
import { useVuelidate } from "@vuelidate/core"
import { required, helpers } from "@vuelidate/validators"

const props = defineProps({
    header: String,
    post: Object,
    userList: Array,
    selectedUsers: Array
})

// Form

const form = useForm({
    name: props.post.name,
    summary: props.post.summary,
    authorList: props.post.authorList,
    status: props.post.status
})

// Rules
const authorsValidation = (value) => value.length > 0
const rules = ref({
    name: { required: helpers.withMessage('Yazı başlığı gereklidir', required) },
    summary: { required: helpers.withMessage('Yazı özeti gereklidir', required) },
    authorList: { authorsValidation: helpers.withMessage('En az bir yazar eklemelisiniz', authorsValidation) }
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

const handleUpdate = async () => {
    const isValidated = await v$.value.$validate()
    if (!isValidated) return
    form.put(route('post.update', props.post.id))
}
</script>

<template>
    <visitor-layout :header="header">

        <template #actionArea>
            <t-button label="Yazı Listesine Geri Dön" icon="fa-solid fa-left-long" :link="route('post.index')" />
        </template>

        <!-- Form -->
        <t-form @submited="handleUpdate" @reset="form.reset()">
            <!-- Title -->
            <t-text-input class="col-span-6" label="Yazı Başlığı" v-model="form.name" :errors="v$.name.$errors" />
            <!-- Summary -->
            <t-text-area-input class="col-span-6" label="Yazı Metni" v-model="form.summary"
                :errors="v$.summary.$errors" />
            <!-- Author -->
            <t-search-input class="col-span-6" v-model="form.authorList" model="userList" :data="userList"
                selectedModel="selectedUsers" :selectedData="selectedUsers" :errors="v$.authorList.$errors" />
            <!-- Status -->
            <t-radio-input class="col-span-6" label="Durum" v-model="form.status" :options="statusTypes" />
        </t-form>
    </visitor-layout>
</template>
