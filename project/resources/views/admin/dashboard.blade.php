@extends('admin.shared.master')
@section('content')
@if( is_permited('dashboard','view') == 1 )
<div class="row">

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="overlay dark"></div>
    <div class="inner text-center">
        <h3>{{ $users->count() }}</h3>

        <p>{{ trans('main.users') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-users"></i>
        </div>
    <a href="{{ route('users.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner text-center">
        <h3>{{ $suppliers->count() }}</h3>

        <p>{{ trans('main.cust_comp') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-handshake-o"></i>
        </div>
    <a href="{{ route('suppliers.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-yellow">
    <div class="inner text-center">
        <h3>{{ $products->count() }}</h3>

        <p>{{ trans('main.products') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-product-hunt"></i>
        </div>
    <a href="{{ route('products.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner text-center">
        <h3>{{ $purchaseInvoice->count() }}</h3>

        <p>{{ trans('main.pur_invoice') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-list-alt"></i>
        </div>
    <a href="{{ route('purchaseInvoice.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-4 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-fuchsia">
    <div class="inner text-center">
        <h3>{{ $sellInvoice->count() }}</h3>

        <p>{{ trans('main.sell_invoice') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-list-alt"></i>
        </div>
    <a href="{{ route('sellInvoice.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-4 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-red">
    <div class="inner text-center">
        <h3>{{ $totalAlert }}</h3>

        <p> {{ trans('main.defi') }}</p>

    </div>
        <div class="icon">
            <i class="fa fa-minus-circle"></i>
        </div>
    <a href="{{ route('products.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
    </div>
</div>

    <div class="col-lg-12 col-xs-12">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner text-center">
                <h3>{{ round($box->totl_value,5) }}</h3>

                <p>{{ trans('main.total_price_in_box') }}</p>

            </div>
            <div class="icon">
                <i class="fa fa-area-chart"></i>
            </div>
            <a href="{{ route('boxes.index') }}" class="small-box-footer">{{ trans('main.more_info') }} </a>
        </div>
    </div>

<div class="col-lg-12 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-green">
    <div class="inner text-center">
        <h3>{{ round($totalGard,5) }} LE</h3>

        <p> {{ trans('main.total_inv') }} </p>

    </div>
        <div class="icon">
            <i class="fa fa-line-chart"></i>
        </div>
    <a href="#" class="small-box-footer">No {{ trans('main.more_info') }} </a>
    </div>
</div>

<div class="col-lg-12 col-xs-12">
    <!-- small box -->
    <div class="small-box bg-black">
    <div class="inner text-center">
        <h3>{{ round($todayTotalGain,5) }} LE</h3>

        <p> {{ trans('main.total_gain_daily') }} </p>

    </div>
        <div class="icon">
            <i class="fa fa-bar-chart"></i>
        </div>
    <a href="#" class="small-box-footer">No {{ trans('main.more_info') }} </a>
    </div>
</div>

</div>
@else
@section('content')
    @include('admin.shared.empty')
@stop
@endif
@endsection
