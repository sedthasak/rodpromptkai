@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

@section('content')
<?php
$customerdata = session('customer');
?>
<section class="row">
    <div class="col-12 bg-package bg-order">
        <div class="container">
            <form method="post" action="{{ route('cartactionPage') }}">
                @csrf

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="wrap-order">
                            <h2>Your <span>Order</span></h2>
                            <div class="wrap-order-detail">
                                @if($type == 'package')
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> รายการสั่งซื้อแพคเกจ</div>
                                <div class="bg-orderdetail">
                                    <div class="topic-orderdetail">{{$item->name}}</div>
                                    <div class="cart-pack-price">
                                        <div class="box-package-price">
                                            <span>฿{{ number_format($item->price, 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                                @endif

                                <div class="login-checkbox">
                                    <label class="list-checkbox"> &nbsp ฉันยอมรับหากชำระเงินแล้วจะไม่สามาถขอคืนเงินหรือยกเลิกในภายหลัง
                                        <input type="checkbox" name="accept" value="1" checked="checked">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-xl-4">
                        <div class="box-sum-cart">
                            <div class="topic-cart"><i class="bi bi-circle-fill"></i> สรุปรายการสั่งซื้อ</div>

                            <input type="hidden" name="customer_id" value="{{$customerdata->id}}" />
                            <input type="hidden" name="type" value="{{$type}}" />
                            <input type="hidden" name="package_dealers_id" value="{{$item->id}}" />
                            <input type="hidden" name="price" id="price" value="{{$item->price}}" />
                            <input type="hidden" name="price_not_vat" id="price_not_vat" value="{{ $item->price - ($item->price * 0.07) }}" />
                            <input type="hidden" name="vat" id="vat" value="{{ $item->price * 0.07 }}" />
                            <input type="hidden" name="discount" id="discount" value="0" />
                            <input type="hidden" name="net_price" id="net_price" value="0" />
                            <input type="hidden" name="donate" id="donate" value="0" />
                            <input type="hidden" name="total" id="total" value="{{ $item->price }}" />

                            <input type="hidden" name="coupons_id" id="coupons_id" value="" />
                            <input type="hidden" name="coupons_rate" id="coupons_rate" value="" />
                            <input type="hidden" name="coupons" id="coupons" value="" />

                            <div class="cartright-box cartright-price">
                                <div class="row">
                                    <div class="col-8">ราคาแพคเกจ</div>
                                    <div class="col-4 text-end"><span class="txt-cart-price" id="price_not_vat_show">฿{{ number_format($item->price - ($item->price * 0.07), 2) }}</span></div>
                                </div>

                                <div class="row">
                                    <div class="col-8">Vat 7%</div>
                                    <div class="col-4 text-end"><span class="txt-cart-price" id="vat_show">฿{{ number_format($item->price * 0.07, 2) }}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-8">ราคาแพคเกจรวม Vat</div>
                                    <div class="col-4 text-end"><span class="txt-cart-price" id="price_show">฿{{ number_format($item->price, 2) }}</span></div>
                                </div>

                                <div class="row" id="discount_info" style="display: none;">
                                    <div class="col-8">ส่วนลด</div>
                                    <div class="col-4 text-end"><span class="txt-cart-price" id="discount_amount"></span></div>
                                </div>
                            </div>

                            <div class="cartright-box cartright-code" id="coupon_add">
                                <div>Promo Code</div>
                                <div class="box-input-code">
                                    <input type="text" placeholder="กรอกโค้ดส่วนลด" id="discount-code">
                                    <button type="button" class="btn-submitcode" id="submit-code">ยืนยัน</button>
                                </div>

                                <div class="code-error" style="display: none;">โค้ดส่วนลดไม่สามารถใช้งานได้</div>
                                <div class="code-success" style="display: none;">โค้ดส่วนลดใช้งานได้</div>
                            </div>

                            <div class="cartright-box cartright-price" id="coupon_info" style="display: none;">
                                <div class="row">
                                    <div class="col-8">
                                        ส่วนลด 
                                        <br>
                                        <div class="box-code-use"><span id="coupon-name"></span> <button type="button" class="btn-del-code"><i class="bi bi-x-circle-fill"></i></button></div>
                                    </div>
                                    <div class="col-4 text-end"><span class="txt-cart-price" id="discount_show"></span></div>
                                </div>
                            </div>

                            <div class="cartright-box cartright-price">
                                <div class="row">
                                    <div class="col-5">
                                        <span class="txt-totalprice">ยอดรวมทั้งหมด</span> 
                                        <div class="txt-total-vat">ยอดรวม Vat 7%</div>
                                    </div>
                                    <div class="col-7 text-end">
                                        <span class="txt-totalprice" id="total_show">฿{{ number_format($item->price, 2) }}</span>
                                    </div>
                                </div>
                                <button class="btn-default btn-red">ยืนยันการสั่งซื้อ</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('script')
<script type="text/javascript">
    // Function to update displayed prices based on hidden inputs
    function updateDisplayedPrices() {
        var price = parseFloat(document.getElementById('price').value);
        var priceNotVat = parseFloat(document.getElementById('price_not_vat').value);
        var vat = parseFloat(document.getElementById('vat').value);
        var discount = parseFloat(document.getElementById('discount').value);
        var total = parseFloat(document.getElementById('total').value);

        document.getElementById('price_not_vat_show').textContent = '฿' + priceNotVat.toFixed(2);
        document.getElementById('vat_show').textContent = '฿' + vat.toFixed(2);
        document.getElementById('price_show').textContent = '฿' + price.toFixed(2);
        document.getElementById('discount_amount').textContent = '฿' + discount.toFixed(2);
        document.getElementById('total_show').textContent = '฿' + total.toFixed(2);
    }

    // Function to show coupon info section and update UI after applying coupon
    function applyCoupon(data) {
        document.getElementById('coupons_id').value = data.coupon_id;
        document.getElementById('coupons_rate').value = data.rate;
        document.getElementById('coupons').value = data.name;

        document.getElementById('coupon-name').textContent = data.name;

        // Calculate discount amount
        var price = parseFloat(document.getElementById('price').value);
        var discountRate = parseFloat(data.rate);
        var discountAmount = price * (discountRate / 100);

        // Update discount amount in hidden field
        document.getElementById('discount').value = discountAmount;

        // Update discount amount in UI
        document.getElementById('discount_amount').textContent = '฿' + discountAmount.toFixed(2);

        // Update total price after discount
        var totalPrice = price - discountAmount;

        // Update total price in hidden field
        document.getElementById('total').value = totalPrice;

        // Update total price in UI
        document.getElementById('total_show').textContent = '฿' + totalPrice.toFixed(2);

        // Show coupon info section
        document.getElementById('coupon_info').style.display = 'block';

        // Show discount info section
        document.getElementById('discount_info').style.display = 'flex';

        // Hide coupon add section
        document.getElementById('coupon_add').style.display = 'none';

        // Show success message and hide error message
        document.querySelector('.code-success').style.display = 'block';
        document.querySelector('.code-error').style.display = 'none';
    }

    // Event listener for applying a coupon
    document.getElementById('submit-code').addEventListener('click', function() {
        var code = document.getElementById('discount-code').value;

        fetch('{{ route("applyCouponAction") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ code: code })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                applyCoupon(data);
            } else {
                // Show error message and hide success message
                document.querySelector('.code-success').style.display = 'none';
                document.querySelector('.code-error').style.display = 'block';
            }
        });
    });

    // Function to cancel coupon and update UI
    function cancelCoupon() {
        // Clear coupon details
        document.getElementById('coupons_id').value = '';
        document.getElementById('coupons_rate').value = '';
        document.getElementById('coupons').value = '';
        document.getElementById('coupon-name').textContent = '';

        // Reset discount amount to zero in hidden field
        document.getElementById('discount').value = 0;

        // Update discount amount to zero in UI
        document.getElementById('discount_amount').textContent = '฿0.00';

        // Update total price back to original price
        var originalPrice = parseFloat(document.getElementById('price').value);
        document.getElementById('total').value = originalPrice;
        document.getElementById('total_show').textContent = '฿' + originalPrice.toFixed(2);

        // Show coupon add section
        document.getElementById('coupon_add').style.display = 'block';

        // Hide coupon info section
        document.getElementById('coupon_info').style.display = 'none';

        // Hide discount info section
        document.getElementById('discount_info').style.display = 'none';
    }

    // Event listener for canceling a coupon
    document.querySelector('.btn-del-code').addEventListener('click', function() {
        cancelCoupon();
    });

    // Function to calculate initial prices on page load
    function calculateInitialPrices() {
        updateDisplayedPrices(); // Update displayed prices when page loads
    }

    // Call the function to calculate initial prices on page load
    calculateInitialPrices();
</script>







@endsection
