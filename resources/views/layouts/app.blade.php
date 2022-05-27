<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>{{ trans('panel.site_title') }}</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">

<!-- favicon
============================================ -->
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('userSite/img/favicon.ico') }}">

<!-- Bootstrap CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/css/bootstrap.min.css') }}">

<!-- Fontawsome CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/css/font-awesome.min.css') }}">

  <!-- Metarial Iconic Font CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/css/material-design-iconic-font.min.css') }}">

  <!-- Plugin CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/css/plugin.css') }}">

<!-- Style CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/style.css') }}">

<!-- Responsive CSS
============================================ -->
  <link rel="stylesheet" href="{{ asset('userSite/css/responsive.css') }}">

<!-- Modernizr JS
============================================ -->
  <script src="{{ asset('userSite/js/vendor/modernizr-2.8.3.min.js') }}"></script>

    @yield('styles')
</head>
<body>
<!--Loading Area Start-->
<div class="loading">
<div class="text-center middle">
  <div class="lds-ellipsis">
    <div></div><div></div>
  </div>
</div>
</div>
<!--Loading Area End-->
<!--Main Wrapper Start-->
<div class="as-mainwrapper">
    <!--Bg White Start-->
    <div class="bg-white">
        <!--Header Area Start-->
        <header>
            <div class="header-top">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7 col-md-6 col-12">
                            <span>Have any question? +968 547856 254</span>
                        </div>
                        <div class="col-lg-5 col-md-6 col-12">
                            <div class="header-top-right">
                                <span>Phone: +85 4856 5478</span>
                                <span>Email: info@example.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-logo-menu sticker">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-12">
                            <div class="logo">
                                <a href=""><img src="{{ asset('img/logo/logo.png') }}" style="height: 64px;width: 250px;" alt="EDUCAT"></a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-12">
                            <div class="mainmenu-area pull-right">
                                <div class="mainmenu d-none d-lg-block">
                                    <nav>
                                        <ul id="nav">
                                            <li class="current"><a href="/">Home</a>
                                            </li>

                                            <li><a href="">Courses</a>
                                                <ul class="sub-menu">
                                                    <li><a href="">Courses Details</a></li>
                                                </ul>
                                            </li>
                                            @if(!isset(Auth::user()->id))
                                              <li><a href="{{url('login')}}">login</a></li>
                                            @else
                                              <li><a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                                                {{ trans('global.logout') }}
                                              </a></li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                                <ul class="header-search">
                                    <li class="search-menu">
                                        <i id="toggle-search" class="zmdi zmdi-search"></i>
                                    </li>
                                </ul>
                                <!--Search Form-->
                                <div class="search">
                                    <div class="search-form">
                                        <form id="search-form" action="#">
                                            <input type="search" placeholder="Search here..." name="search" />
                                            <button type="submit">
                                                <span><i class="fa fa-search"></i></span>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                                <!--End of Search Form-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area start -->
            <div class="mobile-menu-area">
                <div class="container clearfix">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mobile-menu">
                                <nav id="dropdown">
                                    <ul>
                                        <li><a href="index.html">HOME</a>
                                            <ul>
                                                <li><a href="index.html">Home Version 1</a></li>
                                                <li><a href="index-2.html">Home Version 1</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="gallery.html">Gallery</a>
                                            <ul>
                                                <li><a href="gallery.html">Gallery</a></li>
                                                <li><a href="gallery-2.html">Gallery Filtaring</a></li>
                                                <li><a href="gallery-four-column.html">Gallery Four Column</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="team-details.html">Team Details</a></li>
                                        <li><a href="course.html">Courses</a>
                                            <ul class="sub-menu">
                                                <li><a href="courses-details.html">Courses Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="shop.html">Shop</a>
                                            <ul class="sub-menu">
                                                <li><a href="single-product.html">Single Product</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="event.html">Event</a>
                                            <ul class="sub-menu">
                                                <li><a href="event-details.html">Event Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="blog.html">Blog</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog-details.html">Blog Details</a></li>
                                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                                <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Pages</a>
                                            <ul>
                                                <li><a href="team-details.html">Team Details</a></li>
                                                <li><a href="course.html">Courses Page</a></li>
                                                <li><a href="courses-details.html">Course Details Page</a></li>
                                                <li><a href="event.html">Event Page</a></li>
                                                <li><a href="event-details.html">Event Details Page</a></li>
                                                <li><a href="blog.html">Blog</a></li>
                                                <li><a href="blog-details.html">Blog Details Page</a></li>
                                                <li><a href="blog-left-sidebar.html">Blog Left Sidebar</a></li>
                                                <li><a href="blog-no-sidebar.html">Blog No Sidebar</a></li>
                                                <li><a href="wishlist.html">Wishlist Page</a></li>
                                                <li><a href="checkout.html">Checkout Page</a></li>
                                                <li><a href="cart.html">Shopping Cart Page</a></li>
                                                <li><a href="login-register.html">Login Page</a></li>
                                                <li><a href="contact.html">Contact</a></li>
                                            </ul>
                                        </li>
                                        <li><a href="contact.html">Contact us</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Mobile Menu Area end -->
        </header>
        <div style="padding-top: 20px" class="container-fluid">
            @if(session('message'))
                <div class="row mb-2">
                    <div class="col-lg-12">
                        <div class="alert alert-success" role="alert">{{ session('message') }}</div>
                    </div>
                </div>
            @endif
            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    <ul class="list-unstyled">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @yield('content')

        </div>
        <!--End of Header Area-->
            @yield("content")
    <!--End of Event Area-->
    <footer>
        <!--Newsletter Area Start-->
        <div class="newsletter-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="newsletter-content">
                            <h3>SUBSCRIBE</h3>
                            <h2>TO OUR NEWSLETTER</h2>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="newsletter-form angle">
                            <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="mc-form footer-newsletter fix">
                                <div class="subscribe-form">
                                    <input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email here">
                                    <button id="mc-submit" type="submit">SUBSCRIBE</button>
                                </div>
                            </form>
                            <!-- mailchimp-alerts Start -->
                            <div class="mailchimp-alerts text-centre fix pull-right">
                                <div class="mailchimp-submitting"></div><!-- mailchimp-submitting end -->
                                <div class="mailchimp-success"></div><!-- mailchimp-success end -->
                                <div class="mailchimp-error"></div><!-- mailchimp-error end -->
                            </div>
                            <!-- mailchimp-alerts end -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Newsletter Area-->
        <!--Footer Widget Area Start-->
        <div class="footer-widget-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <div class="footer-logo">
                                <a href="/"><img style="width: 260px;" src="{{ asset('img/logo/logo.png') }}" alt=""></a>
                            </div>
                            <p>There are many variations of passg of Lorem Ipsum available, but thmajority have suffered altem, </p>
                            <div class="social-icons">
                                <a href="#"><i class="zmdi zmdi-facebook"></i></a>
                                <a href="#"><i class="zmdi zmdi-rss"></i></a>
                                <a href="#"><i class="zmdi zmdi-google-plus"></i></a>
                                <a href="#"><i class="zmdi zmdi-pinterest"></i></a>
                                <a href="#"><i class="zmdi zmdi-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>GET IN TOUCH</h3>
                            <a href="tel:555-555-1212"><i class="fa fa-phone"></i>555-555-1212</a>
                            <span><i class="fa fa-envelope"></i>info@example.com</span>
                            <span><i class="fa fa-globe"></i>www.languagelinks.com</span>
                            <span><i class="fa fa-map-marker"></i>ur address goes here,street.</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Useful Links</h3>
                            <ul class="footer-list">
                                <li><a href="#">Teachers &amp; Staff</a></li>
                                <li><a href="#">Our Courses</a></li>
                                <li><a href="#">Courses Categories</a></li>
                                <li><a href="#">Support</a></li>
                                <li><a href="#">Terms &amp; Conditions</a></li>
                                <li><a href="#">Privacy Policy</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="single-footer-widget">
                            <h3>Instagram</h3>
                            <ul id="Instafeed"></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Footer Widget Area-->
        <!--Footer Area Start-->
        <div class="footer-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-7 col-12">
                        <span>Copyright &copy; Language links {{ date('Y') }}. All right reserved.Created by <a href="relaxgen.com">relaxgen.com</a></span>
                    </div>
                    <div class="col-lg-6 col-md-5 col-12">
                        <div class="column-right">
                            <span>Privacy Policy , Terms &amp; Conditions</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--End of Footer Area-->
    </footer>
  </div>
  <!--End of Bg White-->
  </div>
  <form id="logoutform" action="{{ route('logout') }}" method="POST" style="display: none;">
      {{ csrf_field() }}
  </form>
  <!--End of Main Wrapper Area-->

  @yield('scripts')

  <!-- jquery
  ============================================ -->
  <script src="{{ asset('userSite/js/vendor/jquery-1.12.4.min.js') }}"></script>

  <!-- popper JS
  ============================================ -->
  <script src="{{ asset('userSite/js/popper.min.js') }}"></script>

  <!-- bootstrap JS
  ============================================ -->
  <script src="{{ asset('userSite/js/bootstrap.min.js') }}"></script>

  <!-- AJax Mail JS
  ============================================ -->
  <script src="{{ asset('userSite/js/ajax-mail.js') }}"></script>

  <!-- plugins JS
  ============================================ -->
  <script src="{{ asset('userSite/js/plugins.js') }}"></script>

  <!-- main JS
  ============================================ -->
  <script src="{{ asset('userSite/js/main.js') }}"></script>
  </body>

  <!-- Mirrored from demo.hasthemes.com/edubuzz/edubuzz/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 18 Dec 2018 08:00:45 GMT -->
  </html>
