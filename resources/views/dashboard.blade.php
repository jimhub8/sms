<!DOCTYPE html>
<html lang="en-US" class="stm-site-preloader">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <title>MFT &#8211; PORTAL</title>
    <link rel='dns-prefetch' href='//js.stripe.com' />
    <link rel='dns-prefetch' href='//fonts.googleapis.com' />
    <link rel='dns-prefetch' href='//s.w.org' />
    <link rel="icon" href="/logo/logo.png">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />



    <link rel='stylesheet' id='stm-google-fonts-css'
        href='//fonts.googleapis.com/css?family=Poppins%7CPoppins%3A300%2C700%2C400%2C500%2C600&#038;subset=latin%2Clatin-ext%2Cdevanagari&#038;ver=5.1.8'
        type='text/css' media='all' />
    <script src="{{ asset('js/theme/jquery.min.js') }}"></script>


    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">

    <link href="{{ asset('css/portal.css') }}" rel="stylesheet">
</head>

<body
    class="home page-template-default page page-id-1503 theme-consulting woocommerce-no-js site_layout_los_angeles  header_style_2 vc_sidebar_page eroom-enabled wpb-js-composer js-comp-ver-6.4.1 vc_responsive elementor-default elementor-kit-6896">
    <div id="wrapper">
        <div id="fullpage" class="content_wrapper">
            <header id="header">
                <div class="header_top clearfix">
                    <div class="container">
                        <div class="logo media-left media-middle">
                            <a href="/"><img src="/logo/logo.png" style="width: px; height: px;" alt="MFT" /></a>
                        </div>
                        <div class="top_nav media-body media-middle">
                            <div class="header_socials">
                                <a target="_blank" href="https://www.facebook.com/mftfulfillmentcentre/"><i
                                        class="fab fa-facebook"></i></a>
                                <a target="_blank" href="https://twitter.com/MFTFulfillment"><i
                                        class="fab fa-twitter"></i></a>
                                <a target="_blank" href="https://www.instagram.com/mftfulfillment/"><i
                                        class="fab fa-instagram"></i></a>
                                <a target="_blank" href="https://ke.linkedin.com/company/mft-fulfillment-centre"><i
                                        class="fab fa-linkedin"></i></a>
                            </div>
                            <div class="top_nav_wrapper clearfix">
                                <ul id="menu-primary-menu" class="main_menu_nav">
                                    <li id="menu-item-7016"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7016">
                                        <a href="#">Home</a></li>
                                    <li id="menu-item-7017"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7017">
                                        <a href="#">Help</a></li>
                                    <li id="menu-item-7018"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7018">
                                        <a href="#">Contacts</a></li>
                                    @if (Auth::user()->role == "Admin")
                                    <li id="menu-item-7018"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7018">
                                        <a href="portal#/users">Admin</a></li>
                                    @endif

                                    <li id="menu-item-7018"
                                        class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7018"
                                        style="margin-top:13px">
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                style="color: #337ab7;    border: none;background: transparent;">Logout</button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mobile_header">
                    <div class="logo_wrapper clearfix">
                        <div class="logo">
                            <a href="/"><img src="/logo/logo.png" style="width: px; height: px;" alt="MFT" /></a>
                        </div>
                        <div id="menu_toggle">
                            <button></button>
                        </div>
                    </div>
                    <div class="header_info">
                        <div class="top_nav_mobile">
                            <ul id="menu-primary-menu-1" class="main_menu_nav">
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7016"><a
                                        href="#">Home</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7017"><a
                                        href="#">Help</a></li>
                                <li class="menu-item menu-item-type-custom menu-item-object-custom menu-item-7018"><a
                                        href="#">Contacts</a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </header>
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
                                                            <li><a href="https://forms.gle/xDHw1sjDticAcMVv7"
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
                                                        <i style="font-size:22px; color: #ffffff; "
                                                            class="fas fa-cog"></i></div>
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
                                                            <li><a href="/sms"
                                                                    style="line-height: 30px; color: #000000;"
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
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    class="vc_row wpb_row vc_row-fluid third_bg_color">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper">
                                                <section class="vc_cta3-container">
                                                    <div
                                                        class="vc_general vc_cta3 third_bg_color vc_cta3-style-flat vc_cta3-shape-square vc_cta3-align-left vc_cta3-color-classic vc_cta3-icon-size-md vc_cta3-actions-right vc_custom_1609935144668 style=""">
                                                        <div class="vc_cta3_content-container">
                                                            <div class="vc_cta3-content">
                                                                <header class="vc_cta3-content-header">
                                                                    <div class="vc_custom_heading">
                                                                        <h2 style="font-size: 20px;color: #002e5b;line-height: 24px"
                                                                            class="consulting-custom-title">For
                                                                            Technical Support contact IT Department</h2>
                                                                    </div>
                                                                </header>
                                                            </div>
                                                            <div class="vc_cta3-actions">
                                                                <div class="vc_btn3-container vc_btn3-right"><button
                                                                        class="vc_general vc_btn3 vc_btn3-size-lg vc_btn3-shape-square vc_btn3-style-flat vc_btn3-block vc_btn3-icon-left vc_btn3-color-theme_style_2"><i
                                                                            class="vc_btn3-icon stm-online-phone-call"></i>
                                                                        0742 834 722 | 0731 090 832</button></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="vc_row-full-width vc_clearfix"></div>
                                <div data-vc-full-width="true" data-vc-full-width-init="false"
                                    class="vc_row wpb_row vc_row-fluid vc_custom_1609861415160 vc_row-has-fill">
                                    <div class="wpb_column vc_column_container vc_col-sm-12">
                                        <div class="vc_column-inner ">
                                            <div class="wpb_wrapper"></div>
                                        </div>
                                    </div>
                                </div>
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

    <script src="{{ asset('js/theme/core.min.js') }}"></script>

    <style type="text/css">
        #footer .footer_widgets .widget .widget_title {
            border-top: transparent;
        }
    </style>

</body>

</html>
