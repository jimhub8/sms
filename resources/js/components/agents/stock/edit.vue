<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Edit Stock</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <div>
                                <label for="">Full Name</label>
                                <el-input placeholder="John Doe" v-model="form.name"></el-input>
                            </div>
                            <div>
                                <label for="">Email Address</label>
                                <el-input placeholder="john@gmail.com" v-model="form.email"></el-input>
                            </div>
                            <div>
                                <label for="">Phone Number</label>
                                <el-input placeholder="+254..." v-model="form.phone"></el-input>
                            </div>

                            <label for="">Address</label>
                            <el-input placeholder="Main st" v-model="form.address"></el-input>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-btn color="blue darken-1" text @click="close">Close</v-btn>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="save" :loading="loading" :disabled="loading">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-layout>
</template>

<script>
import { mapState } from 'vuex';
export default {
    data: () => ({
        dialog: false,
        // loading: false,
        form: {},
        errors: {},
        payload: {
            model: 'stocks',
        },
        gender: [{
                value: 'Male',
                lable: 'Male',
            },
            {
                value: 'Female',
                lable: 'Female',
            },
        ]
    }),
    created() {
        eventBus.$on("openEditStock", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            this.payload['data'] = this.form
            this.$store.dispatch('patchItems', this.payload)
                .then(response => {
                    eventBus.$emit("stockEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['loading']),
    },
};
</script>
