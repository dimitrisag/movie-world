<template>
    <v-card elevation="3">
        <v-card-title>{{ movie.title }}</v-card-title>
        <v-card-subtitle>Posted {{ movie.created_at }}</v-card-subtitle>
        <v-card-text>{{ movie.description }}</v-card-text>
        <div class="d-flex py-3 justify-space-between">
            <v-list-item density="compact">
                <v-list-item-subtitle>{{ movie.likes_count }} Likes | {{ movie.dislikes_count }} Hates</v-list-item-subtitle>
            </v-list-item>

            <v-list-item v-if="$page.props.auth.user" density="compact">
                <v-btn variant="outlined" class="mx-1" size="small" prepend-icon="mdi-thumb-up-outline" @click="vote(movie, true)" color="success">Like</v-btn>
                <v-btn variant="outlined" class="mx-1" size="small" prepend-icon="mdi-thumb-down-outline" @click="vote(movie, false)" color="red">Hate</v-btn>
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
                user_id: this.$page.props.auth.user.id,
                liked: liked
            }
            await axios.post(route('addVote', params))
            this.$emit('voteUpdated')
        },
    }
}
</script>