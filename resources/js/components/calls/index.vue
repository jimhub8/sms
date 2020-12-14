<template>
<v-app>
    <v-container fluid fill-height id="orders">
        <v-layout justify-center align-center wrap>
            <template>
                <v-card>
                    <v-card-title>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn icon v-bind="attrs" v-on="on" @click="getCalls">
                                    <v-icon small>mdi-refresh</v-icon>
                                </v-btn>
                            </template>
                            <span>Refresh</span>
                        </v-tooltip>
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on, attrs }">
                                <v-btn icon v-bind="attrs" v-on="on" @click="make_call('+254731090832')">
                                    <v-icon color="primary">
                                        mdi-phone
                                    </v-icon>
                                </v-btn>
                            </template>
                            <span>Make a Call</span>
                        </v-tooltip>
                        <v-spacer></v-spacer>
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="calls" :search="search">
                        <template v-slot:item.actions="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on, attrs }">
                                    <v-btn icon v-bind="attrs" v-on="on" @click="make_call(item.to)">
                                        <v-icon color="primary">
                                            mdi-phone
                                        </v-icon>
                                    </v-btn>
                                </template>
                                <span>Call {{ item.to }}</span>
                            </v-tooltip>
                        </template>
                    </v-data-table>
                </v-card>
            </template>
        </v-layout>
        <myCall />
    </v-container>
</v-app>
</template>

<script>
import {
    mapState
} from "vuex";
import myCall from './call'
export default {
    components: {
        myCall,
    },
    data() {
        return {
            search: '',
            headers: [{
                    text: 'Create On',
                    align: 'start',
                    value: 'created_at',
                },
                {
                    text: 'From',
                    value: 'from'
                },
                {
                    text: 'To',
                    value: 'to'
                },
                {
                    text: 'Duration',
                    value: 'duration'
                },
                {
                    text: 'Country from',
                    value: 'country_from'
                },
                {
                    text: 'Country to',
                    value: 'country_to'
                },
                {
                    text: 'Direction',
                    value: 'direction'
                },
                {
                    text: 'CallSid',
                    value: 'CallSid'
                },
                {
                    text: 'Call count',
                    value: 'call_count'
                },
                {
                    text: 'Follow up',
                    value: 'followup'
                },
                {
                    text: 'Actions',
                    sortable: false,
                    value: 'actions'
                },
            ],
        }
    },
    methods: {
        getCalls() {
            var payload = {
                model: 'incoming',
                update: 'updateCalls'
            }
            this.$store.dispatch('getItems', payload).then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error.response);
            })
        },

        make_call(phone) {
            eventBus.$emit('makeCallEvent', phone)
        }
    },

    computed: {
        ...mapState(['calls'])
    },
    mounted() {
        this.getCalls();
    },
}
</script>
