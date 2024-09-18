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
<style>

    .pagination-wrapper {
        overflow-x: auto;
        padding: 10px 0;
        text-align: center;
        white-space: nowrap;
    }

    .pagination-wrapper .pagination {
        display: inline-flex;
        justify-content: center;
        flex-wrap: nowrap;
    }

    .pagination-wrapper .page-item {
        margin: 0 2px;
    }

    .pagination-wrapper .page-link {
        width: 40px;
        height: 40px;
        line-height: 40px;
        text-align: center;
        padding: 0;
        border: 1px solid #c60d0d; /* Updated border color */
        border-radius: 5px;
        color: #c60d0d; /* Updated text color */
        text-decoration: none;
        background-color: #fff;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #c60d0d; /* Updated background color */
        color: #fff;
        border-color: #c60d0d; /* Updated border color */
    }

    .pagination-wrapper .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    @media (max-width: 768px) {
        .pagination-wrapper .page-link {
            width: 30px;
            height: 30px;
            line-height: 30px;
        }
    }



</style>

@section('content')

<?php
$arr_tag = array(
    '1' => 'tag-top',
    '2' => 'tag-top-left',
    '3' => 'tag-top-left2',
    '4' => 'tag-top-left3',
);
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
@if(!empty($slide) && count($slide) > 0)
<section class="row">
    <div class="col-12 banner-slidecar">
        <div class="owl-bannercar owl-carousel owl-theme">
            @foreach($slide as $sli)
                @if(isset($sli->link) && isset($sli->image))
                <div class="items">
                    <a href="{{ asset($sli->link) }}" target="_blank">
                        <figure><img src="{{ asset($sli->image) }}" alt=""></figure>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endif






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

                    

                    @if($countcar > 0)
                    <div class="wrap-allitem-car">
                        <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> ดูรถพร้อมขาย</div>
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
                                        <!-- <div><img src="{{asset('frontend/images/icon-filter.svg')}}" alt=""> <span class="filter-hidetxt">เรียงตาม</span></div>
                                        <div>
                                            <select class="form-select" name="orderby">
                                                <option value="new">ปีล่าสุด</option>
                                                <option value="old">ปีที่เก่ากว่า</option>
                                            </select>
                                        </div> -->
                                    </div>
                                </div>
                                <div class="col-8 col-md-8 text-end">
                                    <div class="item-filter">
                                        <div class="filter-hidetxt">แสดงราคา</div>
                                        <div>
                                            <select class="form-select" id="sel_showcash">
                                                <option value="cash">เงินสด</option>
                                                <option value="finance">ผ่อน</option>
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
                                    @foreach ($carsByYear as $carsByYearKey => $car)
                                        @if ($car->myDeal)
                                            @php
                                                $profilecar_img = $car->feature ? asset('storage/' . $car->feature) : asset('public/uploads/default-car.jpg');
                                                $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                                                $oldPrice = $car->old_price;
                                                $newPrice = $car->price;
                                                $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;

                                                $border = $car->myDeal->deal->border ?? '#000000';
                                                $imagePath = $car->myDeal->deal->image_background ? asset('storage/' . str_replace('public/', '', $car->myDeal->deal->image_background)) : null;
                                                $background = $car->myDeal->deal->background ?? '#BC0000';
                                                $topleftPath = $car->myDeal->deal->topleft ? asset('storage/' . str_replace('public/', '', $car->myDeal->deal->topleft)) : null;
                                                $bottomrightPath = $car->myDeal->deal->bottomright ? asset('storage/' . str_replace('public/', '', $car->myDeal->deal->bottomright)) : null;
                                                $font1 = $car->myDeal->deal->font1 ?? '#FFFFFF';
                                                $font2 = $car->myDeal->deal->font2 ?? '#FFDADA';
                                                $font3 = $car->myDeal->deal->font3 ?? '#FFFFFF';
                                                $font4 = $car->myDeal->deal->font4 ?? '#FFE500';

                                                $finance = (($newPrice - 0) + (($newPrice - 0) * 5.75 / 100) * (84 / 12)) / 84;
                                            @endphp

                                            <div class="col-6 col-xl-4 col-itemcar">
                                                <a href="{{ route('cardetailPage', ['slug' => $car->slug]) }}" class="item-car" style="border: 2px solid {{ $border }}; background-image: url('{{ $imagePath }}'); background-color: {{ $background }}">
                                                    @if($topleftPath)
                                                        <div class="{{$arr_tag[$car->myDeal->deal->topleft_position]}}"><img src="{{ $topleftPath }}" alt=""></div>
                                                    @endif
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
                                                                <div class="car-name" style="color: {{ $font1 }}">
                                                                    {{ $car->modelyear }} 
                                                                    {{ $car->brand ? $car->brand->title : 'N/A' }} 
                                                                    {{ $car->model ? $car->model->model : 'N/A' }}
                                                                </div>
                                                                <div class="car-series" style="color: {{ $font2 }}">
                                                                    {{ $car->generation ? $car->generation->generations : 'N/A' }} 
                                                                    {{ $car->subModel ? $car->subModel->sub_models : 'N/A' }}
                                                                </div>
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
                                                                    <div class="txt-gear" style="color: {{ $font3 }}">
                                                                        <img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> 
                                                                        {{ $arr_gear[$car->gear] }}
                                                                    </div>
                                                                </div>

                                                                <div class="col-12 col-md-6 text-end">
                                                                    <div class="car-price" style="color: {{ $font4 }}">
                                                                        {{ number_format($newPrice, 0, '.', ',') }}.-
                                                                    </div>

                                                                    @if($oldPrice > 0)
                                                                        <div class="car-price-discount" style="color: {{ $font3 }}">
                                                                            <span>{{ number_format($oldPrice, 0, '.', ',') }}.-</span> 
                                                                            {{ floor($discountPercentage) }}%
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                            <div class="row caritem-price caritem-price-finance" style="display:none;">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="txt-gear"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> {{ $arr_gear[$car->gear] }}</div>
                                                                </div>
                                                                <div class="col-12 col-md-6 text-end">
                                                                    <div class="car-price">
                                                                        {{ number_format($finance, 0, '.', ',') }}.-
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </figcaption>
                                                    </figure>
                                                </a>
                                            </div>

                                        @else
                                            @php
                                                $profilecar_img = $car->feature ? asset('storage/' . $car->feature) : asset('public/uploads/default-car.jpg');
                                                $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                                                $oldPrice = $car->old_price;
                                                $newPrice = $car->price;
                                                $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;
                                            
                                                $finance = (($newPrice - 0) + (($newPrice - 0) * 5.75 / 100) * (84 / 12)) / 84;
                                            @endphp

                                            <div class="col-6 col-xl-4 col-itemcar">
                                                <a href="{{ route('cardetailPage', ['slug' => $car->slug]) }}" class="item-car">
                                                    <figure>
                                                        <div class="cover-car">
                                                            <img src="{{ $feature }}" alt="">
                                                        </div>
                                                        <figcaption>
                                                            <div class="grid-desccar">
                                                                <div class="car-name">
                                                                    {{ $car->modelyear }} 
                                                                    {{ $car->brand ? $car->brand->title : 'N/A' }} 
                                                                    {{ $car->model ? $car->model->model : 'N/A' }}
                                                                </div>
                                                                <div class="car-series">
                                                                    {{ $car->generation ? $car->generation->generations : 'N/A' }} 
                                                                    {{ $car->subModel ? $car->subModel->sub_models : 'N/A' }}
                                                                </div>
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
                                                            <div class="row caritem-price caritem-price-cash">
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
                                                            <div class="row caritem-price caritem-price-finance" style="display:none;">
                                                                <div class="col-12 col-md-6">
                                                                    <div class="txt-gear"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> {{ $arr_gear[$car->gear] }}</div>
                                                                </div>
                                                                <div class="col-12 col-md-6 text-end">
                                                                    <div class="car-price">
                                                                        {{ number_format($finance, 0, '.', ',') }}.-
                                                                    </div>
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
                        <!-- Pagination Links -->
                        <div class="pagination-wrapper">
                            {{ $paginatedCars->onEachSide(1)->links('pagination::bootstrap-4') }}
                        </div>

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
                    <br>
                    <div class="box-car-article" style="width: 100%; height: auto; overflow: visible; padding: 25px; line-height: 1.5; text-align: justify;">
                        {!! $brandforshow ?? '' !!}
                    </div>




                    @else
                    <div class="box-text-notfound">
                        <img src="{{asset('frontend/images/car-notfound.svg')}}" alt="">
                        <h1>ไม่พบการค้นหา</h1>
                        <p>เพื่อผลลัพธ์ที่ดีกว่าให้ลองค้นหาโดยใช้ตัวเลือกการค้นหาอื่น หรือส่งข้อความมาหาเราเพื่อช่วยหา</p>
                    </div>

                    <div class="box-linkcarseo wow fadeInDown">
                        <h2 class="txt-carseo-notfound">การค้นหายอดนิยม</h2>
                        <div class="row">
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Toyota มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">ฟอร์จูนเนอร์มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">ยาริสมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">วีออสมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">วีโก้มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">คัมรี่มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Toyota commuter มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Honda มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">ซีวิคมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">ฮอนด้าแจ๊สมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">แอคคอร์ด มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">CR-V มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Honda City มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">HR-V มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Mazda มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">Mazda 3 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Mazda 2 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">CX-5 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">CX-3 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BT-50 PRO มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BT-50 มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Mitsubishi มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">Xpander มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Pajero Sport มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Lancer EX มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">มิราจมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Mitsubishi Attrage มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Mitsubishi Triton มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Isuzu มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">ดีแม็กมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">MU-7 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">MU-X มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Isuzu Vega มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">ดราก้อนอายมือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Isuzu Elf มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Nissan มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">Nissan Teana มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Nissan Almera มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Nissan X-Trail มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">นิสสัน นาวาร่า NP300 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Nissan March มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Nissan Juke มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Bmw มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">BMW X1 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BMW 320D มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BMW 520D มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BMW X3 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BMW 320I มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">BMW Z4 มือสอง</a></li>
                                </ul>
                            </div>
                            <div class="col-3 box-linkcar">
                                <h2>ขายรถ Mercedes-Benz มือสอง สภาพดี</h2>
                                <ul>
                                    <li><a href="car.php" target="_blank">BMW X1 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Benz CLA250 AMG</a></li>
                                    <li><a href="car.php" target="_blank">Benz C350 มือสอง</a></li>
                                    <li><a href="car.php" target="_blank">Mercedes-Benz C250</a></li>
                                    <li><a href="car.php" target="_blank">Benz E300</a></li>
                                    <li><a href="car.php" target="_blank">Benz GLC 250</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 box-linkcarseo-mb box-linkcarseo">
                            <h2 class="txt-carseo-notfound">การค้นหายอดนิยม</h2>
                            <div class="owl-linkcarseo owl-carousel owl-theme">
                                <div class="box-linkcar">
                                    <h2>ขายรถ Toyota มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">ฟอร์จูนเนอร์มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">ยาริสมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">วีออสมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">วีโก้มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">คัมรี่มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Toyota commuter มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Honda มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">ซีวิคมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">ฮอนด้าแจ๊สมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">แอคคอร์ด มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">CR-V มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Honda City มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">HR-V มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Mazda มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">Mazda 3 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Mazda 2 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">CX-5 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">CX-3 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BT-50 PRO มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BT-50 มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Mitsubishi มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">Xpander มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Pajero Sport มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Lancer EX มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">มิราจมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Mitsubishi Attrage มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Mitsubishi Triton มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Isuzu มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">ดีแม็กมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">MU-7 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">MU-X มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Isuzu Vega มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">ดราก้อนอายมือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Isuzu Elf มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Nissan มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">Nissan Teana มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Nissan Almera มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Nissan X-Trail มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">นิสสัน นาวาร่า NP300 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Nissan March มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Nissan Juke มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Bmw มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">BMW X1 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BMW 320D มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BMW 520D มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BMW X3 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BMW 320I มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">BMW Z4 มือสอง</a></li>
                                    </ul>
                                </div>
                                <div class="box-linkcar">
                                    <h2>ขายรถ Mercedes-Benz มือสอง สภาพดี</h2>
                                    <ul>
                                        <li><a href="car.php" target="_blank">BMW X1 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Benz CLA250 AMG</a></li>
                                        <li><a href="car.php" target="_blank">Benz C350 มือสอง</a></li>
                                        <li><a href="car.php" target="_blank">Mercedes-Benz C250</a></li>
                                        <li><a href="car.php" target="_blank">Benz E300</a></li>
                                        <li><a href="car.php" target="_blank">Benz GLC 250</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                

                    
                </div>






                
            </div>
        </div>
    </div>
