<template>
    <v-card>
        <v-card-title>{{ movie.title }}</v-card-title>
        <v-card-subtitle>Posted {{ movie.created_at }}</v-card-subtitle>
        <v-card-text>{{ movie.description }}</v-card-text>
        <div class="d-flex py-3 justify-space-between">
            <v-list-item density="compact">
                <v-list-item-subtitle>{{ movie.likes_count }} Likes | {{ movie.dislikes_count }} hates</v-list-item-subtitle>
            </v-list-item>

            <v-list-item density="compact">
                <v-btn @click="vote(movie, true)">Like</v-btn>
                <v-btn @click="vote(movie, false)">Hate</v-btn>
            </v-list-item>

            <v-list-item density="compact">
                <v-list-item-subtitle>Posted by {{ movie.user.name }}</v-list-item-subtitle>
            </v-list-item>
        </div>
    </v-card>
</template>
 
<script>
import axios from 'axios'
export default {
    props: ['movie'],

    methods: {
        async vote(item, liked) {
            const params = {
                movie_id: item.id,
                user_id: item.user_id,
                liked: liked
            }
            await axios.post(route('addVote', params))
        },
    }
}
</script>