@extends('admin.shared.master')
@section('content')

<section class="content">

<div class="row">
  <div class="col-md-3">

    <!-- Profile Image -->
    <div class="box box-primary">
      <div class="box-body box-profile">
        <img class="profile-user-img img-responsive img-circle" src="{{ asset('project/public/images/'.$user['image']) }}" alt="{{ $user['image'] }} picture">

        <h3 class="profile-username text-center">{{ $user['name'] }}</h3>


          <a href="{{ route($buttonsRoutsname.'.edit',$user->id) }}" class="btn btn-primary profile-edit">
              <i class="fa fa-edit"></i>
              <b>{{ trans('main.edit') }}</b>
          </a>
      </div>
      <!-- /.box-body -->
    </div>
    <!-- /.box -->

  </div>
  <!-- /.col -->
  <div class="col-md-9">
  <ul>
    <div class="nav-tabs-custom">
      <ul class="nav nav-tabs">
        <li class="active"><a href="#activity" data-toggle="tab" aria-expanded="true">{{ trans('main.cash_transactions') }} </a></li>
{{--        <li class=""><a href="#settings" data-toggle="tab" aria-expanded="false">{{ trans('main.add_cash_transaction') }}</a></li>--}}
      </ul>
      <div class="tab-content">
        <div class="tab-pane active" id="activity">
          <!-- table -->
          <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title"> <span style="color: red;"> {{ $user->name  }} </span> {{ trans('main.activities') }} </h3>
            </div>
            <!-- /.box-header -->

            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
          <!-- /.table -->
        </div>

        <div class="tab-pane" id="settings">

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
