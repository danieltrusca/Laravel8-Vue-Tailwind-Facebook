const state = {
    user: null,
    userStatus: true
};

const getters = {
    user: state => {
        return state.user;
    },
    status: state => {
        return {
            user: state.userStatus
        };
    }
};

const actions = {
    fetchUser({ commit, state }, userId) {
        commit("setUserStatus", "loading");

        axios
            .get("/api/users/" + userId)
            .then(res => {
                commit("setUser", res.data);
                commit("setUserStatus", "success");
            })
            .catch(error => {
                commit("setUserStatus", "error");
            });
    }
};

const mutations = {
    setUser(state, user) {
        state.user = user;
    },
    setUserStatus(state, userStatus) {
        state.userStatus = userStatus;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};
