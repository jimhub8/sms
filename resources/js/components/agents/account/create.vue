<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Agent</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <div>
                        <label for="">Full Name</label>
                        <el-input placeholder="John Doe" v-model="form.name"></el-input>
                        <small v-if="errors['name']" class="has-text-danger">{{ errors['name'][0] }}</small>
                    </div>
                    <div>
                        <label for="">Email Address</label>
                        <el-input placeholder="john@gmail.com" v-model="form.email"></el-input>
                        <small v-if="errors['email']" class="has-text-danger">{{ errors['email'][0] }}</small>
                    </div>
                    <div>
                        <label for="">Town</label>
                        <el-input placeholder="" v-model="form.town"></el-input>
                        <small v-if="errors['town']" class="has-text-danger">{{ errors['town'][0] }}</small>
                    </div>
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
import {
    mapState
} from 'vuex';
export default {
    data: () => ({
        dialog: false,
        form: {},
    }),
    created() {
        eventBus.$on("openCreateAgent", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            var payload = {
                data: this.form,
                model: 'agents'
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit('alertMessageEvent')
                    eventBus.$emit("agentEvent")
                }).catch((error) => {
                    console.log(error);
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)
                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    } else if (error.response.status === 422) {
                        eventBus.$emit('errorEvent', error.response.data.message)
                        context.commit('errors', error.response.data.errors)
                        return
                    }
                });
        },
        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['errors', 'loading'])
    },
};
</script>
