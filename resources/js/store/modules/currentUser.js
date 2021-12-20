const state = {
    user: {}
};
const getters = {};
const actions = {
    getUser({commit}){
        axios.get("/api/getUser").then(response => {
            console.log('JSON.stringify(response.data): ' + JSON.stringify(response.data));
            commit('setUser', response.data);
        });
    },
    registerUser({}, user){
        return new Promise((resolve, reject) => {
            axios.post("api/register", user).then(response => {
                if(response.data.token){
                    localStorage.setItem("commentbox_token", response.data.token);
                    window.location.replace("/home");
                    resolve(true);
                }
            }).catch(error => {
                reject(error);
            });
        });
    },
    login({}, user){
        return new Promise((resolve, reject) => {
            axios.post("api/login", user).then(response => {
                if(response.data.token){
                    localStorage.setItem("commentbox_token", response.data.token);
                    window.location.replace("/home");
                    resolve(true);
                }
            }).catch(error => {
                console.log('error in store js');
                reject(error);
            })
        });
    },
    logout({}){
        axios.post("api/logout").then(response => {
            localStorage.removeItem("commentbox_token");
            window.location.replace("/home");
            commit('setUser', null);
        });
    }
};
const mutations = {
    setUser(state, data){
        state.user = data;
    }
};

export default {
    namespaced: true,
    state,
    getters,
    actions,
    mutations
}
