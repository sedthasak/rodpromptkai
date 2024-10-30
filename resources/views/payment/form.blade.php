@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - Select Payment Method</title>
@endsection

@section('content')

<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="topic-postcar-welcome topic-postcar">
                        <div class="topic-imgcar"><img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt=""></div>
                        <p>ชำระเงิน</p>
                        <h1>Order : {{ $myorder->order_number }}</h1>
                        <h1>ยอดชำระ : {{ number_format($myorder->total, 0, '.', ',') }} ฿</h1>
                        <div class="box-frmhelpcar">
                            <div class="topic-frmhelpcar"> กรอกอีเมลเพื่อชำระเงิน <span>*</span></div>
                            <div>                            
                                <input type="email" id="input_email" class="form-control" name="input_email" value="{{$myorder->customer->email??''}}" />
                            </div>
                        </div>
                        <br>
                        <p>เลือกช่องทางชำระเงิน</p>
                        
                        <!-- Form for QR Promptpay payment -->
                        <form action="{{ route('payment.create') }}" method="POST" class="payment-form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $myorder->id }}" required>
                            <input type="hidden" class="input_customer_email" name="customer_email" value="{{$myorder->customer->email??''}}">
                            <input type="hidden" name="channel" value="promptpay">
                            <button type="submit" class="btn-postcar">
                                <img src="{{asset('frontend/images/icon-car.svg')}}" alt="">QR Promptpay
                            </button>
                        </form>

                        <br>

                        <!-- Form for credit card payment -->
                        <form action="{{ route('payment.create') }}" method="POST" class="payment-form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $myorder->id }}" required>
                            <input type="hidden" class="input_customer_email" name="customer_email" value="{{$myorder->customer->email??''}}">
                            <input type="hidden" name="channel" value="full">
                            <button type="submit" class="btn-postcar">
                                <img src="{{asset('frontend/images/icon-car.svg')}}" alt="">บัตรเครดิต VISA Mastercard
                            </button>
                        </form>

                        <br>

                        <!-- Form for TrueWallet payment -->
                        <form action="{{ route('payment.create') }}" method="POST" class="payment-form">
                            @csrf
                            <input type="hidden" name="order_id" value="{{ $myorder->id }}" required>
                            <input type="hidden" class="input_customer_email" name="customer_email" value="{{$myorder->customer->email??''}}">
                            <input type="hidden" name="channel" value="truewallet">
                            <button type="submit" class="btn-postcar">
                                <img src="{{asset('frontend/images/icon-car.svg')}}" alt="">True Money Wallet
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    $(document).ready(function() {
        // Disable buttons if email is empty on page load
        toggleButtons();

        // Check email input on change
        $('#input_email').on('input', function() {
            const email = $(this).val();

            // Update all customer email hidden fields
            $('.input_customer_email').val(email);

            // Enable or disable buttons based on email validity
            toggleButtons();
        });

        // Function to toggle buttons based on email validity
        function toggleButtons() {
            const email = $('#input_email').val();
            const isValidEmail = validateEmail(email);
            
            $('.btn-postcar').prop('disabled', !isValidEmail);
        }

        // Email validation function
        function validateEmail(email) {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return regex.test(email);
        }

        // Confirmation and validation for form submission
        $('.payment-form').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission
            
            const email = $('#input_email').val();
            
            // Check if email is valid
            if (!validateEmail(email)) {
                Swal.fire({
                    icon: 'error',
                    title: 'กรุณากรอกอีเมลที่ถูกต้อง',
                    text: 'กรุณาใส่อีเมลที่ถูกต้องก่อนทำการชำระเงิน',
                });
                return;
            }

            // Show confirmation dialog
            Swal.fire({
                title: 'ยืนยันการชำระเงิน?',
                text: "คุณต้องการชำระเงินผ่านช่องทางนี้ใช่หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if the user confirms
                    e.target.submit();
                }
            });
        });
    });
</script>
@endsection
