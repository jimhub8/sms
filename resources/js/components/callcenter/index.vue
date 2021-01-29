<template>
<el-card class="box-card" style="width: 40%; margin: auto">
    <!-- <v-app> -->
    <!-- <v-toolbar color="primary" dark>

            <v-toolbar-title>Call center report</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link to="/rider">
                <v-btn text>Rider</v-btn>
            </router-link>

        </v-toolbar> -->
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="Create" name="first">
            <myCreate :clients="clients" />
        </el-tab-pane>
        <el-tab-pane label="Display" name="second">
            <myShow :clients="clients" />
        </el-tab-pane>
    </el-tabs>
    <!-- </v-app> -->
</el-card>
</template>

<script>
import myCreate from "./create";
import myShow from "./show";
export default {
    components: {
        myCreate,
        myShow
    },
    data() {
        return {
            activeName: 'first',
            clients: [{
                    value: "2wtrade",
                },
                {
                    value: "Mainstream",
                },
                {
                    value: "Spikey",
                },
                {
                    value: "Unateus",
                },
                {
                    value: "Clinton",
                },
                {
                    value: "Fitstall",
                },
            ],
        };
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        },

        getVendors() {
            var payload = {
                model: 'vendors',
                update: 'updateVendors'
            }
            this.$store.dispatch("getItems", payload);
        },
    },
    mounted() {
        this.getVendors();
    },
};
</script>

<style scoped>
</style>
