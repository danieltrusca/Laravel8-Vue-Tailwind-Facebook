const state = {
    posts: null,
    postsStatus: null
};

const getters = {
    posts: state => {
        return state.posts;
    },
    newsStatus: state => {
        return {
            postsStatus: state.postsStatus
        };
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
    }
};

const mutations = {
    setPosts(state, posts) {
        state.posts = posts;
    },
    setPostsStatus(state, status) {
        state.postsStatus = status;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
