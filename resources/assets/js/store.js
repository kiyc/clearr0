export default {
    state: {
        items: [],
        groups: [],
        tasks: [],
        showGroups: true,
    },

    mutations: {
        setItems (state, items) {
            state.items = items
        },
        setGroups (state, groups) {
            state.groups = groups
        },
        setTasks (state, tasks) {
            state.tasks = tasks
        },
        setShowGroups (state, showGroups) {
            state.showGroups = showGroups
        },
    },

    actions: {
        fetchGroups ({ commit }) {
            axios.get( '/api/groups')
                .then( (res) => {
                    let items = []
                    for (let idx in res.data.items) {
                        items.push({
                            id: res.data.items[idx].id,
                            value: res.data.items[idx].name,
                            isGroup: true,
                            isEditing: false,
                        })
                    }
                    commit('setGroups', res.data.items)
                    commit('setItems', items)
                })
                .catch( (res) => {
                    console.log( res )
                })
        },
        switchGroups ({ commit, state }) {
            let items = []
            for (let idx in state.groups) {
                items.push({
                    id: state.groups[idx].id,
                    value: state.groups[idx].name,
                    isGroup: true,
                    isEditing: false,
                })
            }
            commit('setItems', items)
            commit('setShowGroups', true)
        },
        switchTasks ({ commit, state }, groupId) {
            let group = state.groups.filter( g => g.id == groupId ).pop()
            let items = []
            if (group && group.tasks) {
                for (let idx in group.tasks) {
                    items.push({
                        id: group.tasks[idx].id,
                        value: group.tasks[idx].content,
                        isGroup: false,
                        isEditing: false,
                    })
                }
                commit('setItems', items)
                commit('setShowGroups', false)
            }
        },
    },

    getters: {
    },

    modules: {
    }
}
