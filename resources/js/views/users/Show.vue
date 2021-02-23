<template>
    <div>
        <div class="w-100 h-64 overflow-hidden z-10">
            <img
                src="https://images.pexels.com/photos/719597/pexels-photo-719597.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
                alt="user_background"
                class="object-cover w-full"
            />
        </div>
    </div>
</template>

<script>
export default {
    name: "Show",

    data: () => {
        return {
            user: null,
            loading: true,
            posts: []
        };
    },

    mounted() {
        axios
            .get("/api/users/" + this.$route.params.userId)
            .then(res => {
                this.user = res.data;
                this.loading = false;
            })
            .catch(error => {
                console.log("Unable to fetch the user from the server");
                this.loading = false;
            });

        axios
            .get("/api/posts/" + this.$route.params.userId)
            .then(res => {
                this.posts = res.data;
                this.loading = false;
            })
            .catch(error => {
                console.log(error.message);
                this.loading = false;
            });
    }
};
</script>

<style></style>
