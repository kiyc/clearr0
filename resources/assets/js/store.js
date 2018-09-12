export default {
    state: {
        groups: [],
        tasks: [],
    },

    mutations: {
        setGroups (state, groups) {
            state.groups = groups
        },
        setTasks (state, tasks) {
            state.tasks = tasks
        },
    },

    actions: {
        fetchGroups ({ commit }) {
            axios.get( '/api/groups')
                .then( (res) => {
                    commit('setGroups', res.data.items)
                })
                .catch( (res) => {
                    console.log( res )
                })
        },
    },

    getters: {
    },

    modules: {
    }
}
