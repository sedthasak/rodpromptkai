@extends('../frontend/layouts/layout')

@section('subhead')
    <title>Payment Successful - Scan to Pay</title>
@endsection

@section('content')
<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="text-center">
                        <h1>Order Number: {{ $orderNo }}</h1>
                        <h2>Total: {{ number_format($total, 0, '.', ',') }} ฿</h2>
                        <p>Scan the QR code below to complete your payment.</p>
                        <img src="{{ $qrCodeImage }}" alt="QR Code for Payment" class="img-fluid">
                        <p>Reference No: {{ $referenceNo }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
