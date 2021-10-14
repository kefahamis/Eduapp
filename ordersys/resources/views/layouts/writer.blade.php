<!DOCTYPE html>

<html>
<head>
	<title>{{ config('app.website', 'Orders') }}</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('images/eddusaver favicon.png')}}" type="image/png" sizes="16x16"> 
	<link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">


	<link rel="stylesheet" type="text/css" href="{{asset('main/css/client-css.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('main/css/writer-css.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('main/css/writer-css_2.min.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('main/css/custom.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/min/dropzone.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
	<script src="{{asset('js/jquery-1.10.1.min.js')}}"></script>
	
</head>
<body class="main-body-container ">

	@include('layouts.writer_header')

	<main class="">
		@yield('content')
	</main>

</section>
</div>
</div>
<script>
	$(document).ready(function(){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});
	});
</script>
@include('layouts.footer')
<script src="{{asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
<script src="{{asset('js/bootstrap.bundle.min.js')}}" async=""></script>
<script src="{{ asset('sweetalert/dist/sweetalert.min.js') }}"></script>
</body>
</html>