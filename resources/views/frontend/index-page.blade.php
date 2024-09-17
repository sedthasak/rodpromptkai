@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - Home</title>
@endsection

@section('content')
<?php
$arr_gear = array(
    'auto' => 'เกียร์อัตโนมัติ',
    'manual' => 'เกียร์ธรรมดา',
);
?>
<section class="row">
    <div class="col-12 col-xl-9 wrapbanner wow fadeInDown">
        <div class="owl-bannerslide owl-carousel owl-theme">
            @foreach($slide as $sld)
                <div class="items">
                    <a href="{{ asset($sld->link) }}" target="_blank">
                        <figure><img src="{{ asset($sld->image) }}" alt=""></figure>
                    </a>
                    
                </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-xl-3 box-search-car">
        <div class="bg-searchcar">
            <div class="topic-carsearch"><img class="svg" src="{{ asset('frontend/images/carred.svg') }}" alt=""> ค้นหารถยนต์</div>
            <span class="short-desc-search">ค้นหารถมือสอง รถใหม่ ราคาโดนใจในรถพร้อมขายกับเรา</span>
            <div class="carsearch-input">
                <input type="text" readonly value="ยี่ห้อรถ">
            </div>
            <div class="home-popup-search">@include('frontend.layouts.inc-popup-carsearch')</div>

            <!-- Budget section -->
            <div class="wrap-budget">
                <a href="#" class="btn-budget">งบประมาณที่ต้องการ <img src="{{ asset('frontend/images/icon-chev-white.svg') }}" alt=""></a>
                <div class="box-budget">
                    <h2>งบประมาณที่ต้องการ</h2>
                    <div class="tab_article_btn">
                        <div class="active btn-default">ราคาซื้อสด</div>
                        <div class="btn-default">จัดไฟแนนซ์</div>
                    </div>
                    <div>
                        <div class="tab_pdetail">
                            <div class="price-select-wrap">
                                <div class="box-inputyear">
                                    <input type="text" readonly class="price-select-value" placeholder="ราคา">
                                </div>
                                <div class="price-select-dropdown">
                                    <div class="price-select-input-flex">
                                        <input type="text" class="price-select-input price-minimum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ต่ำสุด">
                                        <span>-</span>
                                        <input type="text" class="price-select-input price-maximum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="สูงสุด">
                                        <ul class="price-select-option price-minimum">
                                            @foreach ($priceOptions as $option)
                                                <li data-value="{{ $option['value'] }}">{{ $option['label'] }}</li>
                                            @endforeach
                                        </ul>
                                        <ul class="price-select-option price-maximum">
                                            @foreach ($priceOptions as $option)
                                                <li data-value="{{ $option['value'] }}">{{ $option['label'] }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="box-submit-select">
                                <button class="advance-exit btn-searchcar">ยืนยัน</button>
                            </div>
                        </div>
                        <div class="tab_pdetail">
                            <div class="sel">
                                <select id="installment-select">
                                    <option value="">เลือกราคาผ่อนต่อเดือน</option>
                                    <option value="3000">ต่ำกว่า 3,000 บาท</option>
                                    <option value="5000">ต่ำกว่า 5,000 บาท</option>
                                    <option value="10000">ต่ำกว่า 10,000 บาท</option>
                                    <option value="15000">ต่ำกว่า 15,000 บาท</option>
                                    <option value="20000">ต่ำกว่า 20,000 บาท</option>
                                    <option value="30000">ต่ำกว่า 30,000 บาท</option>
                                    <option value="35000">ต่ำกว่า 35,000 บาท</option>
                                    <option value="40000">ต่ำกว่า 40,000 บาท</option>
                                    <option value="40000+">ผ่อนได้มากกว่า 40,000 บาท</option>
                                </select>
                            </div>
                            <div class="box-submit-select">
                                <button class="advance-exit btn-searchcar">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Year select section -->
            <div class="year-select-wrap">
                <div class="box-inputyear">
                    <input type="text" readonly class="year-select-value" placeholder="ปีเริ่มต้น - ปีสิ้นสุด">
                </div>
                <div class="year-select-dropdown">
                    <div class="year-select-input-flex">
                        <input type="text" class="year-select-input year-minimum" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ปีเริ่มต้น">
                        <span>-</span>
                        <input type="text" class="year-select-input year-maximum" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ปีสิ้นสุด">
                        <ul class="year-select-option year-minimum">
                            @php
                                $currentYear = date('Y');
                                $startYear = $currentYear - 16;
                            @endphp
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                                <li>{{ $year }}</li>
                            @endfor
                        </ul>
                        <ul class="year-select-option year-maximum">
                            @for ($year = $currentYear; $year >= $startYear; $year--)
                                <li>{{ $year }}</li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
            
            <!-- Advanced search section -->
            <div class="wrap-boxadvance">
                <a href="#" class="btn-advancesearch">ค้นหารถยนต์แบบละเอียด <img src="{{ asset('frontend/images/chevron-red.svg') }}" alt=""></a>
                <div class="box-advancesearch">
                    <div class="box-advancesearch-head">
                        <span>ค้นหารถยนต์แบบละเอียด</span>
                        <button class="advance-exit">ยกเลิก</button>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <select id="province-select" class="form-select">
                                <option>จังหวัด</option>
                                @foreach ($province as $isprovince)
                                    <option value="{{ $isprovince->name_th }}">{{ $isprovince->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <select id="color-select" class="form-select">
                                <option>สี</option>
                                <option value="ขาว">ขาว</option>
                                <option value="เขียว">เขียว</option>
                                <option value="ครีม">ครีม</option>
                                <option value="ชมพู">ชมพู</option>
                                <option value="ดำ">ดำ</option>
                                <option value="แดง">แดง</option>
                                <option value="เทา">เทา</option>
                                <option value="น้ำเงิน">น้ำเงิน</option>
                                <option value="น้ำตาล">น้ำตาล</option>
                                <option value="บรอนซ์เงิน">บรอนซ์เงิน</option>
                                <option value="บรอนซ์ทอง">บรอนซ์ทอง</option>
                                <option value="ฟ้า">ฟ้า</option>
                                <option value="ม่วง">ม่วง</option>
                                <option value="ส้ม">ส้ม</option>
                                <option value="เหลือง">เหลือง</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <div class="advance-boxgear">
                                <div>เกียร์</div>
                                <div>
                                    <label><input type="radio" name="advance-gear" value="auto"> <span>อัตโนมัติ</span></label>
                                    <label><input type="radio" name="advance-gear" value="manual"> <span>ธรรมดา</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-9 col-xl-12">
                            <select id="fuel-select" class="form-select">
                                <option value="">เลือกเชื้อเพลิง</option>
                                <option value="1">รถน้ำมัน / hybrid</option>
                                <option value="2">รถไฟฟ้า EV 100%</option>
                                <option value="3">รถติดแก๊ส</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-3 col-xl-12">
                            <a href="#" class="btn-submitsearch btn-searchcar">ยืนยัน</a>
                        </div>
                    </div>
                </div>

                <div class="boxshow-advance">
                    <button class="btn-resetsearch"><img src="{{ asset('frontend/images/icon-reset-white.svg') }}" alt="">ล้าง</button>
                </div>

                <a href="#" class="btn-searchcar index_searchcar">ค้นหารถยนต์</a>
            </div>
        </div>
    </div>
</section>


<section class="row wow fadeInDown">
    <div class="col-12 col-lg-4 col-xl-3 bg-findcar">
        <div class="desc-findcar">
            <div class="topic-findcar">
                <img class="svg" src="{{ asset('frontend/images/icon-carred.svg') }}" alt=""> ช่วยคุณหารถที่ใช่
            </div>
            <p>ให้รถพร้อมขายช่วยหารถให้คุณ</p>
            <a data-fancybox data-src="#help-carsearch" href="javascript:;">คลิกเลย <i class="bi bi-chat-text-fill"></i></a>
        </div>
    </div>
    <div class="col-12 col-lg-8 col-xl-9 bg-carslide">
        <div class="box-carslide">
            <div class="owl-carslide owl-carousel owl-theme">
                @foreach($categories as $cate)
                <div class="items">
                    <a href="{{ route('carsearchPage').'/'.$cate->name }}"><figure><img src="{{ asset($cate->feature) }}" alt=""></figure></a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-12 home-bestsearch wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 box-topichome">
                    <h3 class="topic-home"><i class="bi bi-circle-fill"></i> รถที่ถูกค้นหามากที่สุด</h3>
                    <a href="{{ route('carPage') }}" class="btn-red">ดูทั้งหมด</a>
                </div>
                <div class="col-12">
                    <div class="owl-bestsearch owl-carousel owl-theme">
                        @foreach($topCarsByClickcount as $car1)
                        <a href="{{ route('cardetailPage', ['slug' => $car1->slug]) }}" class="item-car">
                            <figure>
                                <div class="cover-car"><img src="{{ ($car1->feature)?asset('storage/' . $car1->feature):asset('public/uploads/default-car.jpg') }}" alt=""></div>
                                <figcaption>
                                    <div class="car-name">{{ $car1->modelyear." ".$car1->brand->title." ".$car1->model->model }}</div>
                                    <div class="car-series">{{ $car1->generation->generations." ".$car1->subModel->sub_models }}</div>
                                    <div class="car-province">{{ $car1->province ?? "-" }}</div>
                                    <div class="row">
                                        <div class="col-8 col-xl-9">
                                            <div class="descpro-car">{{ $car1->title }}</div>
                                        </div>
                                        <div class="col-4 col-xl-3 text-end">
                                            <div class="txt-readmore">ดูเพิ่มเติม</div>
                                        </div>
                                    </div>
                                    <div class="linecontent"></div>
                                    <div class="row caritem-price">
                                        <div class="col-6">
                                            <div class="txt-gear"><img src="{{ asset('frontend/images/icon-kear.svg') }}" alt=""> {{ $arr_gear[$car1->gear] ?? '' }}</div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="car-price">{{ number_format($car1->price, 0, '.', ',') }}.-</div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="box-sessioncar">
    <div class="sessioncar-order2">
        <section class="row">
            <div class="col-12 bghome-item">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="numbers wow fadeInLeft">
                                <div class="photocar-number">
                                    <img src="{{ asset('frontend/images/Isolation_Mode.svg') }}" alt="">
                                </div>
                                <div class="box-itemnum">
                                    <div class="item-num">
                                        จำนวนรถมาใหม่ <div class="txt-num">{{$carCountLast7Days}}</div>
                                    </div>
                                    <div class="item-num">
                                        จำนวนรถทั้งหมด <div class="txt-num">{{ $allcarcount }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="homeitem-button wow fadeInRight">
                                <div class="txt-homeitem">
                                    <div class="topic-homeitem"><img src="{{ asset('frontend/images/icon-carred.svg') }}" class="svg" alt=""> รถยนต์แบบไหนที่เหมาะกับฉัน?</div>
                                    <div>ให้เราช่วยคุณค้นหารถที่ใช่ตามความต้องการของคุณ</div>
                                </div>
                                <a data-fancybox data-src="#help-carsearch" href="javascript:;" class="btn-red">ค้นหารถยนต์</a>
                            </div>
                        </div>
                    </div>
                    <div class="row row-item-postcar wow fadeInDown">
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{ route('postcarwelcomePage') }}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{ asset('frontend/images/TEM-31-fade.jpg') }}" alt=""></div>
                                    <figcaption>
                                        <h3>ลงขายรถของคุณ ฟรี!</h3>
                                        <p>รถมือเดียว รถบ้านเจ้าของขายเอง</p>
                                        <div class="btn-itempostcar btn-itempostcar-home">ลงขายสำหรับรถบ้าน <img src="{{ asset('frontend/images/chevron.svg') }}" class="svg" alt=""></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{ route('postcarwelcomedealerPage') }}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{ asset('frontend/images/TEM-41-fade.jpg') }}" alt=""></div>
                                    <figcaption>
                                        <h3>ลงขายสำหรับดีลเลอร์</h3>
                                        <p>เต็นท์รถที่น่าเชื่อถือ มีรับประกัน ขับได้สบายใจ</p>
                                        <div class="btn-itempostcar btn-itempostcar-dealer">ลงขายสำหรับดีลเลอร์ <img src="{{ asset('frontend/images/chevron.svg') }}" class="svg" alt=""></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{ route('postcarwelcomeladyPage') }}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{ asset('frontend/images/TEM-51-fade.jpg') }}" alt=""></div>
                                    <figcaption>
                                        <h3>คุณผู้หญิงลงขายรถ</h3>
                                        <p>เจ้าของเล่มรถเป็นผู้หญิง จอดมากกว่าขับ</p>
                                        <div class="btn-itempostcar btn-itempostcar-lady">ลงขายสำหรับคุณผู้หญิง <img src="{{ asset('frontend/images/chevron.svg') }}" class="svg" alt=""></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <div class="sessioncar-order1">
        <section class="row wow fadeInDown">
            <div class="col-12 home-newcar">
                <div class="container">
                    <div class="row">
                        <div class="col-12 bg-number">
                            <div class="numbers wow fadeInLeft">
                                <div class="photocar-number">
                                    <img src="{{ asset('frontend/images/Isolation_Mode.svg') }}" alt="">
                                </div>
                                <div class="box-itemnum">
                                    <div class="item-num">
                                        จำนวนรถมาใหม่ <div class="txt-num">{{$carCountLast7Days}}</div>
                                    </div>
                                    <div class="item-num">
                                        จำนวนรถทั้งหมด <div class="txt-num">{{ $allcarcount }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 box-topichome">
                            <h3 class="topic-home"><i class="bi bi-circle-fill"></i> รถมาใหม่</h3>
                            <a href="#" class="btn-red">ดูทั้งหมด</a>
                        </div>
                    </div>
                    <div class="row row-itemcar">
                        @foreach($allcars6 as $post6post)
                        <div class="col-6 col-md-4 col-itemcar">
                            <a href="{{ route('cardetailPage', ['slug' => $post6post->slug]) }}" class="item-car">
                                <figure>
                                    <div class="cover-car">
                                        <div class="tag-newcar"><img src="{{ asset('frontend/images/icon-tagnew.svg') }}" alt=""> รถมาใหม่</div>
                                        <img src="{{ ($post6post->feature)?asset('storage/' . $post6post->feature):asset('public/uploads/default-car.jpg') }}" alt="">
                                    </div>
                                    <figcaption>
                                        <div class="car-name">{{ $post6post->modelyear." ".$post6post->brand->title." ".$post6post->model->model }}</div>
                                        <div class="car-series">{{ $post6post->generation->generations." ".$post6post->subModel->sub_models }}</div>
                                        <div class="car-province">{{ $post6post->province ?? "-" }}</div>
                                        <div class="row">
                                            <div class="col-12 col-md-8 col-xl-9">
                                                <div class="descpro-car">{{ $post6post->title }}</div>
                                            </div>
                                            <div class="col-12 col-md-4 col-xl-3 text-end">
                                                <div class="txt-readmore">ดูเพิ่มเติม</div>
                                            </div>
                                        </div>
                                        <div class="linecontent"></div>
                                        <div class="row caritem-price">
                                            <div class="col-12 col-md-6">
                                                <div class="txt-gear"><img src="{{ asset('frontend/images/icon-kear.svg') }}" alt=""> {{ $arr_gear[$post6post->gear] ?? '' }}</div>
                                            </div>
                                            <div class="col-12 col-md-6 text-end">
                                                <div class="car-price">{{ number_format($post6post->price, 0, '.', ',') }}.-</div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
    </div>
</section>

@if($news->isNotEmpty())
<section class="row">
    <div class="col-12 home-news wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 box-topichome">
                    <h3 class="topic-home"><i class="bi bi-circle-fill"></i> อัพเดทข่าวยานยนต์</h3>
                    <a href="{{ route('newsPage') }}" class="btn-red">ดูทั้งหมด</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-xl-6 home-news-lg">
                    <a href="{{ route('newsdetailPage', ['slug' => $news[0]->slug]) }}" class="home-itemnews">
                        <figure>
                            <div class="cover-news">
                                <img src="{{ $news[0]->feature ? asset($news[0]->feature) : asset('public/uploads/default-car.jpg') }}" alt="">
                            </div>
                            <figcaption>
                                <div class="item-topicnews">{{ $news[0]->title }}</div>
                                <div class="news-date"><i class="bi bi-calendar3"></i> {{ $news[0]->created_at->format('d M Y H:i') }}</div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="row">
                        @foreach($news->skip(1) as $newsres)
                        <div class="col-6">
                            <a href="{{ route('newsdetailPage', ['slug' => $newsres->slug]) }}" class="home-itemnews">
                                <figure>
                                    <div class="cover-news">
                                        <img src="{{ $newsres->feature ? asset($newsres->feature) : asset('public/uploads/default-car.jpg') }}" alt="">
                                    </div>
                                    <figcaption>
                                        <div class="item-topicnews">{{ $newsres->title }}</div>
                                        <div class="news-date"><i class="bi bi-calendar3"></i> {{ $newsres->created_at->format('d M Y H:i') }}</div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

@include('frontend.layouts.inc_carseo')	

<div style="display: none;" id="help-carsearch">
    <div class="frm-helpcarsearch">
        <div class="topic-helpcar"><img src="{{ asset('frontend/images/carred.svg') }}" alt="" class="svg"> ช่วยคุณหารถที่ใช่</div>
        <p>ให้รถพร้อมขายช่วยหารถให้คุณ</p>
        <form method="post" action="{{ route('helpcaractionPage') }}">
            @csrf
            <input type="hidden" name="customer_id" value="{{ session('customer')->id ?? '' }}">
            <input type="text" class="form-control" name="name" value="" placeholder="ชื่อ - นามสกุล">
            <input type="text" class="form-control" name="tel" value="" placeholder="เบอร์โทรติดต่อ">
            <input type="text" class="form-control" name="line" value="" placeholder="Line ID">
            <input type="text" class="form-control" name="messages" value="" placeholder="รุ่นรถที่ต้องการ">
            <button type="submit" class="btn-red">ส่งข้อมูล</button>
        </form>
    </div>
</div>

@endsection

@section('script')
<!-- Desktop and General Script -->
<script>
    $(document).ready(function() {
        var priceOptions = @json($priceOptions);

        // Function to update the .boxshow-advance section based on selected filters
        function updateAdvanceBox() {
            const province = $('#province-select').val();
            const color = $('#color-select').val();
            const gear = $('input[name="advance-gear"]:checked').val();
            const fuel = $('#fuel-select').val();

            // Clear existing buttons except reset button
            $('.boxshow-advance').find('button:not(.btn-resetsearch)').remove();

            let hasFilters = false;

            // Check if any of the inputs have a valid value and update the boxshow-advance
            if (province && province !== 'จังหวัด') {
                const provinceButton = $('<button type="button" data-input="province-select">' + province + ' <i class="bi bi-x"></i></button>');
                provinceButton.on('click', function() { removeFilter(provinceButton, '#province-select', 'จังหวัด'); });
                $('.boxshow-advance').append(provinceButton);
                hasFilters = true;
            }

            if (color && color !== 'สี') {
                const colorButton = $('<button type="button" data-input="color-select">' + color + ' <i class="bi bi-x"></i></button>');
                colorButton.on('click', function() { removeFilter(colorButton, '#color-select', 'สี'); });
                $('.boxshow-advance').append(colorButton);
                hasFilters = true;
            }

            if (gear) {
                let gearText = gear === 'auto' ? 'เกียร์อัตโนมัติ' : 'เกียร์ธรรมดา';
                const gearButton = $('<button type="button" data-input="advance-gear">' + gearText + ' <i class="bi bi-x"></i></button>');
                gearButton.on('click', function() { removeFilter(gearButton, 'input[name="advance-gear"]', null); });
                $('.boxshow-advance').append(gearButton);
                hasFilters = true;
            }

            if (fuel) {
                let fuelText = fuel == '1' ? 'รถน้ำมัน / hybrid' : fuel == '2' ? 'รถไฟฟ้า EV 100%' : 'รถติดแก๊ส';
                const fuelButton = $('<button type="button" data-input="fuel-select">' + fuelText + ' <i class="bi bi-x"></i></button>');
                fuelButton.on('click', function() { removeFilter(fuelButton, '#fuel-select', ''); });
                $('.boxshow-advance').append(fuelButton);
                hasFilters = true;
            }

            // Show or hide the .boxshow-advance based on whether any filters are active
            if (hasFilters) {
                $('.boxshow-advance').show();
            } else {
                $('.boxshow-advance').hide();
            }
        }

        // Function to remove individual filters and update the corresponding inputs
        function removeFilter(button, selector, defaultOption) {
            button.remove();
            if (selector.startsWith('input')) {
                $(selector).prop('checked', false);
            } else {
                $(selector).val(defaultOption);
            }
            updateAdvanceBox();
        }

        $('#province-select, #color-select, #fuel-select').change(updateAdvanceBox);
        $('input[name="advance-gear"]').change(updateAdvanceBox);

        $('.btn-resetsearch').click(function() {
            $('.boxshow-advance').find('button:not(.btn-resetsearch)').remove();
            $('#province-select').val('จังหวัด');
            $('#color-select').val('สี');
            $('input[name="advance-gear"]').prop('checked', false);
            $('#fuel-select').val('');
            $('.boxshow-advance').hide();
        });

        $('.box-search-car .btn-budget').click(function(event) {
            if ($(".box-search-car .box-budget").is(":hidden")) {
                $(".box-search-car .box-budget").effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.preventDefault();
        });

        $('.box-search-car .advance-exit').click(function(event) {
            $(".box-search-car .box-budget").effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });

        $('.index_searchcar').click(function(e) {
            e.preventDefault();

            var isMobile = $(this).closest('.my-box-search-mobile').length > 0;

            var getBrandNameUrl = "{{ route('getBrandName', ['id' => ':id']) }}";
            var getModelNameUrl = "{{ route('getModelName', ['id' => ':id']) }}";
            var getGenerationNameUrl = "{{ route('getGenerationName', ['id' => ':id']) }}";
            var getSubmodelNameUrl = "{{ route('getSubmodelName', ['id' => ':id']) }}";

            var isEVChecked = isMobile ? $('input[name="ev_mobile"]').is(':checked') : $('input[name="ev"]').is(':checked');
            const brandId = brand_id;
            const modelId = model_id;
            const generationId = generation_id;
            const submodelId = submodel_id;

            var brandName = '';
            var modelName = '';
            var generationName = '';
            var submodelName = '';
            var province = isMobile ? $('select[name="province_mobile"]').val() : $('#province-select').val();
            var color = isMobile ? $('select[name="color_mobile"]').val() : $('#color-select').val();
            var gear = isMobile ? $('input[name="advance-gear-mobile"]:checked').val() : $('input[name="advance-gear"]:checked').val();
            var fuel = isMobile ? $('select[name="gas_mobile"]').val() : $('#fuel-select').val();

            var priceMinimum = isMobile ? $('input[name="price_minimum_mobile"]').val() : $('.price-minimum').val();
            var priceMaximum = isMobile ? $('input[name="price_maximum_mobile"]').val() : $('.price-maximum').val();
            var monthlyPayment = isMobile ? $('.tab_footer select[name="installment_price_mobile"]').val() : $('#installment-select').val();
            var yearStart = isMobile ? $('.year-select-input.year-minimum').val() : $('.year-minimum').val();
            var yearEnd = isMobile ? $('.year-select-input.year-maximum').val() : $('.year-maximum').val();

            var cashType = $('.tab_article_btn .active').text().trim() === "ราคาซื้อสด" ? 'cash' : 'finance';

            function findPriceValue(label) {
                let found = priceOptions.find(option => option.label === label);
                return found ? found.value : 0;
            }

            priceMinimum = findPriceValue(priceMinimum);
            priceMaximum = findPriceValue(priceMaximum);

            if (parseInt(yearStart) > parseInt(yearEnd)) {
                [yearStart, yearEnd] = [yearEnd, yearStart];
            }

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

                var queryParams = [];

                if (cashType) {
                    queryParams.push('cashtype=' + encodeURIComponent(cashType));
                }

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
                if (fuel && fuel !== '') {
                    queryParams.push('fuel_type=' + encodeURIComponent(fuel));
                }

                if (queryParams.length > 0) {
                    url += '?' + queryParams.join('&');
                }

                window.location.href = url;
            }

            fetchNamesAndRedirect();
        });

        if ($('.boxshow-advance button').length <= 1) {
            $('.boxshow-advance').hide();
        }
    });
</script>

<!-- Mobile-Specific Script -->
<script>
    $(document).ready(function() {
        var priceOptions = @json($priceOptions);

        $('.btn-searchcar').click(function(e) {
            e.preventDefault();

            var isMobile = $(this).closest('.my-box-search-mobile').length > 0;

            if (!isMobile) {
                return;
            }

            var getBrandNameUrl = "{{ route('getBrandName', ['id' => ':id']) }}";
            var getModelNameUrl = "{{ route('getModelName', ['id' => ':id']) }}";
            var getGenerationNameUrl = "{{ route('getGenerationName', ['id' => ':id']) }}";
            var getSubmodelNameUrl = "{{ route('getSubmodelName', ['id' => ':id']) }}";

            var isEVChecked = $('input[name="ev_mobile"]').is(':checked');
            const brandId = brand_id;
            const modelId = model_id;
            const generationId = generation_id;
            const submodelId = submodel_id;

            var brandName = '';
            var modelName = '';
            var generationName = '';
            var submodelName = '';
            var province = $('select[name="province_mobile"]').val();
            var color = $('select[name="color_mobile"]').val();
            var gear = $('input[name="advance-gear-mobile"]:checked').val();
            var gas = $('select[name="gas_mobile"]').val();

            var priceMinimum = $('input[name="price_minimum_mobile"]').val();
            var priceMaximum = $('input[name="price_maximum_mobile"]').val();
            var monthlyPayment = $('.tab_footer select[name="installment_price_mobile"]').val();
            var yearStart = $('.year-select-input.year-minimum').val();
            var yearEnd = $('.year-select-input.year-maximum').val();

            var cashType = $('.tab_footer_btn .active').text().trim() === "ราคาซื้อสด" ? 'cash' : 'finance';

            function findPriceValue(label) {
                let found = priceOptions.find(option => option.label === label);
                return found ? found.value : 0;
            }

            priceMinimum = findPriceValue(priceMinimum);
            priceMaximum = findPriceValue(priceMaximum);

            if (parseInt(yearStart) > parseInt(yearEnd)) {
                [yearStart, yearEnd] = [yearEnd, yearStart];
            }

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

                var queryParams = [];

                if (cashType) {
                    queryParams.push('cashtype=' + encodeURIComponent(cashType));
                }

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

                if (queryParams.length > 0) {
                    url += '?' + queryParams.join('&');
                }

                window.location.href = url;
            }

            fetchNamesAndRedirect();
        });
    });
