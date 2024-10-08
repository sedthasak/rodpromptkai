<!-- resources/views/backend/order-detail.blade.php -->

@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - Order Detail</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
</div>

<!-- Order Detail Section -->
<div class="intro-y grid grid-cols-12 gap-6 mt-5">
    <!-- General Order Information -->
    <div class="col-span-12 xl:col-span-4">
        <div class="box p-5">
            <h3 class="text-lg font-medium mb-4">General Information</h3>
            <div class="mb-2">
                <strong>Order Number:</strong> {{ $order->order_number }}
            </div>
            <div class="mb-2">
                <strong>Order Date:</strong> {{ date('d/m/Y H:i:s', strtotime($order->created_at)) }}
            </div>
            <div class="mb-2">
                <strong>Order Status:</strong> <span class="badge {{ $order->status == 'success' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->status) }}</span>
            </div>
            <div class="mb-2">
                <strong>Order Type:</strong> {{ ucfirst($order->type) }}
            </div>
            <div class="mb-2">
                <strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Payment Status:</strong> <span class="badge {{ $order->payment_status == 'success' ? 'bg-success' : 'bg-warning' }}">{{ ucfirst($order->payment_status) }}</span>
            </div>
        </div>
    </div>

    <!-- Customer Information -->
    <div class="col-span-12 xl:col-span-4">
        <div class="box p-5">
            <h3 class="text-lg font-medium mb-4">Customer Information</h3>
            <div class="mb-2">
                <strong>Name:</strong> {{ $order->customer->firstname ?? 'N/A' }} {{ $order->customer->lastname ?? '' }}
            </div>
            <div class="mb-2">
                <strong>Email:</strong> {{ $order->customer->email ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Telephone:</strong> {{ $order->customer->telephone ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Address:</strong> {{ $order->customer->address ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Province:</strong> {{ $order->customer->province ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>District:</strong> {{ $order->customer->district ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Subdistrict:</strong> {{ $order->customer->subdistrict ?? 'N/A' }}
            </div>
            <div class="mb-2">
                <strong>Zipcode:</strong> {{ $order->customer->zipcode ?? 'N/A' }}
            </div>
        </div>
    </div>

    <!-- Pricing Information -->
    <div class="col-span-12 xl:col-span-4">
        <div class="box p-5">
            <h3 class="text-lg font-medium mb-4">Pricing Information</h3>
            <div class="mb-2">
                <strong>Price:</strong> {{ number_format($order->price, 2, '.', ',') }} ฿
            </div>
            <div class="mb-2">
                <strong>VAT:</strong> {{ number_format($order->vat, 2, '.', ',') }} ฿
            </div>
            <div class="mb-2">
                <strong>Net Price:</strong> {{ number_format($order->net_price, 2, '.', ',') }} ฿
            </div>
            <div class="mb-2">
                <strong>Discount:</strong> {{ number_format($order->discount, 2, '.', ',') }} ฿
            </div>
            <div class="mb-2">
                <strong>Total:</strong> <span class="text-xl font-bold">{{ number_format($order->total, 2, '.', ',') }} ฿</span>
            </div>
        </div>
    </div>

    <!-- Order Items (if applicable) -->
    @if ($order->items && count($order->items) > 0)
        <div class="col-span-12 mt-5">
            <div class="box p-5">
                <h3 class="text-lg font-medium mb-4">Order Items</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($order->items as $index => $item)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->unit_price, 2, '.', ',') }} ฿</td>
                                <td>{{ number_format($item->total_price, 2, '.', ',') }} ฿</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>

<!-- Back Button -->
<div class="intro-y box mt-5">
    <div class="p-5">
        <a href="{{ route('BN_orders') }}" class="btn btn-primary">Back to Orders List</a>
    </div>
</div>
@endsection
