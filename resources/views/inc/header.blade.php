<header id="header">
    <div class="header_top clearfix">
        <div class="container">
            <div class="logo media-left media-middle">
                @if($org == "speedball")
                <a href="#"><img src="https://speedballcourier.com/wp-content/uploads/2018/05/logo-white.png" style="height: 100px;" alt="MFT" /></a>
                @elseif(($org == "mft"))
                <a href="#"><img src="/logo/logo.png" style="height: 100px;" alt="MFT" /></a>
                @endif
            </div>
            @auth
            <div class="top_nav media-body media-middle">
                <div class="header_socials">
                    <a target="_blank" href="https://www.facebook.com/mftfulfillmentcentre/"><i
                            class="fab fa-facebook"></i></a>
                    <a target="_blank" href="https://twitter.com/MFTFulfillment"><i class="fab fa-twitter"></i></a>
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
                        @auth

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
                        @endauth

                    </ul>
                </div>
            </div>
            @endauth

        </div>
    </div>
    <div class="mobile_header">
        <div class="logo_wrapper clearfix">
            <div class="logo">
                {{-- <a href="/"><img src="/logo/logo.png" style="height: 100px;" alt="MFT" /></a> --}}
                
                @if($org == "speedball")
                <a href="#"><img src="https://speedballcourier.com/wp-content/uploads/2018/05/logo-white.png" style="height: 100px;" alt="MFT" /></a>
                @elseif(($org == "mft"))
                <a href="#"><img src="/logo/logo.png" style="height: 100px;" alt="MFT" /></a>
                @endif
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
