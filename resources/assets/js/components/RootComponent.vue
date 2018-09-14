<template>
    <v-layout>
        <v-flex>
            <v-list>
                <v-list-tile v-if="!showGroups">
                    <v-list-tile-content>
                        <v-btn fab flat small @click="switchGroups">
                            <v-icon color="info">arrow_back</v-icon>
                        </v-btn>
                    </v-list-tile-content>
                </v-list-tile>
                <template v-for="item in items">
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-text-field
                                v-model="item.value"
                                :readonly="!item.isEditing"
                            >
                                <v-slide-x-reverse-transition
                                    slot="append-outer"
                                    mode="out-in"
                                >
                                    <v-icon
                                        class="mt-2 mb-0"
                                        :color="item.isEditing ? 'success' : 'info'"
                                        @click="item.isEditing = !item.isEditing"
                                        v-text="item.isEditing ? 'check' : 'edit'"
                                    ></v-icon>
                                </v-slide-x-reverse-transition>
                                <v-card flat slot="append-outer" v-if="item.isGroup">
                                    <v-icon
                                        class="mt-2 mb-0"
                                        color="info"
                                        @click="switchTasks(item.id)"
                                    >arrow_forward</v-icon>
                                </v-card>
                            </v-text-field>
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
    computed: mapState(['items', 'showGroups']),
    mounted () {
        this.fetchGroups()
    },
    methods: mapActions(['fetchGroups', 'switchTasks', 'switchGroups']),
}
</script>
