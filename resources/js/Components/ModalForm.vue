<template>
    <v-card>
        <v-card-title>Insert new movie</v-card-title>
        <v-card-text>
            <v-sheet width="300" class="mx-auto">
                <v-form @submit.prevent="submit">
                    <v-text-field v-model="form.title" label="Movie title"></v-text-field>
                    <v-textarea v-model="form.description" label="Movie description"></v-textarea>
                    <v-btn type="submit" block class="mt-2">Submit</v-btn>
                </v-form>
            </v-sheet>
        </v-card-text>
    </v-card>
</template>
  
<script setup>
import { defineEmits } from 'vue'
import { usePage, useForm } from '@inertiajs/vue3'

const { emit } = defineEmits(['closeModal'])

const { props } = usePage()

const form = useForm({
    title: '',
    description: '',
    user_id: props.auth.user.id
})

const submit = () => {
    form.post(route('addMovie'), () => {
        emit('closeModal')
    })
    console.log(form)
    // Here you can implement your form submission logic
    
}
</script>