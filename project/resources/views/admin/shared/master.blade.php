<!DOCTYPE html>

<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ trans('main.control_panel') }} | {{ $PageTitle }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<meta name="_token" content="{{csrf_token()}}" />
  <!-- Favicon -->
  <link rel="icon" href="{{asset('image/logo.png')}}" type="image/x-icon"/>
  <link rel="shortcut icon" href="{{asset('image/logo.png')}}" type="image/x-icon"/>
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{asset('css/ionicons.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">


  <link rel="stylesheet" href="{{asset('dist/css/skins/skin-blue.min.css')}}">

  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  @if(Auth::user()->lang == 'ar')
    <link rel="stylesheet" href="{{asset('css/style_rtl.css')}}">
  @endif
  <script src = "{{ asset('js/ajaxfile.js') }}">
      </script>

</head>
<body class="hold-transition skin-blue sidebar-mini" {{ isset($printOrder) ? doPrintFunction() : null }} >
<div class="wrapper" {{ isset($printOrder) ? doPrintFunction() : null }} >

  <!-- Main Header -->
  @include('admin.shared.Header')

  <!-- Left side column. contains the logo and sidebar -->
  @include('admin.shared.SideBar')

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">

      <h1>
      {{ $PageTitle}}
      </h1>

      <ol class="breadcrumb">
        <li><a href="{{route($buttonsRoutsname.'.index')}}"  ><i class="fa fa-home"></i> {{ $PageTitle }}</a></li>
        <li class="active">{{ $headerLevelProcessTitle2  }}</li>
      </ol>
    </section>



    <!-- Main content -->
    <section id="content" class="content">
      <!-- Your Page Content Here -->
    	@yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  @include('admin.shared.Footer')

</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.2.3 -->
<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>


<script src="{{ asset('dist/js/app.min.js') }}"></script>
<script src="{{ url('js/sweetalert.js') }}"></script>
<script src="{{ url('js/vue.min.js') }}"></script>
    @include('sweetalert::view')
@yield('ajax')
@yield('vue')
<script type="text/javascript">
window.addEventListener('keydown', function(e) {
    if (e.keyIdentifier == 'U+000A' || e.keyIdentifier == 'Enter' || e.keyCode == 13) {
        if (e.target.nodeName == 'INPUT' && e.target.type == 'text') {
            e.preventDefault();
            return false;
        }
    }
}, true);
</script>
<script>
    $('.btn-profile').hover(function () {
        $(this).parents('.sup-tool').find('.tooltip-profile').css('display', 'flex');
    });

    $('.sup-tool').mouseleave(function () {
        console.log('dfjkgnfkdjgnkfj');
        $(this).find('.tooltip-profile').css('display', 'none');
    });


    function previewImage(event){
        var render = new FileReader();
        var imageField = document.getElementById('image-field');
        render.onload = function(){
            if (render.readyState == 2) {
                imageField.src = render.result;
            }
        }
        render.readAsDataURL(event.target.files[0]);
    }
</script>
</body>
</html>
