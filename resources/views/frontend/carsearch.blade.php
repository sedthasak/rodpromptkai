@extends('../frontend/layouts/layout')

@section('subhead')
    <title>ซื้อรถ {{$mytitle}} ในตลาดรถยนต์ทั่วประเทศไทย | รถพร้อมขาย</title>
    <meta property="og:title" content="ซื้อรถ {{$mytitle}} ในตลาดรถยนต์ทั่วประเทศไทย | รถพร้อมขาย" />
    <meta property="og:type" content="product" />
    <meta property="og:url" content="{{ decode_url(url()->current()) }}" />
    <meta property="og:image" content="{{asset('frontend/images/66ab16642431e.webp')}}" />
    <meta property="og:site_name" content="rodpromptkai.com - รถพร้อมขาย เว็บไซต์รถยนต์">
    <meta property="og:description" content="รวมรถมือสอง {{$mytitle}}  จำนวน  คัน สภาพดี ซื้อรถ ขายรถ ทุกรุ่นทุกยี่ห้อ ราคาถูกกว่านี้ไม่มีอีกแล้ว" />
    <meta property="og:locale" content="th_TH">

    <meta name="keywords" content="{{$mykeyword}}" />
    <meta name="description" content="รวมรถมือสอง {{$mytitle}}  จำนวน  คัน สภาพดี ซื้อรถ ขายรถ ทุกรุ่นทุกยี่ห้อ ราคาถูกกว่านี้ไม่มีอีกแล้ว" />

@endsection

@section('content')

