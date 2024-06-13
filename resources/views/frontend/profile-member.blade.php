@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

@section('content')

<?php
// $default_image = asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png');
// echo "<pre>";
// print_r($_POST);
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 page-member levelclass-{{$level}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="boxtext-membername">
                        <h2>{{$level}}</h2>
                        <h3>aom1234</h3>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="member-profile-userid">
                        <div class="boxtext-memid">
                            <i class="bi bi-person-circle"></i> บัญชีที่ใช้เข้าสู่ระบบ : เบอร์โทรศัพท์มือถือ <span>096-123-4567</span> 
                        </div>
                        <a href="#" class="btn-seetier">See all tiers <img src="images/icon-chev-white.svg" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="member-boxid">
                        <div class="row">
                            <div class="col-12 col-md-8">
                                <div class="box-memberid">
                                    Member ID : <span>6D3243259103157</span>
                                    <button class="btn-sentmember">sent <img src="{{asset('frontend/images2/icon-sent.svg')}}" alt=""></button>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 text-end">
                                <a href="#" class="btn-purchase-history">
                                    <img src="{{asset('frontend/images2/icon-purchase.svg')}}" alt=""> Purchase History <i class="bi bi-chevron-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-boxcode">
                        <h3>โค้ดส่วนลดของฉัน</h3>
                        <div class="bg-boxcode">
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-soldout"><img src="{{asset('frontend/images2/coupon-soldout.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-used">ใช้โค้ดนี้แล้ว</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-code">
                                                        <h5>ROD1234</h5>
                                                        <button title="คัดลอกโค้ด" class="btn-copycode">copy <img src="{{asset('frontend/images2/icon-copy.svg')}}" alt=""></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="wrap-boxcode wrap-boxcode-{{$level}}">
                        <h3>โค้ดพิเศษสำหรับคุณ</h3>
                        <div class="bg-boxcode">
                            <div class="row">
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-soldout"><img src="{{asset('frontend/images2/coupon-soldout.svg')}}" alt=""></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-used">ใช้โค้ดนี้แล้ว</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>ส่วนลด 20% สูงสุด 1,000 บาท</h4>
                                                    <p>เฉพาะแพคเกจแบบประหยัดขึ้นไป</p>
                                                    <div class="coupon-timeout"><i class="bi bi-clock"></i> ใช้ได้ก่อน :  30.04.2024</div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-code">
                                                        <h5>ROD1234</h5>
                                                        <button title="คัดลอกโค้ด" class="btn-copycode">copy <img src="{{asset('frontend/images2/icon-copy.svg')}}" alt=""></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@section('script')
<script>

</script>
@endsection



