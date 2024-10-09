@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - postcar-welcome-dealer</title>
@endsection

@section('content')
@php
    $dealerRoute = '';
    $customerRole = $customer_role['role'];
    $dealerPosts = $customer_post['dealer'];
    $dealerPackQuota = $customer_role['dealerpack_quota'];
    $vipPackQuota = $customer_role['vippack_quota'];

    // Check if the customer is within their post quota limit
    if (($customerRole == 'dealer' && $dealerPosts < $dealerPackQuota) ||
        ($customerRole == 'vip' && $dealerPosts < $vipPackQuota)) {
        $dealerRoute = route('postcarwelcomedealerPage');
    } else {
        // Redirect to the package page if the quota is exceeded
        header("Location: " . route('packagePage'));
        exit();
    }
@endphp

<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="topic-postcar-welcome topic-postcar">
                        <div class="topic-imgcar">
                            <img src="{{ asset('frontend/images/Isolation_Mode.svg') }}" alt="">
                        </div>
                        <p>ยินดีต้อนรับ</p>
                        <h1>สำหรับดีลเลอร์ / ลงแบบฝากขาย</h1>
                        <div class="list-txtwelcome">
                            <div><img src="{{ asset('frontend/images/icon-tick.svg') }}" alt=""> ใส่ชื่อดีลเลอร์/ผู้ขาย</div>
                            <div><img src="{{ asset('frontend/images/icon-tick.svg') }}" alt=""> รูปถ่ายหน้าโชว์รูม/รูปถ่ายของผู้ขาย</div>
                            <div><img src="{{ asset('frontend/images/icon-tick.svg') }}" alt=""> ที่อยู่เพื่อปักหมุด</div>
                        </div>
                        <form method="POST" action="{{ route('carpostbrowse') }}">
                            @csrf
                            <input type="hidden" name="type" value="dealer">
                            <button class="btn-postcar">
                                <img src="{{ asset('frontend/images/icon-car.svg') }}" alt=""> ลงขายรถของคุณ
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
@endsection
