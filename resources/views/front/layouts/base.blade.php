<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>
        @if(isset($title))
            {{ $title }}
        @else
            {{ $config->site_title }}
        @endif
        </title>
        <meta name="description" content="{{ $config->site_description }}">
        <meta name="author" content="SkyWare LLC">
        
        <!-- Mobile Meta -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        @if(isset($meta))
        <meta property="og:title" content="{{ $meta['title'] }}"/>
        <meta property="og:url" content="{{ $meta['url'] }}"/>
        <meta property="og:image" content="{{ $meta['image'] }}"/>
        <meta property="og:site_name" content="{{ $meta['site_name'] }}"/>
        <meta property="og:description" content="{{ $meta['description'] }}"/>
        @endif
        
        <!-- Put favicon.ico and apple-touch-icon(s).png in the images folder -->
        <link rel="shortcut icon" href="{{ asset('static/images/favicon.ico')}}">

        <!-- CSS StyleSheets -->
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:700,400&subset=cyrillic-ext,latin' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="{{ asset('static/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/animate.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/prettyPhoto.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('static/rs-plugin/css/settings.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/style.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/news.css') }}">
        <link rel="stylesheet" href="{{ asset('static/css/responsive.css') }}">
        <!--[if lt IE 9]>
        <link rel="stylesheet" href="{{ asset('css/ie.css') }}">
        <script type="text/javascript" src="js/html5.js')}}"></script>
    <![endif]-->


        <!-- Skin style (** you can change the link below with the one you need from skins folder in the css folder **) -->
        <link rel="stylesheet" id="skinCSS" href="{{ asset('static/css/skins/default.css') }}">

    </head>
    <body style="overflow:hidden">

        <!-- site preloader start -->
        <div class="page-loader">
            <div class="loader-in"></div>
        </div>
        <!-- site preloader end -->

        <div class="pageWrapper">
            <!-- Header Start -->
            <div id="headWrapper" class="clearfix">

                <!-- top bar start -->
                <!-- top bar end -->

                <!-- Logo, global navigation menu and search start -->
                <header class="top-head nav-2">
                    <div class="container">
                        <div class="row">
                            <div class="logo cell-3">
                                <a href="{{ route('index') }}"></a>
                            </div>
                            <div class="cell-9 top-menu">

                                <!-- top navigation menu start -->
                                @include('front.includes.breadcrumb')
                                <!-- top navigation menu end -->

                                <!-- top search start -->
                                <div class="top-search">
                                    <a href="#"><span class="fa fa-search"></span></a>
                                    <div class="search-box">
                                        <div class="input-box left">
                                            <input type="text" name="t" id="t-search" class="txt-box" placeHolder="Хайх үгээ оруулна уу..." />
                                        </div>
                                        <div class="left">
                                            <input type="submit" id="b-search" class="btn main-bg" value="Хайх" />
                                        </div>
                                    </div>
                                </div>
                                <!-- top search end -->
                            </div>
                        </div>
                    </div>
                </header>
                <!-- Logo, Global navigation menu and search end -->

            </div>
            <!-- Header End -->

            <!-- Content Start -->
            @yield('content')
            <!-- Content End -->

            <!-- Footer start -->
            @include('front.includes.footer')
            <!-- Footer end -->

            <!-- Back to top Link -->
            <div id="to-top" class="main-bg"><span class="fa fa-chevron-up"></span></div>

        </div>

        <!-- Load JS siles -->
        <script type="text/javascript" src="{{asset('static/js/jquery.min.js')}}"></script>

        <!-- Waypoints script -->
        <script type="text/javascript" src="{{asset('static/js/waypoints.min.js')}}"></script>

        <!-- SLIDER REVOLUTION SCRIPTS  -->
        <script type="text/javascript" src="{{asset('static/rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('static/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

        <!-- Animate numbers increment -->
        <script type="text/javascript" src="{{asset('static/js/jquery.animateNumber.min.js')}}"></script>

        <!-- slick slider carousel -->
        <script type="text/javascript" src="{{asset('static/js/slick.min.js')}}"></script>

        <!-- Animate numbers increment -->
        <script type="text/javascript" src="{{asset('static/js/jquery.easypiechart.min.js')}}"></script>

        <!-- PrettyPhoto script -->
        <script type="text/javascript" src="{{asset('static/js/jquery.prettyPhoto.js')}}"></script>

        <!-- Share post plugin script -->
        <script type="text/javascript" src="{{asset('static/js/jquery.sharrre.min.js')}}"></script>

        <!-- Product images zoom plugin -->
        <script type="text/javascript" src="{{asset('static/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>

        <!-- Input placeholder plugin -->
        <script type="text/javascript" src="{{asset('static/js/jquery.placeholder.js')}}"></script>

        <!-- general script file -->
        <script type="text/javascript" src="{{asset('static/js/script.js')}}"></script>
    </body>
</html>