<?php
$arr_gear = array(
    'auto' => 'เกียร์อัตโนมัติ',
    'manual' => 'เกียร์ธรรมดา',
);
// echo "<pre>";
// print_r($priceOptions);
// echo "</pre>";
// echo "<pre>";
// print_r(count($results));
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 banner-slidecar">
        <div class="owl-bannercar owl-carousel owl-theme">
            <div class="items">
                <figure><img src="{{asset('frontend/images/banner-car.jpg')}}" alt=""></figure>
            </div>
            <div class="items">
                <figure><img src="{{asset('frontend/images/banner-car.jpg')}}" alt=""></figure>
            </div>
            <div class="items">
                <figure><img src="{{asset('frontend/images/banner-car.jpg')}}" alt=""></figure>
            </div>
            <div class="items">
                <figure><img src="{{asset('frontend/images/banner-car.jpg')}}" alt=""></figure>
            </div>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-12 wrap-carpage">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    
                    
                    <div class="wrap-breadcrumb">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('indexPage') }}"><span>หน้าแรก</span></a></li>
                                <li class="breadcrumb-item"><a href="{{ route('carsearchPage') }}"><span>ค้นหารถ</span></a></li>
                                @foreach ($breadcrumb as $bc)
                                    <li class="breadcrumb-item {{ $loop->last ? 'active text-truncate' : '' }}" aria-current="{{ $loop->last ? 'page' : '' }}">
                                        @if ($loop->last)
                                            <span>{{ $bc['title'] }}</span>
                                        @else
                                            <a href="{{ $bc['url'] }}"><span>{{ $bc['title'] }}</span></a>
                                        @endif
                                    </li>
                                @endforeach
                            </ol>
                        </nav>
                        <h1>
                            ซื้อรถมือสอง {{$mytitle}} ในตลาดรถยนต์ไทย 
                        </h1>
                    </div>

                </div>
            </div>

            <div class="row">
                <div class="col-12 col-lg-4 col-xl-3 hide-search-mb">
                    @include('frontend.layouts.inc-carsearch-new')
                </div>

                <div class="col-12 col-lg-8 col-xl-9">
                <div class="wrap-allitem-car">
                        <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> ดูรถพร้อมขาย | {{$searchFailed}}</div>
                        <div class="txt-numresult">ทั้งหมด <span>{{$countcar}}</span> รายการ</div>
                        <div class="btn-boxfilter">
                            <button>F48 ปี16-ปัจจุบัน</button>
                            <button>E84 ปี09-16</button>
                            <button>F48 ปี16-ปัจจุบัน</button>
                            <button>E84 ปี09-16</button>
                        </div>
                        <div class="btn-boxfilter">
                            <button>2023</button>
                            <button>2021</button>
                            <button>2020</button>
                            <button>2019</button>
                            <button>2018</button>
                            <button>2017</button>
                            <button>2016</button>
                            <button>2015</button>
                            <button>2014</button>
                            <button>2013</button>
                            <button>2012</button>
                            <button>2011</button>
                        </div>
                        <div class="box-filteritem">
                            <div class="row">
                                <div class="col-4 col-md-4">
                                    <div class="item-filter">
                                        <div><img src="{{asset('frontend/images/icon-filter.svg')}}" alt=""> <span class="filter-hidetxt">เรียงตาม</span></div>
                                        <div>
                                            <select class="form-select">
                                                <option value="">ปีล่าสุด</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-8 col-md-8 text-end">
                                    <div class="item-filter">
                                        <div class="filter-hidetxt">แสดงราคา</div>
                                        <div>
                                            <select class="form-select">
                                                <option value="">เงินสด</option>
                                                <option value="">ผ่อน</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="item-filter">
                                        <div class="filter-hidetxt">เปลี่ยนมุมมอง</div>
                                        <div class="box-changelayout">
                                            <button class="btn-list-item"><img src="{{asset('frontend/images/icon-list.svg')}}" class="svg" alt=""></button>
                                            <button class="btn-grid-item active"><img src="{{asset('frontend/images/icon-grid.svg')}}" class="svg" alt=""></button>
                                        </div>
                                    </div>


                                    


                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        @foreach ($results as $modelyear => $carsByYear)
                            <div class="box-itemcar">
                                <div class="car-year">{{ $modelyear }}</div>
                                <div class="row row-itemcar carlist-page">
                                    @foreach ($carsByYear as $car)
                                        @if ($car->myDeal)
                                            @php
                                                $profilecar_img = $car->feature ? asset('storage/' . $car->feature) : asset('public/uploads/default-car.jpg');
                                                $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                                                $oldPrice = $car->old_price;
                                                $newPrice = $car->price;
                                                $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;

                                                $border = $car->myDeal->deal->border ?? '#000000';
                                                $imagePath = $car->myDeal->deal->image_background ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $car->myDeal->deal->image_background)) : null;
                                                $background = $car->myDeal->deal->background ?? '#BC0000';
                                                $topleftPath = $car->myDeal->deal->topleft ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $car->myDeal->deal->topleft)) : null;
                                                $bottomrightPath = $car->myDeal->deal->bottomright ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $car->myDeal->deal->bottomright)) : null;
                                                $font1 = $car->myDeal->deal->font1 ?? '#FFFFFF';
                                                $font2 = $car->myDeal->deal->font2 ?? '#FFDADA';
                                                $font3 = $car->myDeal->deal->font3 ?? '#FFFFFF';
                                                $font4 = $car->myDeal->deal->font4 ?? '#FFE500';
                                            @endphp

                                            <div class="col-6 col-xl-4 col-itemcar">
                                                <div class="item-car" style="border: 2px solid {{ $border }}; background-image: url('{{ $imagePath }}'); background-color: {{ $background }}">
                                                    @if($topleftPath)
                                                        <div class="tag-top-left"><img src="{{ $topleftPath }}" alt=""></div>
                                                    @endif
                                                    <!-- <div class="logo-bigbrand"><img src="{{ asset('frontend/images2/logo-bigbrand.svg') }}" alt=""></div> -->
                                                    <figure>
                                                        <div class="cover-car">
                                                            <div class="box-timeout">
                                                                <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก {{ $car->remaining_time ?? '3 วัน 18 ชม.' }}</div>
                                                                @if($bottomrightPath)
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
                                            </div>

                                        @else
                                            <!-- Default design when there is no myDeal but use dynamic text -->
                                            @php
                                                $profilecar_img = $car->feature ? asset('storage/' . $car->feature) : asset('public/uploads/default-car.jpg');
                                                $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                                                $oldPrice = $car->old_price;
                                                $newPrice = $car->price;
                                                $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;
                                            @endphp

                                            <div class="col-6 col-xl-4 col-itemcar">
                                                <a href="car-detail.php" class="item-car">
                                                    <figure>
                                                        <div class="cover-car">
                                                            <img src="{{ $feature }}" alt="">
                                                        </div>
                                                        <figcaption>
                                                            <div class="grid-desccar">
                                                                <div class="car-name">{{ $car->modelyear }} {{ $car->brand->title }} {{ $car->model->model }}</div>
                                                                <div class="car-series">{{ $car->generation->generations }} {{ $car->subModel->sub_models }}</div>
                                                                <div class="car-province">{{ $car->province }}</div>
                                                                <div class="row">
                                                                    <div class="col-12 col-md-8">
                                                                        <div class="descpro-car">{{ strip_tags($car->detail) }}</div>
                                                                    </div>
                                                                    <div class="col-12 col-md-4 text-end">
                                                                        <div class="txt-readmore">ดูเพิ่มเติม</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="linecontent"></div>
                                                            <div class="row caritem-price">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="txt-gear"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> {{ $arr_gear[$car->gear] }}</div>
                                                                </div>

                                                                <div class="col-12 col-md-6 text-end">
                                                                    <div class="car-price">
                                                                        {{ number_format($newPrice, 0, '.', ',') }}.-
                                                                    </div>

                                                                    @if($oldPrice > 0)
                                                                        <div class="car-price-discount">
                                                                            <span>{{ number_format($oldPrice, 0, '.', ',') }}.-</span> {{ floor($discountPercentage) }}%
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </a>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <div class="box-frmhelpcar">
                            <div class="topic-frmhelpcar">
                                <img src="{{asset('frontend/images/carred.svg')}}" alt=""> <span>ช่วยคุณหารถที่ใช่</span> ให้รถพร้อมขายช่วยหารถให้คุณ
                            </div>
                            <form action="">
                                <div>
                                    <input type="text" class="form-control" placeholder="ชื่อ - นามสกุล">
                                    <input type="text" class="form-control" placeholder="เบอร์โทรติดต่อ">
                                    <input type="text" class="form-control" placeholder="Line ID">
                                    <input type="text" class="form-control" placeholder="รุ่นรถที่ต้องการ">
                                </div>
                                <button>คลิกเลย <i class="bi bi-chat-text-fill"></i></button>
                            </form>
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
    $(document).on("click", ".btn-grid-item", function () {
    //    if ( !$( this ).hasClass( "active" ) ) {
    //         $('.btn-list-item').removeClass('active');
    //         $(this).addClass('active');
    //         $('.col-itemcar').removeClass('col-12 list-item').addClass('col-6 col-xl-4');
    //       }
        if ($(".btn-list-item").hasClass("active")) {
            $(".btn-list-item").removeClass('active');
        }
        else {
            
        }
        if ($(".btn-grid-item").hasClass("active")) {
            // console.log("has class");
        }
        else {
            $(".btn-grid-item").addClass('active');
            $(".list-item").addClass('col-6 col-xl-4').removeClass('col-12 list-item');
        }
    });
    $('.btn-list-item').click(function (event) {
        // if ( !$( this ).hasClass( "active" ) ) {
        //         $('.btn-grid-item').removeClass('active');
        //         $(this).addClass('active');
        //         $('.col-itemcar').removeClass('col-6 col-xl-4').addClass('col-12 list-item');
        //     }
        if ($(".btn-grid-item").hasClass("active")) {
            $(".btn-grid-item").removeClass('active');
        }
        else {
            
        }
        if ($(".btn-list-item").hasClass("active")) {
            
        }
        else {
            $(".btn-list-item").addClass('active');
            $(".col-xl-4").addClass('col-12 list-item').removeClass('col-6 col-xl-4');
        }
    });

