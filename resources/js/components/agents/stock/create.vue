<template>
<v-layout row justify-center>
    <v-dialog v-model="dialog" persistent max-width="700px">
        <v-card>
            <v-card-title>
                <span class="headline text-center" style="margin: auto;">Update Stock</span>
            </v-card-title>
            <v-divider></v-divider>
            <v-card-text>
                <v-container grid-list-md>
                    <v-layout row wrap>
                        <v-flex sm6>
                            <label for="">Stock Date</label>
                            <el-date-picker v-model="form.stock_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd" style="width: 100%" disabled>
                            </el-date-picker>
                        </v-flex>
                        <v-flex sm6>
                            <label for="">Opening Stock</label>
                            <el-input placeholder="" v-model="form.opening_stock" disabled></el-input>
                            <!-- <small v-if="errors['opening_stock']" class="has-text-danger">{{ errors['opening_stock'][0] }}</small> -->
                        </v-flex>
                        <v-flex sm6>
                            <label for="">Received Stock</label>
                            <el-input placeholder="" v-model="form.received"></el-input>
                            <small v-if="errors['received']" class="has-text-danger">{{ errors['received'][0] }}</small>
                        </v-flex>
                        <v-flex sm6>
                            <label for="">Delivered</label>
                            <el-input placeholder="" v-model="form.delivered"></el-input>
                            <small v-if="errors['delivered']" class="has-text-danger">{{ errors['delivered'][0] }}</small>
                        </v-flex>
                        <v-flex sm6>
                            <label for="">Returned</label>
                            <el-input placeholder="" v-model="form.returned"></el-input>
                            <small v-if="errors['returned']" class="has-text-danger">{{ errors['returned'][0] }}</small>
                        </v-flex>
                        <v-flex sm6>
                            <label for="">Closing Stock</label>
                            <el-input placeholder="" v-model="closing_stock" disabled></el-input>
                            <!-- <small v-if="errors['closing_stock']" class="has-text-danger">{{ errors['closing_stock'][0] }}</small> -->
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
        loading: false,
        form: {
            stock_date: new Date(),
            opening_stock: 0,
            received: 0,
            delivered: 0,
            returned: 0,
        },
    }),
    created() {
        eventBus.$on("openCreateStock", data => {
            this.dialog = true;
            this.getOpeningStock()
        });
    },

    methods: {
        save() {
            var payload = {
                data: this.form,
                model: 'stock'
            }
            this.form.closing_stock = this.closing_stock
            this.$store.dispatch('postItems', payload)
                .then(response => {
                    eventBus.$emit("stockEvent")
                    eventBus.$emit('alertMessageEvent')
                }).catch((error) => {
                    console.log(error.response.data.message);
                    // error.response.data.message
                    this.$message.error(error.response.data.message);
                })
        },

        getOpeningStock() {
            var payload = {
                model: 'opening_stock/1',
                update: 'updateOpeningStock'
            }
            this.$store.dispatch("getItems", payload).then((response) => {

                // console.log(response);
                this.form.opening_stock = response.data.closing_stock
            }).catch((error) => {
                console.log(error.response.data.errors);
                // error.response.data.errors
                // this.$message.error(error.response.data.errors);
            })
        },

        close() {
            this.dialog = false;
        }
    },
    computed: {
        ...mapState(['errors', 'opening_stock']),
        closing_stock() {
            return parseInt(this.form.opening_stock) + parseInt(this.form.received) - parseInt(this.form.delivered) - parseInt(this.form.returned)
        }
    },
};
</script>
