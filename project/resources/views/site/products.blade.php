@extends('welcome')
@section('content')

    <!-- One -->
    <section id="one" class="wrapper style1">
        <div class="inner">
            @include('site.siteLayout.head')
            <div class="cate-btn">
                @if(isset($categories))
                    <a href="#" class="button special small @if(!isset($Id)) scale @endif" id="all">{{ trans('main.site.all') }}</a>
                    @foreach($categories as $category)
                        <a href="{{ $category->id }}" class="button special small @if(isset($Id)){{ $Id == $category->id? 'scale' : '' }} @endif" id="{{ $category->id }}">{{ $category->name }}</a>
                    @endforeach
                @endif
            </div>
            @if($products->count() > 0 )
                    @if($buttonsRoutsname == 'productImages')
                    @foreach($products as $product)
                        <a href="{{ asset('images/'.$product->image) }}">
                            <article class="feature left" style="height: 100%; box-shadow: none; background-color: transparent; padding: 20px; margin: 0">
                                <span class="image" style="padding: 0;border: 2px solid; border-radius: 10px; background-color: #fff; box-shadow: 0 0 4px #808080bf;"><img src="{{ asset('images/'.$product->image) }}" alt="" /></span>
                            </article>
                        </a>
                    @endforeach
                @else
                        <div class="result">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col col-12 col-lg-4 col-md-12 col-sm-12">
                                        <a href="{{ url('site/product/'.$product->id.'/details') }}">
                                            <article class="feature left">
                                                <div class="image">
                                                    <div class="overlay">
                                                        <a href="{{ url('site/product/'.$product->id.'/details') }}">
                                                            <span>View <i class="fa fa-eye"></i> </span>
                                                        </a>
                                                    </div>
                                                    <img src="{{ asset('images/'.$product->image) }}" alt="" />
                                                </div>
                                                <div class="content">
                                                    @if($product->discount)
                                                        <span class="mark-sale">
                                                            <i class="fa fa-bookmark"></i>
                                                        </span>
                                                    @endif
                                                    <h5>{{ $product->name }}</h5>
                                                    <div class="desc">
                                                        <p>
                                                            {{ $product->desc }}
                                                        </p>
                                                    </div>
                                                    <p>

                                                        @if($product->discount)
                                                            <span class="badge badge-light line">${{ number_format($product->pay_price, 0, ',',',') }}.00</span>
                                                            <span class="disc">-{{ $product->discount }}%</span>
                                                        @endif
                                                    </p>
                                                    <p>
                                                        <span class="badge badge-warning">${{ ($product->discount && $product->priceInDisc)?number_format($product->priceInDisc, 0, ',',',') : number_format($product->pay_price , 0, ',',',') }}.00</span>
                                                    </p>
                                                    <div class="rate">
                                                        <div class="container">
                                                            <div class="feedback">
                                                                <div class="rating">
                                                                    <input type="radio" name="rating{{$product->id}}" value="5" id="rating-5" {{ ($product->rate == 5)? 'checked': '' }}>
                                                                    <label for="rating-5"></label>
                                                                    <input type="radio" name="rating{{$product->id}}" value="4" id="rating-4" {{ ($product->rate == 4)? 'checked': '' }}>
                                                                    <label for="rating-4"></label>
                                                                    <input type="radio" name="rating{{$product->id}}" value="3" id="rating-3" {{ ($product->rate == 3)? 'checked': '' }}>
                                                                    <label for="rating-3"></label>
                                                                    <input type="radio" name="rating{{$product->id}}" value="2" id="rating-2" {{ ($product->rate == 2)? 'checked': '' }}>
                                                                    <label for="rating-2"></label>
                                                                    <input type="radio" name="rating{{$product->id}}" value="1" id="rating-1" {{ ($product->rate == 1)? 'checked': '' }}>
                                                                    <label for="rating-1"></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <p>
                                                            @if(isset($product->rate) && $product->rate > 0)
                                                                ( <i class="fa fa-star"></i> {{$product->rate}} )
                                                            @endif
                                                        </p>
                                                    </div>
                                                    <form class="addProduct-ToCart" action="{{ route('addProductToCart') }}" method="POST">
                                                        <input type="hidden" name="productName" value="{{ $product->name }}">
                                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                        <input type="hidden" name="userId" value="{{ Auth::user()->id }}">
                                                        <input type="hidden" name="price" value="{{ $product->pay_price }}">
                                                        <input type="hidden" name="desc" value="{{ $product->desc }}">
                                                        <input type="hidden" name="image" value="{{ $product->image }}">
                                                        <input type="hidden" name="discount" value="{{ $product->discount }}">
                                                        <input type="hidden" name="priceInDisc" value="{{ $product->priceInDisc }}">
                                                        <input type="hidden" name="count" value="1">
                                                        <button class="btn btn-default btn-block">
                                                            <i class="fa fa-cart-plus"></i>
                                                            {{ trans('main.site.add_to_cart') }}
                                                        </button>
                                                    </form>
                                                </div>
                                            </article>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                @endif
            @else
                <div class="empty" style="width: 100%">
                    <div class="image">
                        <img src="{{ asset('site/images/sad.png') }}" alt="">
                    </div>
                    <div class="text">
                        <p>
                            Category is empty
                        </p>
                        <div class="text-img">
                            <img src="{{ asset('site/images/box.png') }}" alt="">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

