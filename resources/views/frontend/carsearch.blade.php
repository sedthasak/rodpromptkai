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
                        <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> ดูรถพร้อมขาย | {{count($results)}} | {{$searchFailed}}</div>
                        <div class="txt-numresult">ทั้งหมด <span>{{count($results)}}</span> รายการ</div>
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
                        <div class="box-itemcar">
                            <div class="car-year">2023</div>
                            <div class="row row-itemcar carlist-page">

                                <div class="col-6 col-xl-4 col-itemcar">
                                    <a href="car-detail.php" class="item-car" style="background-color: #BC0000; border: 2px solid #BC0000">
                                        <div class="tag-top-left"><img src="{{asset('frontend/images2/tag-specialprice.svg')}}" alt=""></div>
                                        <div class="logo-bigbrand"><img src="{{asset('frontend/images2/logo-bigbrand.svg')}}" alt=""></div>
                                        <figure>
                                            <div class="cover-car">
                                                <div class="box-timeout">
                                                    <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก 3 วัน 18 ชม.</div>
                                                    <div class="tag-bottom-right"><img src="{{asset('frontend/images2/tag-44.png')}}" alt=""></div>
                                                </div>
                                                <img src="{{asset('frontend/images/CAR202304060092_Mini_Cooper_20230406_153757523_WATERMARK.png')}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name" style="color: #FFFFFF">2016 Honda CR-V </div>
                                                    <div class="car-series" style="color: #FFDADA">CR-V 2.0 E (MY12) (MNC)</div>
                                                    <div class="car-province" style="color: #FFDADA">กรุงเทพมหานคร</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car" style="color: #FFFFFF">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore" style="color: #FFFFFF">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear" style="color: #fff"><img src="{{asset('frontend/images2/icon-gear.svg')}}" alt="" class="svg"> เกียร์อัตโนมัติ</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price" style="color: #FFE500">599,000.-</div>
                                                        <div class="car-price-discount" style="color: #fff">
                                                            <span>999,000.-</span> 15%
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>


                            </div>
                        </div>

                        <div class="box-itemcar">
                            <div class="car-year">2021</div>
                            <div class="row row-itemcar">
                                <div class="col-6 col-xl-4 col-itemcar">
                                    <a href="car-detail.php" class="item-car">
                                        <figure>
                                            <div class="cover-car">
                                                <img src="{{asset('frontend/images/CAR202304060092_Mini_Cooper_20230406_153757523_WATERMARK.png')}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name">2016 Honda CR-V </div>
                                                    <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                                                    <div class="car-province">กรุงเทพมหานคร</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> เกียร์อัตโนมัติ</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price">599,000.-</div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </a>
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
            var kw1, kw2, kw3, kw4, kw5;

            // Other parameters
            var priceMinimum = isMobile ? $('input[name="price_minimum_mobile"]').val() : $('input[name="price_minimum"]').val();
            var priceMaximum = isMobile ? $('input[name="price_maximum_mobile"]').val() : $('input[name="price_maximum"]').val();
            var monthlyPayment = isMobile ? $('.tab_footer select[name="installment_price_mobile"]').val() : $('.tab_pdetail select').val();

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
                if (priceMinimum) {
                    queryParams.push('price_minimum=' + encodeURIComponent(priceMinimum));
                }
                if (priceMaximum) {
                    queryParams.push('price_maximum=' + encodeURIComponent(priceMaximum));
                }
                if (monthlyPayment) {
                    queryParams.push('monthly_payment=' + encodeURIComponent(monthlyPayment));
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




