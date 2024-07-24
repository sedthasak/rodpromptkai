@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

<style>
    .list-mycarsearch.brand.active {
        background-color: #E4EEFA;
    }
    .list-mycarsearch.model.active {
        background-color: #E4EEFA;
    }
</style>

@section('content')


@include('frontend.layouts.inc_profile')	
<?php

$default_image = asset('frontend/deal-example.webp');
// echo "<pre>";
// print_r($results);
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.inc_menuprofile_search_2024')
                <div class="col-12 col-lg-8 col-xl-9">
                    

                <div class="desc-pageprofile">
                        <div class="wraptopic-pageprofile">
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> เพิ่มการมองเห็น</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        @include('frontend.layouts.inc_menu-specialdeal')

                        <div class="row wrpa-topic-dealspecial">
                            <div class="col-6">
                                <h3 class="topic-dealspecial">ใส่โปรโมชั่น</h3>
                            </div>
                            <div class="col-6 text-end">
                             @include('frontend.layouts.inc_btn_adddeal')
                            </div>
                            <div class="col-12">
                                <div class="note-notdeal">ท่านไม่สามารถใส่ดีลเพิ่มเติมได้ โควต้ารถของท่านไม่เพียงพอ กรุณาซื้อดีลเพิ่ม</div>
                            </div>
                        </div>


                        <div class="row">
                            @foreach($results as $car)
                            @php
                            $profilecar_img = ($car->feature)?asset('storage/' . $car->feature):asset('public/uploads/default-car.jpg');
                            @endphp
                            <div class="col-12 col-md-6 col-xl-4 adddeal-item">
                                <div class="item-mycar">
                                    <div class="item-mycar-cover">
                                        <figure><img src="{{$profilecar_img}}" alt=""></figure>
                                    </div>
                                    <div class="adddeal-desc">
                                        <div class="mycar-name">{{$car->modelyear." ".$car->brands_title." ".$car->model_name}}</div>
                                        <div class="mycar-type">{{$car->generations_name." ".$car->sub_models_name}}</div>
                                        <a data-fancybox data-src="#popup-editprice" href="javascript:;" class="deal-selectcar"><i class="bi bi-check-circle-fill"></i> เลือก</a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            


                        </div>


                    </div>

                    <div class="totop-mb"><a id="button-top">กลับสู่ด้านบน</a></div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@section('script')

@endsection