</script>
<script>
    $(document).ready(function() {

        // Handle search button click for mobile and desktop
        $('.btn-searchcar').click(function(e) {
            e.preventDefault();

            var isMobile = $(this).closest('.my-box-search-mobile').length > 0;

            // Define route names
            var getBrandNameUrl = "{{ route('getBrandName', ['id' => ':id']) }}";
            var getModelNameUrl = "{{ route('getModelName', ['id' => ':id']) }}";
            var getGenerationNameUrl = "{{ route('getGenerationName', ['id' => ':id']) }}";
            var getSubmodelNameUrl = "{{ route('getSubmodelName', ['id' => ':id']) }}";

            // Fetch data from the correct box (desktop or mobile)
            var isEVChecked = isMobile ? $('input[name="ev_mobile"]').is(':checked') : $('input[name="ev"]').is(':checked');
            const brandId = brand_id;
            const modelId = model_id;
            const generationId = generation_id;
            const submodelId = submodel_id;

            // Initialize variables
            var brandName = '';
            var modelName = '';
            var generationName = '';
            var submodelName = '';
            var province = isMobile ? $('select[name="province_mobile"]').val() : $('select[name="province"]').val();

            // Other parameters
            var priceMinimum = isMobile ? $('input[name="price_minimum_mobile"]').val() : $('input[name="price_minimum"]').val();
            var priceMaximum = isMobile ? $('input[name="price_maximum_mobile"]').val() : $('input[name="price_maximum"]').val();
            var monthlyPayment = isMobile ? $('.tab_footer select[name="installment_price_mobile"]').val() : $('.tab_pdetail select').val();
            var yearStart = isMobile ? $('.year-select-input.year-minimum').val() : $('.year-select-input.year-minimum').val();
            var yearEnd = isMobile ? $('.year-select-input.year-maximum').val() : $('.year-select-input.year-maximum').val();
            var color = isMobile ? $('select[name="color_mobile"]').val() : $('select[name="color"]').val();
            var gear = isMobile ? $('input[name="advance-gear-mobile"]:checked').val() : $('input[name="advance-gear"]:checked').val();
            var gas = isMobile ? $('select[name="gas_mobile"]').val() : $('select[name="gas"]').val();

            // Function to fetch name from server
            function fetchName(url, id, callback) {
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        callback(response.name);
                    },
                    error: function() {
                        callback('empty');
                    }
                });
            }

            // Fetch names
            function fetchNamesAndRedirect() {
                var fetchCount = 0;
                var totalFetches = 4;

                function checkCompletion() {
                    fetchCount++;
                    if (fetchCount === totalFetches) {
                        constructAndRedirect();
                    }
                }

                if (brandId) {
                    fetchName(getBrandNameUrl, brandId, function(name) {
                        brandName = name;
                        checkCompletion();
                    });
                } else {
                    brandName = 'empty';
                    checkCompletion();
                }

                if (modelId) {
                    fetchName(getModelNameUrl, modelId, function(name) {
                        modelName = name;
                        checkCompletion();
                    });
                } else {
                    modelName = 'empty';
                    checkCompletion();
                }

                if (generationId) {
                    fetchName(getGenerationNameUrl, generationId, function(name) {
                        generationName = name;
                        checkCompletion();
                    });
                } else {
                    generationName = 'empty';
                    checkCompletion();
                }

                if (submodelId) {
                    fetchName(getSubmodelNameUrl, submodelId, function(name) {
                        submodelName = name;
                        checkCompletion();
                    });
                } else {
                    submodelName = 'empty';
                    checkCompletion();
                }
            }

            function constructAndRedirect() {
                // Sanitize price inputs to remove non-numeric characters
                priceMinimum = priceMinimum.replace(/\D/g, '');
                priceMaximum = priceMaximum.replace(/\D/g, '');

                // Construct the URL based on the criteria
                var url = '/carsearch';

                if (brandName !== 'empty') {
                    url += '/' + encodeURIComponent(brandName);
                }
                if (modelName !== 'empty') {
                    url += '/' + encodeURIComponent(modelName);
                }
                if (generationName !== 'empty') {
                    url += '/' + encodeURIComponent(generationName);
                }
                if (submodelName !== 'empty') {
                    url += '/' + encodeURIComponent(submodelName);
                }
                if (province && province !== 'empty') {
                    url += '/' + encodeURIComponent(province);
                }

                // Construct query parameters
                var queryParams = [];

                if (isEVChecked) {
                    queryParams.push('ev=yes');
                }
                if (priceMinimum) {
                    queryParams.push('min_price=' + encodeURIComponent(priceMinimum));
                }
                if (priceMaximum) {
                    queryParams.push('max_price=' + encodeURIComponent(priceMaximum));
                }
                if (monthlyPayment) {
                    queryParams.push('monthly=' + encodeURIComponent(monthlyPayment));
                }
                if (yearStart) {
                    queryParams.push('min_year=' + encodeURIComponent(yearStart));
                }
                if (yearEnd) {
                    queryParams.push('max_year=' + encodeURIComponent(yearEnd));
                }
                if (color) {
                    queryParams.push('color=' + encodeURIComponent(color));
                }
                if (gear) {
                    queryParams.push('gear=' + encodeURIComponent(gear));
                }
                if (gas) {
                    queryParams.push('fuel_type=' + encodeURIComponent(gas));
                }

                // Add query parameters to the URL
                if (queryParams.length > 0) {
                    url += '?' + queryParams.join('&');
                }

                // Redirect to the constructed URL
                window.location.href = url;
            }

            // Fetch names and then redirect
            fetchNamesAndRedirect();
        });

    });
