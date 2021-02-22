<template>
<v-card class="mx-auto" width="600" style="margin-bottom: 20px">
    <v-card dark flat>
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
            <!-- <v-timeline-item color="pink" small v-for="item in 4" :key="item.id"> -->
            <v-timeline-item color="pink" small v-for="item in waybill.waybillTrackingDetail" :key="item.id">
                <v-row class="pt-1">
                    <v-col cols="6">
                        <strong>{{ item.date }}</strong>
                        <!-- <strong>Boom</strong> -->
                    </v-col>
                    <v-col>
                        <v-card>
                            <v-card-title   style="color: #fff; background-color: #f08c25!important;">
                                <!-- Lorem -->
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
</v-card>
</template>

<script>
export default {
    props: ['waybill'],
}
</script>
