<template>
<v-card>
    <el-upload class="upload-demo" ref="upload" action="/messages" :auto-upload="false" :headers="item_header">
        <el-button slot="trigger" size="small" type="primary">select file</el-button>
        <el-button style="margin-left: 10px" size="small" type="success" @click="submitUpload">upload to server</el-button>
        <div class="el-upload__tip" slot="tip">
            xlsx files with a size less than 500kb
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
</v-card>
</template>

<script>
export default {
    data() {
        return {
            loading: false,
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
        };
    },
    methods: {
        submitUpload() {
            this.$refs.upload.submit();
        },
        send() {
            this.loading = true;
            axios
                .get("messages_send")
                .then((response) => {
                    this.loading = false;

                    eventBus.$emit('alertMessageEvent')
                })
                .catch((error) => {
                    this.$message.error('Oops, Something went wrong');

                    this.loading = false;
                    console.log(error);
                });
        },

        getMessages() {
            axios
                .get("messages")
                .then((response) => {
                    this.messages = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getMessages();
    },
};
</script>

<style>
</style>
