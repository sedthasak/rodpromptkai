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
    <div class="col-12 wrap-seetier">
        <div class="menu-seetiers">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-3">
                        <a href="{{route('profilePage')}}" class="btn-tiers-back"><img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""><span>ย้อนกลับ</span></a>
                    </div>
                    <div class="col-10 col-md-9">
                        <div class="wrap-btntiers">
                            <a href="{{route('specialprivilegesPage')}}" class="btn-tiers-back"><img src="{{asset('frontend/images2/icon-wink.svg')}}" class="svg" alt=""><span>สิทธิพิเศษ</span></a>
                            <a class="btn-tiers-back active"><img src="{{asset('frontend/images2/icon-tiers.svg')}}" class="svg" alt=""><span>การปรับระดับ</span></a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-desc-seetiers">
                        <h3>การปรับระดับ</h3>
                        <div class="seetiers-topic-gold">ข้อกำหนดการปรับระดับ</div>
                        <div class="box-detail-tiers">
                            <div class="icon-starmember">
                                <img src="{{asset('frontend/images2/starmember.svg')}}" alt="">
                            </div>
                            <div class="desc-starmember">
                                <h4>ระยะเวลาการสะสมคะแนน</h4>
                                <p><i class="bi bi-clock"></i> <span>1 ปี</span> นับตั้งแต่วันที่ 1 ม.ค. - 31 ธ.ค.</p>
                                <h4>คะแนนสะสมจะถูกยกเลิก และเริ่มนับคะแนนใหม่</h4>
                                <p><img src="{{asset('frontend/images2/icon-calendar.svg')}}" alt="">ทุกวันที่ 1 มกราคม ของทุกปี</p>
                            </div>
                        </div>
                    </div>
                    <div class="seetiers-member-level">
                        <h3 class="topic-seetier2"><img src="{{asset('frontend/images2/icon-tiers.svg')}}" class="svg" alt=""> การปรับระดับสมาชิก</h3>
                        <div>
                            <div class="seetiers-boxmember boxmember-level1">
                                <img src="{{asset('frontend/images2/crown-silver.svg')}}" alt="">
                                <div class="seetiers-txt">
                                    <h6>ระดับสมาชิก</h6>
                                    <h5>ลดลง</h5>
                                </div>
                                <div class="line"></div>
                                <p>ผู้ใช้มีคะแนน <span>ไม่ถึงเกณฑ์ขั้นต่ำ</span> ของระดับปัจจุบัน</p>
                            </div>
                            <div class="seetiers-boxmember boxmember-level2">
                                <img src="{{asset('frontend/images2/crown-gold.svg')}}" alt="">
                                <div class="seetiers-txt">
                                    <h6>ระดับสมาชิก</h6>
                                    <h5>คงเดิม</h5>
                                </div>
                                <div class="line"></div>
                                <p>ผู้ใช้มีคะแนน <span>ถึงเกณฑ์ขั้นต่ำ</span> ของระดับปัจจุบัน</p>
                            </div>
                            <div class="seetiers-boxmember boxmember-level3">
                                <img src="{{asset('frontend/images2/crown-platinum.svg')}}" alt="">
                                <div class="seetiers-txt">
                                    <h6>ระดับสมาชิก</h6>
                                    <h5>เพิ่มขึ้น</h5>
                                </div>
                                <div class="line"></div>
                                <p>ผู้ใช้มีคะแนน <span>ถึงเกณฑ์ขั้นต่ำของระดับ</span> ของระดับปัจจุบัน</p>
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



