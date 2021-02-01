@extends('layouts.app')

@section('content')
<v-app>
    <v-card style="width: 60%!important;margin: auto">
        <v-card-title>
            Dashboard
        </v-card-title>
        <v-divider></v-divider>
        <v-card-text>
            <v-container>
                <v-layout row>
                    <v-flex sm5 style="margin-left: 30px;cursor: pointer">
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}`" class="mx-auto"
                                width="100%" href="/sms" style="height: 100px;text-decoration: none;">
                                <v-container fill-height>
                                    <p style="margin: auto;font-size: 40px;">Go To Sms</p>
                                </v-container>
                            </v-card>
                        </v-hover>
                    </v-flex>
                    <v-flex sm5 style="cursor: pointer" offset-sm1>
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}`" class="mx-auto"
                                width="100%" href="/portal" style="height: 100px;text-decoration: none;">
                                <v-container fill-height>
                                    <p style="margin: auto;font-size: 40px;">Go To Portal</p>
                                </v-container>
                            </v-card>
                        </v-hover>
                    </v-flex>
                    {{-- <v-flex sm5 offset-sm1 style="cursor: pointer">
                        <v-hover>
                            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}`" class="mx-auto"
                                width="100%" href="/sms">
                                <v-container fill-height>
                                    PORTAL
                                </v-container>
                            </v-card>
                        </v-hover>
                    </v-flex> --}}
                </v-layout>
            </v-container>
        </v-card-text>
    </v-card>
</v-app>
@endsection