</script>
<!-- <script>
    $(document).ready(function() {

        // Handle search button click for mobile and desktop
        $('.btn-searchcar').click(function(e) {
            e.preventDefault();

            var isMobile = $(this).closest('.my-box-search-mobile').length > 0;

            // Define route names
            var getBrandNameUrl = "{{ route('getBrandName', ['id' => ':id']) }}";
            var getModelNameUrl = "{{ route('getModelName', ['id' => ':id']) }}";
            var getGenerationNameUrl = "{{ route('getGenerationName', ['id' => ':id']) }}";
            var getSubmodelNameUrl = "{{ route('getSubmodelName', ['id' => ':id']) }}";

            // Fetch data from the correct box (desktop or mobile)
            var isEVChecked = isMobile ? $('input[name="ev_mobile"]').is(':checked') : $('input[name="ev"]').is(':checked');
            const brandId = brand_id;
            const modelId = model_id;
            const generationId = generation_id;
            const submodelId = submodel_id;

            // Initialize variables
            var brandName = '';
            var modelName = '';
            var generationName = '';
            var submodelName = '';

            // Function to fetch name from server
            function fetchName(url, id, callback) {
                $.ajax({
                    url: url.replace(':id', id),
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        callback(response.name);
                    },
                    error: function() {
                        callback('empty');
                    }
                });
            }

            // Fetch names
            if (brandId) {
                fetchName(getBrandNameUrl, brandId, function(name) {
                    brandName = name;
                    fetchModelName();
                });
            } else {
                fetchModelName();
            }

            function fetchModelName() {
                if (modelId) {
                    fetchName(getModelNameUrl, modelId, function(name) {
                        modelName = name;
                        fetchGenerationName();
                    });
                } else {
                    fetchGenerationName();
                }
            }

            function fetchGenerationName() {
                if (generationId) {
                    fetchName(getGenerationNameUrl, generationId, function(name) {
                        generationName = name;
                        fetchSubmodelName();
                    });
                } else {
                    fetchSubmodelName();
                }
            }

            function fetchSubmodelName() {
                if (submodelId) {
                    fetchName(getSubmodelNameUrl, submodelId, function(name) {
                        submodelName = name;
                        // Log all data after fetching names
                        logAllData();
                    });
                } else {
                    // Log all data after fetching names
                    logAllData();
                }
            }

            function logAllData() {
                var purchaseType = isMobile
                    ? $('.tab_footer_btn .btn-default.active').text().trim() // Mobile
                    : $('.tab_article_btn .btn-default.active').text().trim(); // Desktop

                var monthlyPayment = isMobile 
                    ? $('.tab_footer select[name="installment_price_mobile"]').val() // Mobile
                    : $('.tab_pdetail select').val(); // Desktop

                var priceMinimum = isMobile ? $('input[name="price_minimum_mobile"]').val() : $('input[name="price_minimum"]').val();
                var priceMaximum = isMobile ? $('input[name="price_maximum_mobile"]').val() : $('input[name="price_maximum"]').val();
                var yearStart = isMobile ? $('.year-select-input.year-minimum').val() : $('.year-select-input.year-minimum').val();
                var yearEnd = isMobile ? $('.year-select-input.year-maximum').val() : $('.year-select-input.year-maximum').val();
                var color = isMobile ? $('select[name="color_mobile"]').val() : $('select[name="color"]').val();
                var gear = isMobile ? $('input[name="advance-gear-mobile"]:checked').val() : $('input[name="advance-gear"]:checked').val();
                var gas = isMobile ? $('select[name="gas_mobile"]').val() : $('select[name="gas"]').val();
                var province = isMobile ? $('select[name="province_mobile"]').val() : $('select[name="province"]').val();

                // Log the collected data
                console.log('1. Electric Vehicle:', isEVChecked);
                console.log('2. Brand ID:', brandId, 'Brand Name:', brandName || 'empty');
                console.log('3. Model ID:', modelId, 'Model Name:', modelName || 'empty');
                console.log('4. Generation ID:', generationId, 'Generation Name:', generationName || 'empty');
                console.log('5. Submodel ID:', submodelId, 'Submodel Name:', submodelName || 'empty');
                console.log('6. Purchase Type:', purchaseType);
                console.log('7. Price Minimum:', priceMinimum);
                console.log('8. Price Maximum:', priceMaximum);
                console.log('9. Monthly Payment:', monthlyPayment);
                console.log('10. Year Start:', yearStart);
                console.log('11. Year End:', yearEnd);
                console.log('12. Color:', color);
                console.log('13. Gear:', gear);
                console.log('14. Gas:', gas);
                console.log('15. Province:', province);
            }
        });

    });
</script> -->
@endsection




