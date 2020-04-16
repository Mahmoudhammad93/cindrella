@extends('admin.shared.master')
@section('content')

<section class="content">

<div class="row">
  <div class="col-md-4">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('project/public/images/'.$supplier['image']) }}" alt="{{ $supplier['image'] }} picture"  data-toggle="modal" data-target="#view">

        <h3 class="profile-username text-center">{{ $supplier['name'] }}</h3>

        <p class="text-muted text-center">{{  trans('main.'.$supplier->getType->name)  }}</p>

          @if($supplier->group_id == 1)
              <a href="{{ route($buttonsRoutsname.'.edit',$supplier->id) }}" class="btn btn-primary profile-edit">
                  <i class="fa fa-edit"></i>
                  <b> {{ trans('main.edit') }} </b>
              </a>
          @else
              <a href="{{ asset('/images/'.$supplier['image']) }}" class="btn btn-primary profile-edit">
                  <i class="fa fa-eye"></i>
                  <b>{{ trans('main.view') }}</b>
              </a>
          @endif
          @php
          $color = '';
            if (round($supplier->getBalance->first()['total_balance'],3) > 0){
                $color = '#2cff2c';
            }elseif (round($supplier->getBalance->first()['total_balance'],3) < 0){
                $color = '#ff7f6f';
            }else{
                $color = '#fff';
            }
          @endphp
        <a class="btn btn-primary btn-block"><b>{{ trans('main.total_palance') }} : <span style="color: {{$color}}; font-size: 15px;"> {{ round($supplier->getBalance->first()['total_balance'],3) }} {{ trans('main.coins.le') }} </span> </b></a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col -->
    <div class="modal fade" id="view">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('/images/'.$supplier['image']) }}" alt="{{ $supplier['image'] }} picture">
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
  <div class="col-md-8">
  <ul>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">{{ trans('main.cash_transactions') }} </a></li>
        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">{{ trans('main.add_cash_transaction') }}</a></li>
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activity">
          <!-- table -->
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <span style="color: red;"> {{ $supplier->name  }} </span> {{ trans('main.activities') }} </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover">
              @if( $supplier->getBalance->count() > 0 )

                <thead>
                <tr>
                  <th>#</th>
                  <th> {{ trans('main.date') }} </th>
                  <th> {{ trans('main.type') }} </th>
                  <th> {{ trans('main.value') }} </th>
                  <th> {{ trans('main.total_palance') }} </th>
                  <th> {{ trans('main.desc') }} </th>
                 </tr>
                </thead>
                <tbody>
                @php
                 $i = 1;
                @endphp
                @foreach($supplier->getBalance as $row)
                <tr>
                  <td>{{ $i }}</td>
                  <td>{{ $row['date'] }}</td>
                  @if($row['payment_type'] == 0)
                   <td><span class="label label-danger">{{ trans('main.depit') }} </span></td>
                  @else
                   <td><span class="label label-info">{{ trans('main.credit') }} </span></td>
                  @endif
                  <td>{{ round($row['depet_value'],3) }}</td>
                  <td>{{ round($row['total_balance'],3) }}</td>
                  <td>{{ $row['desc'] }}</td>
                </tr>
                @php
                 $i= $i+1;
                @endphp
               @endforeach
              </tbody>
              @else
                 <h3 class="text-center" style="color: red;"> No Activities Yet </h3>
               @endif
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
          <!-- /.table -->
        </div>

        <div class="tab-pane" id="settings">
           @if(count($errors) > 0)
             <div class="alert alert-danger text-center">
                @foreach($errors->all() as $error)
                  <P>{{ $error }}</P>
                @endforeach
              </div>
         <div></div>
                    @endif
          <form class="form-horizontal" action="{{ route('suppliers.saveBalance') }}" method="post">
               {{ csrf_field() }}
               <input type="hidden" name="supplier_id" value="{{ $supplier->id }}" />

               <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">{{ trans('main.palance') }} </label>

              <div class="col-sm-10">
                <input type="number" step=any class="form-control" value="{{ old('depet_value') }}" id="inputEmail" placeholder="Balance Value" name="depet_value">
              </div>
            </div>

            <div class="form-group">
              <label for="inputEmail" class="col-sm-2 control-label">{{ trans('main.pay_type') }}</label>

              <div class="col-sm-10">
                <select class="form-control" value="{{ old('payment_type') }}" name="payment_type">
                  <option value="0"> {{ trans('main.depit') }} </option>
                  <option value="1"> {{ trans('main.credit') }} </option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="inputName" class="col-sm-2 control-label"> {{ trans('main.date') }}</label>
              <div class="col-sm-10">
                <input type="date" class="form-control" value="{{ old('date') }}" id="inputName" name="date" placeholder="Date">
              </div>
            </div>

            <div class="form-group">
              <label for="inputExperience" class="col-sm-2 control-label"> {{ trans('main.desc') }} </label>

              <div class="col-sm-10">
                <textarea class="form-control" id="inputExperience" placeholder="Descriptoin" name="desc">{{ old('desc') }}</textarea>
              </div>
            </div>

            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-info">{{ trans('main.save') }}</button>
              </div>
            </div>
          </form>
        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- /.nav-tabs-custom -->
  </div>
  <!-- /.col -->
</div>
<!-- /.row -->

</section>


@endsection
