<template>
<v-app>
    <v-layout row justify-center>
        <v-hover>
            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}`" class="mx-auto" style="width: 40%;padding: 10px; height: 700px;margin-top: 100px">
                <v-card-title primary-title>
                    Send sms
                    <v-spacer></v-spacer>
                    <v-btn color="primary" text href="/portal#/sms">Send Bulk Sms</v-btn>
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-layout row wrap>

                        <v-flex sm12>
                            <el-radio v-model="form.org" label="MFT">MFT</el-radio>
                            <el-radio v-model="form.org" label="Speedball">Speedball</el-radio>
                        </v-flex>
                        <!-- <v-flex sm12>
                            <v-select :items="items" label="Status" @change="mess_type"></v-select>
                        </v-flex> -->
                        <!-- <v-flex sm12>
                            <v-text-field v-model="form.name" label="Client Name" required></v-text-field>
                            <small class="has-text-danger" v-if="errors.name">{{ errors.name[0] }}</small>
                        </v-flex> -->
                        <v-flex sm12>
                            <v-textarea v-model="form.phone" color="blue">
                                <div slot="label">
                                    Phone numbers
                                </div>
                            </v-textarea>
                            <!-- <v-text-field v-model="form.phone" label="Phone Number" required></v-text-field> -->
                            <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </v-flex>
                        <!-- <v-flex sm12>
                            <v-text-field v-model="form.product_name" label="Product Name" required></v-text-field>
                            <small class="has-text-danger" v-if="errors.product_name">{{ errors.product_name[0] }}</small>
                        </v-flex> -->
                        <v-flex sm12>
                            <v-textarea v-model="form.message" color="blue">
                                <div slot="label">
                                    Message
                                </div>
                            </v-textarea>
                            <small class="has-text-danger" v-if="errors.message">{{ errors.message[0] }}</small>
                        </v-flex>
                    </v-layout>
                </v-card-text>
                <v-divider></v-divider>
                <v-card-actions>
                    <v-btn color="primary" @click="reset" text>
                        <v-icon>mdi-restore</v-icon> Reset
                    </v-btn>
                    <v-spacer></v-spacer>
                    <v-btn color="primary" @click="send" text :loading="loading" :disabled="loading">
                        <v-icon>mdi-send</v-icon> Send
                    </v-btn>
                </v-card-actions>
            </v-card>

        </v-hover>
    </v-layout>
    <v-snackbar v-model="snackbar" :color="color">
        {{ message }}
        <v-btn text color="primary" @click.native="snackbar = false">Close</v-btn>
    </v-snackbar>
</v-app>
</template>

<script>
export default {
    data() {
        return {
            items: ['Not Picking', 'Not Available', 'Busy'],
            form: {
                phone: '',
                message: '',
                org: 'MFT'
            },
            message: '',
            color: 'black',
            snackbar: false,
            loading: false,
            errors: [],
            message_type: '',
            messages: {
                not_picking: 'Hello, Jane Doe. This is speedball courier services. It is a delivery company in Nairobi. Thank you for your feedback. Kindly, contact us through 0207608777, when available for the order of 2mk oil and 2 samsu oil worth kshs. 6000',
                not_available: 'not available',
                busy: 'Busy',
            }
        }
    },
    methods: {
        send() {
            this.errors = []
            this.loading = true
            axios.post('/sms', this.form).then((response) => {
                this.reset()
                this.loading = false
                this.message = 'Sms sent'
                this.snackbar = true
            }).catch((error) => {
                this.loading = false
                this.message = 'Something went wrong'
                this.snackbar = true
                this.color = 'red'
                console.log(error.response);
                this.errors = error.response.data.errors
            })
        },
        reset() {
            this.form.phone = ''
            this.form.message = ''
        },
        mess_type(e) {
            console.log(e);
            if (e == 'Not Picking') {
                this.form.message = this.messages.not_picking
            }
            if (e == 'Not Available') {
                this.form.message = this.messages.not_available
            }
            if (e == 'Busy') {
                this.form.message = this.messages.busy
            }
            // this.message_type = e
        }
    },
}
</script>

<style scoped>
.has-text-danger {
    color: red;
}
</style>
