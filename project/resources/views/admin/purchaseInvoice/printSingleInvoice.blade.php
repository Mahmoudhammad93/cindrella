@if( is_permited('PurchaseInvoice','print') == 1 )
@extends('admin.shared.master')
@section('content')

<section class="invoice">
      <!-- title row -->
      <div class="row">
        <div class="col-xs-12">
          <h2 class="page-header">
            <i class="fa fa-globe"></i> Beauty Cinderella , Sys.
            <small class="pull-right">{{ trans('main.date') }}: {{ date('y-m-d') }}</small>
          </h2>
        </div>
        <!-- /.col -->
      </div>
      <hr>
      <div class="row invoice-info">
        <p>
        <b>  {{ trans('main.code') }} : # {{ $row->code }}</b><br>
          <span>
          <strong>{{ trans('main.from') }} :</strong>
          <span>
          <span>
            @if(isset($row->getSupplier->name))
                {{ $row->getSupplier->name }}
            @else
                {{ trans('main.supplier_is_deleted')}}
            @endif
          </span>
        </p>
        <p>
          <span>
          <strong>{{ trans('main.address') }}  :</strong>
          <span>
          <span>
          @if(isset($row->getSupplier->name))
                      {{ $row->getSupplier->address }}
                  @else
                      {{ trans('main.supplier_is_deleted')}}
                  @endif
          </span>
        </p>
        <p>
          <span>
          <strong>{{ trans('main.phone') }} :</strong>
          <span>
          <span>
          @if(isset($row->getSupplier->name))
                      {{ $row->getSupplier->phone }}
                  @else
                      {{ trans('main.supplier_is_deleted')}}
                  @endif
          </span>
        </p>
        <p>
              <b> {{ trans('main.date') }}:</b> {{ $row->date }}<br>
              <b>{{ trans('main.total_value') }}:</b> {{number_format(round($row->total_value,5) , 1, ',',',')}} {{ trans('main.coins.le') }}
        </p>
      </div>
      <hr style="margin: 0;height: 3px;border-top: 1px solid #f1f1f1;">
      <!-- Table row -->
      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Product ( الصنف ) </th>
              <th>Product Code ( كود الصنف ) #</th>
              <th>َQuantity ( الكمية )</th>
              <th>Pay Price ( سعر الشراء )</th>
              <th>Total Price ( الاجمالي )</th>
            </tr>
            </thead>

            <tbody>
            @php
             $i = 1;
            @endphp
            @foreach($row->getInvoiceProducts as $inPro)
            <tr>
              <td>{{ $i }}</td>
              <td>{{ $inPro->getProduct->name }}</td>
              <td>{{ $inPro->getProduct->code }}</td>
              <td>{{ round($inPro->quantity,3) }}</td>
              <td>{{ round($inPro->pay_price,3) }}</td>
              <td>{{ round($inPro->total_price,3) }}</td>
            </tr>
            @php
             $i = $i + 1;
            @endphp
            @endforeach
            <tr>
              <td colspan='6' class="text-center" > Total Value ( الاجمالي ) : <span style="color: red; font-size: 20px;"> {{ round($row->total_value,5) }} LE </span> </td>
            </tr>
            </tbody>
          </table>
        </div>
        <!-- /.col -->
      </div>
    </section>
@endsection
@else
@section('content')
    @include('admin.shared.empty')
@stop
@endif