@section('script')
    <script>

        // To Show Products By Categories
        $(document).on('click', '.button.special.small', function (e) {
            var btnId = $(this).attr('id');
            $(this).addClass('scale').siblings().removeClass('scale');
            e.preventDefault();
            $.ajax({
                url: "{{ route('getProduct') }}",
                type: "GET",
                dataType: 'JSON',
                data:  { prodID: btnId},
                success: function (data) {
                    console.log(data)
                    $('.result .row').html('');
                    var products = '';
                    if (data.length == 0){
                        $('.empty').hide();
                        products = '<div class="empty" style="width: 100%;"><div class="image"><img src="{{ asset('site/images/sad.png') }}" alt=""></div><div class="text"><p>Category is empty</p><div class="text-img"><img src="{{ asset('site/images/box.png') }}" alt=""></div></div></div>';
                        $('.result').append(products);
                    }else {
                        data.forEach(function (ele) {
                            var priceFormat = new Intl.NumberFormat('en-US', {
                                style: 'currency',
                                currency: 'USD'
                            });

                            var rate1 = "";
                            (ele.rate == 1)? rate1 = 'checked':'';

                            var rate2 = "";
                            (ele.rate == 2)? rate2 = 'checked':'';

                            var rate3 = "";
                            (ele.rate == 3)? rate3 = 'checked':'';

                            var rate4 = "";
                            (ele.rate == 4)? rate4 = 'checked':'';

                            var rate5 = "";
                            (ele.rate == 5)? rate5 = 'checked':'';

                            var discount = "";
                            (ele.discount > 0)? discount = '<span class="badge badge-light line">'+priceFormat.format(ele.pay_price)+'</span><span class="disc">-'+ele.discount+'%</span>' : discount ='';

                            var markSale = "";
                            (ele.discount > 0)? markSale = '<span class="mark-sale"><i class="fa fa-bookmark"></i></span>': markSale = '';

                            var priceOnDisc = ele.pay_price - (ele.pay_price * ele.discount) / 100;

                            $('.empty').hide();
                            @if(isset($product))
                                products = '<div class="col col-12 col-lg-4 col-md-12 col-sm-12"><div class="feature left"><span class="image"><div class="overlay"><a href="{{ url('site/product/'.$product->id.'/details') }}"><span>View <i class="fa fa-eye"></i> </span></a></div><img src="{{ asset('images/') }}/' + ele.image + '" alt="" /></span> <div class="content"> '+markSale+' <h5>' + ele.name + '</h5><div class="desc"><p>'+ele.desc+'</p></div> <p>'+discount+'</p><p><span class="badge badge-warning">'+priceFormat.format(priceOnDisc)+'</span></p><div class="rate"><div class="container"><div class="feedback"><div class="rating"><input type="radio" name="rating'+ele.id+'" value="5" id="rating-5" id="rating-5" '+rate5+'><label for="rating-5"></label><input type="radio" name="rating'+ele.id+'" value="4" id="rating-4" '+rate4+'><label for="rating-4"></label><input type="radio" name="rating'+ele.id+'" value="3" id="rating-3" '+rate3+'><label for="rating-3"></label><input type="radio" name="rating'+ele.id+'" value="2" id="rating-2" '+rate2+'><label for="rating-2"></label><input type="radio" name="rating'+ele.id+'" value="1" id="rating-1" '+rate1+'><label for="rating-1"></label></div></div></div><p>@if(isset($product->rate) && $product->rate > 0)( <i class="fa fa-star"></i> '+ele.rate+' )@endif</p></div> <form class="addProduct-ToCart" action="{{ route('addProductToCart') }}" method="POST"><input type="hidden" name="productName" value="'+ele.name +'"><input type="hidden" name="product_id" value="'+ele.id+'"><input type="hidden" name="userId" value="{{ Auth::user()->id }}"><input type="hidden" name="price" value="'+ele.pay_price+'"><input type="hidden" name="desc" value="'+ele.desc+'"><input type="hidden" name="image" value="'+ele.image+'"><input type="hidden" name="count" value="1"><button class="btn btn-default btn-block"><i class="fa fa-cart-plus"></i>{{ trans('main.site.add_to_cart') }}</button></form> </div></div></div>';
                            @endif
                            $('.result .row').append(products);
                        });
                    }
                }
            });
            // if (btnId !== 'all'){
            //
            // }
        });

        // To Insert Product To Cart
        $(document).on('submit', '.addProduct-ToCart', function (e) {
            e.preventDefault();
            var product_id  = $(this).find('input[name=product_id]').val(),
                count       = $(this).find('input[name=count]').val(),
                userId      = $(this).find('input[name=userId]').val(),
                productName = $(this).find('input[name=productName]').val(),
                price       = $(this).find('input[name=price]').val(),
                desc        = $(this).find('input[name=desc]').val(),
                image       = $(this).find('input[name=image]').val(),
                discount    = $(this).find('input[name=discount]').val(),
                priceInDisc = $(this).find('input[name=priceInDisc]').val(),
                url         = $(this).attr('action'),
                type        = $(this).attr('method');
            <?php $pId = '"product_id"' ?>
            $.ajax({
                url: url,
                type: type,
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {
                    "product_id": product_id,
                    "userId": userId,
                    "count": count,
                    "productName":productName,
                    "price": price,
                    "desc": desc,
                    "image": image,
                    "discount": discount,
                    "priceInDisc": priceInDisc,
                },
                success: function (data) {
                    if (data==0){
                        var cartCount = parseInt($('.cart .badge').text(), 10) +1;
                        $('.cart .badge').text(cartCount);
                        $('.nav-cart .badge').text(cartCount);
                    }
                    iziToast.success({
                        title: 'تم',
                        timeout: 2000,
                        theme: 'light',
                        animateInside: true,
                        transitionInMobile: 'fadeInUp',
                        transitionOutMobile: 'fadeOutDown',
                        message: 'تم اضافة المنتج بنجاح',
                        onClosed: function () {
                            // location.reload();
                        }
                    });
                }
            })
        });

        function load_cart()
        {
            $.ajax({
                url:"index.php",
                method:"POST",
                success:function(data)
                {
                    $('.cart .badge').html(data);
                }
            })
        }

    </script>
@endsection
