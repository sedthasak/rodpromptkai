@extends('../frontend/layouts/layout')

@section('subhead')
    <title>Payment Failed</title>
@endsection

@section('content')
<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="text-center">
                        <h1>Payment Failed</h1>
                        <p>{{ $message }}</p>
                        <a href="{{ url()->previous() }}" class="btn-postcar">Try Again</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection