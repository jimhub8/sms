<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="400px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Edit Product</span>
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
        payload: {
            model: 'products',
        },
    }),
    created() {
        eventBus.$on("openEditProduct", data => {
            this.form = data
            this.dialog = true;
        });
    },

    methods: {
        save() {
            this.payload['data'] = this.form
            this.$store.dispatch('patchItems', this.payload)
                .then(response => {
                    eventBus.$emit("productEvent")
                });
        },
        close() {
            this.dialog = false;
        }
    },
};
</script>
