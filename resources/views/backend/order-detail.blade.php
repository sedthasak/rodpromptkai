@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Order Details</title>
@endsection

@section('subcontent')
    <div class="intro-y box mt-5">
        <div class="p-5">
            <!-- Order Header Information -->
            <h2 class="text-lg font-medium">Order Details</h2>
            <div class="mb-3">
                <strong>Order Number:</strong> {{ $order->order_number }}<br>
                <strong>Status:</strong> 
                <span class="badge {{ $order->status == 'success' ? 'bg-success' : 'bg-warning' }}">
                    {{ ucfirst($order->status) }}
                </span><br>
                <strong>Customer ID:</strong> {{ $order->customer_id }}<br>
                <strong>Total Amount:</strong> {{ number_format($order->total ?? 0, 2, '.', ',') }} ฿
            </div>



            <!-- Order Details Table -->
            <h3 class="text-lg font-medium mt-5">Order Information</h3>
            <table class="table table-bordered mt-3">
                <!-- Dynamic Row for Customer Information -->
                <tr>
                    <th style="width: 25%;">Customer Information</th>
                    <td>
                        @if ($order->person_type === 'individual')
                            <!-- Individual Customer Information -->
                            <p><strong>Name:</strong> {{ $order->individual_name }}</p>
                            <p><strong>Tax ID:</strong> {{ $order->individual_taxidno }}</p>
                            <p><strong>Phone:</strong> {{ $order->individual_telephone }}</p>
                            <p><strong>Email:</strong> {{ $order->individual_email }}</p>
                            <p><strong>Address:</strong> {{ $order->individual_address }}</p>
                            <p><strong>Province:</strong> {{ $order->individual_province }}</p>
                            <p><strong>District:</strong> {{ $order->individual_district }}</p>
                            <p><strong>Subdistrict:</strong> {{ $order->individual_subdistrict }}</p>
                            <p><strong>Zipcode:</strong> {{ $order->individual_zipcode }}</p>
                        @elseif ($order->person_type === 'corporation')
                            <!-- Corporate Customer Information -->
                            <p><strong>Corporation Name:</strong> {{ $order->corporation_name }}</p>
                            <p><strong>Tax ID:</strong> {{ $order->corporation_taxidno }}</p>
                            <p><strong>Branch:</strong> {{ $order->corporation_branch }}</p>
                            <p><strong>Branch ID:</strong> {{ $order->corporation_branchid }}</p>
                            <p><strong>Phone:</strong> {{ $order->corporation_telephone }}</p>
                            <p><strong>Email:</strong> {{ $order->corporation_email }}</p>
                            <p><strong>Address:</strong> {{ $order->corporation_address }}</p>
                            <p><strong>Province:</strong> {{ $order->corporation_province }}</p>
                            <p><strong>District:</strong> {{ $order->corporation_district }}</p>
                            <p><strong>Subdistrict:</strong> {{ $order->corporation_subdistrict }}</p>
                            <p><strong>Zipcode:</strong> {{ $order->corporation_zipcode }}</p>
                        @else
                            <!-- Default Case for Unavailable Customer Information -->
                            <p>Customer Information Not Available</p>
                        @endif
                    </td>
                </tr>

                <!-- Payment Information -->
                <tr>
                    <th>Payment Information</th>
                    <td>
                        <p><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</p>
                        <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status ?? 'N/A') }}</p>
                        <p><strong>Payment Date:</strong> {{ optional($order->payment_date)->format('d/m/Y H:i:s') ?? 'N/A' }}</p>
                    </td>
                </tr>

                <!-- Donation Information -->
                @if($order->donate)
                    <tr>
                        <th>Donation Information</th>
                        <td>
                            <p><strong>Donation:</strong> {{ $order->donate ? 'Yes' : 'No' }}</p>
                            <p><strong>Donation Amount:</strong> {{ number_format($order->donation ?? 0, 2, '.', ',') }} ฿</p>
                        </td>
                    </tr>
                @endif

                <!-- Coupons Information (if available) -->
                @if($order->coupons_id)
                    <tr>
                        <th>Coupon Information</th>
                        <td>
                            <p><strong>Coupon ID:</strong> {{ $order->coupons_id }}</p>
                            <p><strong>Coupon Rate:</strong> {{ $order->coupons_rate }}%</p>
                            <p><strong>Coupon Name:</strong> {{ $order->coupons }}</p>
                        </td>
                    </tr>
                @endif

                <!-- Discount Information (if available) -->
                @if($order->discount)
                    <tr>
                        <th>Discount Information</th>
                        <td>
                            <p><strong>Discount Amount:</strong> {{ number_format($order->discount ?? 0, 2, '.', ',') }} ฿</p>
                        </td>
                    </tr>
                @endif
            </table>
            <!-- Receipt Options -->
            <h3 class="text-lg font-medium mt-5">Generate Receipt Options</h3>
            @if(!$order->no_receipt)
                <div class="mt-3">
                    <!-- Full Receipt Option -->
                    @if($order->full_receipt)
                        @if($order->person_type === 'individual')
                            <a href="{{ route('generate.individual.receipt', $order->id) }}" target="_blank" class="btn btn-primary">Generate Individual Receipt</a>
                        @elseif($order->person_type === 'corporation')
                            <a href="{{ route('generate.corporate.tax.invoice', $order->id) }}" target="_blank" class="btn btn-primary">Generate Corporate Tax Invoice</a>
                        @endif
                    @endif

                    <!-- Short Receipt Option -->
                    @if($order->short_receipt)
                        <a href="{{ route('generate.short.receipt', $order->id) }}" target="_blank" class="btn btn-primary mt-2">Generate Short Receipt</a>
                    @endif
                </div>
            @else
                <p class="text-danger mt-3">No Receipt Selected</p>
            @endif
        </div>
    </div>
@endsection
