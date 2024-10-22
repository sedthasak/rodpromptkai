@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - create-payment</title>
@endsection

@section('content')

<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="topic-postcar-welcome topic-postcar">
                        <div class="topic-imgcar"><img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt=""></div>
                        <p>ชำระเงิน</p>
                        <h1>Order : {{ $myorder->order_number }}</h1>
                        <h1>ยอดชำระ : {{ number_format($myorder->total, 0, '.', ',') }} ฿</h1>

                        <form action="{{ route('payment.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="order_id" id="order_id" value="{{ $myorder->id }}" required>
                            <button type="submit" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> Create QR Payment</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
