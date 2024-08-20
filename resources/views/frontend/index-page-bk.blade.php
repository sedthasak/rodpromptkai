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
// $tel = '0998741070';
// $SixDigitRandomNumber = rand(100000,999999);
// $message = $SixDigitRandomNumber.$tel;

// echo "<pre>";
// print_r($slide);
// echo "</pre>";
// echo "<pre>";
// print_r($SixDigitRandomNumber);
// echo "</pre>";
// echo "<pre>";
// print_r($allcarcount);
// echo "</pre>";
// echo "<pre>";
// print_r($cars);
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 col-xl-9 wrapbanner wow fadeInDown">
        <div class="owl-bannerslide owl-carousel owl-theme">
            @foreach($slide as $keyslide => $sld)
            <div class="items">
                <figure><img src="{{asset($sld->image)}}" alt=""></figure>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-12 col-xl-3 box-search-car">
        <div class="bg-searchcar">
            <div class="topic-carsearch"><img class="svg" src="images/icon-carred.svg" alt=""> ค้นหารถยนต์</div>
            <span class="short-desc-search">ค้นหารถมือสอง รถใหม่ ราคาโดนใจในรถพร้อมขายกับเรา</span>
            <div class="carsearch-input">
                <input type="text" readonly value="ยี่ห้อรถ">
            </div>
            <div class="home-popup-search">@include('frontend.layouts.inc-popup-carsearch')</div> 
            
            <!-- เพิ่มใหม่ -->
            <div class="wrap-budget">
                <a href="#" class="btn-budget">งบประมาณที่ต้องการ <img src="images/icon-chev-white.svg" alt=""></a>
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
                                            <li>1,000 บาท</li>
                                            <li>2,000 บาท</li>
                                            <li>3,000 บาท</li>
                                            <li>4,000 บาท</li>
                                            <li>5,000 บาท</li>
                                        </ul>
                                        <ul class="price-select-option price-maximum">
                                            <li>1,000 บาท</li>
                                            <li>2,000 บาท</li>
                                            <li>3,000 บาท</li>
                                            <li>4,000 บาท</li>
                                            <li>5,000 บาท</li>
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
                                <select>
                                    <option value="">เลือกราคาผ่อนต่อเดือน</option>
                                    <option value="">ต่ำกว่า 3,000 บาท</option>
                                    <option value="">ต่ำกว่า 5,000 บาท</option>
                                    <option value="">ต่ำกว่า 10,000 บาท</option>
                                    <option value="">ต่ำกว่า 15,000 บาท</option>
                                    <option value="">ต่ำกว่า 20,000 บาท</option>
                                    <option value="">ต่ำกว่า 30,000 บาท</option>
                                    <option value="">ต่ำกว่า 35,000 บาท</option>
                                    <option value="">ต่ำกว่า 40,000 บาท</option>
                                    <option value="">ผ่อนได้มากกว่า 40,000 บาท</option>
                                </select>
                            </div>
                            <div class="box-submit-select">
                                <button class="advance-exit btn-searchcar">ยืนยัน</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
                            <li>2024</li>
                            <li>2023</li>
                            <li>2022</li>
                            <li>2021</li>
                            <li>2020</li>
                        </ul>
                        <ul class="year-select-option year-maximum">
                            <li>2024</li>
                            <li>2023</li>
                            <li>2022</li>
                            <li>2021</li>
                            <li>2020</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- เพิ่มใหม่ -->
            
            <div class="wrap-boxadvance">
                <a href="#" class="btn-advancesearch">ค้นหารถยนต์แบบละเอียด <img src="images/chevron-red.svg" alt=""></a>
                <div class="box-advancesearch">
                    <div class="box-advancesearch-head">
                        <span>ค้นหารถยนต์แบบละเอียด</span>
                        <button class="advance-exit">ยกเลิก</button>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <select name="" id="" class="form-select">
                                <option>จังหวัด</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <select name="" id="" class="form-select">
                                <option>สี</option>
                                <option>ทุกสี</option>
                                <option>ขาว</option>
                                <option>เขียว</option>
                                <option>ครีม</option>
                                <option>ชมพู</option>
                                <option>ดำ</option>
                                <option>แดง</option>
                                <option>เทา</option>
                                <option>น้ำเงิน</option>
                                <option>น้ำตาล</option>
                                <option>บรอนซ์เงิน</option>
                                <option>บรอนซ์ทอง</option>
                                <option>ฟ้า</option>
                                <option>ม่วง</option>
                                <option>ส้ม</option>
                                <option>เหลือง</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4 col-xl-12">
                            <div class="advance-boxgear">
                                <div>เกียร์</div>
                                <div>
                                    <label><input type="radio" name="advance-gear"> <span>อัตโนมัติ</span></label>
                                    <label><input type="radio" name="advance-gear"> <span>ธรรมดา</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-9 col-xl-12">
                            <select name="" id="" class="form-select">
                                <option>แก๊ส</option>
                                <option>ติดแก๊ส</option>
                                <option>ไม่ติดแก๊ส</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-3 col-xl-12">
                            <a href="#" class="btn-submitsearch btn-searchcar">ยืนยัน</a>
                        </div>
                    </div>
                </div>

                <div class="boxshow-advance">
                    <button class="btn-resetsearch"><img src="images/icon-reset-white.svg" alt="">ล้าง</button>
                    <button>กรุงเทพฯ <i class="bi bi-x"></i></button>
                    <button>สีขาว<i class="bi bi-x"></i></button>
                    <button>เกียร์อัตโนมัติ<i class="bi bi-x"></i></button>
                </div>

                <a href="#" class="btn-searchcar">ค้นหารถยนต์</a>
            </div>
        </div>
    </div>
