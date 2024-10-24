<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment...</title>
</head>
<body onload="document.getElementById('payment-form').submit();">
    <h1>Redirecting to Payment...</h1>
    <form id="payment-form" action="https://payments.paysolutions.asia/payment" method="POST">
        @csrf
        <input type="hidden" name="customeremail" value="{{ $customerEmail }}">
        <input type="hidden" name="customername" value="{{ $customerName }}">
        <input type="hidden" name="productdetail" value="Order {{ $referenceNo }}">
        <input type="hidden" name="refno" value="{{ $referenceNo }}">
        <input type="hidden" name="merchantid" value="{{ $merchantID }}">
        <input type="hidden" name="cc" value="{{ $currencyCode }}">
        <input type="hidden" name="total" value="{{ $total }}">
        <input type="hidden" name="lang" value="{{ $lang }}">
        <input type="hidden" name="channel" value="{{ $channel }}">

        <!-- You can include a fallback button just in case auto-submit fails -->
        <button type="submit" hidden>Proceed to Payment</button>
    </form>
</body>
</html>
