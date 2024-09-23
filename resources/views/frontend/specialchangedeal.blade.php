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
    .swal2-container {
        z-index: 99995 !important; /* Adjust this value if needed */
    }
</style>

@section('content')


@include('frontend.layouts.inc_profile')	
<?php
$usewithdeal  = 'yes';
$default_image = asset('frontend/deal-example.webp');
$arr_gear = array(
    'auto' => 'เกียร์อัตโนมัติ',
    'manual' => 'เกียร์ธรรมดา',
);
$arr_tag = array(
    '1' => 'tag-top',
    '2' => 'tag-top-left',
    '3' => 'tag-top-left2',
    '4' => 'tag-top-left3',
);
// echo "<pre>";
// print_r($results);
// echo "</pre>";
// foreach($results as $resultsss){
//     echo "<pre>";
//     print_r($resultsss->myDeal->deal);
//     echo "</pre>";
// }
?>
@php
    $usestatus = $usestatus ?? 'approved';
    $usewithdeal = $usewithdeal ?? null;
    $usesearchbox = $usesearchbox ?? 'on';

    if ($usewithdeal === 'yes') {
        $customerCars = $customer_cars_with_deals[$usestatus] ?? [];
    } elseif ($usewithdeal === 'no') {
        $customerCars = $customer_cars_without_deals[$usestatus] ?? [];
    } else {
        $customerCars = $customer_cars_by_status[$usestatus] ?? [];
    }
    $brandData = $customerCars['brands'] ?? [];
@endphp
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.inc_menuprofile_search_2024', ['customerCars' => $customerCars])
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
                            
                            $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                            $oldPrice = $car->old_price;
                            $newPrice = $car->price;
                            $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;
                            $isSelected = $car->myDeal->deal->id == $car->mydeal->deals_id;

                            $border = $car->myDeal->deal->border ?? '#000000';
                            $imagePath = $car->myDeal->deal->image_background ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $car->myDeal->deal->image_background)) : null;
                            $background = $car->myDeal->deal->background ?? null;
                            

                            $font1 = $car->myDeal->deal->font1 ?? '#FFFFFF';
                            $font2 = $car->myDeal->deal->font2 ?? '#FFDADA';
                            $font3 = $car->myDeal->deal->font3 ?? '#FFFFFF';
                            $font4 = $car->myDeal->deal->font4 ?? '#FFE500';
                            $topleftPath = '';
                            $bottomrightPath = '';

                            $topleftPath = $car->myDeal && $car->myDeal->deal && $car->myDeal->deal->topleft ? asset('storage/' . str_replace('public/', '', $car->myDeal->deal->topleft)) : null;
                            $bottomrightPath = $car->myDeal && $car->myDeal->deal && $car->myDeal->deal->bottomright ? asset('storage/' . str_replace('public/', '', $car->myDeal->deal->bottomright)) : null;


                            @endphp

                            <div class="col-12 col-xl-4 item-changedeal col-itemcar">
                                <div class="item-car" style="border: 2px solid {{ $border }}; background-image: url('{{ $imagePath }}'); background-color: {{ $background }}">
                                    @if($car->myDeal && $car->myDeal->deal && $car->myDeal->deal->topleft)
                                        <div class="{{$arr_tag[$car->myDeal->deal->topleft_position]}}"><img src="{{ $topleftPath }}" alt=""></div>
                                    @endif

                                    <figure>
                                        <div class="cover-car">
                                            <div class="box-timeout">
                                                <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก {{ $car->remaining_time }}</div>
                                                @if($car->myDeal && $car->myDeal->deal && $car->myDeal->deal->bottomright)
                                                    <div class="tag-bottom-right"><img src="{{ $bottomrightPath }}" alt=""></div>
                                                @endif
                                            </div>
                                            <img src="{{ $feature }}" alt="">
                                        </div>
                                        <figcaption>
                                            <div class="grid-desccar">
                                                <div class="car-name" style="color: {{ $font1 }}">{{ $car->modelyear }} {{ $car->brand->title }} {{ $car->model->model }}</div>
                                                <div class="car-series" style="color: {{ $font2 }}">{{ $car->generation->generations }} {{ $car->subModel->sub_models }}</div>
                                                <div class="car-province" style="color: {{ $font2 }}">{{ $car->province }}</div>
                                                <div class="row">
                                                    <div class="col-12 col-md-8">
                                                        <div class="descpro-car" style="color: {{ $font1 }}">{{ strip_tags($car->detail) }}</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 text-end">
                                                        <div class="txt-readmore" style="color: {{ $font1 }}">ดูเพิ่มเติม</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="linecontent"></div>
                                            <div class="row caritem-price">
                                                <div class="col-12 col-md-6">
                                                    <div class="txt-gear" style="color: {{ $font3 }}"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> {{ $arr_gear[$car->gear] }}</div>
                                                </div>

                                                <div class="col-12 col-md-6 text-end">
                                                    <div class="car-price" style="color: {{ $font4 }}">
                                                        {{ number_format($newPrice, 0, '.', ',') }}.-
                                                    </div>

                                                    @if($oldPrice > 0)
                                                        <div class="car-price-discount" style="color: {{ $font3 }}">
                                                            <span>{{ number_format($oldPrice, 0, '.', ',') }}.-</span> {{ floor($discountPercentage) }}%
                                                        </div>
                                                    @endif
                                                </div>


                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                                <div class="adddeal-desc">
                                    <a href="{{route('specialselectdealPage', ['car' => $car->id])}}" class="btn-changedeal deal-selectcar">เปลี่ยนรูปแบบ</a>
                                    <a data-fancybox data-src="#popup-editprice" href="javascript:;" class="deal-selectcar" data-id="{{ $car->id }}" data-price="{{ number_format($car->price, 0, '', '') }}">
                                        <i class="bi bi-check-circle-fill"></i> แก้ไขราคา
                                    </a>
                                    
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
        function formatNumberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        $('.deal-selectcar').on('click', function() {
            var price = $(this).data('price');
            var id = $(this).data('id');           
            var formattedPrice = formatNumberWithCommas(parseFloat(price).toFixed(0));
            $('#current_price').val(formattedPrice);
            $('#car_id').val(id);
            $('#promotion_price').val('');
        });

        $('#promotion_price').on('input', function() {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = $(this).val().replace(/,/g, '');
            
            if (isNaN(promoPrice) || promoPrice === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาใส่ตัวเลขที่ถูกต้อง',
                    text: 'กรุณาใส่ราคาที่เป็นตัวเลข',
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then(() => {
                    $(this).val('');
                });
            } else {
                promoPrice = parseFloat(promoPrice);
                $(this).val(formatNumberWithCommas(promoPrice));
            }
        });

        $('#editprice_form').on('submit', function(e) {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = parseFloat($('#promotion_price').val().replace(/,/g, ''));

            if (promoPrice > currentPrice) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'ราคาโปรโมชั่นสูงกว่าราคาเดิม',
                    text: 'ราคาโปรโมชั่นที่กรอกสูงกว่าราคาเดิม ท่านต้องการดำเนินการต่อหรือไม่?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).off('submit').submit(); // Proceed with the form submission
                    }
                });
            } else {
                e.preventDefault();
                Swal.fire({
                    icon: 'info',
                    title: 'ยืนยันการเปลี่ยนแปลงราคา',
                    text: 'ท่านต้องการบันทึกการเปลี่ยนแปลงราคาหรือไม่?',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).off('submit').submit(); // Proceed with the form submission
                    }
                });
            }
        });
    });