</section>


<section class="row wow fadeInDown">
    <div class="col-12 col-lg-4 col-xl-3 bg-findcar">
        <div class="desc-findcar">
            <div class="topic-findcar">
                <img class="svg" src="{{asset('frontend/images/icon-carred.svg')}}" alt=""> ช่วยคุณหารถที่ใช่
            </div>
            <p>ให้รถพร้อมขายช่วยหารถให้คุณ</p>
            <a data-fancybox data-src="#help-carsearch" href="javascript:;">คลิกเลย <i class="bi bi-chat-text-fill"></i></a>
        </div>
    </div>
    <div class="col-12 col-lg-8 col-xl-9 bg-carslide">
        <div class="box-carslide">
            <div class="owl-carslide owl-carousel owl-theme">
                @foreach($categories as $keycate => $cate)
                <div class="items">
                    <a href="{{url('/search-category').'/'.$cate->id}}"><figure><img src="{{asset($cate->feature)}}" alt=""></figure></a> 
                </div>
                @endforeach
                <!-- <div class="items">
                    <a href="{{route('carPage')}}"><figure><img src="{{asset('frontend/images/car01.png')}}" alt=""></figure></a> 
                </div>
                <div class="items">
                    <a href="{{route('carPage')}}"><figure><img src="{{asset('frontend/images/car02.png')}}" alt=""></figure></a> 
                </div>
                <div class="items">
                    <a href="{{route('carPage')}}"><figure><img src="{{asset('frontend/images/car03.png')}}" alt=""></figure></a> 
                </div>
                <div class="items">
                    <a href="{{route('carPage')}}"><figure><img src="{{asset('frontend/images/car04.png')}}" alt=""></figure></a> 
                </div>
                <div class="items">
                    <a href="{{route('carPage')}}"><figure><img src="{{asset('frontend/images/car05.png')}}" alt=""></figure></a> 
                </div> -->
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
                    <a href="{{route('carPage')}}" class="btn-red">ดูทั้งหมด</a>
                </div>
                <div class="col-12">
                    <div class="owl-bestsearch owl-carousel owl-theme">
                        @php
                        $car1count = 0;
                        @endphp
                        @foreach($cars as $keycar1 => $car1)
                        @php
                        $car1count++;
                        if($car1count <= 5){
                        $profilecar_img = ($car1->feature)?asset($car1->feature):asset('public/uploads/default-car.jpg');
                        @endphp
                        <a href="{{route('cardetailPage', ['slug' => $car1->slug])}}" class="item-car">
                            <figure>
                                <div class="cover-car"><img src="{{$profilecar_img}}" alt=""></div>
                                <figcaption>
                                    <div class="car-name">{{$car1->modelyear." ".$car1->brands_title." ".$car1->model_name}} </div>
                                    <div class="car-series">{{$car1->generations_name." ".$car1->sub_models_name}}</div>
                                    <div class="car-province">@if(!empty($car1->customer_proveince)){{$car1->customer_proveince}}@else{{"-"}}@endif</div>
                                    <div class="row">
                                        <div class="col-8 col-xl-9">
                                            <div class="descpro-car">{{$car1->title}}</div>
                                        </div>
                                        <div class="col-4 col-xl-3 text-end">
                                            <div class="txt-readmore">ดูเพิ่มเติม</div>
                                        </div>
                                    </div>
                                    <div class="linecontent"></div>
                                    <div class="row caritem-price">
                                        <div class="col-6">
                                            <div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> {{$arr_gear[$car1->gear]??''}}</div>
                                        </div>
                                        <div class="col-6 text-end">
                                            <div class="car-price">{{number_format($car1->price, 0, '.', ',')}}.-</div>
                                        </div>
                                    </div>
                                </figcaption>
                            </figure>
                        </a>
                        @php
                        }
                        @endphp
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
                                    <img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt="">
                                </div>
                                <div class="box-itemnum">
                                    <div class="item-num">
                                        จำนวนรถมาใหม่ <div class="txt-num">0</div>
                                    </div>
                                    <div class="item-num">
                                        จำนวนรถทั้งหมด <div class="txt-num">{{$allcarcount}}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="homeitem-button wow fadeInRight">
                                <div class="txt-homeitem">
                                    <div class="topic-homeitem"><img src="{{asset('frontend/images/icon-carred.svg')}}" class="svg" alt=""> รถยนต์แบบไหนที่เหมาะกับฉัน?</div>
                                    <div>ให้เราช่วยคุณค้นหารถที่ใช่ตามความต้องการของคุณ</div>
                                </div>
                                <a data-fancybox data-src="#help-carsearch" href="javascript:;" class="btn-red">ค้นหารถยนต์</a>
                            </div>
                        </div>
                    </div>
                    <div class="row row-item-postcar wow fadeInDown">
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{route('postcarwelcomePage')}}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{asset('frontend/images/66ab16642431e.webp')}}" alt=""></div>
                                    <figcaption>
                                        <h3>ลงขายรถของคุณ ฟรี!</h3>
                                        <p>รถมือเดียว รถบ้านเจ้าของขายเอง</p>
                                        <div class="btn-itempostcar btn-itempostcar-home">ลงขายสำหรับรถบ้าน <img src="{{asset('frontend/images/chevron.svg')}}" class="svg" alt=""></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{route('postcarwelcomedealerPage')}}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{asset('frontend/images/66ab16642ade9.webp')}}" alt=""></div>
                                    <figcaption>
                                        <h3>ลงขายสำหรับดีลเลอร์</h3>
                                        <p>เต็นท์รถที่น่าเชื่อถือ มีรับประกัน ขับได้สบายใจ</p>
                                        <div class="btn-itempostcar btn-itempostcar-dealer">ลงขายสำหรับดีลเลอร์ <img src="{{asset('frontend/images/chevron.svg')}}" class="svg" alt=""></div>
                                    </figcaption>
                                </figure>
                            </a>
                        </div>
                        <div class="col-12 col-lg-4 item-postcar">
                            <a href="{{route('postcarwelcomeladyPage')}}">
                                <figure>
                                    <div class="cover-itempost"><img src="{{asset('frontend/images/66ab16642ea0e.webp')}}" alt=""></div>
                                    <figcaption>
                                        <h3>คุณผู้หญิงลงขายรถ</h3>
                                        <p>เจ้าของเล่มรถเป็นผู้หญิง จอดมากกว่าขับ</p>
                                        <div class="btn-itempostcar btn-itempostcar-lady">ลงขายสำหรับคุณผู้หญิง <img src="{{asset('frontend/images/chevron.svg')}}" class="svg" alt=""></div>
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
                                    <img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt="">
                                </div>
                                <div class="box-itemnum">
                                    <div class="item-num">
                                        จำนวนรถมาใหม่ <div class="txt-num">0</div>
                                    </div>
                                    <div class="item-num">
                                        จำนวนรถทั้งหมด <div class="txt-num">{{$allcarcount}}</div>
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
                        @php
                        $post6post_img = ($post6post->feature)?asset($post6post->feature):asset('public/uploads/default-car.jpg');
                        @endphp
                        <div class="col-6 col-md-4 col-itemcar">
                            <a href="{{route('cardetailPage', ['slug' => $post6post->slug])}}" class="item-car">
                                <figure>
                                    <div class="cover-car">
                                        <div class="tag-newcar"><img src="{{asset('frontend/images/icon-tagnew.svg')}}" alt=""> รถมาใหม่</div>
                                        <img src="{{$post6post_img}}" alt="">
                                    </div>
                                    <figcaption>
                                        <div class="car-name">{{$post6post->modelyear." ".$post6post->brands_title." ".$post6post->model_name}} </div>
                                        <div class="car-series">{{$post6post->generations_name." ".$post6post->sub_models_name}}</div>
                                        <div class="car-province">@if(isset($post6post->customer_proveince)){{$post6post->customer_proveince}}@else{{"-"}}@endif</div>
                                        <div class="row">
                                            <div class="col-12 col-md-8 col-xl-9">
                                                <div class="descpro-car">{{$post6post->title}}</div>
                                            </div>
                                            <div class="col-12 col-md-4 col-xl-3 text-end">
                                                <div class="txt-readmore">ดูเพิ่มเติม</div>
                                            </div>
                                        </div>
                                        <div class="linecontent"></div>
                                        <div class="row caritem-price">
                                            <div class="col-12 col-md-6">
                                                <div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> {{$arr_gear[$post6post->gear]??''}}</div>
                                            </div>
                                            <div class="col-12 col-md-6 text-end">
                                                <div class="car-price">{{number_format($post6post->price, 0, '.', ',')}}.-</div>
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
@if(isset($news) && (count($news) > 0))
<section class="row">
    <div class="col-12 home-news wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 box-topichome">
                    <h3 class="topic-home"><i class="bi bi-circle-fill"></i> อัพเดทข่าวยานยนต์</h3>
                    <a href="{{route('newsPage')}}" class="btn-red">ดูทั้งหมด</a>
                </div>
            </div>
            <div class="row">
                @php
                $feature0_news = ($news[0]->feature)?asset($news[0]->feature):asset('public/uploads/default-car.jpg');
                @endphp
                <div class="col-12 col-xl-6 home-news-lg">
                    <a href="{{route('newsdetailPage', ['news_id' => $news[0]->id])}}" class="home-itemnews">
                        <figure>
                            <div class="cover-news">
                                <img src="{{$feature0_news}}" alt="">
                            </div>
                            <figcaption>
                                <div class="item-topicnews">{{$news[0]->title}}</div>
                                <div class="news-date"><i class="bi bi-calendar3"></i> {{date('d M Y H:i', strtotime($news[0]->created_at))}}</div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-12 col-xl-6">
                    <div class="row">
                        @foreach($news as $keynews => $newsres)
                            @if($keynews != 0)

                            @php
                            $feature_news = ($newsres->feature)?asset($newsres->feature):asset('public/uploads/default-car.jpg');
                            @endphp
                            <div class="col-6">
                                <a href="{{route('newsdetailPage', ['news_id' => $newsres->id])}}" class="home-itemnews">
                                    <figure>
                                        <div class="cover-news">
                                            <img src="{{$feature_news}}" alt="">
                                        </div>
                                        <figcaption>
                                            <div class="item-topicnews">{{$newsres->title}}</div>
                                            <div class="news-date"><i class="bi bi-calendar3"></i> {{date('d M Y H:i', strtotime($newsres->created_at))}}</div>
                                        </figcaption>
                                    </figure>
                                </a>
                            </div>
                            @endif
                        @endforeach


                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
