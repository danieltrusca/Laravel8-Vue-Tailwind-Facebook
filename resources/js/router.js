import Vue from "vue";
import VueRouter from "vue-router";
//import Start from "./views/Start.vue";
import NewsFeed from "./views/NewsFeed.vue";
import UserShow from "./views/users/Show.vue";

Vue.use(VueRouter);

export default new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: NewsFeed,
            meta: { title: "News Feed" }
        },
        {
            path: "/users/:userId",
            name: "user.show",
            component: UserShow,
            meta: { title: "Profile" }
        }
    ]
});
