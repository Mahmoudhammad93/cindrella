@extends('welcome')
@section('content')

    <!-- One -->
    <section id="one" class="categories wrapper style1">
        <div class="inner">
            @include('site.siteLayout.head')
            @if($buttonsRoutsname == 'gallery')
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col col-12 col-lg-3 col-md-12 col-sm-12">
                            <a href="{{ url('site/product/images/'.$category->id) }}">
                                <article class="feature left">
                                    <div class="image">
                                        <div class="overlay">
                                            <span>View <i class="fa fa-eye"></i> </span>
                                        </div>
                                        <img src="{{ asset('images/'.$category->image) }}" alt="" />
                                    </div>
                                    <div class="content" style="justify-content: center">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="row">
                    @foreach($categories as $category)
                        <div class="col col-12 col-lg-3 col-md-12 col-sm-12">
                            <a href="{{ url('site/products/'.$category->id) }}">
                                <article class="feature left">
                                    <div class="image">
                                        <div class="overlay">
                                            <span>View <i class="fa fa-eye"></i> </span>
                                        </div>
                                        <img src="{{ asset('images/'.$category->image) }}" alt="" />
                                    </div>
                                    <div class="content" style="justify-content: center">
                                        <h5>{{ $category->name }}</h5>
                                    </div>
                                </article>
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).on('click', '.button.special.small', function (e) {
            e.preventDefault();
            var btnId = $(this).attr('id');
            alert(btnId);
            $.ajax({})
        });
    </script>
@endsection
