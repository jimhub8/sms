<template>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm9 offset-sm3>
                <v-card style="padding: 10px 0;">
                    <v-layout row>
                        <v-flex sm1 style="margin-left: 10px;">
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getUsers">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                        </v-flex>
                        <v-flex sm2>
                            <h3 style="margin-left: 30px !important;margin-top: 10px;">Users</h3>
                        </v-flex>
                        <v-flex offset-sm8 sm3>
                            <v-btn color="info" @click="openCreate" text>Create User</v-btn>
                        </v-flex>
                    </v-layout>
                </v-card>
            </v-flex>
            <v-flex sm9 offset-sm3>
                <v-card>
                    <v-card-title>
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="users.data" :search="search">
                        <template v-slot:item.actions="{ item }">
                            <v-tooltip bottom>
                                <template v-slot:activator="{ on }">
                                    <v-btn v-on="on" icon class="mx-0" @click="openEdit(item)" slot="activator">
                                        <v-icon small color="blue darken-2">mdi-pen</v-icon>
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
                        </template>
                    </v-data-table>
                </v-card>

            </v-flex>
        </v-layout>
    <Create />
    <Edit />
    </v-container>
</template>

<script>
import {
    mapState
} from 'vuex';
import Create from "./create";
import Edit from "./edit";

export default {
    props: ['user'],
    components: {
        Create,
        Edit,
    },
    data() {
        return {
            form: {},
            loader: false,
            search: "",
            users_det: {
                data: []
            },
            users_search: [],
            temp: "",
            checkedRows: [],
            headers: [
                // {
                //     text: "Id#",
                //     value: "id",
                //     type: "number"
                // },
                {
                    text: "Name",
                    value: "name"
                },
                {
                    text: "Email",
                    value: "email"
                },
                {
                    text: "Phone No.",
                    value: "phone"
                },
                {
                    text: "Role",
                    value: "role"
                },
                {
                    text: "Created On",
                    value: "created_at",
                    // type: "date",
                    // dateInputFormat: "YYYY-MM-DD",
                    // dateOutputFormat: "Do MMMM YYYY"
                },
                {
                    text: "Actions",
                    value: "actions",
                    sortable: false
                }
            ]
        };
    },
    methods: {
        openCreate() {
            eventBus.$emit("openCreateUser");
        },
        openEdit(data) {
            eventBus.$emit("openEditUser", data);
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

        deleteItem(item) {
            this.$store.dispatch("deleteItem", "users/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getUsers();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowUser", data);
        },
        getUsers() {
            var payload = {
                model: 'users',
                update: 'updateUsers'
            }
            this.$store.dispatch("getItems", payload);
        },
        updateSelected(url) {
            // alert('test')
            if (this.checkedRows.length < 1) {
                eventBus.$emit("errorEvent", "Please select atleast one row");
                return;
            }

            this.$store
                .dispatch("updateSelected", {
                    url,
                    checked: this.checkedRows
                })
                .then(response => {
                    eventBus.$emit("alertRequest", "Updated");
                    this.checkedRows = [];
                    this.getUsers();
                });
        },
        selectionChanged(params) {
            this.checkedRows = params.selectedRows;
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateUsers'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['users', 'loading'])
    },
    mounted() {
        // this.$store.dispatch('getUsers');
        eventBus.$emit("LoadingEvent");
        this.getUsers();
    },
    created() {
        eventBus.$on("userEvent", data => {
            this.getUsers();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditUser");
            } else {
                eventBus.$emit("openCreateUser");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view users"]) {
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

.v-main__wrap,
.v-main {
    padding: 0 !important;
}
</style>
