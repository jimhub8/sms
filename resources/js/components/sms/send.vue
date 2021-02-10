<template>
<v-row justify="center">
    <v-dialog v-model="dialog" persistent max-width="600px">
        <v-card>
            <v-card-title>
                <span class="headline">Send SMS</span>
            </v-card-title>
            <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" sm="12" md="12">
                            <el-select v-model="opt" placeholder="Select" @change="text_update">
                                <el-option v-for="item in options" :key="item.value" :label="item.value" :value="item.value">
                                </el-option>
                            </el-select>
                        </v-col>
                        <v-col cols="12" sm="12" md="12">
                            <v-textarea label="Message" v-model="message"></v-textarea>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
            <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="blue darken-1" text @click="close">
                    Close
                </v-btn>
                <v-btn color="blue darken-1" @click="confirm" outlined rounded :loading="loading" :disabled="loading">
                    <v-icon>mdi-send</v-icon>
                    Send
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</v-row>
</template>

<script>
export default {
    props: ['form', 'messages'],
    data: () => ({
        dialog: false,
        loading: false,
        opt: '',

        message: '',

        options: [{
            value: '{{ Client Name }}'
        }, {
            value: '{{ Client Phone }}'
        }, {
            value: '{{ Client Address }}'
        },
        // {
        //     value: '{{ Product }}'
        // }
        ],
    }),
    methods: {
        send() {
            this.form.message = this.message
            // this.loading_message = "Sending messages ... Please wait";
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

        confirm() {
            this.$confirm(
                    this.messages.length + " messages will be sent",
                    "Warning", {
                        confirmButtonText: "OK",
                        cancelButtonText: "Cancel",
                        type: "warning",
                    }
                )
                .then(() => {
                    if (this.messages.length > 0) {
                        this.send()
                    }
                })
                .catch(() => {
                    // this.$message({
                    //     type: "error",
                    //     message: "Delete canceled",
                    // });
                });
        },
        close() {
            this.dialog = false
        },
        text_update(text) {
            this.message = this.message + ' ' + text + ' '
            this.opt = ''
        }
    },
    created() {
        eventBus.$on('smsEvent', data => {
            this.dialog = true
        })
    },

}
</script>
