@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile-check</title>
@endsection

@section('content')


@include('frontend.layouts.inc_profile')	
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.inc-menuprofile-search')
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="desc-pageprofile">
                        <div class="wraptopic-pageprofile">
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> รถที่ลงขาย</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        @include('frontend.layouts.inc_menu-mycar')
                        <div class="item-mycar">
                            <div class="item-mycar-cover">
                                <a href="car-detail.php"><figure><img src="{{asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png')}}" alt=""></figure></a>
                            </div>
                            <div class="mycar-detail-mb">
                                <a href="car-detail.php">
                                    <div class="mycar-name">2023 BMW X1</div>
                                    <div class="mycar-type">X1 2.0 sDrive18i</div>
                                    <div class="mycar-idcar">4กข 8113</div>
                                </a>
                            </div>
                            <div class="item-mycar-detail-check item-mycar-detail">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="car-detail.php">
                                            <div class="mycar-name">2023 BMW X1</div>
                                            <div class="mycar-type">X1 2.0 sDrive18i</div>
                                            <div class="mycar-idcar">4กข 8113</div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <div class="mycar-post">วันที่ลงขาย :  16 มิ.ย. 66</div>
                                        <div class="mycar-price-mb mycar-price">599,000.-</div>
                                    </div>
                                </div>
                                <div class="mycar-boxline">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mycar-boxprice">
                                                <div class="mycar-price">599,000.-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="item-mycar">
                            <div class="item-mycar-cover">
                                <a href="car-detail.php"><figure><img src="{{asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png')}}" alt=""></figure></a>
                            </div>
                            <div class="mycar-detail-mb">
                                <a href="car-detail.php">
                                    <div class="mycar-name">2023 BMW X1</div>
                                    <div class="mycar-type">X1 2.0 sDrive18i</div>
                                    <div class="mycar-idcar">4กข 8113</div>
                                </a>
                            </div>
                            <div class="item-mycar-detail-check item-mycar-detail">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="car-detail.php">
                                            <div class="mycar-name">2023 BMW X1</div>
                                            <div class="mycar-type">X1 2.0 sDrive18i</div>
                                            <div class="mycar-idcar">4กข 8113</div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <div class="mycar-post">วันที่ลงขาย :  16 มิ.ย. 66</div>
                                        <div class="mycar-price-mb mycar-price">599,000.-</div>
                                    </div>
                                </div>
                                <div class="mycar-boxline">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mycar-boxprice">
                                                <div class="mycar-price">599,000.-</div>
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
    $( ".box-menuprofile > ul > li:nth-child(2) > a" ).addClass( "here" );
    $( ".menu-mycar > ul > li:nth-child(2) > a" ).addClass( "here" );
</script>
@endsection