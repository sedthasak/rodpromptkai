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

                        <form action="{{ url('/create-payment') }}" method="POST">
                            @csrf
                            <input type="hidden" name="amount" id="amount" value="{{ $amount }}" required>
                            <input type="hidden" name="order_id" id="order_id" value="{{ $order_id }}" required>
                            <input type="hidden" name="email" id="email" value="{{ $email }}" required>
                            <input type="hidden" name="customerName" id="customerName" value="{{ $customerName }}" required>
                            <button type="submit" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> Create QR Payment</button>
                        </form>
                        <br>
                        <br>
                        <br>
                        <br>
                        <form method="post" action="https://payment.paysolutions.asia/epaylink/payment.aspx">
                            Customer E-mail:
                            <input type="text" name="customeremail" value="customer@email.com">
                            <br> Product Detail:
                            <input type="text" name="productdetail" value="product detail">
                            <br>
                            <!-- refno unique number 12 digit -->
                            Reference No.:
                            <input type="text" name="refno" value="123456789012">
                            <br>
                            <!-- merchantid 8 digit -->
                            Merchant ID:
                            <input type="text" name="merchantid" value="12345678">
                            <br>
                            <!-- currency code -->
                            Currency Code:
                            <input type="text" name="cc" value="00">
                            <br> Total:
                            <input type="text" name="total" value="1">
                            <br> Lang:
                            <input type="text" name="lang" value="TH">
                            <br>
                            <br>
                            <input type="submit" name="Submit" value="Comfirm Order">
                        </form>



                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

@endsection


