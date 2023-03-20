<template>
    <Head title="MovieWorld" />
    <HeaderMenu v-if="$page.props.auth.user">
    </HeaderMenu>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <v-row class="py-6">
                <v-col cols="12" sm="8">
                    <ul :key="componentKey">
                        <li v-for="movie in movies" :key="movie.id">
                            <Movie class="my-2" :movie="movie" :key="componentKey" @voteUpdated="getData(params)"/>
                        </li>
                    </ul>
                </v-col>
                <v-col cols="12" sm="4">
                    <v-btn v-if="$page.props.auth.user" prepend-icon="mdi-plus-box-multiple-outline" color="success" @click="handleDialog">New Movie</v-btn>
                    <v-card class="my-4">
                        <v-card-title>Sort by</v-card-title>
                        <v-card-item>
                            <v-btn variant="outlined" prependIcon="mdi-thumb-up-outline" rounded="pill" color="primary"
                                @click="sortBy('likes')">
                                Likes
                            </v-btn>
                        </v-card-item>
                        <v-card-item>
                            <v-btn variant="outlined" prependIcon="mdi-thumb-down-outline" rounded="pill" color="primary"
                                @click="sortBy('hates')">
                                Hates
                            </v-btn>
                        </v-card-item>
                        <v-card-item>
                            <v-btn variant="outlined" prependIcon="mdi-clipboard-text-clock" rounded="pill" color="primary" @click="sortBy('created_at')">
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
import Movie from './Movie.vue'
import HeaderMenu from '../Components/HeaderMenu.vue'
import axios from 'axios';
export default {
    components: {
        AuthenticatedLayout,
        ModalForm,
        HeaderMenu,
        Movie
    },
    data: () => ({
        dialog: false,
        componentKey: 0,
        movies: [],
        descOrder: false,
        params: {},
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
            this.getData(this.params)


        },
        async getData(params) {
            await axios.get(route('movies'), { params }).then(response => {
                this.movies = response.data
                this.componentKey += 1
            })
        },
        sortBy(val) {
            this.descOrder = !this.descOrder
            if (val === 'likes') {
                this.params.orderBy = 'likes_count';
            }
            else if (val === 'hates') {
                this.params.orderBy = 'dislikes_count';
            }
            else {
                this.params.orderBy = val;
            }
            if (this.descOrder) { this.params.order = 'asc' } else { this.params.order = 'desc' }
            this.componentKey += 1
            return
        },
    }
}
</script>