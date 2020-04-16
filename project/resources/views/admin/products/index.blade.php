@if( is_permited('products','view') == 1 )
@extends('admin.shared.master')
@section('content')

<!-- TABLE: LATEST ORDERS -->
  <div class="box box-info">
  <!-- /.box-body -->
    <div class="box-header clearfix">
      @if( is_permited('products','add') == 1 )
      <a href="{{ route($buttonsRoutsname.'.create') }}" class="btn btn-sm btn-info btn-flat pull-right" style="margin-left: 5px;"><i class="fa fa-plus"></i> {{ trans('main.add') }} {{ $PageTitle }} </a>
      @endif

      @if( is_permited('products','print') == 1 )
      <form action="{{ route($buttonsRoutsname.'.print') }}" method="post" style="display: inline;">
        {{ csrf_field() }}
        @foreach($rows as $key => $value)
        <input name="{{$key}}" value="{{$value->id}}" style="display: none;"/>
        @endforeach
        <button class="btn btn-sm btn-primary btn-flat pull-right"><i class="fa fa-print"></i> {{ trans('main.print') }} </button>
      </form>
      @endif

      @if($rows->count() > 0)
      @php
       $totalcostprice = 0;
      @endphp
      @foreach($rows as $rowforcontallcost)
      @php
       $totalcostprice = $totalcostprice + ($rowforcontallcost->sell_price * $rowforcontallcost->quantity) ;
      @endphp
      @endforeach
      @endif
      <button type="button" class="btn btn-sm btn-success btn-flat pull-left"> {{ trans('main.total') }}  : <span style="font-size: 15px;"> {{ $rows->count() }} </span> {{ trans('main.product') }} </button>
      <button type="button" class="btn btn-sm btn-danger btn-flat pull-left" style="margin-left: 5px;"> {{ trans('main.total_price') }} : <span style="font-size: 15px;"> {{ isset( $totalcostprice ) ? round($totalcostprice,5) : 0}} </span> {{ trans('main.coins.le') }} </button>

    </div>
    <!-- /.box-header -->

    <!-- /.box-footer -->
    <div class="box-body">
{{--        <div>{!! \Milon\Barcode\DNS1D::getBarcodeSVG('123', 'C128A') !!}</div>--}}

    <!-- include table response -->
      <!-- filteration model -->
      @if( is_permited('products','search') == 1 )
      @include("admin.".$buttonsRoutsname.".components.filterComponent",$filterData)
      @endif
      <!-- filteration model -->


             <!-- /.table-responsive -->
      <div class="table-responsive table-striped table-bordered">
        @if($rows->count() > 0)
        @php
          $ths = [trans('main.code') , trans('main.name') ,trans('main.category'), trans('main.quantity') , trans('main.units') ,trans('main.purchase_price') , trans('main.pay_price'), trans('main.priceInDisc'),trans('main.barcode') ,trans('main.options')];
          $tds = $rows;
          $tdOnly = ['code','name','category_id','quantity','unit_id','sell_price','pay_price','priceInDisc'];
        @endphp

        @php
         $Otipnsinputs  = [
          is_permited('products','edit') == 1 ? 'admin.shared.buttons.edit' : '',
          is_permited('products','delete') == 1 ? 'admin.shared.buttons.delete' : '',
         ];
        @endphp

        <table class="table table-hover no-margin">
          @include("admin.".$buttonsRoutsname.".components.tableComponent",[$ths,$tds,$tdOnly,$Otipnsinputs])
        </table>
        {{ $tds->links() }}
        @else

        <div class="alert alert-danger text-center" style="color: red; margin-top: 50px; margin-bottom: 50px;"> No Data Found </div>

        @endif
      </div>
      <!-- /.table-responsive -->

    <!-- include table response -->

    </div>

  </div>
  <!-- /.box -->

@stop

@else
@section('content')
    @include('admin.shared.empty')
@stop
@endif
