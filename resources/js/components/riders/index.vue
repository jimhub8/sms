<template>
<el-card class="box-card" style="width: 40%; margin: auto">
    <el-tabs v-model="activeName" @tab-click="handleClick">
        <el-tab-pane label="Create" name="first">
            <myCreate :riders="riders" />
        </el-tab-pane>
        <el-tab-pane label="Display" name="second">
            <myShow  :riders="riders" />
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
        }
    }
};
</script>

<style scoped>
</style>
