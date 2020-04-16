<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="{{asset('site/assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/iziToast.min.css')}}">
<!--[if lte IE 8]><script src="{{ asset('site/assets/js/ie/html5shiv.js') }}"></script><![endif]-->
    <link rel="stylesheet" href="{{ asset('site/assets/css/main.css') }}" />
    <!--[if lte IE 8]><link rel="stylesheet" href="{{ asset('site/assets/css/ie8.css') }}" /><![endif]-->
<!--[if lte IE 9]><link rel="stylesheet" href="{{ asset('site/assets/css/ie9.css') }}" /><![endif]-->
<link rel="icon" href="{{asset('image/cart-logo.png')}}" type="image/x-icon"/>
    <link rel="shortcut icon" href="{{asset('image/cart-logo.png')}}" type="image/x-icon"/>
    @yield('style')

    <title>{{ $pageTitle }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
</head>
@php
    if ($headerStat == 1){

        $bodyClass = 'landing';
        $navClass = 'alt';
    }else{
        $bodyClass = '';
        $navClass = '';
    }
@endphp
<body id="app" class="{{ $bodyClass }}">

<div class="loading-page">
    <div class="sk-circle">
        <div class="sk-circle1 sk-child"></div>
        <div class="sk-circle2 sk-child"></div>
        <div class="sk-circle3 sk-child"></div>
        <div class="sk-circle4 sk-child"></div>
        <div class="sk-circle5 sk-child"></div>
        <div class="sk-circle6 sk-child"></div>
        <div class="sk-circle7 sk-child"></div>
        <div class="sk-circle8 sk-child"></div>
        <div class="sk-circle9 sk-child"></div>
        <div class="sk-circle10 sk-child"></div>
        <div class="sk-circle11 sk-child"></div>
        <div class="sk-circle12 sk-child"></div>
    </div>
    <span>
        Loading
        <span class="sep1"></span>
        <span class="sep2"></span>
        <span class="sep3"></span>
    </span>
</div>

@php
    if (isset(Auth::user()->id)){
        $productsCart = DB::table('cart')
                ->join('products','products.id','=','cart.product_id')
                ->join('users', 'users.id', '=', 'cart.userId')
                ->where('cart.userId','=',Auth::user()->id)
                ->get();
    }
@endphp

<!-- Start Scroll To Top -->
<div id="scroll-top" class="scroll-top">
    <span class="chevron"></span>
</div>
<!-- /end scroll to top -->

<!-- Search -->
<div class="search">
    <div class="search-field">
        <input type="text" name="search" id="search-field" class="form-control" placeholder="Search...">
        <form action="{{ url('site/result/search') }}" id="search-submit">
            <button type="submit" class="search-btn">
                <i class="fa fa-search"></i>
            </button>
        </form>
        <div class="close-search">
            <span class="close-1"></span>
            <span class="close-2"></span>
        </div>
    </div>
    <div class="search-result"></div>
</div>
<!-- /end search -->

<!-- Start Cart -->
<a class="cart-url" href="{{ url('site/cart') }}">
    <div class="cart">
        <i class="fa fa-cart-plus"></i>
        @if (isset($productsCart))
            <span class="badge badge-danger {{ (count($productsCart) > 0)? 'flash': '' }}"> {{ count($productsCart) }} </span>
        @endif
    </div>
</a>
<!-- /end cart -->

<!-- Header -->
<div class="top-bar">
    <div class="contact">
        <ul class="list-unstyled">
            <li>
                <p>
                    <i class="fa fa-phone"></i>
                    <span>(010) 0446 0433</span>
                </p>
            </li> |
            <li>
                <p>
                    <i class="fa fa-envelope-o"></i>
                    <span>mahmoudhammad423@gmail.com</span>
                </p>
            </li>
        </ul>
    </div>
    @if (Route::has('login'))
        @auth
            <div class="right-nav">
                <div class="login">
                    <div class="social">
                        <ul class="list-unstyled">
                            <li><a href=""><i class="fa fa-facebook"></i></a></li>
                            <li><a href=""><i class="fa fa-flickr"></i></a></li>
                            <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                            <li><a href=""><i class="fa fa-twitter"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-image">
                            <img src="{{ asset('images/'.Auth::user()->image) }}" alt="">
                        </div>
                        {{ Auth::user()->name }}
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        @if(Auth::user()->group_id == 1)
                            <a href="{{ url('/home') }}" class="icon fa-tachometer dropdown-item" target="_blank">Admin Panel</a>
                        @endif
                        <a class="btn-flat icon fa-sign-out dropdown-item" href="{{ url('/site/home') }}"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>

            </div>
        @else
            <div class="login">
                <div class="social">
                    <ul class="list-unstyled">
                        <li><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li><a href=""><i class="fa fa-flickr"></i></a></li>
                        <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                        <li><a href=""><i class="fa fa-twitter"></i></a></li>
                    </ul>
                </div>
                <div class="opt">
                    <a href="{{ route('login') }}"><i class="fa fa-lock"></i>Login</a>

                @if (Route::has('register'))
                        <a href="{{ route('register') }}"><i class="fa fa-user"></i>Sign Up</a>
                    @endif
                </div>
            </div>
        @endauth
    @endif
</div>
<header id="header">
    <div class="top-navbar">
        <h1>
            <a href="{{ url('/site/home') }}">
                <img src="{{ asset('images/site-logo.png') }}" alt="">
            </a>
        </h1>
        @if (Route::has('login'))
            @auth
                <li class="mob-search">
                    <a href="" id="search">
                        <i class="fa fa-search"></i>
                    </a>
                </li>
            @endauth
        @endif
        <a href="#nav" class="sidebar" style="font-size: 30px;margin-right: 0"></a>
        <div class="nav">
            <ul class="list-unstyled">
                @if($buttonsRoutsname == 'home')
                    <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'home')? 'active':'' }}@endif"><a href="#" data-value="banner" class="icon fa-home">{{ trans('main.site.home') }}</a></li>
                @else
                    <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'home')? 'active':'' }}@endif"><a href="{{ url('/site/home') }}" class="icon fa-home">{{ trans('main.site.home') }}</a></li>
                @endif
            @if (Route::has('login'))
                @auth
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'products')? 'active':'' }}@endif @if(isset($Id)){{ ($Id)?'active':'' }}@endif"><a href="{{ url('/site/products') }}" class="icon fa-shopping-cart">{{ trans('main.site.products') }}</a></li>
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'categories')? 'active':'' }}@endif"><a href="{{ url('/site/categories') }}" class="icon fa-caret-square-o-down">{{ trans('main.site.categories') }}</a></li>
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'gallery')? 'active':'' }}@endif"><a href="{{ url('/site/gallery') }}" class="icon fa-picture-o">{{ trans('main.site.gallery') }}</a></li>
                    @else

                    @if (Route::has('register'))
                            <li style="display: none"> <a href="{{ route('register') }}">{{ trans('main.site.register') }}</a></li>
                        @endif
                    @endauth
                @endif
                    @if($buttonsRoutsname == 'home')
                        <li><a href="#" data-value="services" class="icon fa-cogs">{{ trans('main.site.services') }}</a></li>
                        <li><a href="#" data-value="about-us" class="icon fa-fire">{{ trans('main.site.about_us') }}</a></li>
                        <li><a href="#" data-value="contact-us" class="icon fa-envelope-o">{{ trans('main.site.contact_us') }}</a></li>
                    @else
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'services')? 'active':'' }}@endif"><a href="{{ url('/site/services') }}" class="icon fa-cogs">{{ trans('main.site.services') }}</a></li>
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'about_us')? 'active':'' }}@endif"><a href="{{ url('/site/about_us') }}" class="icon fa-fire">{{ trans('main.site.about_us') }}</a></li>
                        <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'contact_us')? 'active':'' }}@endif"><a href="{{ url('/site/contact_us') }}" class="icon fa-envelope-o">{{ trans('main.site.contact_us') }}</a></li>
                    @endif
                    @if (Route::has('login'))
                        @auth
                            <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'search')? 'active':'' }}@endif">
                                <a href="" id="search">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>
                        @endauth
                    @endif
            </ul>
        </div>
        <a class="nav-cart-url" href="{{ url('site/cart') }}">
            <div class="nav-cart">
                <i class="fa fa-cart-plus"></i>
                {{ trans('main.site.cart') }}
                @if (isset($productsCart) && $productsCart->count() > 0)
                    <span class="badge badge-danger {{ (count($productsCart) > 0)? 'flash': '' }}"> {{ count($productsCart) }} </span>
                @endif
            </div>
        </a>
        <a class="btn-lang" href="{{ url('/lang/') }}/@lang('main.lang_href')">
            @lang('main.lang')
            <i class="fa fa-language"></i>
        </a>
    </div>
</header>
