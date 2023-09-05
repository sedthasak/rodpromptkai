@extends('../backend/layout/base')

@section('body')
    <body class="login">
        @yield('content')
        @include('../backend/layout/components/dark-mode-switcher')
        @include('../backend/layout/components/main-color-switcher')

        <!-- BEGIN: JS Assets-->
        <script src="{{ mix('dist/js/app.js') }}"></script>
        <!-- END: JS Assets-->

        @yield('script')
    </body>
@endsection
