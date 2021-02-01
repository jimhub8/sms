<template>
<div>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-card style="padding: 20px;">
                <!-- <v-pagination v-model="stock.current_page" :length="stock.last_page" total-visible="5" @input="next_page(stock.path, stock.current_page)" circle v-if="stock.last_page > 1"></v-pagination> -->
                <v-spacer></v-spacer>
                <form action="/agent/logout" method="post"  v-if="guard == 'agent'">
                    <input type="hidden" name="_token" :value="csrf">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                            <v-btn v-on="on" flat slot="activator" color="primary" class="mx-0" type="submit" outlined>
                                <v-icon>mdi-logout</v-icon> Logout
                            </v-btn>
                        </template>
                        <span>Logout</span>
                    </v-tooltip>
                </form>
                <VDivider />
                <v-row>
                    <v-col sm="3" v-if="guard == 'web'">
                        <label for="">Agent</label>
                        <el-select v-model="form.agent_id" placeholder="Select">
                            <el-option v-for="item in agents" :key="item.id" :label="item.name" :value="item.id">
                            </el-option>
                        </el-select>
                    </v-col>
                    <v-col sm="3">
                        <label for="">Start date</label>
                        <el-date-picker v-model="form.start_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-col>
                    <v-col sm="3">
                        <label for="">End date</label>
                        <el-date-picker v-model="form.end_date" type="date" placeholder="Pick a Date" format="yyyy/MM/dd" value-format="yyyy-MM-dd">
                        </el-date-picker>
                    </v-col>
                    <v-col sm="3">
                        <v-tooltip right>
                            <template v-slot:activator="{ on }">
                                <v-btn icon v-on="on" slot="activator" class="mx-0" @click="filter" style="margin-top: 23px;">
                                    <v-icon color="blue darken-2" small>mdi-filter</v-icon>
                                </v-btn>
                            </template>
                            <span>Filter</span>
                        </v-tooltip>
                    </v-col>
                </v-row>
                <v-flex sm12>
                    <v-card>
                        <v-card-title>
                            Stock
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getStock">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-btn color="info" @click="openCreate" text v-if="guard == 'agent'">Update Stock</v-btn>
                            <v-spacer></v-spacer>
                            <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                        </v-card-title>
                        <v-data-table :headers="headers" :items="stock.data" :search="search" :loading="loading">
                            <template v-slot:item.created_at="{ item }">
                                <el-tag type="success">{{ item.created_at }}</el-tag>
                            </template>
                            <!-- <template v-slot:item.actions="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openEdit(item)" slot="activator">
                                        <v-icon small color="blue darken-2">mdi-pencil</v-icon>
                                    </v-btn>
                                </template>
                                <span>Edit {{ item.name }}</span>
                            </v-tooltip>
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" class="mx-0" @click="confirm_delete(item)" slot="activator">
                                        <v-icon small color="pink darken-2">mdi-delete</v-icon>
                                    </v-btn>
                                </template>
                                <span>Delete {{ item.name }}</span>
                            </v-tooltip>
                        </template> -->
                        </v-data-table>
                    </v-card>
                </v-flex>
            </v-card>

        </v-layout>
    </v-container>
    <Create />
    <!-- <Edit></Edit> -->
</div>
</template>

<script>
import {
    mapState
} from 'vuex';
import Create from "./create";
// import Edit from "./edit";

export default {
    props: ['user', 'guard'],
    components: {
        Create,
        // Edit,
    },
    data() {
        return {
            form: {},
            loader: false,
            search: "",

            csrf: document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content"),
            headers: [{
                    text: "Created On",
                    value: "created_at",
                },
                {
                    text: "Agent name",
                    value: "agent.name"
                },
                {
                    text: "Opening Stock",
                    value: "opening_stock"
                },
                {
                    text: "Received",
                    value: "received"
                },
                {
                    text: "Returned",
                    value: "returned"
                },
                {
                    text: "Delivered",
                    value: "delivered"
                },
                {
                    text: "Closing Stock",
                    value: "closing_stock"
                },
                // {
                //     text: "Actions",
                //     value: "actions",
                //     sortable: false
                // }
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateStock");
        },
        openEdit(data) {
            eventBus.$emit("openEditStock", data);
        },

        confirm_delete(item) {
            this.$confirm('This will permanently delete the file. Continue?', 'Warning', {
                confirmButtonText: 'OK',
                cancelButtonText: 'Cancel',
                type: 'warning'
            }).then(() => {
                this.deleteItem(item)
            }).catch(() => {
                this.$message({
                    type: 'error',
                    message: 'Delete canceled'
                });
            });
        },
        filter() {
            var payload = {
                model: 'stock_filter',
                update: 'updateStock',
                data: this.form,
            }
            this.$store.dispatch("filterItems", payload);
        },

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "stock/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getStock();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowStock", data);
        },
        getStock() {
            var payload = {
                model: 'stock',
                update: 'updateStock'
            }
            this.$store.dispatch("getItems", payload);
        },
        getAgents() {
            var payload = {
                model: 'agents',
                update: 'updateAgents'
            }
            this.$store.dispatch("getItems", payload);
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateStock'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['stock', 'loading', 'agents'])
    },
    mounted() {
        // this.$store.dispatch('getStock');
        eventBus.$emit("LoadingEvent");
        this.getAgents();
        this.getStock();
    },
    created() {
        eventBus.$on("stockEvent", data => {
            this.getStock();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditStock");
            } else {
                eventBus.$emit("openCreateStock");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view stock"]) {
    //         next();
    //       } else {
    //         next("/");
    //       }
    //     });
    //   }
};
</script>

<style scoped>
.el-input--prefix .el-input__inner {
    border-radius: 50px !important;
}

.v-toolbar__content,
.v-toolbar__extension {
    height: auto !important;
}

.v-avatar {
    height: 10px !important;
    width: 10px !important;
    margin-left: 40% !important;
}
</style>
