@extends('welcome')

@section('content')
    <!-- Main -->
    <section id="main" class="wrapper search-page">
        @if(isset($product) && $product->count() > 0)
            @include('site.siteLayout.head')
            <div class="search-page-result">
                {{$product}}
            </div>
        @else
            <div class="not-found">
                <div class="search-overlay">
                    <h1>Not Found</h1>
                    <p>Nothing matched your search criteria. Please try again with different keywords.</p>
                    <div class="right-search">
                        <form action="">
                            <input type="search" name="" id="" class="form-control" placeholder="Type Keywords...">
                            <i class="fa fa-search"></i>
                        </form>
                    </div>
                    <a href="">OR BACK TO HOMEPAGE</a>
                </div>
                <div class="image">
                    <img src="{{ asset('/site/assets/images/404-background.jpg') }}" alt="">
                </div>
            </div>
        @endif
    </section>
@endsection
