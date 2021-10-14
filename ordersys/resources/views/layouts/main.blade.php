<!DOCTYPE html>

<html>
<head>
	<title>{{ config('app.website', 'Orders') }}</title>
	<meta charset="utf-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{asset('images/eddusaver favicon.png')}}" type="image/png" sizes="16x16"> 
    <link rel="stylesheet" type="text/css" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style1.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/style2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/datetimepicker/css/bootstrap-datetimepicker.min.css')}}"/>

    <link rel="stylesheet" type="text/css" href="{{asset('css/dropzone.min.css')}}">
    <script src="{{asset('js/jquery-1.10.1.min.js')}}"></script>
    <script src="{{asset('js/dropzone.js')}}"></script>
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
      var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
      (function(){
         var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
         s1.async=true;
         s1.src='https://embed.tawk.to/5cd1abc1d07d7e0c63925d13/default';
         s1.charset='UTF-8';
         s1.setAttribute('crossorigin','*');
         s0.parentNode.insertBefore(s1,s0);
     })();
 </script>
 <!--End of Tawk.to Script-->
</head>
<body class="main-body-container ">
	@if (auth()->check())

	@if (auth()->user()->can('is_admin'))
	@include('layouts.admin_header')
	@elseif (auth()->user()->can('is_writer'))
	@include('layouts.writer_header')
	@elseif (auth()->user()->can('is_customer'))
	@include('layouts.customer_header')
	@else
	@include('layouts.header_nav')
	@endif
	@else
	@include('layouts.header_nav')
	@endif

	<main class="layout-content">
		
		@yield('content')
     
 </main>
 <script type="text/javascript">
  $.ajaxSetup({
   headers: {
    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
}
});
</script>

@include('layouts.footer')
@if(auth()->check())
@include('chat')
@endif
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.4.0/dropzone.js"></script> -->
<script src="{{asset('js/bootstrap.bundle.min.js')}}" async=""></script>

<script src="{{asset('js/order-init.js')}}"></script>
</body>
</html>