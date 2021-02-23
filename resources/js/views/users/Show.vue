<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-8">
            <div class="w-100 h-64 overflow-hidden z-10">
                <img
                    src="https://images.pexels.com/photos/719597/pexels-photo-719597.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                    alt="user_background"
                    class="object-cover w-full"
                />
            </div>
            <div
                class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20"
            >
                <div class="w-32">
                    <img
                        src="https://images.pexels.com/photos/670720/pexels-photo-670720.jpeg?auto=compress&cs=tinysrgb&dpr=1&w=500"
                        alt="user_profile_image"
                        class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg"
                    />
                </div>
                <p class="text-2xl text-gray-100 ml-4">
                    {{ user ? user.data.attributes.name : "" }}
                </p>
            </div>
        </div>
        <p v-if="postsLoading">Loading...</p>
        <div v-else-if="posts.length < 1">No posts found. Get started...</div>
        <Post
            v-else
            v-for="post in posts.data"
            :key="post.data.post_id"
            :post="post"
        />
    </div>
</template>

<script>
import Post from "../../components/Post.vue";
export default {
    name: "Show",
    components: {
        Post
    },
    data: () => {
        return {
            user: null,
            userLoading: true,
            posts: [],
            postsLoading: true
        };
    },

    mounted() {
        axios
            .get("/api/users/" + this.$route.params.userId)
            .then(res => {
                this.user = res.data;
            })
            .catch(error => {
                console.log("Unable to fetch the user from the server");
            })
            .finally(() => {
                this.userLoading = false;
            });

        axios
            .get("/api/users/" + this.$route.params.userId + "/posts")
            .then(res => {
                this.posts = res.data;
            })
            .catch(error => {
                console.log(error.message);
            })
            .finally(() => {
                this.postsLoading = false;
            });
    }
};
</script>

<style></style>
