<template>
<v-app>

    <v-main>
        <v-container fluid fill-height>

            <v-layout justify-center align-center>

                <router-view :user="user" :guard="guard" />
            </v-layout>
        </v-container>
    </v-main>
    <!-- <v-toolbar color="primary" dark>

            <v-toolbar-title>MFT</v-toolbar-title>

            <v-spacer></v-spacer>

            <router-link to="/">
                <v-btn text>Call Center</v-btn>
            </router-link>
            <router-link to="/products">
                <v-btn text>Products</v-btn>
            </router-link>
            <router-link to="/agents">
                <v-btn text>Agents</v-btn>
            </router-link>
            <router-link to="/Stock">
                <v-btn text>Stock Update</v-btn>
            </router-link>

        </v-toolbar> -->

    <!-- <el-tabs v-model="activeName" @tab-click="handleClick">
            <el-tab-pane label="Create" name="first">
                <myCreate :clients="clients" />
            </el-tab-pane>
            <el-tab-pane label="Display" name="second">
                <myShow :clients="clients" />
            </el-tab-pane>
        </el-tabs> -->
</v-app>
</template>

<script>
export default {
    props: ['user', 'guard'],

}
</script>

<style>

</style>
