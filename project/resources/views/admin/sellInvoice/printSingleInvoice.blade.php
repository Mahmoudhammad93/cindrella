@if( is_permited('sellInvoice','print') == 1 )
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
            @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
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
          @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
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
          @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
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
      <div class="row">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th> {{trans('main.product')}} </th>
              <th>َ{{trans('main.quantity')}}</th>
              <th>َ{{trans('main.one_price')}}</th>
              <th>{{ trans('main.total_price') }}</th>
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
              <td>{{ round($inPro->quantity,3) }}</td>
              <td>{{ round($inPro->sell_price,3) }}</td>
              <td>{{ round($inPro->total_price,3) }}</td>
            </tr>
            @php
             $i = $i + 1;
            @endphp
            @endforeach
            <tr>
              <td colspan='6' class="text-center" > {{ trans('main.total_value') }} : <span style="color: red; font-size: 20px;"> {{number_format(round($row->total_value,5) , 1, ',',',')}} {{ trans('main.coins.le') }} </span> </td>
            </tr>
            </tbody>
          </table>
        <!-- /.col -->
      </div>
    </section>
@endsection
@else
@section('content')
    @include('admin.shared.empty')
@stop
@endif
