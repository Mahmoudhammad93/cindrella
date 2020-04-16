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
      <!-- info row -->
      <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
              From ( من ) :
              <strong>
                  @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
                      {{ $row->getSupplier->name }}
                  @else
                      Supplier is deleted
                  @endif
              </strong>
              <address>
                  <br> Address ( العنوان )  :
                  @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
                      {{ $row->getSupplier->address }}
                  @else
                      Supplier is deleted
                  @endif
                  <br> Phone ( رقم الهاتف ) :
                  @if(isset($row->getSupplier->name) && $row->getSupplier->type == 1)
                      {{ $row->getSupplier->phone }}
                  @else
                      Supplier is deleted
                  @endif
              </address>
          </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <address>

          </address>
        </div>
        <!-- /.col -->
        <div class="col-sm-4 invoice-col">
          <b>  Code ( الكود ) : # {{ $row->code }}</b><br>
          <br>
          <b> Date ( التاريخ ):</b> {{ $row->date }}<br>
          <b>Total Value ( الاجمالي ):</b> {{ round($row->total_value,5) }} LE <br>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

      <!-- Table row -->
      <div class="row">
        <div class="col-xs-12 table-responsive">
          <table class="table table-striped">
            <thead>
            <tr>
              <th>#</th>
              <th>Category ( القسم ) </th>
              <th>Product ( الصنف ) </th>
              <th>Product Code ( كود الصنف ) #</th>
              <th>َQuantity ( الكمية )</th>
              <th>Sell Price ( سعر البيع )</th>
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
                <td>
                    @if(isset($inPro->getProduct->getCategory->name))
                        {{ $inPro->getProduct->getCategory->name }}
                    @else
                        Category is deleted
                    @endif
                </td>
                <td>
                    @if(isset($inPro->getProduct->name))
                        {{ $inPro->getProduct->name }}
                    @else
                        Category is deleted
                    @endif
                </td>
                <td>
                    @if(isset($inPro->getProduct->code ))
                        {{ $inPro->getProduct->code }}
                    @else
                        Category is deleted
                    @endif
                </td>
              <td>{{ round($inPro->quantity,3) }}</td>
              <td>{{ round($inPro->sell_price,3) }}</td>
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
            @if( is_permited('singleInvoice','print') == 1 )
                <a href="{{ route('printSingleInvoice',$td->id) }}" class="btn btn-sm btn-success btn-flat center"><i class="fa fa-print"></i> Print ( طباعة ) </a>
            @endif
        </div>
        <!-- /.col -->
      </div>
    </section>
@endsection
