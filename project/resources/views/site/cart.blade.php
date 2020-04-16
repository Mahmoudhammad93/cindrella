@extends('welcome')
@section('style')

@endsection
@section('content')
    <section id="one" class="wrapper style1">
        <div class="inner">
            @include('site.siteLayout.head')
            <div class="cart-page">
            @if($cartProducts->count() <= 0)
                <div class="empty" style="width: 100%">
                    <div class="image">
                        <img src="{{ asset('site/images/sad.png') }}" alt="">
                    </div>
                    <div class="text">
                        <p>
                            Cart is empty
                        </p>
                        <div class="text-img">
                            <img src="{{ asset('site/images/box.png') }}" alt="">
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    @foreach($cartProducts as $cartProduct)
                        <div class="col col-12 col-lg-4 col-md-12 col-sm-12">
                            <div class="product">
                                <div class="image">
                                    <div class="overlay"></div>
                                    @if($cartProduct->discount)
                                        <span class="offer-mark"></span>
                                    @endif
                                    <img src="{{ asset('images/'.$cartProduct->image) }}" alt="">
                                </div>
                                <div class="info">
                                    <div class="desc">
                                        <h4 class="name mb-2"><a href="{{ url('site/product/'.$cartProduct->id.'/details') }}">{{$cartProduct->productName}}</a></h4>
                                        <p class="text">
                                            {{ $cartProduct->desc }}
                                        </p>
                                        <p class="one-price">
                                            <span>Price of one : <span>{{ $cartProduct->count }}</span> X {{ number_format($cartProduct->price , 0, ',',',') }},00 LE</span>
                                        </p>
                                        @if($cartProduct->discount)
                                        <p class="price">
                                            <span class="disc">-{{ $cartProduct->discount }}%</span>
                                            <span class="badge badge-light line total">
                                                ${{ number_format($cartProduct->price * $cartProduct->count , 0, ',',',') }},00
                                            </span>
                                        </p>
                                        @endif
                                        <p class="price">
                                            @php
                                                $totalPrice = $cartProduct->price * $cartProduct->count;
                                            @endphp
                                            <span class="badge badge-warning total" style="font-size: 20px; font-family: 'Poppins', Fallback, sans-serif;">
                                               <span>${{ ($cartProduct->discount)?number_format($totalPrice - ($totalPrice * $cartProduct->discount) / 100, 0, ',',',') : number_format($cartProduct->price * $cartProduct->count , 0, ',',',') }}</span>,00
                                            </span>
                                        </p>
                                    </div>
                                    <div class="opt">
                                        <div class="rate">
                                            <div class="container">
                                                <div class="feedback">
                                                    <div class="rating">
                                                        <input type="radio" name="rating{{$cartProduct->id}}" value="5" data-id="{{ $cartProduct->id }}" id="rating-5" {{ ($cartProduct->rate == 5)? 'checked': '' }}>
                                                        <label for="rating-5"></label>
                                                        <input type="radio" name="rating{{$cartProduct->id}}" value="4" data-id="{{ $cartProduct->id }}" id="rating-4" {{ ($cartProduct->rate == 4)? 'checked': '' }}>
                                                        <label for="rating-4"></label>
                                                        <input type="radio" name="rating{{$cartProduct->id}}" value="3" data-id="{{ $cartProduct->id }}" id="rating-3" {{ ($cartProduct->rate == 3)? 'checked': '' }}>
                                                        <label for="rating-3"></label>
                                                        <input type="radio" name="rating{{$cartProduct->id}}" value="2" data-id="{{ $cartProduct->id }}" id="rating-2" {{ ($cartProduct->rate == 2)? 'checked': '' }}>
                                                        <label for="rating-2"></label>
                                                        <input type="radio" name="rating{{$cartProduct->id}}" value="1" data-id="{{ $cartProduct->id }}" id="rating-1" {{ ($cartProduct->rate == 1)? 'checked': '' }}>
                                                        <label for="rating-1"></label>
                                                    </div>
                                                </div>
                                            </div>
                                            <p>
                                                @if(isset($cartProduct->rate) && $cartProduct->rate > 0)
                                                ( <i class="fa fa-star"></i> {{$cartProduct->rate}} )
                                                @endif
                                            </p>
                                        </div>
                                        <div class="rating-info">
                                            <a href="#" class="rate-info-btn">View rating details</a>
                                            <div class="rate-bars">
                                                <div class="bar-box">
                                                    <label><i class="fa fa-star"></i> 1 :</label>
                                                    <div class="progress-bar">
                                                        <div class="progress1" style="width:1%; background-position:1%;"></div>
                                                        <input id="setVal1" type="number" name="rating_bar" value="{{$cartProduct->rate + 53}}"  pattern="\d*"/>
                                                    </div>
                                                </div>
                                                <div class="bar-box">
                                                    <label><i class="fa fa-star"></i> 2 :</label>
                                                    <div class="progress-bar">
                                                        <div class="progress2" style="width:1%; background-position:1%;"></div>
                                                        <input id="setVal2" type="number" name="rating_bar" value="{{$cartProduct->rate + 70}}"  pattern="\d*"/>
                                                    </div>
                                                </div>
                                                <div class="bar-box">
                                                    <label><i class="fa fa-star"></i> 3 :</label>
                                                    <div class="progress-bar">
                                                        <div class="progress3" style="width:1%; background-position:1%;"></div>
                                                        <input id="setVal3" type="number" name="rating_bar" value="{{$cartProduct->rate + 10}}"  pattern="\d*"/>
                                                    </div>
                                                </div>
                                                <div class="bar-box">
                                                    <label><i class="fa fa-star"></i> 4 :</label>
                                                    <div class="progress-bar">
                                                        <div class="progress4" style="width:1%; background-position:1%;"></div>
                                                        <input id="setVal4" type="number" name="rating_bar" value="{{$cartProduct->rate}}"  pattern="\d*"/>
                                                    </div>
                                                </div>
                                                <div class="bar-box">
                                                    <label><i class="fa fa-star"></i> 5 :</label>
                                                    <div class="progress-bar">
                                                        <div class="progress5" style="width:1%; background-position:1%;"></div>
                                                        <input id="setVal5" type="number" name="rating_bar" value="{{$cartProduct->rate + 30}}"  pattern="\d*"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="count-box">
                                            <button class="minus" {{ ($cartProduct->count == 1)? 'disabled': '' }}> <i class="fa fa-minus"></i> </button>
                                            <input type="number" name="count" id="count" readonly value="{{ $cartProduct->count }}">
                                            <input type="hidden" name="count_id" value="{{ $cartProduct->id }}">
                                            <button class="plus"> <i class="fa fa-plus"></i> </button>
                                        </div>
                                        <div class="opt-btn">
                                            <form class="delete-product" id="delete-product" action="" method="">
                                                <input type="hidden" name="product_id" value="{{ $cartProduct->id }}">
                                                <a href="#" class="btn btn-warning small delete-btn">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </form>
                                            <a href="#" class="btn btn-warning btn-block">
                                                Pay this order only
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                        <div class="col col-12 col-md-12">
                            <a href="{{ url('site/cart/payment') }}" class="btn btn-warning small btn-block">Complete all order {{number_format($allProductsPrice , 0, ',',',') }},00 LE</a>
                        </div>
                </div>
            @endif
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        var app = new Vue({
            el: '#app',
            data: {
                title: 'test',
            }
        });
        // To plus another one from the same product
        $(document).on('click', '.plus', function () {
            var input = $(this).parent().find('input[name=count]');
            input.val(parseInt(input.val()) + 1);
            input.change();

            var inputValue = input.val(),
                count_id = $(this).parent().find('input[name=count_id]').val();
            // console.log(inputValue);
            $.ajax({
                url: "{{ route('countUpdatePlus') }}",
                type: "POST",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {"inputValue": inputValue, "count_id": count_id},
                success: function (data) {
                    iziToast.success({
                        title: 'OK',
                        timeout: 2000,
                        message: 'تم زيادة واحد اخر!',
                    });
                }
            });
            if (inputValue != 1){
                $(this).parents('.product').find('.minus').attr('disabled',false);
            }
            return false;
        });

        // To minus one from the same product
        $(document).on('click', '.minus', function () {
            var input = $(this).parent().find('input[name=count]');
            var count = parseInt(input.val()) - 1;
            count = count < 1 ? 1 : count;
            input.val(count);
            input.change();
            var inputValue = input.val(),
                count_id = $(this).parent().find('input[name=count_id]').val();
            // console.log(inputValue);
            if(inputValue >= 1){
                $.ajax({
                    url: "{{ route('countUpdateMinus') }}",
                    type: "POST",
                    headers: {
                        'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: {"inputValue": inputValue, "count_id": count_id},
                    success: function (data) {
                        // $('.desc').replaceWith($('.desc').html(data));
                        iziToast.error({
                            title: 'OK',
                            timeout: 2000,
                            message: 'تم حذف واحد!',
                        });
                    }
                });
                if (inputValue == 1){
                    $(this).parents('.product').find('.minus').attr('disabled','disabled');
                }
            }else{
                return false;
            }
            return false;
        });

        // To Delete Product From Cart

        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault()
            $(this).parent('#delete-product').submit();
        });

        $(document).on('submit', '#delete-product', function (e) {
            var id = $(this).parent().find('input[name=product_id]').val();
            $.ajax({
                url: "site/product/"+id+"/destroy",
                type: "delete",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                data: {"id": id},
                success: function (data) {
                    iziToast.error({
                        title: 'تم',
                        message: 'تم حذف المنتج بنجاح',
                        timeout: 2000,
                        onClosed: function () {
                            location.reload();
                        }
                    });
                }
            })

            return false;
        });

        $(document).on('change', 'input[name=rating]', function () {
            var value = $(this).val(),
                dataId = $(this).attr('data-id');
            $.ajax({
                url: "{{ route('rating') }}",
                type: "POST",
                data: {"value": value, "dataId": dataId},
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                success: function (data) {
                    $('#rating-'+data).attr('checked', 'checked');
                }
            });
            return false;
        });

    </script>
@endsection
