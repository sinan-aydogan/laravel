<script setup>
import VisitorLayout from "@/Layouts/VisitorLayout.vue"

// Components
import TButton from "@/Components/TButton.vue";
import TForm from "@/Components/TForm.vue";
import TTextInput from "@/Components/TTextInput.vue";
import TTextAreaInput from "@/Components/TTextAreaInput.vue";
import TSelectInput from "@/Components/TSelectInput.vue";
import TRadioInput from "@/Components/TRadioInput.vue";
import { useForm } from '@inertiajs/inertia-vue3'
import { Inertia } from "@inertiajs/inertia";

defineProps({
    header: String,
    userList: Array
})

// Form

const form = useForm({
    name: '',
    summary: '',
    user_id: null,
    status: true
})

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

const handleSubmit = () => {
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
            <t-text-input class="col-span-6" label="Yazı Başlığı" v-model="form.name" />
            <!-- Summary -->
            <t-text-area-input class="col-span-6" label="Yazı Metni" v-model="form.summary" />
            <!-- Author -->
            <t-select-input class="col-span-6" label="Yazar" v-model="form.user_id" :options="userList"
                labelKey="name" />
            <!-- Status -->
            <t-radio-input class="col-span-6" label="Durum" v-model="form.status" :options="statusTypes" />
        </t-form>
    </visitor-layout>
</template>
