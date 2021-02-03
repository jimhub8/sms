<template>
<el-card class="box-card" style="width: 40%; margin: auto">
    <!-- <v-app> -->
    <!-- <v-toolbar color="primary" dark>

            <v-toolbar-title>Rider Perfomance</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link to="/">
                <v-btn text>Call Center</v-btn>
            </router-link>

        </v-toolbar> -->
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="Create" name="first">
            <myCreate :riders="riders" />
        </el-tab-pane>
        <el-tab-pane label="Display" name="second">
            <myShow :riders="riders" />
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
            riders: [{
                    value: "John",
                },
                {
                    value: "Jane",
                },
                {
                    value: "Chris",
                },
                {
                    value: "Doe",
                },
                {
                    value: "Paul",
                },
            ],
        };
    },
    methods: {
        handleClick(tab, event) {
            console.log(tab, event);
        },
        getRiders() {
            var payload = {
                model: 'rideraccount',
                update: 'updateRiders'
            }
            this.$store.dispatch("getItems", payload);
        },
    },

    mounted() {
        this.getRiders();
    },
};
</script>

<style scoped>
</style>
