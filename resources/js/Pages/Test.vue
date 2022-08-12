<script setup>
import { ref } from "vue"
import VisitorLayout from "../Layouts/VisitorLayout.vue"

// Components
import TButton from "@/Components/TButton.vue";
import TForm from "@/Components/TForm.vue";
import TTextInput from "@/Components/TTextInput.vue";
import TSelectInput from "@/Components/TSelectInput.vue";
import TCheckboxInput from "@/Components/TCheckboxInput.vue";
import TRadioInput from "@/Components/TRadioInput.vue";
import TModal from "@/Components/TModal.vue";
import TTable from "@/Components/TTable.vue";

defineProps({
    header: String
})

const options = [
    {
        id: 'adana',
        name: 'Adana'
    },
    {
        id: 'kocaeli',
        name: 'Kocaeli'
    },
    {
        id: 'izmir',
        name: 'İzmir'
    }
]

const calismaAraclari = [
    {
        id: 'pc',
        label: 'Bilgisayar'
    },
    {
        id: 'kumpas',
        label: 'Kumpas'
    },
    {
        id: 'araba',
        label: 'Araba'
    }
]

const collars = [
    {
        id: 'white',
        label: 'Beyaz Yaka'
    },
    {
        id: 'blue',
        label: 'Mavi Yaka',
    },
    {
        id: 'intern',
        label: 'Stajer'
    }
]
// Table Headers
const tableHeaders = [
    {
        id: 'id',
        label: 'ID'
    },
    {
        id: 'name',
        label: 'Kullanıcı Adı'
    },
    {
        id: 'email',
        label: 'Email'
    }
]

const showCreateModal = ref(false);

const form = ref({
    name: '',
    email: '',
    province: null,
    working_tools: [],
    collar_type: null
})

const handleSubmit = () => {
    alert('Form gönderildi');
}

const handleReset = () => {
    alert('Form sıfırlandı');
}
</script>

<template>
    <visitor-layout header="Button Komponenti Tasarım Dersi">

        <template #actionArea>
            <t-button label="Yeni Personel Ekle" icon="plus" @clicked="showCreateModal = true" />
        </template>

        <!-- Table -->
        <t-table :data="tableData" :headers="tableHeaders" />

    </visitor-layout>

    <teleport to="body">
        <t-modal v-model="showCreateModal">
            <t-form @submitted="handleSubmit" @reset="handleReset" title="Personel Ekleme Formu"
                subTitle="Beyaz yaka personeli eklemek için kullanın">
                <!-- İsim -->
                <t-text-input label="İsim" icon="fa-solid fa-home" class="col-span-3" v-model="form.name" clearable />
                <!-- Email -->
                <t-text-input label="Email" class="col-span-3" v-model="form.email" />
                <!-- İl -->
                <t-select-input label="İl" class="col-span-3" clearable v-model="form.province" :options="options"
                    labelKey="name" />
                <!-- Space -->
                <div class="col-span-3"></div>
                <!-- Çalışma Araçları -->
                <t-checkbox-input v-model="form.working_tools" label="Çalışma Araçları" class="col-span-3"
                    :options="calismaAraclari" />
                <!-- Kadro Türü -->
                <t-radio-input label="Kadro Türü" class="col-span-3" v-model="form.collar_type" :options="collars"
                    id="collar_type" />
            </t-form>
        </t-modal>
    </teleport>
</template>
