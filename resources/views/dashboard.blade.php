@extends('layouts.portal')

@section('content')
<div id="wrapper">
    <div id="fullpage" class="content_wrapper">
        @include('inc.header')
        <div id="main" class="footer_hide">
            <div class="container">

                <div class="content-area">


                    <article id="post-1503" class="post-1503 page type-page status-publish hentry">

                        <div class="entry-content">
                            <div data-vc-full-width="true" data-vc-full-width-init="false"
                                class="vc_row wpb_row vc_row-fluid vc_custom_1609941898558 vc_row-has-fill">
                                <div class="wpb_column vc_column_container vc_col-sm-12">
                                    <div class="vc_column-inner ">
                                        <div class="wpb_wrapper">
                                            <div class="vc_custom_heading text_align_center title_no_stripe">
                                                <h4 style="text-align: center" class="consulting-custom-title">MFT -
                                                    PORTAL</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width vc_clearfix"></div>
                            <div data-vc-full-width="true" data-vc-full-width-init="false"
                                class="vc_row wpb_row vc_row-fluid vc_custom_1609942182638 vc_row-has-fill vc_column-gap-10 vc_row-o-equal-height vc_row-flex">
                                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-6 vc_col-has-fill">
                                    <div class="vc_column-inner vc_custom_1609935744911">
                                        <div class="wpb_wrapper">


                                            <div onClick="return true"
                                                class="icon_box  vc_custom_1609945415017 style_1 icon_left clearfix">
                                                <div class="icon  font-color_custom font-color_base_bg"
                                                    style="width:70px">
                                                    {{-- <i class="fas fa-file-invoice"></i> --}}
                                                    <i style="font-size:22px; color: #ffffff; "
                                                        class="fas fa-file-invoice"></i></div>
                                                <div class="icon_text">
                                                    <h5 style="font-size:22px;line-height:46px"
                                                        class="font-color_base no_stripe">FINANCE &amp; HR</h5>
                                                    <ul class="list-group">
                                                        <li><a href="https://docs.google.com/forms/d/e/1FAIpQLSdATmFus_0cJQPQBdTGoFSfPCwPLpFcZPqJ8Jg37Vz5c76LzQ/viewform"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="Leave">LEAVE
                                                                APPLICATION</a></li>
                                                        <li><a href="https://phplaravel-317638-1717196.cloudwaysapps.com/"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="Requisition">PURCHASE
                                                                REQUISITION</a></li>
                                                        <li><a href="#" style="line-height: 30px; color: #000000;"
                                                                target="Advance">SALARY
                                                                ADVANCE APPLICATION</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-6 vc_col-has-fill">
                                    <div class="vc_column-inner vc_custom_1609935729949">
                                        <div class="wpb_wrapper">


                                            <div onClick="return true"
                                                class="icon_box  vc_custom_1609941618695 style_1 icon_left clearfix">
                                                <div class="icon  font-color_custom font-color_base_bg"
                                                    style="width:70px">
                                                    <i style="font-size:22px; color: #ffffff; " class="fas fa-cog"></i>
                                                </div>
                                                <div class="icon_text">
                                                    <h5 style="font-size:22px;line-height:46px"
                                                        class="font-color_base no_stripe">OPERATIONS</h5>
                                                    <ul class="list-group">
                                                        <li><a href="/portal#/stock"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="portal">AGENTS
                                                                STOCK RUNNING SHEET</a></li>
                                                        <li><a href="/portal#/rider"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="portal">RIDER
                                                                WEEKLY PERFORMANCE REPORT</a></li>
                                                        <li><a href="/portal#/"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="portal">CALL
                                                                CENTRE WEEKLY PERFORMANCE REPORT</a></li>
                                                        <li><a href="https://forms.gle/7V2qRt3mokKmt8ZX7"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="occurrence">OCCURRENCE BOOK/RECORD</a></li>

                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width vc_clearfix"></div>
                            <div data-vc-full-width="true" data-vc-full-width-init="false"
                                class="vc_row wpb_row vc_row-fluid vc_custom_1609942195958 vc_row-has-fill vc_column-gap-10 vc_row-o-equal-height vc_row-flex">
                                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-6 vc_col-has-fill">
                                    <div class="vc_column-inner vc_custom_1609935744911">
                                        <div class="wpb_wrapper">


                                            <div onClick="return true"
                                                class="icon_box  vc_custom_1609942398175 style_1 icon_left clearfix">
                                                <div class="icon  font-color_custom font-color_base_bg"
                                                    style="width:70px">
                                                    <i style="font-size:22px; color: #ffffff; "
                                                        class="fas fa-warehouse"></i></div>
                                                <div class="icon_text">
                                                    <h5 style="font-size:22px;line-height:46px"
                                                        class="font-color_base no_stripe">WAREHOUSING</h5>
                                                    <ul class="list-group">
                                                        {{-- <li><a href="/warehouse/sop"
                                                                    style="line-height: 30px; color: #000000;">STANDARD
                                                                    OPERATING PROCEDURE (SOP)</a></li>
                                                            <li><a href="/warehouse/"
                                                                    style="line-height: 30px; color: #000000;">GOODS
                                                                    RECEIVED NOTE</a></li>
                                                            <li><a href="/warehouse/"
                                                                    style="line-height: 30px; color: #000000;">DISPATCH
                                                                    NOTE</a></li>
                                                            <li><a href="/warehouse/"
                                                                    style="line-height: 30px; color: #000000;">PACKING
                                                                    SLIP</a></li>
                                                            <li><a href="#"
                                                                    style="line-height: 30px; color: #000000;">OCCURANCE
                                                                    BOOK</a></li> --}}

                                                        <li><a href="/warehouse/Warehousing Service - Contract.pdf"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="contract">
                                                                WAREHOUSING SERVICE CONTRACT
                                                            </a></li>
                                                        <li><a href="/warehouse/MFT COMPANY PROFILE.pdf"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="profile">
                                                                MFT COMPANY PROFILE
                                                            </a></li>
                                                        <li><a href="/warehouse/MFT WAREHOUSING SERVICE BANNAER.pdf"
                                                                style="line-height: 30px; color: #000000;"
                                                                target="banner">
                                                                MFT WAREHOUSING SERVICE BANNER
                                                            </a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="wpb_column vc_column_container vc_col-sm-6 vc_col-lg-6 vc_col-has-fill">
                                    <div class="vc_column-inner vc_custom_1609935729949">
                                        <div class="wpb_wrapper">


                                            <div onClick="return true"
                                                class="icon_box  vc_custom_1609941662990 style_1 icon_left clearfix">
                                                <div class="icon  font-color_custom font-color_base_bg"
                                                    style="width:70px">
                                                    <i style="font-size:22px; color: #ffffff; "
                                                        class="fas fa-comments"></i></div>
                                                <div class="icon_text">
                                                    <h5 style="font-size:22px;line-height:46px"
                                                        class="font-color_base no_stripe">COMMUNICATIONS</h5>
                                                    <ul class="list-group">
                                                        <li><a href="/sms" style="line-height: 30px; color: #000000;"
                                                                target="sms">SMS</a>
                                                        </li>
                                                        <li><a href="#" style="line-height: 30px; color: #000000;"
                                                                target="chat">CHAT
                                                                ROOM</a></li>
                                                        <li><a href="#" style="line-height: 30px; color: #000000;"
                                                                target="forum">DISCUSSION
                                                                FORUM</a></li>
                                                        <li><a href="#" style="line-height: 30px; color: #000000;"
                                                                target="notice">NOTICE
                                                                BOARD</a></li>
                                                        <li><a href="#" style="line-height: 30px; color: #000000;"
                                                                target="faq">FAQs</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="vc_row-full-width vc_clearfix"></div>

                            @include('inc.footer')

                            <div class="vc_row-full-width vc_clearfix"></div>
                        </div>

                    </article>
                </div>

            </div>
            <!--.container-->
        </div>
        <!--#main-->
    </div>
    <!--.content_wrapper-->
</div>
<!--#wrapper-->
<!-- Instagram Feed JS -->

@endsection
