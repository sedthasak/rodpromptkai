@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - ค้นหารถ</title>
@endsection

@section('content')

<?php

// echo "<pre>";
// print_r($breadcrumb);
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
                            ค้นหารถ
                            @if ($brand_breadcrumb)
                                {{ $brand_breadcrumb }}
                            @endif
                            @if ($model_breadcrumb)
                                {{ $model_breadcrumb }}
                            @endif
                            @if ($generation_breadcrumb)
                                {{ $generation_breadcrumb }}
                            @endif
                            @if ($sub_model_breadcrumb)
                                {{ $sub_model_breadcrumb }}
                            @endif
                            @if ($provincesearch)
                                {{ $provincesearch }}
                            @endif
                            ในตลาดรถยนต์ไทย
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
                        <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> ดูรถพร้อมขาย</div>
                        <div class="txt-numresult">ทั้งหมด <span>345</span> รายการ</div>
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

</script>
@endsection




