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
// print_r($default_image);
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
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> ดีลพิเศษ</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        @include('frontend.layouts.inc_menu-specialdeal')
                        <div class="row wrap-topic-changedeal wrpa-topic-dealspecial">
                            <div class="col-12">
                                <h3 class="topic-dealspecial">เปลี่ยนรูปแบบโปรโมชั่น</h3>
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
                                        <div class="mycar-type">{{$car->price}}</div>
                                        <a href="{{route('specialselectdealPage', ['car' => $car->id])}}" class="btn-changedeal deal-selectcar">เปลี่ยนรูปแบบ</a>
                                        <a data-fancybox data-src="#popup-editprice" href="javascript:;" class="btn-changedeal deal-selectcar"> แก้ไขราคา</a>
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
@include('frontend.layouts.inc_deal_editprice')



@endsection

@section('script')
<script>
    $(document).ready(function() {
        $('.deal-selectcar').on('click', function() {
            var price = $(this).data('price');
            var id = $(this).data('id');
            $('#current_price').val(price);
            $('#car_id').val(id);
            $('#promotion_price').val('');
        });

        $('#promotion_price').on('input', function() {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = parseFloat($(this).val());

            if (promoPrice > currentPrice) {
                alert('ราคาโปรโมชั่นไม่สามารถสูงกว่าราคาเดิมได้');
                $(this).val(currentPrice);
            }
        });

        $('#editprice_form').on('submit', function(e) {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = parseFloat($('#promotion_price').val());
            
            if (promoPrice > currentPrice) {
                alert('ราคาโปรโมชั่นไม่สามารถสูงกว่าราคาเดิมได้');
                e.preventDefault();
            }
        });
    });
</script>
@endsection
