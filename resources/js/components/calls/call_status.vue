<template>
<v-dialog v-model="dialog" width="256">
    <v-card class="mx-auto" tile>
        <v-navigation-drawer permanent>
            <v-system-bar></v-system-bar>
            <v-list>
                <v-list-item>
                    <v-list-item-avatar>
                        <v-img src="https://cdn.vuetifyjs.com/images/john.png"></v-img>
                    </v-list-item-avatar>
                </v-list-item>

                <v-list-item link>
                    <v-list-item-content>
                        <v-list-item-title class="title">
                            John Leider
                        </v-list-item-title>
                        <v-list-item-subtitle>john@vuetifyjs.com</v-list-item-subtitle>
                    </v-list-item-content>

                    <v-list-item-action>
                        <v-icon>mdi-menu-down</v-icon>
                    </v-list-item-action>
                </v-list-item>
            </v-list>
            <v-divider></v-divider>
            <v-list nav dense>
                <v-list-item-group v-model="selectedItem" color="primary">
                    <v-list-item v-for="(item, i) in items" :key="i" @click="update_status(item.text)">
                        <v-list-item-icon>
                            <v-icon v-text="item.icon"></v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title v-text="item.text"></v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
        </v-navigation-drawer>
    </v-card>
</v-dialog>
</template>

<script>
import {
    Device
} from 'twilio-client';
export default {
    data() {
        return {
            dialog: false,

            selectedItem: 0,
            items: [{
                    text: 'Busy',
                    icon: 'mdi-phone-alert-outline'
                },
                {
                    text: 'Not picking',
                    icon: 'mdi-phone-missed'
                },
                {
                    text: 'Not Available',
                    icon: 'mdi-phone-classic-off'
                },
                {
                    text: 'Hanged Up',
                    icon: 'mdi-phone-cancel'
                },
                {
                    text: 'Success',
                    icon: 'mdi-phone-check-outline'
                },
            ],
        }
    },
    methods: {
        update_status(){
            
        }
    },
    created() {
        eventBus.$on('updateCallStatusEvent', data => {
            this.dialog = true
        });
    },
}
</script>
