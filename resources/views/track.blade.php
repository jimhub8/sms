@extends('layouts.portal')

@section('content')
<div id="app">
<div id="wrapper">
    <div id="fullpage" class="content_wrapper">
        @include('inc.header')
        <v-app style="margin-top: 40px">
            <my-tracking :waybill="{{ json_encode($waybill) }}" />
        </v-app>

        <div class="vc_row-full-width vc_clearfix"></div>

        @include('inc.footer')

        <div class="vc_row-full-width vc_clearfix"></div>
    </div>
</div>
</div>
@endsection
