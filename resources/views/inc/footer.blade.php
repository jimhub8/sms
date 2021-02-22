<div>
    <div data-vc-full-width="true" data-vc-full-width-init="false" class="vc_row wpb_row vc_row-fluid third_bg_color">
        @auth
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="vc_cta3-container">
                        <div class="vc_general vc_cta3 third_bg_color vc_cta3-style-flat vc_cta3-shape-square vc_cta3-align-left vc_cta3-color-classic vc_cta3-icon-size-md vc_cta3-actions-right vc_custom_1609935144668">
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
        @endauth

    </div>
    <div class="vc_row-full-width vc_clearfix"></div>
    @if($org == 'mft')
    <div data-vc-full-width="true" data-vc-full-width-init="false"
        class="vc_row wpb_row vc_row-fluid vc_custom_1609861415160 vc_row-has-fill" style="background-image: url(/logo/mft.jpg)">

        @elseif($org == 'speedball')
        <div data-vc-full-width="true" data-vc-full-width-init="false"
            class="vc_row wpb_row vc_row-fluid vc_custom_1609861415160 vc_row-has-fill" style="background-image: url(/logo/speedball.jpg)">
            @endif
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner ">
                    <div class="wpb_wrapper"></div>
                </div>
            </div>
        </div>
    </div>
