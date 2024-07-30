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
<?php

// echo "<pre>";
// print_r($customer_cars_by_status);
// echo "</pre>";
// foreach ($cars as $brandTitle => $models) {
//     echo "Brand: $brandTitle\n";
//     foreach ($models as $modelName => $cars) {
//         echo "  Model: $modelName\n";
//         foreach ($cars as $car) {
//             echo "    Car ID: {$car->id}, Title: {$car->title}\n";
//         }
//     }
//     echo "<br>";
// }

?>







@include('frontend.layouts.inc_profile')    

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
                                        <div class="mycar-type">{{$car->price}}</div>
                                        <a data-fancybox data-src="#popup-editprice" href="javascript:;" class="deal-selectcar" data-id="{{$car->id}}" data-price="{{$car->price}}"><i class="bi bi-check-circle-fill"></i> เลือก</a>
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
    function filterBrands() {
        // Get the search input value
        var input = document.getElementById('search-input').value.toLowerCase();
        var brandList = document.getElementById('brand-list');
        var buttons = brandList.getElementsByClassName('list-mycarsearch');

        // Loop through all brand buttons and hide those that don't match the search query
        for (var i = 0; i < buttons.length; i++) {
            var brandTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            console.log(brandTitle);
            if (brandTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }
</script>


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
</>
@endsection