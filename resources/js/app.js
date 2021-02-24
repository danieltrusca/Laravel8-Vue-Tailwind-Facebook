import Vue from "vue";
import router from "./router";
import store from "./store/index.js";
import App from "./components/App.vue";

require("./bootstrap");

const app = new Vue({
    el: "#app",
    components: {
        App
    },

    router,

    store
});