</script>











<script>
    var selectedBrandId = null;
    var selectedModelId = null;

    function filterBrands() {
        var input = document.getElementById('search-input').value.toLowerCase();
        var brandList = document.getElementById('brand-list');
        var buttons = brandList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var brandTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (brandTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    function filterModels() {
        var input = document.getElementById('model-search-input').value.toLowerCase();
        var modelList = document.getElementById('model-list');
        var buttons = modelList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var modelTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (modelTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
        button.addEventListener('click', function() {
            selectedBrandId = this.getAttribute('data-brand-id');
            var modelList = document.getElementById('model-list');
            modelList.innerHTML = '';

            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(btn) {
                btn.classList.remove('active');
            });
            this.classList.add('active');

            var brandData = @json($brandData);
            if (brandData[selectedBrandId]) {
                var models = brandData[selectedBrandId].models;
                for (var modelId in models) {
                    if (models.hasOwnProperty(modelId)) {
                        var model = models[modelId];
                        var modelButton = document.createElement('button');
                        modelButton.className = 'list-mycarsearch';
                        modelButton.setAttribute('data-model-id', modelId);
                        modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                        modelButton.addEventListener('click', function() {
                            selectedModelId = this.getAttribute('data-model-id');
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                btn.classList.remove('active');
                            });
                            this.classList.add('active');
                            window.location.href = `{{ route('specialchangedealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                        });
                        modelList.appendChild(modelButton);
                    }
                }
            }
        });
    });

    document.getElementById('search-button').addEventListener('click', function() {
        var keyword = document.getElementById('car-id-input').value;
        var url = new URL(window.location.href);

        url.searchParams.delete('brand_id');
        url.searchParams.delete('model_id');
        url.searchParams.set('keyword', keyword);

        window.location.href = url.toString();
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        var url = new URL(window.location.href);
        url.search = '';
        window.location.href = url.toString();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var brandId = urlParams.get('brand_id');
        var modelId = urlParams.get('model_id');

        if (brandId) {
            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
                if (button.getAttribute('data-brand-id') === brandId) {
                    button.classList.add('active');
                    selectedBrandId = brandId;

                    var brandData = @json($brandData);
                    if (brandData[selectedBrandId]) {
                        var models = brandData[selectedBrandId].models;
                        var modelList = document.getElementById('model-list');
                        modelList.innerHTML = '';

                        for (var modelId in models) {
                            if (models.hasOwnProperty(modelId)) {
                                var model = models[modelId];
                                var modelButton = document.createElement('button');
                                modelButton.className = 'list-mycarsearch';
                                modelButton.setAttribute('data-model-id', modelId);
                                modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                                modelButton.addEventListener('click', function() {
                                    selectedModelId = this.getAttribute('data-model-id');
                                    document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                        btn.classList.remove('active');
                                    });
                                    this.classList.add('active');
                                    window.location.href = `{{ route('specialchangedealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                                });
                                modelList.appendChild(modelButton);
                            }
                        }

                        if (modelId) {
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(button) {
                                if (button.getAttribute('data-model-id') === modelId) {
                                    button.classList.add('active');
                                    selectedModelId = modelId;
                                }
                            });
                        }
                    }
                }
            });
        }
    });
</script>
@endsection
