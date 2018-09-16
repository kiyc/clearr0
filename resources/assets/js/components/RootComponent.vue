<template>
    <v-layout>
        <v-flex>
            <v-list class="blue" dark>
                <v-list-tile>
                    <v-list-tile-content>
                        <v-flex row>
                        <v-btn fab flat small @click="switchGroups" v-if="!showGroups">
                            <v-icon>arrow_back</v-icon>
                        </v-btn>
                        <v-btn fab flat small @click="showNewGroupInput" v-if="showGroups">
                            <v-icon>add</v-icon>
                        </v-btn>
                        <v-btn fab flat small @click="showNewTaskInput" v-else>
                            <v-icon>add</v-icon>
                        </v-btn>
                        </v-flex>
                    </v-list-tile-content>
                </v-list-tile>
                <v-list-tile v-if="showNewInput">
                    <v-list-tile-content>
                        <v-flex style="width:100%">
                            <v-text-field
                                v-model="newValue"
                                placeholder="New Item"
                            >
                                <v-card flat slot="append-outer" class="blue">
                                    <v-icon
                                        class="mt-2 mb-0"
                                        @click="saveNewItem"
                                    >check</v-icon>
                                </v-card>
                            </v-text-field>
                        </v-flex>
                    </v-list-tile-content>
                </v-list-tile>
                <template v-for="item in items">
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-flex style="width:100%">
                                <v-text-field
                                    v-model="item.value"
                                    :readonly="!item.isEditing"
                                >
                                    <v-card flat slot="append-outer" class="blue">
                                        <v-icon
                                            class="mt-2 mb-0"
                                            @click="removeItem(item)"
                                        >clear</v-icon>
                                    </v-card>
                                    <v-slide-x-reverse-transition
                                        slot="append-outer"
                                        mode="out-in"
                                    >
                                        <v-icon
                                            class="mt-2 mb-0"
                                            @click="updateItem(item)"
                                            v-text="item.isEditing ? 'check' : 'edit'"
                                        ></v-icon>
                                    </v-slide-x-reverse-transition>
                                    <v-card flat slot="append-outer" v-if="item.isGroup" class="blue">
                                        <v-icon
                                            class="mt-2 mb-0"
                                            @click="switchTasks(item.id)"
                                        >arrow_forward</v-icon>
                                    </v-card>
                                </v-text-field>
                            </v-flex>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-flex>
    </v-layout>
</template>

<script>
import { mapState, mapActions } from 'vuex'

export default {
    data() {
        return {
        }
    },
    computed: {
        ...mapState(['items', 'showGroups', 'showNewInput']),
        newValue: {
            get () {
                return this.$store.state.newValue
            },
            set (value) {
                this.$store.commit('setNewValue', value)
            }
        },
    },
    mounted () {
        this.fetchGroups()
    },
    methods: {
        ...mapActions([
            'fetchGroups',
            'switchTasks',
            'switchGroups',
            'showNewGroupInput',
            'showNewTaskInput',
            'saveNewItem',
            'removeItem',
        ]),
        updateItem (item) {
            item.isEditing = !item.isEditing

            if (!item.isEditing) {
                this.$store.dispatch('updateItem', item)
            }
        },
    },
}
</script>
