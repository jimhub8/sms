<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Edit Agent</span>
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
                                <label for="">Town</label>
                                <el-input placeholder="" v-model="form.town"></el-input>
                                <small v-if="errors['town']" class="has-text-danger">{{ errors['town'][0] }}</small>
                            </div>
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
export default {
    data: () => ({
        dialog: false,
        loading: false,
        form: {},
        errors: {},
    }),
    created() {
        eventBus.$on("openEditAgent", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                model: 'agents',
                id: this.form.id,
                data: this.form
            }
            this.$store.dispatch('patchItems', payload)
                .then(response => {
                    eventBus.$emit("agentEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
};
</script>
