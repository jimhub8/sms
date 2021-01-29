<template>
<div class="text-center">
    <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="200" offset-y transition="slide-y-transition">
        <!-- <v-menu v-model="menu" :close-on-content-click="false" :nudge-width="30" offset-x> -->
        <template v-slot:activator="{ on, attrs }">
            <!-- <v-btn color="indigo" dark v-bind="attrs" v-on="on">
                Menu as Popover
            </v-btn> -->
            <v-btn icon slot="activator" dark v-bind="attrs" v-on="on">
                <v-icon color="white lighten-1" large>
                    mdi-account-circle
                </v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-list>
                <v-list-item>
                    <v-avatar color="indigo">
                        <v-icon dark>
                            mdi-account-circle
                        </v-icon>
                    </v-avatar>
                    <!-- <v-spacer></v-spacer> -->

                    <v-list-item-content style="margin-left: 20px">
                        <v-list-item-title>{{ user.name }}</v-list-item-title>
                        <v-list-item-subtitle>{{ user.role }}</v-list-item-subtitle>
                    </v-list-item-content>

                </v-list-item>
            </v-list>

            <v-divider></v-divider>

            <v-card-actions>
                <v-spacer></v-spacer>

                <form action="/logout" method="post">
                    <input type="hidden" name="_token" :value="csrf">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                            <v-btn v-on="on" flat slot="activator" color="primary" icon class="mx-0" type="submit">
                                <v-icon>mdi-logout</v-icon>
                            </v-btn>
                        </template>
                        <span>Logout</span>
                    </v-tooltip>
                </form>
            </v-card-actions>
        </v-card>
    </v-menu>
</div>
</template>

<script>
export default {
    props: ['user'],
    data: () => ({
        fav: true,
        menu: false,
        message: false,
        hints: true,
        csrf: document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content"),
    }),
}
</script>
