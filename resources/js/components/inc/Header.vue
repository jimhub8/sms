<template>
<v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
        <!--  -->
        <div style="height: 100px;background: #f0f0f0;"></div>
        <v-list>
            <v-list-item-group>
                <router-link to="/" v-if="user.role == 'Admin' ||  user.role == 'Call center'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-face-agent</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Customer Service</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/rider" v-if="user.role == 'Admin' ||  user.role == 'Rider Manager'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-bike</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Riders</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/agents" v-if="user.role == 'Admin'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Agents</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/vendors" v-if="user.role == 'Admin'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-select-multiple-marker</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Vendors</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/products" v-if="user.role == 'Admin'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-chart-ppf</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Products</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/users" v-if="user.role == 'Admin'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account-circle-outline</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Users</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/stock" v-if="user.role == 'Admin'">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-stocking</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Stock update</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
            </v-list-item-group>
        </v-list>
    </v-navigation-drawer>

    <v-app-bar app color="primary">
        <v-app-bar-nav-icon @click="drawer = !drawer" color="white"></v-app-bar-nav-icon>

        <v-toolbar-title style="color: #fff">MFT</v-toolbar-title>

        <v-spacer></v-spacer>
        <myMenu :user="user"/>
    </v-app-bar>

    <v-main>
        <!--  -->
    </v-main>
</v-app>
</template>

<script>
import myMenu from './menu'
export default {
    components: {
        myMenu,
    },
    props: ['user', 'guard'],
    data: () => ({
        selectedItem: 1,
        drawer: null
    }),
    methods: {
        alertMessage() {
            this.$message({
                message: "Success",
                type: "success",
            });
        },
        errorMessage(message) {
            this.$message({
                message: message,
                type: "error",
            });
        }
    },

    created () {
        eventBus.$on('alertMessageEvent', data => {
            this.alertMessage()
        });
        eventBus.$on('errorEvent', data => {
            this.errorMessage(data)
        });
    },
}
</script>

<style scoped>
.v-application a {
    text-decoration: none !important;
}
</style>
