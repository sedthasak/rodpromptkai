@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - login-welcome</title>
@endsection

@section('content')

<?php
// $tel = '0998741070';
// $SixDigitRandomNumber = rand(100000,999999);
// $message = $SixDigitRandomNumber.$tel;

// echo "<pre>";
// print_r($tel);
// echo "</pre>";
// echo "<pre>";
// print_r($SixDigitRandomNumber);
// echo "</pre>";

// $codetosend = rand(100000,999999);
// echo "<pre>";
// print_r($codetosend);
// echo "</pre>";
// session()->put('codetosend', $codetosend);
// session()->flush();


$data = session()->all();
echo "<pre>";
print_r($data);
echo "</pre>";
?>
<section class="row">
    <div class="col-12 wrap-login">
        <div class="container">
            <div class="row">
                <div class="col-12 wow fadeInDown">
                    <div class="login-welcome">
                        <img src="{{asset('frontend/images/logo.svg')}}" alt="">
                        <h1>สวัสดีคุณ Dev</h1>
                        <h2>ยินดีต้อนรับสู่ RodPromptkai</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

@endsection
