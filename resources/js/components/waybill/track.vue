<template>
<div style="padding: 20px">
    <v-card class="mx-auto" width="600" style="margin-bottom: 20px;">
        <v-toolbar width="600" style="margin:auto;padding: 7px 0">
            <v-text-field v-model="form.waybill" color="primary" :loading="loading" :disabled="loading" label="Track waybill" @keyup.enter="getOrder"></v-text-field>
            <v-btn class="" color="primary" dark outlined rounded small style="margin-left: 15px" @click="getOrder">
                <v-icon dark>mdi-magnify</v-icon>
                Search
            </v-btn>

        </v-toolbar>
        <v-card-text class="py-0" v-if="searched">
            <v-row style="background: #17478c;color: #fff;">
                <v-col sm="6">
                    <b>Consignor:</b> {{ waybill.seller.name }} <br>
                    <b>From Location: </b>{{ waybill.seller.address }}<br>
                    <!-- <b>Package: </b>1 -->
                </v-col>
                <!-- <v-col sm="6">
                    <b>Consignee:</b> {{ waybill.client.name }} <br>
                    <b>To Location: </b>{{ waybill.client.address }}<br>
                    <b>Package: </b>1
                </v-col> -->
            </v-row>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-text class="py-0" v-if="searched">
            <v-timeline align-top dense>
                <v-timeline-item color="pink" small v-for="item in waybill.order_history" :key="item.id">
                    <v-row class="pt-1">
                        <v-col cols="6">
                            <strong>{{ item.created_at }}</strong>
                        </v-col>
                        <v-col>
                            <v-card>
                                <v-card-title style="color: #fff; background-color: #f08c25!important;font-size: 15px">
                                    {{ item.action }}
                                </v-card-title>
                                <v-card-text>
                                    <div v-html="item.update_comment"></div>
                                </v-card-text>
                            </v-card>
                        </v-col>
                    </v-row>
                </v-timeline-item>

            </v-timeline>
        </v-card-text>
    </v-card>
    <v-snackbar v-model="snackbar">
        {{ text }}
    </v-snackbar>
</div>
</template>

<script>
export default {
    props: ['org'],
    data() {
        return {
            text: '',
            snackbar: false,
            waybill: {},
            form: {
                waybill: ''
            },
            searched: false,
            loading: false
        }
    },

    methods: {
        getOrder() {
            var headers = {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            this.loading = true
            console.log(this.$route)
            axios.post('waybill?org=' + this.org, this.form, {
                headers: headers
            }).then((response) => {
                this.loading = false
                this.waybill = response.data
                this.searched = true
            }).catch((error) => {
                this.text = 'Order not found'
                this.snackbar = true
                this.searched = false
                this.loading = false
            })
        }
    },
    mounted() {
        // this.getOrder()
    }

}
</script>
