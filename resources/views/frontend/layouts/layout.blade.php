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
@yield('script')
@if(session('success'))
            
<script>
    // @include('frontend.layouts.inc_carseo')
    // Swal.fire(
    //     'Success',
    //     '&nbsp;',
    //     'warning'
    // )
    Swal.fire({
        title: '{{session('success')}}',
        // text: "You won't be able to revert this!",
        icon: 'success',
        // showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        // confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        // if (result.isConfirmed) {
        //     Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //     )
        // }
    })
</script>
@endif
@if(session('error'))

<script>
    // Swal.fire(
    //     'Success',
    //     '&nbsp;',
    //     'warning'
    // )
    Swal.fire({
        title: '{{session('error')}}',
        // text: "You won't be able to revert this!",
        icon: 'success',
        // showCancelButton: true,
        // confirmButtonColor: '#3085d6',
        // cancelButtonColor: '#d33',
        // confirmButtonText: 'Yes, delete it!'
        // }).then((result) => {
        // if (result.isConfirmed) {
        //     Swal.fire(
        //     'Deleted!',
        //     'Your file has been deleted.',
        //     'success'
        //     )
        // }
    })
</script>
@endif

</div>

</body>

</html>
