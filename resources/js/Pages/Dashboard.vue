<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-6 text-gray-900">You're logged in!</div>
                <v-row>
                    <v-col cols="12" sm="8"></v-col>
                    <v-col cols="12" sm="4"><v-btn @click="handleDialog">dasdasdas</v-btn></v-col>
                </v-row>
            </div>
            <v-dialog v-model="dialog" @closeModal="handleCloseModal">
                <ModalForm v-on:close="dialog = false"/>
            </v-dialog>
        </div>
    </AuthenticatedLayout>
</template>


<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import ModalForm from '../Components/ModalForm.vue';
import { ref } from 'vue';

defineProps({
    ModalForm,
})

const dialog = ref(false)

const handleDialog = () => {
    dialog.value = !dialog.value

}

const handleCloseModal = () => {
    dialog.value = false
}


</script>