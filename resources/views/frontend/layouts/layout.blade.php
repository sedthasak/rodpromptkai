<!doctype html>
<html>

<head>
    @include('frontend.layouts.inc_head')	
</head>

<body>

<div class="container-fluid">
	
@include('frontend.layouts.inc_menu')		

@yield('content')

@include('frontend.layouts.inc_carseo')		
@include('frontend.layouts.inc_help-carsearch')		
@include('frontend.layouts.inc_footer')		


</div>

</body>

</html>
