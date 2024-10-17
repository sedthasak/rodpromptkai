@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - create-payment</title>
@endsection

@section('content')

@php
$order_id = 'ODR123456789';
$amount = 1200;
$email = 'kk.supernova00@gmail.com';
$customerName = 'Kongphop Kamsaikaeo';
@endphp
<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="topic-postcar-welcome topic-postcar">
                        <div class="topic-imgcar"><img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt=""></div>
                        <p>ชำระเงิน</p>
                        <h1>Order : {{$order_id}}</h1>
                        <h1>ยอดชำระ : {{ number_format($amount, 0, '.', ',') }} ฿</h1>

                        <form action="{{ route('payment.create') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" id="amount" value="{{ $amount }}" required>
                            <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}" required>
                            <input type="hidden" name="email" id="email" value="{{ $email }}" required>
                            <input type="hidden" name="customerName" id="customerName" value="{{ $customerName }}" required>
                            <button type="submit" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> Create QR Payment</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection