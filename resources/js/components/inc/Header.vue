<template>
<v-app id="inspire">
    <v-navigation-drawer v-model="drawer" app>
        <!--  -->
        <div style="height: 100px;background: #f0f0f0;"></div>
        <v-list>
            <v-list-item-group v-model="selectedItem" color="primary">
                <router-link to="/">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-face-agent</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Customer Service</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/rider">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-bike</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Riders</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/agents">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-account</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Agents</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/vendors">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-select-multiple-marker</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Vendors</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/products">
                    <v-list-item>
                        <v-list-item-icon>
                            <v-icon>mdi-chart-ppf</v-icon>
                        </v-list-item-icon>
                        <v-list-item-content>
                            <v-list-item-title>Products</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </router-link>
                <router-link to="/stock">
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
    </v-app-bar>

    <v-main>
        <!--  -->
    </v-main>
</v-app>
</template>

<script>
export default {
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
        }
    },

    created () {
        eventBus.$on('alertMessageEvent', data => {
            this.alertMessage()
        });
    },
}
</script>

<style scoped>
.v-application a {
    text-decoration: none !important;
}
</style>
