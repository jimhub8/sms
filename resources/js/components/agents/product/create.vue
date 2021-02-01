<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="500px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Create Product</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <div>
                                <label for="">Product Name</label>
                                <el-input placeholder="" v-model="form.name"></el-input>
                                <small v-if="errors['name']" class="has-text-danger">{{ errors['name'][0] }}</small>
                            </div>
                            <div>
                                <label for="">Vendor</label>
                                <el-select v-model="form.vendor_id" placeholder="Select" style="width: 100%">
                                    <el-option v-for="item in vendors" :key="item.id" :label="item.name" :value="item.id">
                                    </el-option>
                                </el-select>
                                <small v-if="errors['vendor_id']" class="has-text-danger">{{ errors['vendor_id'][0] }}</small>
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
import {
    mapState
} from 'vuex';
export default {
    data: () => ({
        dialog: false,
        form: {},
    }),
    created() {
        eventBus.$on("openCreateProduct", data => {
            this.dialog = true;
            this.getVendors()
        });
    },

    methods: {
        save() {
            var payload = {
                data: this.form,
                model: 'products'
            }
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("productEvent")
                    eventBus.$emit('alertMessageEvent')
                });
        },
        close() {
            this.dialog = false;
        },
    },
    computed: {
        ...mapState(['errors', 'vendors', 'loading'])
    },
};
</script>
