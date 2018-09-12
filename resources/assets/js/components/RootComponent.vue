<template>
    <v-layout>
        <v-flex>
            <v-list>
                <template v-for="item in groups">
                    <v-list-tile>
                        <v-list-tile-content>
                            <v-list-tile-title v-text="item.name"></v-list-tile-title>
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
    computed: mapState(['groups']),
    mounted () {
        this.fetchGroups()
    },
    methods: mapActions(['fetchGroups']),
}
</script>