@include('frontend.layouts.inc_carseo')	
<?php
$data = session()->all();
$customerdata = session('customer');
?>
<div style="display: none;" id="help-carsearch">
    <div class="frm-helpcarsearch">
        <div class="topic-helpcar"><img src="{{asset('frontend/images/carred.svg')}}" alt="" class="svg"> ช่วยคุณหารถที่ใช่</div>
        <p>ให้รถพร้อมขายช่วยหารถให้คุณ</p>
        <form method="post" action="{{route('helpcaractionPage')}}">
            @csrf
            <input type="hidden"  name="customer_id	" value="{{$customerdata->id??''}}" >
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

<script>
    function submit1() {
        // console.log($('#province').find('option:selected').text());
        var province = $('#province').find('option:selected').text();
        
        if ($('#province').text() !== "จังหวัด" && $('#province').val() !== "" && $('#province').val() !== "จังหวัด") {
            var newButton = $('<button type="button" onclick="del(this)">'+province+' <i class="bi bi-x"></i></button>');
            $('.boxshow-advance').append(newButton);
        }
        

        // console.log("color="+$('#color').val());
        if($('#color').val() !== "") {
            var newButton = $('<button type="button" onclick="del(this)">'+$('#color').val()+' <i class="bi bi-x"></i></button>');
            $('.boxshow-advance').append(newButton);
        }


        if($("input[name='gear']").val() !== "") {
            console.log($("input[name='gear']").val());
            var newButton;
            if ($("input[name='gear']").val() === "auto") {
                newButton = $('<button type="button" onclick="del(this)">เกียร์อัตโนมัติ <i class="bi bi-x"></i></button>');
            }

            if ($("input[name='gear']").val() === "manual") {
                newButton = $('<button type="button" onclick="del(this)">เกียร์ธรรมดา<i class="bi bi-x"></i></button>');
            }
            
            $('.boxshow-advance').append(newButton);
        }


        if($('#power').val() !== "") {
            var newButton;
            if ($('#power').val() == 1) {
                newButton = $('<button type="button" onclick="del(this)">รถน้ำมัน / hybrid <i class="bi bi-x"></i></button>');
            }
            
            if ($('#power').val() == 2) {
                newButton = $('<button type="button" onclick="del(this)">รถไฟฟ้า EV 100% <i class="bi bi-x"></i></button>');
            }

            if ($('#power').val() == 3) {
                newButton = $('<button type="button" onclick="del(this)">รถติดแก๊ส <i class="bi bi-x"></i></button>');
            }
            $('.boxshow-advance').append(newButton);
        }
    }
    function province(data){
        console.log($(data).find('option:selected').text());
    }
    function del(data){
        $(data).remove();
    }
    function delall(){
        // Remove all buttons within the boxshow-advance container
        $('.boxshow-advance').find('button:not(.btn-resetsearch)').remove();
        $('.boxshow-advance').show();
    }

    function search4() {
        $('input[name="brand_id"]').val(brand_id);
        $('input[name="model_id"]').val(model_id);
        $('input[name="generation_id"]').val(generation_id);
        $('input[name="submodel_id"]').val(submodel_id);
        $('input[name="pricelow"]').val($('.pricelow').text().replace(/,/g, ''));
        $('input[name="pricehigh"]').val($('.pricehigh').text().replace(/,/g, ''));
        $('input[name="yearlow"]').val($('.yearlow').text());
        $('input[name="yearhigh"]').val($('.yearhigh').text());
        $('#my_form').submit();
    }
