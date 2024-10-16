<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Result</title>
</head>
<body>
    @if ($status === 'success')
        <h1>Payment Successful!</h1>
        <p>Transaction ID: {{ $data['transactionId'] }}</p>
        <p>Order Date: {{ $data['orderDateTime'] }}</p>
    @else
        <h1>Payment Failed</h1>
        <p>{{ $message }}</p>
    @endif
</body>
</html>
