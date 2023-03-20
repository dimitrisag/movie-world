<template>
    <v-card width="400" class="mx-auto">
        <v-card-title>Insert new movie</v-card-title>
        <v-card-text>
            <v-sheet width="300" class="mx-auto">
                <v-form @submit.prevent="submit">
                    <v-text-field v-model="title" label="Movie title"></v-text-field>
                    <v-textarea v-model="description" label="Movie description"></v-textarea>
                    <v-btn type="submit" block class="mt-2" color="success">Submit</v-btn>
                </v-form>
            </v-sheet>
        </v-card-text>
    </v-card>
</template>

<script>
import axios from 'axios'
export default {
    data: () => ({
        form: {},
        title: '',
        description: ''
    }),

    methods: {
        async submit() {
            const args = {
                title: this.title,
                description: this.description,
                user_id: this.$page.props.auth.user.id
            }
            await axios.post(route('addMovie'), args).then(response => {
                this.$emit('closeModal')
            }
            )
        }
    }
}
</script>