</script>

<!-- ตัวเลขวิ่ง -->
<script>
    $(document).ready(function() {

			testScroll();

            $(window).scroll(testScroll);
            var viewedth = false;
            var viewedvn = false;
            function isScrolledIntoView(elem) {
                var docViewTop = $(window).scrollTop();
                var docViewBottom = docViewTop + $(window).height();

                var elemTop = $(elem).offset().top;
                var elemBottom = elemTop + $(elem).height();

                return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
            }

            function testScroll() {
                if (isScrolledIntoView($(".numbers")) && !viewedth) {
                    viewedth = true;
                    $('.numbers').find('.txt-num').not('.active').each(function () {
                        $(this).prop('Counter',0).addClass('active').animate({
                            Counter: $(this).text()
                        }, {
                            duration: 1500,
                            easing: 'swing',
                            step: function (now) {
                            // $(this).text(commaSeparateNumber(Math.ceil(now)));
                            $(this).text(Math.ceil(now));
                            }
                        });
                    });
                } 

                function commaSeparateNumber(val){
                    while (/(\d+)(\d{3})/.test(val.toString())){
                    val = val.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
                    }
                    return val;
                }
            }
    });

</script>
<!-- // phase 2 -->
<script>
    $( document ).ready(function() {

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
</script>
<!-- // END phase 2 -->
@endsection
