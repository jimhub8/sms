<template>
<v-app>
    <v-layout row justify-center>
        <v-hover>
            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}`" class="mx-auto" style="width: 40%;padding: 10px; height: 500px;margin-top: 100px">

                <v-card-title primary-title>
                    Send sms
                </v-card-title>
                <v-divider></v-divider>
                <v-card-text>
                    <v-layout row wrap>
                        <v-flex sm12>
                            <v-text-field v-model="form.phone" label="Phone Number" required></v-text-field>
                            <small class="has-text-danger" v-if="errors.phone">{{ errors.phone[0] }}</small>
                        </v-flex>
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
            form: {
                phone: '',
                message: ''
            },
            message: '',
            color: 'black',
            snackbar: false,
            loading: false,
            errors: []
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
        }
    },
}
</script>

<style scoped>
.has-text-danger {
    color: red;
}
</style>