</script>













<!-- Additional custom scripts -->
<!-- <script>
    $(document).ready(function() {
        $('.box-search-car .btn-budget').click(function (event) {
            if (  $( ".box-search-car .box-budget" ).is( ":hidden" ) ) {
                $( ".box-search-car .box-budget" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.preventDefault();
        });

        $('.box-search-car .advance-exit').click(function (event) {
            $( ".box-search-car .box-budget" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });
    });
    // function submit1() {
    //     var province = $('#province').find('option:selected').text();
    //     if ($('#province').text() !== "จังหวัด" && $('#province').val() !== "" && $('#province').val() !== "จังหวัด") {
    //         var newButton = $('<button type="button" onclick="del(this)">'+province+' <i class="bi bi-x"></i></button>');
    //         $('.boxshow-advance').append(newButton);
    //     }

    //     if($('#color').val() !== "") {
    //         var newButton = $('<button type="button" onclick="del(this)">'+$('#color').val()+' <i class="bi bi-x"></i></button>');
    //         $('.boxshow-advance').append(newButton);
    //     }

    //     if($("input[name='gear']").val() !== "") {
    //         var newButton;
    //         if ($("input[name='gear']").val() === "auto") {
    //             newButton = $('<button type="button" onclick="del(this)">เกียร์อัตโนมัติ <i class="bi bi-x"></i></button>');
    //         }

    //         if ($("input[name='gear']").val() === "manual") {
    //             newButton = $('<button type="button" onclick="del(this)">เกียร์ธรรมดา<i class="bi bi-x"></i></button>');
    //         }
    //         $('.boxshow-advance').append(newButton);
    //     }

    //     if($('#power').val() !== "") {
    //         var newButton;
    //         if ($('#power').val() == 1) {
    //             newButton = $('<button type="button" onclick="del(this)">รถน้ำมัน / hybrid <i class="bi bi-x"></i></button>');
    //         }
    //         if ($('#power').val() == 2) {
    //             newButton = $('<button type="button" onclick="del(this)">รถไฟฟ้า EV 100% <i class="bi bi-x"></i></button>');
    //         }
    //         if ($('#power').val() == 3) {
    //             newButton = $('<button type="button" onclick="del(this)">รถติดแก๊ส <i class="bi bi-x"></i></button>');
    //         }
    //         $('.boxshow-advance').append(newButton);
    //     }
    // }

    // function province(data){
    //     console.log($(data).find('option:selected').text());
    // }

    // function del(data){
    //     $(data).remove();
    // }

    // function delall(){
    //     $('.boxshow-advance').find('button:not(.btn-resetsearch)').remove();
    //     $('.boxshow-advance').show();
    // }

    // function search4() {
    //     $('input[name="brand_id"]').val(brand_id);
    //     $('input[name="model_id"]').val(model_id);
    //     $('input[name="generation_id"]').val(generation_id);
    //     $('input[name="submodel_id"]').val(submodel_id);
    //     $('input[name="pricelow"]').val($('.pricelow').text().replace(/,/g, ''));
    //     $('input[name="pricehigh"]').val($('.pricehigh').text().replace(/,/g, ''));
    //     $('input[name="yearlow"]').val($('.yearlow').text());
    //     $('input[name="yearhigh"]').val($('.yearhigh').text());
    //     $('#my_form').submit();
    // }

    // $(document).ready(function() {
    //     testScroll();
    //     $(window).scroll(testScroll);
    //     var viewedth = false;
    //     var viewedvn = false;
    //     function isScrolledIntoView(elem) {
    //         var docViewTop = $(window).scrollTop();
    //         var docViewBottom = docViewTop + $(window).height();
    //         var elemTop = $(elem).offset().top;
    //         var elemBottom = elemTop + $(elem).height();
    //         return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
    //     }

    //     function testScroll() {
    //         if (isScrolledIntoView($(".numbers")) && !viewedth) {
    //             viewedth = true;
    //             $('.numbers').find('.txt-num').not('.active').each(function () {
    //                 $(this).prop('Counter',0).addClass('active').animate({
    //                     Counter: $(this).text()
    //                 }, {
    //                     duration: 1500,
    //                     easing: 'swing',
    //                     step: function (now) {
    //                         $(this).text(Math.ceil(now));
    //                     }
    //                 });
    //             });
    //         }
    //     }
    // });

    
</script> -->

@endsection
