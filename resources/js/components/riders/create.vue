<template>
<el-card class="box-card">
    <div slot="header" class="clearfix">
        <span>Rider report</span>
        <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
    </div>
    <div>
        <label for="">Date</label>
        <el-date-picker v-model="form.date" type="date" placeholder="Pick a day" style="width: 100%" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
        </el-date-picker>
        <small v-if="errors['date']" class="has-text-danger">{{ errors['date'][0] }}</small>
    </div>

    <div class="text item">
        <label for="">Rider</label>
        <el-select v-model="form.rider" placeholder="Select" style="width: 100%" allow-create filterable clearable>
            <el-option v-for="item in riders" :key="item.id" :label="item.name" :value="item.name"></el-option>
        </el-select>
        <small v-if="errors['rider']" class="has-text-danger">{{ errors['rider'][0] }}</small>
    </div>

    <div>
        <label for="">Total Orders</label>
        <el-input placeholder="Please input" v-model="form.total_orders"></el-input>
        <small v-if="errors['total_orders']" class="has-text-danger">{{ errors['total_orders'][0] }}</small>
    </div>

    <el-row :gutter="20">
        <el-col :span="12">
            <div>
                <label for="">Delivered</label>
                <el-input placeholder="Please input" v-model="form.delivered"></el-input>
            </div>
            <small v-if="errors['delivered']" class="has-text-danger">{{ errors['delivered'][0] }}</small>
        </el-col>
        <el-col :span="12">
            <div>
                <label for="">Returned</label>
                <el-input placeholder="Please input" v-model="form.returned"></el-input>
            </div>
            <small v-if="errors['returned']" class="has-text-danger">{{ errors['returned'][0] }}</small>
        </el-col>
    </el-row>

    <div>
        <label for="">Comment</label>
        <el-input type="textarea" placeholder="Please input" v-model="form.comment"></el-input>
    </div>

    <div class="bottom clearfix" style="margin-top: 30px">
        <el-button type="primary" :loading="loading" :disabled="loading" @click="send_report" style="float: right">Submit report</el-button>
    </div>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Delivered</th>
                <th scope="col">Return</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>{{ (parseInt(form.delivered) / parseInt(form.total_orders) * 100).toFixed(2) }}%</td>
                <td>{{ (parseInt(form.returned) / parseInt(form.total_orders) * 100).toFixed(2) }}%</td>
            </tr>
        </tbody>
    </table>

</el-card>
</template>

<script>
import { mapState } from 'vuex';
export default {
    props: ['riders'],
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
            form: {},
            tableData: [{
                status: '',
                count: 0
            }],
            errors: [],
            loading: false
        };
    },
    methods: {
        add_new() {
            this.tableData.push({
                status: '',
                count: 0
            })
        },
        deleteRow(index) {
            this.tableData.splice(index, 1)
        },
        send_report() {
            this.loading = true

            this.errors = []
            axios.post('riders', this.form).then((response) => {
                console.log(response);
                this.loading = false
                eventBus.$emit('alertMessageEvent')

            }).catch((error) => {
                this.loading = false
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
            })
        },
    },
    computed: {
        ...mapState(['riders'])
    },

};
</script>

<style scoped>
</style>
