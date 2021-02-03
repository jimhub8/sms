<template>
<div>
    <v-container fluid fill-height>
        <v-layout justify-center align-center wrap>
            <v-flex sm12>
                <v-pagination v-model="riders.current_page" :length="riders.last_page" total-visible="5" @input="next_page(riders.path, riders.current_page)" circle v-if="riders.last_page > 1"></v-pagination>
            </v-flex>
            <v-flex sm12>
                <v-card>
                    <v-card-title>
                        Rider
                            <v-tooltip right>
                                <template v-slot:activator="{ on }">
                                    <v-btn icon v-on="on" slot="activator" class="mx-0" @click="getRiders">
                                        <v-icon color="blue darken-2" small>mdi-refresh</v-icon>
                                    </v-btn>
                                </template>
                                <span>Refresh</span>
                            </v-tooltip>
                            <v-btn color="info" @click="openCreate" text>Create Rider</v-btn>
                        <v-spacer></v-spacer>
                        <v-text-field v-model="search" append-icon="mdi-magnify" label="Search" single-line hide-details></v-text-field>
                    </v-card-title>
                    <v-data-table :headers="headers" :items="riders" :search="search" :loading="loading">
                        <template v-slot:item.actions="{ item }">
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
                        </template>
                    </v-data-table>
                </v-card>
            </v-flex>
        </v-layout>
    </v-container>
    <Create></Create>
    <Edit></Edit>
</div>
</template>

<script>
import { mapState } from 'vuex';
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
            headers: [
                {
                    text: "Name",
                    value: "name"
                },
                {
                    text: "Created On",
                    value: "created_at",
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
            eventBus.$emit("openCreateRider");
        },
        openEdit(data) {
            eventBus.$emit("openEditRider", data);
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
            this.$store.dispatch("deleteItem", "riders/" + item.id).then(response => {
                this.$message({
                    type: 'success',
                    message: 'Delete completed'
                });
                this.getRiders();
            });
        },
        openShow(data) {
            eventBus.$emit("openShowRider", data);
        },
        getRiders() {
            var payload = {
                model: 'rideraccount',
                update: 'updateRiders'
            }
            this.$store.dispatch("getItems", payload);
        },

        next_page(path, page) {
            var payload = {
                path: path,
                page: page,
                update: 'updateRiders'
            }
            this.$store.dispatch("nextPage", payload);
        },
    },
    computed: {
        ...mapState(['riders', 'loading'])
    },
    mounted() {
        // this.$store.dispatch('getRiders');
        eventBus.$emit("LoadingEvent");
        this.getRiders();
    },
    created() {
        eventBus.$on("riderEvent", data => {
            this.getRiders();
        });

        eventBus.$on("responseChooseEvent", data => {
            console.log(data);
            if (data == "Excel") {
                eventBus.$emit("openEditRider");
            } else {
                eventBus.$emit("openCreateRider");
            }
        });
    },

    //   beforeRouteEnter(to, from, next) {
    //     next(vm => {
    //       if (vm.user.can["view riders"]) {
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
