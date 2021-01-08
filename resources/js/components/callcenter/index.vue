<template>
<el-card class="box-card" style="width: 40%; margin: auto">
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="Create" name="first">
            <myCreate :clients="clients" />
        </el-tab-pane>
        <el-tab-pane label="Display" name="second">
            <myShow :clients="clients" />
        </el-tab-pane>
    </el-tabs>
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
            activeName: 'second',
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
        }
    }
};
</script>

<style scoped>
</style>
