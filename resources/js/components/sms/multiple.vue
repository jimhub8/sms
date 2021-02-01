<template>
<v-container fluid fill-height>
    <!-- <v-layout justify-center align-center wrap>
        <v-card style="padding: 20px">

            <v-card-text>

                <v-layout row wrap>
                    <v-flex sm3>
                        <label for="">Start Date</label>
                        <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-flex>
                    <v-flex sm3>
                        <label for="">End Date</label>
                        <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-flex>
                </v-layout>

                <el-upload class="upload-demo" ref="upload" action="/messages" :auto-upload="false" :headers="item_header">
                    <el-button slot="trigger" size="small" type="primary">select file</el-button>
                    <el-button style="margin-left: 10px" size="small" type="success" @click="submitUpload">upload to server</el-button>
                    <div class="el-upload__tip" slot="tip">
                        csv/xlsx files
                    </div>
                </el-upload>
                <v-divider></v-divider>
                <v-tooltip bottom>
                    <template v-slot:activator="{ on, attrs }">
                        <v-btn icon v-bind="attrs" v-on="on" @click="getMessages" small>
                            <v-icon color="primary"> mdi-refresh </v-icon>
                        </v-btn>
                    </template>
                    <span>Get data</span>
                </v-tooltip>

                <v-spacer></v-spacer>
                <v-btn color="primary" text @click="send" :loading="loading" :disabled="loading">Send Messages</v-btn>

                <v-data-table :headers="headers" :items="messages" :search="search"></v-data-table>
            </v-card-text>

        </v-card>
    </v-layout> -->

    <v-layout justify-center align-center wrap>
        <v-flex sm9 offset-sm3>
            <v-card style="height: 100px; padding-top: 20px">
                <v-layout row>
                    <!-- <v-flex sm1 style="margin-left: 10px;">
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getMessages">
                                    <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                </v-btn>
                            </template>
                            <span>Refresh</span>
                        </v-tooltip>
                    </v-flex> -->
                    <v-flex sm2 style="margin-left: 10px">
                        <label for="">Start Date</label>
                        <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-flex>
                    <v-flex sm2 style="margin-left: 30px">
                        <label for="">End Date</label>
                        <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-flex>
                    <v-flex sm2 style="margin-top: 30px" offset-sm1>
                        <!-- <v-btn color="primary" text @click="send" :loading="loading" :disabled="loading">Send Messages</v-btn> -->
                        <v-tooltip bottom>
                            <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on" slot="activator" class="mx-0" @click="filter">
                                    <v-icon color="blue darken-2" small>mdi-filter</v-icon>
                                </v-btn>
                            </template>
                            <span>Filter</span>
                        </v-tooltip>
                        <v-tooltip bottom v-if="send_sms">
                            <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on" slot="activator" class="mx-0" @click="confirm">
                                    <v-icon color="blue darken-2" small>mdi-send</v-icon>
                                </v-btn>
                            </template>
                            <span>Send messages to the users on the table</span>
                        </v-tooltip>
                    </v-flex>
                    <v-flex sm4 style="margin-top: 30px">
                        <el-upload class="upload-demo" ref="upload" action="/messages" :auto-upload="false" :headers="item_header" loading>
                            <el-button slot="trigger" size="small" type="primary">select file</el-button>
                            <el-button style="margin-left: 10px" size="small" type="success" @click="submitUpload">upload to server</el-button>
                            <!-- <div class="el-upload__tip" slot="tip">
                                csv/xlsx files
                            </div> -->
                        </el-upload>
                    </v-flex>
                </v-layout>
            </v-card>
        </v-flex>
        <v-flex sm9 offset-sm3>
            <v-card>
                <v-card-title>
                    <!-- <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field> -->
                </v-card-title>
                <v-data-table :headers="headers" :items="messages" :search="search" :loading="loading" :loading-text="loading_message"></v-data-table>
            </v-card>
        </v-flex>
    </v-layout>
    <mySend :form="form" :messages="messages" />
</v-container>
</template>

<script>
import mySend from './send'
export default {
    components: {
        mySend,
    },
    data() {
        return {
            loading: false,
            loading_message: "Loading... Please wait",
            search: "",
            headers: [{
                    text: "Name",
                    value: "name",
                },
                {
                    text: "Phone",
                    value: "phone",
                },
                {
                    text: "Address",
                    value: "address",
                },
            ],

            item_header: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            messages: [],
            form: {},
            send_sms: false
        };
    },
    methods: {
        submitUpload() {
            this.$refs.upload.submit();
        },
        send() {
            this.loading_message = "Sending messages ... Please wait";
            this.loading = true;
            axios
                .post("messages_send", this.form)
                .then((response) => {
                    this.loading = false;
                    this.send_sms = false
                    eventBus.$emit("alertMessageEvent");
                })
                .catch((error) => {
                    this.$message.error("Oops, Something went wrong");
                    this.send_sms = false

                    this.loading = false;
                    console.log(error);
                });
        },
        filter() {
            this.loading = true;
            this.loading_message = "Loading ... Please wait";
            axios
                .post("filter_messages", this.form)
                .then((response) => {
                    this.loading = false;
                    if (response.data.length < 1) {
                        this.$message.error("Oops, No data found");
                    } else {
                        this.send_sms = true

                    }
                    this.messages = response.data;
                    // eventBus.$emit("alertMessageEvent");
                })
                .catch((error) => {
                    this.$message.error("Oops, Something went wrong");

                    this.loading = false;
                    console.log(error);
                });
        },

        getMessages() {
            this.loading_message = "Loading ... Please wait";
            axios
                .get("messages")
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        confirm() {
            eventBus.$emit('smsEvent')
        },
    },
    mounted() {
        this.getMessages();
    },
};
</script>

<style>
</style>
