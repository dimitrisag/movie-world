<template>
    <div>
        <ul>
            <li v-for="movie in items" :key="movie.id">
                <v-card>
                    <v-card-title>{{ movie.title }}</v-card-title>
                    <v-card-subtitle>Posted {{ movie.created_at }}</v-card-subtitle>
                    <v-card-text>{{ movie.description }}</v-card-text>
                    <div class="d-flex py-3 justify-space-between">
                        <v-list-item density="compact">
                            <v-list-item-subtitle>{{ count(movie, true) }}Likes | hates</v-list-item-subtitle>
                        </v-list-item>

                        <v-list-item density="compact">
                            <v-btn @click="vote(movie, true)">Like</v-btn>
                            <v-btn @click="vote(movie, false)">Hate</v-btn>
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
import axios from 'axios'
export default {
    props: ['items'],

    methods: {
        async vote(item, liked) {
            const params = {
                movie_id: item.id,
                user_id: item.user_id,
                liked: liked
            }
            await axios.post(route('addVote', params))
        },

        async count(item, liked) {
            let result
            await axios.get('votes', {movie_id: item.id, liked:liked})
                .then(response => {
                    result = response.data
                    
                })
            return result
        }
    }
}
</script>