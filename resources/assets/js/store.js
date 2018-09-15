export default {
    state: {
        items: [],
        groups: [],
        tasks: [],
        showGroups: true,
        showNewInput: false,
        newValue: '',
        groupId: null,
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
        setShowNewInput (state, showNewInput) {
            state.showNewInput = showNewInput
        },
        setNewValue (state, newValue) {
            state.newValue = newValue
        },
        setGroupId (state, groupId) {
            state.groupId = groupId
        },
    },

    actions: {
        setGroupItems ({ commit }, rawItems) {
            let items = []
            for (let idx in rawItems) {
                items.push({
                    id:        rawItems[idx].id,
                    value:     rawItems[idx].name,
                    isGroup:   true,
                    isEditing: false,
                })
            }
            commit('setItems', items)
        },
        fetchGroups ({ commit, dispatch }) {
            axios.get( '/api/groups')
                .then( (res) => {
                    commit('setGroups', res.data.items)
                    dispatch('setGroupItems', res.data.items)
                })
                .catch( (res) => {
                    console.log( res )
                })
        },
        switchGroups ({ commit, state, dispatch }) {
            dispatch('setGroupItems', state.groups)
            commit('setShowGroups', true)
            commit('setGroupId', null)
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
                commit('setGroupId', groupId)
            }
        },
        showNewGroupInput ({ commit }) {
            commit('setShowNewInput', true)
        },
        showNewTaskInput ({ commit }) {
            commit('setShowNewInput', true)
        },
        saveNewItem ({ commit, state, dispatch }) {
            if (state.showGroups) {
                let url  = '/api/groups'
                let data = { name: state.newValue }
                axios.post(url, data)
                    .then( res => {
                        commit('setShowNewInput', false)
                        commit('setNewValue', '')
                        commit('setGroups', res.data.items)
                        dispatch('setGroupItems', res.data.items)
                    })
                    .catch( error => {
                        console.log(error)
                    })
            } else if (state.groupId) {
            }
        },
        updateItem ({ commit, state, dispatch }, item) {
            if (state.showGroups) {
                let url  = '/api/groups/' + item.id
                let data = { name: item.value }
                axios.patch(url, data)
                    .then( res => {
                        commit('setGroups', res.data.items)
                        dispatch('setGroupItems', res.data.items)
                    })
                    .catch( error => {
                        console.log(error)
                    })
            } else if (state.groupId) {
            }
        },
    },

    getters: {
    },

    modules: {
    }
}
