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
    <div class="col-12 wrap-seetier wrap-seetier-card">
        <div class="menu-seetiers">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-3">
                        <a href="#" class="btn-tiers-back"><img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""><span>ย้อนกลับ</span></a>
                    </div>
                    <div class="col-10 col-md-9">
                        <div class="wrap-btntiers">
                            <a class="btn-tiers-back active"><img src="{{asset('frontend/images2/icon-wink.svg')}}" class="svg" alt=""><span>สิทธิพิเศษ</span></a>
                            <a href="{{route('seealltiersPage')}}" class="btn-tiers-back"><img src="{{asset('frontend/images2/icon-tiers.svg')}}" class="svg" alt=""><span>การปรับระดับ</span></a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-desc-seetiers">
                        <h3>สิทธิพิเศษ</h3>
                        <div class="seetiers-topic-gold">ตามระดับสมาชิกของคุณ</div>
                        <div class="box-detail-tiers box-detail-tiers-card">
                            <div class="row row-cardmember">
                                <div class="col-3 col-card-member member-past">
                                    <div class="photo-membercard"><img src="{{asset('frontend/images2/card-level1.svg')}}" alt=""></div>
                                    <div class="txt-cardlevel">member</div>
                                </div>
                                <div class="col-3 col-card-member member-past">
                                    <div class="photo-membercard"><img src="{{asset('frontend/images2/card-level2.svg')}}" alt=""></div>
                                    <div class="txt-cardlevel">classic</div>
                                </div>
                                <div class="col-3 col-card-member member-active">
                                    <div class="photo-membercard"><img src="{{asset('frontend/images2/card-level3.svg')}}" alt=""></div>
                                    <div class="txt-cardlevel">gold</div>
                                </div>
                                <div class="col-3 col-card-member">
                                    <div class="photo-membercard"><img src="{{asset('frontend/images2/card-level4.svg')}}" alt=""></div>
                                    <div class="txt-cardlevel">platinum</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="topic-special-level">
                        <h3 class="topic-seetier2"><img src="{{asset('frontend/images2/icon-wink.svg')}}" class="svg" alt=""> สิทธิพิเศษตามระดับ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row bg-blue">
    <div class="col-12">
        <div class="list-special-member">
            <div class="row">
                <div class="col-12">
                    <div class="member-boxpad">
                        <div class="row">
                            <div class="col-4"><h3>ระดับสมาชิก</h3></div>
                            <div class="col-2 card-colpad"><div class="tab-member tab-member-lv1">Member</div></div>
                            <div class="col-2 card-colpad"><div class="tab-member tab-member-lv2">Classic</div></div>
                            <div class="col-2 card-colpad"><div class="tab-member tab-member-lv3">Gold</div></div>
                            <div class="col-2 card-colpad"><div class="tab-member tab-member-lv4">Platinum</div></div>
                        </div>
                    </div>
                    <div class="member-boxpad bgwhite-member">
                        <div class="row">
                            <div class="col-4"><h4>ยอดสั่งซื้อ</h4></div>
                            <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1">0</div></div>
                            <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2">< 299,999</div></div>
                            <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3">300,000</div></div>
                            <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4">500,000</div></div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-topic-special"><span>สิทธิพิเศษ</span></div> 
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>โค้ดส่วนลด</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>Movie & Popcorn</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>โค้ดดีลอาหารใช้หน้าร้าน</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>ส่วนลดตั๋วเครื่องบิน</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>Coins แลกโค้ด</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>โค้ดจ่ายบิล</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>E-Voucher</h5></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv1 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv2 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv3 not-special"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
                                <div class="col-2 card-colpad text-center"><div class="txt-point point-lv4"><img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt=""></div></div>
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
