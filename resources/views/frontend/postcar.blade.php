@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - postcar</title>
@endsection

@section('content')

<?php
$quota = $customer_login->customer_quota;
$role = $customer_login->role;
$post = $customer_post;

// Determine routes based on conditions
$homeCarRoute = ($post < $quota) ? route('postcarwelcomePage') : route('packagePage');
$ladyCarRoute = ($post < $quota) ? route('postcarwelcomeladyPage') : route('packagePage');

// Conditional logic for ดีลเลอร์
if (in_array($role, ['dealer', 'vip', 'admin'])) {
    $dealerRoute = ($post < $quota) ? route('postcarwelcomedealerPage') : route('packagePage');
} else {
    $dealerRoute = route('packagePage');
}
?>
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

                        <a href="{{ $homeCarRoute }}" class="item-postcar item-homecar">
                            <img src="{{asset('frontend/images/icon-post01.svg')}}" alt="">
                            <h2>รถบ้าน<br>เจ้าของขายเอง</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                        <a href="{{ $dealerRoute }}" class="item-postcar item-dealer">
                            <img src="{{asset('frontend/images/icon-post02.svg')}}" alt="">
                            <h2>ดีลเลอร์/<br>ลงแบบฝากขาย</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                        <a href="{{ $ladyCarRoute }}" class="item-postcar item-lady">
                            <img src="{{asset('frontend/images/icon-post03.svg')}}" alt="">
                            <h2>คุณผู้หญิงลงขายรถ</h2>
                            <div class="btn-select-post">เลือก</div>
                        </a>

                    </div>
                    <div class="txt-postcontact">สอบถามข้อมูลเพิ่มเติม ติดต่อ 02-123-4567</div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection