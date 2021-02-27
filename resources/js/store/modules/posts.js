const state = {
    posts: null,
    postsStatus: null,
    postMessage: ""
};

const getters = {
    posts: state => {
        return state.posts;
    },
    newsStatus: state => {
        return {
            postsStatus: state.postsStatus
        };
    },
    postMessage: state => {
        return state.postMessage;
    }
};

const actions = {
    fetchNewsPosts({ commit, state }) {
        commit("setPostsStatus", "loading");

        axios
            .get("/api/posts")
            .then(res => {
                commit("setPosts", res.data);
                commit("setPostsStatus", "success");
            })
            .catch(error => {
                commit("setPostsStatus", "error");
            });
    },
    postMessage({ commit, state }) {
        commit("setPostsStatus", "loading");

        axios
            .post("/api/posts", { body: state.postMessage })
            .then(res => {
                commit("pushPost", res.data);
                commit("setPostsStatus", "success");
                commit("updateMessage", "");
            })
            .catch(error => {});
    }
};

const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    },
    updateMessage(state, newMessage) {
        state.postMessage = newMessage;
    },
    pushPost(state, newMessage) {
        state.posts.data.unshift(newMessage);
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
