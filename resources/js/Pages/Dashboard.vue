<template>
    <Head title="MovieWorld" />
    <HeaderMenu v-if="$page.props.auth.user">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Movies</h2>
        </template>
    </HeaderMenu>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <v-row class="py-6">
                <v-col cols="12" sm="8">
                    <Movies :items="movies" :key="componentKey" />
                </v-col>
                <v-col cols="12" sm="4">
                    <v-btn v-if="$page.props.auth.user" @click="handleDialog">New Movie</v-btn>
                    <v-card>
                        <v-card-title>Sort by</v-card-title>
                        <v-card-item>
                            <v-btn rounded="pill" color="primary" @click="sortBy('likes')">
                                Likes
                            </v-btn>
                        </v-card-item>
                        <v-card-item>
                            <v-btn rounded="pill" color="primary" @click="sortBy('hates')">
                                Hates
                            </v-btn>
                        </v-card-item>
                        <v-card-item>
                            <v-btn rounded="pill" color="primary" @click="sortBy('created_at')">
                                Dates
                            </v-btn>
                        </v-card-item>
                    </v-card>
                </v-col>

            </v-row>
        </div>
        <v-dialog v-model="dialog">
            <ModalForm v-on:close="dialog = false" @closeModal="handleCloseModal" />
        </v-dialog>
    </div>
</template>

<script>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ModalForm from '../Components/ModalForm.vue';
import Movies from './Movies.vue';
import HeaderMenu from '../Components/HeaderMenu.vue'
import axios from 'axios';
export default {
    components: {
        AuthenticatedLayout,
        ModalForm,
        Movies,
        HeaderMenu
    },
    data: () => ({
        dialog: false,
        componentKey: 0,
        movies: [],
        descOrder:false,
        params: {}
    }),
    mounted() {
        this.getData()
    },
    watch: {
        params: {
            deep: true,
            handler() {
                this.getData(this.params)
            }
        }
    },
    methods: {
        handleDialog() {
            this.dialog = true
        },
        handleCloseModal() {
            this.dialog = false
            this.componentKey += 1
        },
        async getData(params) {
            await axios.get(route('movies'), {params}).then(response => {
                this.movies = response.data
            })
        },
        sortBy(val) {
            this.descOrder = !this.descOrder
            this.params.orderBy = val
            if (this.descOrder) {this.params.order = 'asc'} else this.params.order = 'desc'
            return
        }
    }
}
</script>