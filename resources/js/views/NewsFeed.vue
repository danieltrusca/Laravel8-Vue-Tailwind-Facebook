<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />
        <p v-if="postsStatus === 'loading'">Loading...</p>
        <Post
            v-else
            v-for="(post, postKey) in posts.data"
            :key="postKey"
            :post="post"
        />
    </div>
</template>

<script>
import NewPost from "../components/NewPost.vue";
import Post from "../components/Post.vue";
import { mapGetters } from "vuex";
export default {
    name: "NewsFeed",
    components: {
        NewPost,
        Post
    },

    mounted() {
        this.$store.dispatch("fetchNewsPosts");
    },
    computed: {
        ...mapGetters({
            posts: "posts",
            postsStatus: "postsStatus"
        })
    }
};
</script>

<style scoped></style>
