<template>
<el-card class="box-card">
    <div slot="header" class="clearfix">
        <span>Rider report</span>
        <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
    </div>
    <div class="text item">
        <label for="">Rider</label>
        <el-select v-model="form.rider" placeholder="Select" style="width: 100%" allow-create filterable clearable>
            <el-option v-for="item in riders" :key="item.value" :label="item.value" :value="item.value"></el-option>
        </el-select>
        <small v-if="errors['rider']" class="has-text-danger">{{ errors['rider'][0] }}</small>
    </div>
    <el-row :gutter="20">
        <el-col :span="12">
            <label for="">Start Date</label>
            <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a day" style="width: 100%" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
            </el-date-picker>
            <small v-if="errors['start_date']" class="has-text-danger">{{ errors['start_date'][0] }}</small>
        </el-col>
        <el-col :span="12">
            <label for="">End Date</label>
            <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a day" style="width: 100%" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
            </el-date-picker>
            <small v-if="errors['end_date']" class="has-text-danger">{{ errors['end_date'][0] }}</small>
        </el-col>
    </el-row>

    <el-tooltip content="Download report" placement="bottom">
        <el-button circle @click="download">
            <i class="mdi mdi-file-excel" style="font-size: 20px"></i>
        </el-button>
    </el-tooltip>

    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Total Orders</th>
                <th scope="col">Date</th>
                <th scope="col">Delivered</th>
                <th scope="col">Return</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(item, index) in tableData" :key="item.id">
                <th scope="row">{{ index+1 }} </th>
                <td>
                    <el-tag>{{ item.date }}</el-tag>
                </td>
                <td>{{ item.total_orders }}</td>
                <td>{{ item.delivered }}
                    <el-tag type="success">{{ (parseInt(item.delivered) / parseInt(item.total_orders) * 100).toFixed(2) }}% </el-tag>
                </td>
                <td>{{ item.returned }}
                    <el-tag type="danger"> {{ (parseInt(item.returned) / parseInt(item.total_orders) * 100).toFixed(2) }}%</el-tag>
                </td>
            </tr>
        </tbody>
    </table>
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
    props: ['riders'],
    data() {
        return {
            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            form: {},
            loading: false,
            errors: [],
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
            this.errors = []
            axios.post('rider_filter', this.form).then((response) => {
                // console.log(response);
                this.loading = false
                this.tableData = response.data
                this.$message({
                    message: 'Report generated',
                    type: 'success'
                });
            }).catch((error) => {
                console.log(error.response.statusText);
                this.loading = false
                this.tableData = {}

                if (error.response.status === 500) {
                    eventBus.$emit('errorEvent', error.response.statusText)
                    return
                } else if (error.response.status === 401 || error.response.status === 409) {
                    eventBus.$emit('reloadRequest', error.response.statusText)
                } else if (error.response.status === 422) {
                    this.errors = error.response.data.errors
                    eventBus.$emit('errorEvent', error.response.data.message)
                    return
                } else if (error.response.status === 404) {
                    // this.errors = error.response.data.errors
                    eventBus.$emit('errorEvent', error.response.data.message)
                    return
                }
                console.log(error);
            })
        },

        download() {
            this.$refs.form_data.submit()
        },
        // report_date() {
        //     axios.get('filter_rider', this.form).then((response) => {
        //         console.log(response);
        //         this.date_options = response.data
        //     }).catch((error) => {
        //         console.log(error);
        //     })
        // }

    },
    computed: {
        url() {
            return '/rider_report?start_date=' + this.form.start_date + '&end_date=' + this.form.end_date + '&rider=' + this.form.rider
        }
    },

    mounted() {
        // this.report_date();
    },
}
</script>

<style>

</style>
