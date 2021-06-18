<!DOCTYPE html>
<html lang="en-US" class="">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="profile" href="http://gmpg.org/xfn/11">


    @if($org == "speedball")
    <title>Speedball PORTAL</title>
    <link rel="icon" href="/logo/logo1.png">
    @elseif(($org == "mft"))
    <title>MFT PORTAL</title>
    <link rel="icon" href="/logo/logo.png">
    @elseif(($org == "360"))
    <title>360 PORTAL</title>
    <link rel="icon" href="/logo/360.png">
    @endif
    {{-- <link rel='dns-prefetch' href='//js.stripe.com' /> --}}
    {{-- <link rel='dns-prefetch' href='//fonts.googleapis.com' /> --}}
    {{-- <link rel='dns-prefetch' href='//s.w.org' /> --}}

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />



    <link rel='stylesheet' id='stm-google-fonts-css'
        href='//fonts.googleapis.com/css?family=Poppins%7CPoppins%3A300%2C700%2C400%2C500%2C600&#038;subset=latin%2Clatin-ext%2Cdevanagari&#038;ver=5.1.8'
        type='text/css' media='all' />
    <script src="{{ asset('js/theme/jquery.min.js') }}"></script>


    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">
</head>
<style>
    .v-application--wrap {
        min-height: auto !important;
    }
</style>

<body
    class="home page-template-default page page-id-1503 theme-consulting woocommerce-no-js site_layout_los_angeles  header_style_2 vc_sidebar_page eroom-enabled wpb-js-composer js-comp-ver-6.4.1 vc_responsive elementor-default elementor-kit-6896">
    <div id="track">
        <div id="wrapper">
            <div id="fullpage" class="content_wrapper">
                @include('inc.header')
                <v-app style="margin-top: 40px">
                    <my-tracking :org="{{ json_encode($org) }}" />
                </v-app>

                <div class="vc_row-full-width vc_clearfix"></div>

                @include('inc.footer')

                <div class="vc_row-full-width vc_clearfix"></div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/theme/core.min.js') }}"></script>

    <style type="text/css">
        #footer .footer_widgets .widget .widget_title {
            border-top: transparent;
        }
    </style>

    <script src="{{ asset('js/track.js') }}" defer></script>
</body>

</html>
