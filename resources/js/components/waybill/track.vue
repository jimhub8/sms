<template>
<v-card class="mx-auto" width="600" style="margin-bottom: 20px">
    <!-- <v-card dark flat>
        <v-card-text class="py-0">
            <VRow>
                <VCol sm="6">
                    <b>Consignor:</b> UNATEUS LLC <br>
                    <b>From Location: </b>MOSCOW<br>
                    <b>Package: </b>1
                </VCol>
                <VCol sm="6">
                    <b>Consignee:</b> UNATEUS LLC <br>
                    <b>To Location: </b>Kisumu<br>
                    <b>Package: </b>1
                </VCol>
            </VRow>
        </v-card-text>
    </v-card>
    <v-card-text class="py-0">
        <v-timeline align-top dense>
            <v-timeline-item color="pink" small v-for="item in waybill.waybillTrackingDetail" :key="item.id">
                <v-row class="pt-1">
                    <v-col cols="6">
                        <strong>{{ item.date }}</strong>
                    </v-col>
                    <v-col>
                        <v-card>
                            <v-card-title   style="color: #fff; background-color: #f08c25!important;">
                                {{ item.actionLabel }}
                            </v-card-title>
                            <v-card-text>
                                {{ item.updatedOU }}

                            </v-card-text>
                        </v-card>
                    </v-col>
                </v-row>
            </v-timeline-item>

        </v-timeline>
    </v-card-text>
    -->

    <v-text-field v-model="form.waybill" label="Track waybill" @keyup.enter="getOrder"></v-text-field>

    <v-card-text class="py-0" v-if="searched">
        <v-row style="background: #17478c;color: #fff;">
            <v-col sm="6">
                <b>Consignor:</b> {{ waybill.seller.name }} <br>
                <b>From Location: </b>{{ waybill.seller.address }}<br>
                <!-- <b>Package: </b>1 -->
            </v-col>
            <v-col sm="6">
                <b>Consignee:</b> {{ waybill.client.name }} <br>
                <b>To Location: </b>{{ waybill.client.address }}<br>
                <b>Package: </b>1
            </v-col>
        </v-row>
    </v-card-text>
    <v-divider></v-divider>
    <v-card-text class="py-0">
        <v-timeline align-top dense>
            <v-timeline-item color="pink" small v-for="item in waybill.order_history" :key="item.id">
                <v-row class="pt-1">
                    <v-col cols="6">
                        <strong>{{ item.created_at }}</strong>
                    </v-col>
                    <v-col>
                        <v-card>
                            <v-card-title style="color: #fff; background-color: #f08c25!important;">
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
</template>

<script>
export default {
    props: ['org'],
    data() {
        return {
            waybill: {},
            form: {
                waybill: ''
            },
            searched: false
        }
    },

    methods: {
        getOrder() {
            console.log(this.$route)
            axios.post('waybill?org=' + this.org, this.form).then((response) => {
                this.waybill = response.data
                this.searched = true
            })
        }
    },
    mounted() {
        this.getOrder()
    }

}
</script>
