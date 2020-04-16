<!-- Nav -->
<nav id="nav">
    <ul class="links mt-4">
        @if (Route::has('login'))
            @auth
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
                <span class="pages">Site Pages</span>
                @if($buttonsRoutsname == 'home')
                    <li><a href="#" data-value="banner" class="icon fa-home">Home</a></li>
                @else
                    <li><a href="{{ url('/site/home') }}" class="icon fa-home">Home</a></li>
                @endif
                <li><a href="{{ url('/site/generic') }}" class="icon fa-genderless">Generic</a></li>
                <li><a href="{{ url('/site/element') }}" class="icon fa-list-alt">Elements</a></li>
                <li><a href="{{ url('/site/products') }}" class="icon fa-shopping-cart">Products</a></li>
                <li><a href="{{ url('/site/categories') }}" class="icon fa-caret-square-o-down">Categories</a></li>
                <li><a href="{{ url('/site/gallery') }}" class="icon fa-picture-o">Gallery</a></li>
                @if(Auth::user()->group_id == 1)
                    <li><a href="{{ url('/home') }}" class="icon fa-tachometer">Admin Panel</a></li>
                @endif
            @else
                <li><a href="{{ route('login') }}">Login</a></li>

                @if (Route::has('register'))
                    <li style="display: none"> <a href="{{ route('register') }}">Register</a></li>
                @endif
            @endauth
        @endif
            @if($buttonsRoutsname == 'home')
                <li><a href="#" data-value="services" class="icon fa-cogs">Services</a></li>
                <li><a href="#" data-value="contact-us" class="icon fa-envelope-o">Contact Us</a></li>
                <li><a href="#" data-value="about-us" class="icon fa-fire">About Us</a></li>
            @else
                <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'services')? 'active':'' }}@endif"><a href="{{ url('/site/services') }}" class="icon fa-cogs">services</a></li>
                <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'contact_us')? 'active':'' }}@endif"><a href="{{ url('/site/contact_us') }}" class="icon fa-envelope-o">Contact Us</a></li>
                <li class="@if(isset($buttonsRoutsname)){{ ($buttonsRoutsname == 'about_us')? 'active':'' }}@endif"><a href="{{ url('/site/about_us') }}" class="icon fa-fire">About Us</a></li>
            @endif
            @if (Route::has('login'))
                @auth
                    <li>
                        <a class="btn-flat icon fa-sign-out" href="{{ url('/site/home') }}"
                           onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                    <li>
                        <a class="btn-lang" href="{{ url('/lang/') }}/@lang('main.lang_href')">
                            @lang('main.lang')
                            <i class="fa fa-language"></i>
                        </a>
                    </li>
                @endauth
            @endif
    </ul>
</nav>
