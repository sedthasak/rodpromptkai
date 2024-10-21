@extends('../frontend/layouts/layout')

@section('subhead')
    <title>Payment Result - Scan to Pay</title>
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
                        @if (isset($qrCodeImage) && $qrCodeImage)
                            <p>Scan the QR code below to complete your payment.</p>
                            <img src="{{ $qrCodeImage }}" alt="QR Code for Payment" class="img-fluid">
                        @else
                            <p>{{ $message ?? 'An error occurred while processing your payment.' }}</p>
                        @endif
                        <p>Reference No: {{ $referenceNo }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
