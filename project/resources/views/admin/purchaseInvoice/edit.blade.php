@if( is_permited('PurchaseInvoice','edit') == 1 )

@extends('admin.shared.master')
@section('content')
  <!-- Modal Edit -->
        <div class="modal-content">
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">{{trans('main.edit_invoive_data')}} </h3>
              </div>
              <form method="POST" action="{{route($buttonsRoutsname.'.update',$row->id)}}" class="form-horizontal" enctype="multipart/form-data">
              {{ csrf_field() }}
              {{ method_field('put') }}
              @include('admin.'.$buttonsRoutsname.'.components.EditFormComponent')
              </form>

                <!-- /.box-footer -->

            </div>
            <!-- /.box -->
        </div>
    <!-- End of Modal Edit -->
@endsection

@else
@section('content')
    @include('admin.shared.empty')
@stop
@endif
