<template>
    <div>
        <ul>
            <li v-for="movie in movies" :key="movie.id">
                <v-card>
                    <v-card-title>{{ movie.title }}</v-card-title>
                    <v-card-subtitle>Posted {{ movie.created_at }}</v-card-subtitle>
                    <v-card-text>{{ movie.description }}</v-card-text>
                    <div class="d-flex py-3 justify-space-between">
                        <v-list-item density="compact">
                            <v-list-item-subtitle>Likes | hates</v-list-item-subtitle>
                        </v-list-item>

                        <v-list-item density="compact">
                            <v-list-item-subtitle>Posted by {{ movie.user_id }}</v-list-item-subtitle>
                        </v-list-item>
                    </div>
                </v-card>
            </li>
        </ul>
    </div>
</template>
 
<script>
import axios from 'axios';
export default {
    data: () => ({
        movies: []
    }),

    mounted() {
        axios.get(route('movies')).then(response => {
            this.movies = response.data
            console.log(response.data)
        })
    }
}
</script>