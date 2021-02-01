<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create User</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
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
                    <label for="">Role</label>
                    <el-select v-model="form.role" placeholder="Select" style="width: 100%" clearable filterable>
                        <el-option v-for="item in options" :key="item.value" :label="item.value" :value="item.value">
                        </el-option>
                    </el-select>
                    <small v-if="errors['role']" class="has-text-danger">{{ errors['role'][0] }}</small>
                </div>
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
        loading: false,
        form: {},
        options: [{
                value: 'Admin'
            },
            {
                value: 'Call center'
            },
            {
                value: 'Rider Manager'
            },
        ],
        payload: {
            model: 'users',
        }
    }),
    created() {
        eventBus.$on("openCreateUser", data => {
            this.dialog = true;
        });
    },

    methods: {
        save() {
            this.payload['data'] = this.form
            this.$store.dispatch('postItems', this.payload)
                .then(response => {
                    eventBus.$emit("userEvent")
                });
        },
        close() {
            this.dialog = false;
        },
    },
    computed: {
        ...mapState(['errors'])
    },
};
</script>
