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
                            <v-list-item-subtitle>Likes | hates</v-list-item-subtitle>
                        </v-list-item>

                        <v-list-item density="compact">
                            <v-btn>Like</v-btn>
                            <v-btn>Hate</v-btn>
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
export default {
    props: ['items'],
}
</script>