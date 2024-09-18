@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - postcar</title>
@endsection

@section('content')

<?php
$homeCarRoute = '';
$dealerRoute = '';
$ladyCarRoute = '';

$customerRole = $customer_role['role'];
$normalPosts = $customer_post['normal'];
$dealerPosts = $customer_post['dealer'];
$dealerPackQuota = $customer_role['dealerpack_quota'];
$vipPackQuota = $customer_role['vippack_quota'];

// Set homeCarRoute and ladyCarRoute
if (in_array($customerRole, ['normal', 'dealer', 'vip', 'admin']) && $normalPosts < $customer_role['customer_quota']) {
    $homeCarRoute = route('postcarwelcomePage');
    $ladyCarRoute = route('postcarwelcomeladyPage');
}

// Set dealerRoute
if ($customerRole == 'normal') {
    $dealerRoute = route('packagePage');
} elseif ($customerRole == 'admin') {
    $dealerRoute = route('postcarwelcomedealerPage');
} elseif ($customerRole == 'dealer') {
    if ($dealerPosts < $dealerPackQuota) {
        $dealerRoute = route('postcarwelcomedealerPage');
    } else {
        $dealerRoute = route('packagePage');
    }
} elseif ($customerRole == 'vip') {
    if ($dealerPosts < $vipPackQuota) {
        $dealerRoute = route('postcarwelcomedealerPage');
    } else {
        $dealerRoute = route('packagePage');
    }
}

// Button clickability
$homeDisabled = ($homeCarRoute == '') ? 'disabled' : '';
$ladyDisabled = ($ladyCarRoute == '') ? 'disabled' : '';
$dealerDisabled = ($dealerRoute == '') ? 'disabled' : '';

// echo "<pre>";
// print_r($customer_role);
// echo "</pre>";
// echo "<pre>";
// print_r($customer_post);
// echo "</pre>";
?>

<style>
    .disabled {
        pointer-events: none;
        opacity: 0.6; /* Optional: Make the disabled buttons look visually disabled */
    }
</style>

<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 text-center">
                    <div class="topic-postcar-mt topic-postcar">
                        <div class="topic-imgcar"><img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt=""></div>
                        <h1>ลงขายรถของคุณ<span>ฟรี!</span></h1>
                        <p class="hide-txtmb">กรุณาเลือกประเภท</p>
                    </div>
                    <div class="wrap-itempost">

                        <a href="{{ $homeCarRoute ?: '#' }}" class="item-postcar item-homecar {{ $homeDisabled }}">
                            <img src="{{asset('frontend/images/icon-post01.svg')}}" alt="">
                            <h2>รถบ้าน<br>เจ้าของขายเอง</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                        <a href="{{ $dealerRoute ?: '#' }}" class="item-postcar item-dealer {{ $dealerDisabled }}">
                            <img src="{{asset('frontend/images/icon-post02.svg')}}" alt="">
                            <h2>ดีลเลอร์/<br>ลงแบบฝากขาย</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                        <a href="{{ $ladyCarRoute ?: '#' }}" class="item-postcar item-lady {{ $ladyDisabled }}">
                            <img src="{{asset('frontend/images/icon-post03.svg')}}" alt="">
                            <h2>คุณผู้หญิงลงขายรถ</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                    </div>
                    <div class="txt-postcontact">สอบถามข้อมูลเพิ่มเติม ติดต่อ 098-969-1120</div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
