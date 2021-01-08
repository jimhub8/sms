<template>
<el-card class="box-card">
    <div slot="header" class="clearfix">
        <span>Call center report</span>
        <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
    </div>
    <div class="text item">
        <label for="">Date Range</label>
        <el-select v-model="form.date" placeholder="Select" style="width: 100%" allow-create filterable clearable>
            <el-option v-for="(item, index) in date_options" :key="index" :label="item" :value="item"></el-option>
        </el-select>
    </div>
    <div class="text item">
        <label for="">Client</label>
        <el-select v-model="form.client" placeholder="Select" style="width: 100%" allow-create filterable clearable>
            <el-option v-for="item in clients" :key="item.value" :label="item.value" :value="item.value"></el-option>
        </el-select>
    </div>

    <!-- <download-excel :data="tableData.data" footer="Test footer" name="Report.xls"> -->
    <el-tooltip content="Download report" placement="bottom">
        <el-button circle @click="download">
            <i class="mdi mdi-file-excel" style="font-size: 20px"></i>
        </el-button>
    </el-tooltip>
    <!-- </download-excel> -->

    <el-table :data="tableData.data" border style="width: 100%;margin-top: 20px">
        <el-table-column prop="status" label="Status" width="180">
            <template slot-scope="scope">
                {{ scope.row.status }}
            </template>
        </el-table-column>
        <el-table-column prop="count" label="Total count">
            <template slot-scope="scope">
                {{ scope.row.count }}
            </template>
        </el-table-column>
        <el-table-column prop="action" label="Percentage" width="100">
            <template slot-scope="scope">
                {{ parseFloat(parseInt(scope.row.count) / parseInt(tableData.total_orders) * 100).toFixed(2) }}%
            </template>
        </el-table-column>
    </el-table>

    <div class="bottom clearfix" style="margin-top: 30px">
        <el-button type="primary" :loading="loading" :disabled="loading" @click="show" style="float: right">Generate report</el-button>
    </div>

    <form :action="url" method="post" ref="form_data" target="_blank">
        <input type="hidden" name="_token" :value="csrf">
    </form>

</el-card>
</template>

<script>
export default {
    props: ['clients'],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            form: {},
            loading: false,
            date_options: [],
            tableData: {},
            json_fields: {
                "Status": "status",
                "Total Count": "count",
            },
        };
    },
    methods: {
        show() {
            this.loading = true
            axios.post('filter', this.form).then((response) => {
                console.log(response);
                this.loading = false
                this.tableData = response.data
                this.$message({
                    message: 'Report generated',
                    type: 'success'
                });
            }).catch((error) => {
                this.loading = false
                console.log(error);
            })
        },

        report_date() {
            axios.get('report', this.form).then((response) => {
                console.log(response);
                this.date_options = response.data
            }).catch((error) => {
                console.log(error);
            })
        },
        download() {
            this.$refs.form_data.submit()
        },

    },
    computed: {
        url() {
            return '/export?date=' + this.form.date + '&client=' + this.form.client
        },
        serialize_data() {
            return JSON.stringify(this.form)
            // retur n JSON.stringify(this.form);
            //     this.$refs.form.submit()
            // eventBus.$emit('printPackageEvent', packaged)
        },
    },
    mounted() {
        this.report_date();
    },
}
</script>

<style>

</style>
