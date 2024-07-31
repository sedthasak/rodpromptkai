<!doctype html>
<html>
<head>
    @yield('subhead')
    @include('frontend.layouts.inc_head')
</head>
<body>
    <div class="container-fluid">
        @include('frontend.layouts.inc_menu')		
        @yield('content')
        @include('frontend.layouts.inc_help-carsearch')		
        @include('frontend.layouts.inc_footer')		
        @yield('script')

        {{-- Display SweetAlert on session success --}}
        @if(session('success'))
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Clear the success session variable
                            {{ session()->forget('success') }}
                        }
                    });
                });
            </script>
        @endif

        {{-- Display SweetAlert on session error --}}
        @if(session('error'))
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        title: 'Error!',
                        text: '{{ session('error') }}',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Clear the error session variable
                            {{ session()->forget('error') }}
                        }
                    });
                });
            </script>
        @endif

    </div>
</body>
</html>