</section>



@endsection
@section('script')
<script>
    $(document).ready(function() {
        // Listen for change events on the orderby select box
        $('select[name="orderby"]').change(function() {
            var selectedValue = $(this).val();
            var currentUrl = window.location.href;

            // Check if there's already a query string in the URL
            if (currentUrl.includes('?')) {
                // If the orderby parameter already exists, replace it
                if (currentUrl.includes('orderby=')) {
                    currentUrl = currentUrl.replace(/(orderby=)[^\&]+/, '$1' + selectedValue);
                } else {
                    // Add the orderby parameter to the existing query string
                    currentUrl += '&orderby=' + selectedValue;
                }
            } else {
                // No query string exists, add the orderby parameter
                currentUrl += '?orderby=' + selectedValue;
            }

            // Redirect to the new URL
            window.location.href = currentUrl;
        });
    });
</script>

<script>
    $(document).ready(function() {
        // Listen for change events on the select box with id sel_showcash
        $('#sel_showcash').change(function() {
            var selectedValue = $(this).val();

            if (selectedValue === 'cash') {
                // Show cash prices and hide finance prices
                $('.caritem-price-cash').show();
                $('.caritem-price-finance').hide();
            } else if (selectedValue === 'finance') {
                // Show finance prices and hide cash prices
                $('.caritem-price-finance').show();
                $('.caritem-price-cash').hide();
            }
        });

        // Trigger the change event on page load to set the correct state
        $('#sel_showcash').trigger('change');
    });
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
        var priceOptions = @json($priceOptions);

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

            // Determine the cash type (สด or ผ่อน) based on the current view
            var cashType = isMobile
                ? $('.tab_footer_btn .active').text().trim() === "ราคาซื้อสด" ? 'cash' : 'finance'
                : $('.tab_article_btn .active').text().trim() === "ราคาซื้อสด" ? 'cash' : 'finance';

            // Function to find the numeric value based on the label
            function findPriceValue(label) {
                let found = priceOptions.find(option => option.label === label);
                return found ? found.value : 0;
            }

            // Convert price values to numbers using the labels
            priceMinimum = findPriceValue(priceMinimum);
            priceMaximum = findPriceValue(priceMaximum);

            // Ensure that min_year is less than or equal to max_year
            if (parseInt(yearStart) > parseInt(yearEnd)) {
                [yearStart, yearEnd] = [yearEnd, yearStart];
            }

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
                if (province && province !== 'จังหวัด') {
                    url += '/' + encodeURIComponent(province);
                }

                // Construct query parameters
                var queryParams = [];

                // Add the cash type to the query string
                if (cashType) {
                    queryParams.push('cashtype=' + encodeURIComponent(cashType));
                }

                // Add price filters based on the cash type
                if (cashType === 'cash') {
                    if (priceMinimum) {
                        queryParams.push('min_price=' + encodeURIComponent(priceMinimum));
                    }
                    if (priceMaximum) {
                        queryParams.push('max_price=' + encodeURIComponent(priceMaximum));
                    }
                } else if (cashType === 'finance') {
                    if (monthlyPayment) {
                        queryParams.push('monthly=' + encodeURIComponent(monthlyPayment));
                    }
                }

                // Add other filters to the query string if they are present
                if (isEVChecked) {
                    queryParams.push('ev=yes');
                }
                if (yearStart) {
                    queryParams.push('min_year=' + encodeURIComponent(yearStart));
                }
                if (yearEnd) {
                    queryParams.push('max_year=' + encodeURIComponent(yearEnd));
                }
                if (color && color !== 'สี') {
                    queryParams.push('color=' + encodeURIComponent(color));
                }
                if (gear && gear !== 'empty') {
                    queryParams.push('gear=' + encodeURIComponent(gear));
                }
                if (gas && gas !== '') {
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
<script>
    // Ensure images are responsive within the box
    document.querySelectorAll('.box-car-article img').forEach(img => {
        img.style.maxWidth = '100%';
        img.style.height = 'auto';
    });
</script>

@endsection




