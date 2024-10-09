<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>ใบกำกับภาษี (Corporate Tax Invoice)</title>
    <style>
        @font-face {
            font-family: 'Sarabun';
            font-style: normal;
            font-weight: normal;
            src: url("{{ storage_path('fonts/Sarabun-Regular.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'Sarabun';
            font-style: bold;
            font-weight: bold;
            src: url("{{ storage_path('fonts/Sarabun-Bold.ttf') }}") format('truetype');
        }
        body {
            font-family: 'Sarabun', sans-serif;
            font-size: 16px;
            margin: 0;
            padding: 0;
        }
        .content {
            width: 80%;
            margin: auto;
            padding: 20px;
        }
        .header, .footer {
            text-align: center;
            margin: 20px 0;
        }
        .footer {
            margin-top: 40px;
        }
        .details p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <div class="content">
        <div class="header">
            <h2>ใบกำกับภาษี</h2>
        </div>
        <div class="details">
            <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
            <p><strong>ชื่อบริษัท:</strong> {{ $order->corporation_name }}</p>
            <p><strong>ที่อยู่บริษัท:</strong> {{ $order->corporation_address }}</p>
            <p><strong>อีเมล:</strong> {{ $order->corporation_email }}</p>
            <p><strong>โทรศัพท์:</strong> {{ $order->corporation_telephone }}</p>
        </div>
        <h3 style="margin-top: 30px;">รายละเอียดสินค้า</h3>
        <table>
            <thead>
                <tr>
                    <th>สินค้า</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>รวม</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $productName }}</td>
                    <td>{{ $amount }}</td>
                    <td>{{ number_format($order->price, 2) }}</td>
                    <td>{{ number_format($order->price * $amount, 2) }}</td>
                </tr>
            </tbody>
        </table>
        <p style="text-align: right; margin-top: 20px;"><strong>ยอดรวมทั้งหมด:</strong> {{ number_format($order->price * $amount, 2) }} บาท</p>
        <div class="footer">
            <p>ขอบคุณที่ใช้บริการ</p>
        </div>
    </div>
</body>
</html>
