<template>
<v-dialog v-model="dialog" width="400">

    <v-card>
        <v-card-title primary-title>
            Calls
        </v-card-title>
        <v-card-text>
            <v-text-field v-model="form.phone_number" label="Phone No." required></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-btn icon :color="call_status.color" @click="callCustomer">
                <v-icon>{{ call_status.call_icon }}</v-icon>
            </v-btn>
            <v-btn icon color="red" @click="hangup">
                <v-icon>mdi-phone-hangup</v-icon>
            </v-btn>

            <v-spacer></v-spacer>
            <v-btn icon color="primary" @click="icoming_call">
                <v-icon>mdi-cloud-upload-outline</v-icon>
            </v-btn>
        </v-card-actions>
    </v-card>
    <myCallStatus />
</v-dialog>
</template>

<script>
import {
    Device
} from 'twilio-client';
import myCallStatus from './call_status'
export default {
    components: {
        myCallStatus,
    },
    data() {
        return {
            dialog: false,
            form: {
                phone_number: '254731090832'
            },
            twilio_token: '',
            call_status: {
                color: 'primary',
                call_icon: 'mdi-phone',
            }
        }
    },
    methods: {
        icoming_call() {
            var payload = {
                model: 'incoming',
                data: this.form
            }
            this.$store.dispatch('postItems', payload).then((response) => {
                console.log(response);
                // this.call_status.call_icon = 'mdi-phone-in-talk'
                // this.call_status.color = 'success'
            }).catch((error) => {
                console.log(error.response);
            })
        },

        call() {
            var payload = {
                model: 'call',
                data: this.form
            }
            this.$store.dispatch('postItems', payload).then((response) => {
                console.log(response);
                this.call_status.call_icon = 'mdi-phone-in-talk'
                this.call_status.color = 'success'
            }).catch((error) => {
                console.log(error.response);
            })
        },

        generate_token() {
            axios.get("twilio_token").then((response) => {
                console.log(response);
                this.twilio_token = response.data
                console.log('Token Generated...');

                var device = new Device(response.data, {
                    // Set Opus as our preferred codec. Opus generally performs better, requiring less bandwidth and
                    // providing better audio quality in restrained network conditions. Opus will be default in 2.0.
                    // codecPreferences: ["opus", "pcmu"],
                    // Use fake DTMF tones client-side. Real tones are still sent to the other end of the call,
                    // but the client-side DTMF tones are fake. This prevents the local mic capturing the DTMF tone
                    // a second time and sending the tone twice. This will be default in 2.0.
                    // fakeLocalDTMF: true,
                    // Use `enableRingingState` to enable the device to emit the `ringing`
                    // state. The TwiML backend also needs to have the attribute
                    // `answerOnBridge` also set to true in the `Dial` verb. This option
                    // changes the behavior of the SDK to consider a call `ringing` starting
                    // from the connection to the TwiML backend to when the recipient of
                    // the `Dial` verb answers.
                    // enableRingingState: true
                });
                console.log(device);
                device.on("ready", function (device) {
                    console.log("Twilio.Device Ready!");
                    // document.getElementById("call-controls").style.display = "block";
                });

                device.on("error", function (error) {
                    console.log("Twilio.Device Error: " + error.message);
                });

                device.on("connect", function (conn) {
                    console.log("Successfully established call!");
                    // document.getElementById("button-call").style.display = "none";
                    // document.getElementById("button-hangup").style.display = "inline";
                    // volumeIndicators.style.display = "block";
                    this.bindVolumeIndicators(conn);
                });

                device.on("disconnect", function (conn) {
                    console.log("Call ended.");
                    // document.getElementById("button-call").style.display = "inline";
                    // document.getElementById("button-hangup").style.display = "none";
                    // volumeIndicators.style.display = "none";
                });

                device.on("incoming", function (conn) {
                    console.log("Incoming connection from " + conn.parameters.From);
                    var archEnemyPhoneNumber = "+12093373517";

                    if (conn.parameters.From === archEnemyPhoneNumber) {
                        conn.reject();
                        console.log("It's your nemesis. Rejected call.");
                    } else {
                        // accept the incoming connection and start two-way audio
                        conn.accept();
                    }
                });

                // setClientNameUI(data.identity);

                device.audio.on("deviceChange", this.updateAllDevices.bind(device));

                // Show audio selection UI if it is supported by the browser.
                if (device.audio.isOutputSelectionSupported) {
                    console.log('supported');
                    // document.getElementById("output-selection").style.display = "block";
                }

                // Device.setup(response.data);

                // var self = this

                // Device.ready(function (device) {});
                // setTimeout(() => {
                //     this.connect()
                // }, 1000);
                // setTimeout(() => {
                //     this.callCustomer()
                // }, 3000);

            }).catch((error) => {
                console.log(error);
            })
        },

        bindVolumeIndicators(connection) {
            connection.volume(function (inputVolume, outputVolume) {
                var inputColor = 'red';
                if (inputVolume < .50) {
                    inputColor = 'green';
                } else if (inputVolume < .75) {
                    inputColor = 'yellow';
                }

                inputVolumeBar.style.width = Math.floor(inputVolume * 300) + 'px';
                inputVolumeBar.style.background = inputColor;

                var outputColor = 'red';
                if (outputVolume < .50) {
                    outputColor = 'green';
                } else if (outputVolume < .75) {
                    outputColor = 'yellow';
                }

                outputVolumeBar.style.width = Math.floor(outputVolume * 300) + 'px';
                outputVolumeBar.style.background = outputColor;
            });
        },
        updateAllDevices() {
            // this.updateDevices(speakerDevices, device.audio.speakerDevices.get());
            // this.updateDevices(ringtoneDevices, device.audio.ringtoneDevices.get());
        },
        updateDevices(selectEl, selectedDevices) {
            selectEl.innerHTML = "";

            device.audio.availableOutputDevices.forEach(function (device, id) {
                var isActive = selectedDevices.size === 0 && id === "default";
                selectedDevices.forEach(function (device) {
                    if (device.deviceId === id) {
                        isActive = true;
                    }
                });

                var option = document.createElement("option");
                option.label = device.label;
                option.setAttribute("data-id", id);
                if (isActive) {
                    option.setAttribute("selected", "selected");
                }
                selectEl.appendChild(option);
            });
        },

        connect() {

            Device.connect(function () {
                console.log('********************************');
                // Disable the hangup button and enable the call buttons
                // hangUpButton.prop("disabled", true);
                // callCustomerButtons.prop("disabled", false);
                // callSupportButton.prop("disabled", false);

                console.log("disconnected");
            });

        },
        callCustomer() {
            // var params = {
            //     To: this.form.phone_number
            // };

            var params = {
                "phoneNumber": this.form.phone_number
            };
            console.log("Calling " + params.phoneNumber + "...");
            // updateCallStatus("Calling " + phoneNumber + "...");

            var device = new Device();
            device.setup(this.twilio_token);

            if (device) {
                alert('test')
                var outgoingConnection = device.connect(params);
                outgoingConnection.on("ringing", function () {
                    console.log("Ringing...");
                });
            }

            // var params = {
            //     "phoneNumber": this.form.phone_number
            // };
            // Device.connect(params);

            // setTimeout(() => {
            //     this.dial_call()
            // }, 3000);
        },
        dial_call() {
            axios.get('dial_call').then((response) => {
                console.log(response);
            }).catch((error) => {
                console.log(error);
            })
        },

        hangup() {
            Device.disconnectAll()
            // device.disconnectAll();
            this.update_call_status()
        },
        update_call_status() {
            eventBus.$emit('updateCallStatusEvent')
        }
    },
    created() {
        eventBus.$on('makeCallEvent', data => {
            this.dialog = true
            this.form.phone_number = data
        });
    },

    mounted() {
        setTimeout(() => {
            this.generate_token()
        }, 2000);
    },
}
</script>
