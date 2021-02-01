<template>
<el-card class="box-card">
    <div slot="header" class="clearfix">
        <span>Call center report</span>
        <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
    </div>
    <!-- <el-row :gutter="20"> -->
    <!-- <el-col :span="24"> -->
    <div>
        <label for="">Date</label>
        <el-date-picker v-model="form.report_date" type="date" placeholder="Pick a day" style="width: 100%" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
        </el-date-picker>
        <small v-if="errors['report_date']" class="has-text-danger">{{ errors['report_date'][0] }}</small>
    </div>
    <!-- </el-col> -->
    <!-- <el-col :span="12">
            <label for="">End Date</label>
            <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a day" style="width: 100%" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
            </el-date-picker>
        </el-col> -->
    <!-- </el-row> -->
    <div class="text item">
        <label for="">Client</label>
        <el-select v-model="form.client" placeholder="Select" style="width: 100%" allow-create filterable clearable>
            <el-option v-for="item in vendors" :key="item.name" :label="item.name" :value="item.name"></el-option>
        </el-select>
        <small v-if="errors['client']" class="has-text-danger">{{ errors['client'][0] }}</small>
    </div>

    <div>
        <label for="">Total Orders</label>
        <el-input placeholder="Please input" v-model="form.total_orders"></el-input>
        <small v-if="errors['total_orders']" class="has-text-danger">{{ errors['total_orders'][0] }}</small>
    </div>

    <div>
        <label for="">Comment</label>
        <el-input type="textarea" placeholder="Please input" v-model="form.comment"></el-input>
    </div>

    <el-table :data="tableData" border style="width: 100%; margin-top: 20px">
        <el-table-column prop="status" label="Status" width="180">
            <template slot-scope="scope">
                <el-select v-model="scope.row.status" placeholder="Select" style="width: 100%" allow-create filterable clearable>
                    <el-option v-for="item in options" :key="item.value" :label="item.label" :value="item.value"></el-option>
                </el-select>
            </template>
        </el-table-column>
        <el-table-column prop="count" label="Total count">
            <template slot-scope="scope">
                <el-input placeholder="Please input" v-model="scope.row.count"></el-input>
            </template>
        </el-table-column>
        <el-table-column prop="action" label="Percentage" width="100">
            <template slot-scope="scope">
                {{
            parseFloat(
              (parseInt(scope.row.count) / parseInt(form.total_orders)) * 100
            ).toFixed(2)
          }}%
            </template>
        </el-table-column>
        <el-table-column prop="action" label="Remove" width="100">
            <template slot-scope="scope">
                <el-button type="danger" icon="el-icon-delete" @click.native.prevent="deleteRow(scope.$index)"></el-button>
            </template>
        </el-table-column>
    </el-table>

    <el-button type="primary" icon="el-icon-plus" @click="add_new" style="margin: 5px 0">Add aother row</el-button>
    <hr />
    <div class="bottom clearfix" style="margin-top: 30px">
        <el-button type="primary" :loading="loading" :disabled="loading" @click="send_report" style="float: right">Submit report</el-button>
    </div>
</el-card>
</template>

<script>
import {
    mapState
} from 'vuex';
export default {
    props: ["clients"],
    data() {
        return {
            options: [{
                    value: "Scheduled",
                    label: "Scheduled",
                },
                {
                    value: "Cancelled",
                    label: "Cancelled",
                },
                {
                    value: "Not Picking",
                    label: "Not Picking",
                },
                {
                    value: "Not Availble",
                    label: "Not Availble",
                },
                {
                    value: "Busy",
                    label: "Busy",
                },
                {
                    value: "Will call us back",
                    label: "Will call us back",
                },
                {
                    value: "Incomplete number",
                    label: "Incomplete number",
                },
            ],
            form: {
                report_date: new Date()
            },
            tableData: [{
                status: "",
                count: 0,
            }, ],
            loading: false,
            errors: []
        };
    },
    methods: {
        add_new() {
            this.tableData.push({
                status: "",
                count: 0,
            });
        },
        deleteRow(index) {
            this.tableData.splice(index, 1);
        },
        send_report() {
            this.loading = true;
            this.form.data = this.tableData;
            this.errors = []
            axios
                .post("report", this.form)
                .then((response) => {
                    console.log(response);
                    this.loading = false;
                    eventBus.$emit("alertMessageEvent");
                })
                .catch((error) => {
                    this.loading = false;
                    // console.log(error);
                    if (error.response.status === 500) {
                        eventBus.$emit('errorEvent', error.response.statusText)

                        return
                    } else if (error.response.status === 401 || error.response.status === 409) {
                        eventBus.$emit('reloadRequest', error.response.statusText)
                    } else if (error.response.status === 422) {
                        this.errors = error.response.data.errors
                        eventBus.$emit('errorEvent', error.response.data.message)
                        return
                    }
                });
        },
    },
    computed: {
        ...mapState(['vendors'])
    },
};
</script>

<style scoped>
</style>
