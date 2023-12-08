@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - car</title>
@endsection

@section('content')


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
                <div class="col-12 col-lg-4 col-xl-3 hide-search-mb">
                    <?php 
                    // require('inc-carsearch.php');
                    ?>
                    @include('frontend.layouts.inc-carsearch')
                </div>
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="wrap-allitem-car">
                        <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> ดูรถพร้อมขาย</div>
                        <div class="result-btn-search">
                            <button class="btn-refresh"><img src="{{asset('frontend/images/icon-clear.svg')}}" alt="">ล้างข้อมูล</button>
                            <button>BMW <i class="bi bi-x"></i></button>
                            <button>X1 <i class="bi bi-x"></i></button>
                        </div>
                        <div class="txt-numresult">ทั้งหมด <span>{{number_format(count($cars))}}</span> รายการ</div>
                        <div class="btn-boxfilter model">
                            <button>รุ่น1</button>
                            <button>รุ่น2</button>
                        </div>
                        <div class="btn-boxfilter generation">
                            <button>F48 ปี16-ปัจจุบัน</button>
                            <button>E84 ปี09-16</button>
                        </div>
                        <div class="btn-boxfilter submodel">
                            <button>Hybride</button>
                        </div>
                        <div class="btn-boxfilter year">
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

                    <div id="caryearcontent">
                        @php
                            $total = count($cars);
                            $currentyear="";

                        @endphp
                        @foreach ($cars as $index => $rows)
                            @if ($index == 0)
                                <div class="box-itemcar">
                                <div class="car-year">{{$rows->modelyear}}</div>
                                <div class="row row-itemcar">

                                <div class="col-itemcar col-6 col-xl-4">
                                    <a href="{{url('/car-detail').'/'.$rows->id}}" class="item-car">
                                        <figure>
                                            <div class="cover-car">
                                                <img src="{{$rows->feature}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name">{{$rows->modelyear}} {{$rows->brand_name}} {{$rows->model_name}} </div>
                                                    <div class="car-series">{{$rows->submodel_name}} {{$rows->generation_name}}</div>
                                                    <div class="car-province">{{$rows->province}}</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car">{{$rows->title}}</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> @if($rows->gear=="auto"){{"เกียร์อัตโนมัติ"}}@else{{"เกียร์ธรรมดา"}}@endif</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price">{{number_format($rows->price)}}.-</div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            @else
                                <div class="col-itemcar col-6 col-xl-4">
                                    <a href="{{url('/car-detail').'/'.$rows->id}}" class="item-car">
                                        <figure>
                                            <div class="cover-car">
                                                <img src="{{$rows->feature}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name">{{$rows->modelyear}} {{$rows->brand_name}} {{$rows->model_name}} </div>
                                                    <div class="car-series">{{$rows->submodel_name}} {{$rows->generation_name}}</div>
                                                    <div class="car-province">{{$rows->province}}</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car">{{$rows->title}}</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> @if($rows->gear=="auto"){{"เกียร์อัตโนมัติ"}}@else{{"เกียร์ธรรมดา"}}@endif</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price">{{number_format($rows->price)}}.-</div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </a>
                                </div>
                            @endif
                            @if ($index == $total - 1)
                                </div>
                                </div>
                                {{-- </div> --}}
                            @endif
                            @if (($index+1) > 0 && ($index+1) % 10 == 0)
                                @if ($index == $total - 1)
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
                                @else
                                    </div>
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
            
                                    
                                    <div class="box-itemcar">
                                    <div class="car-year">{{$rows->modelyear}}</div>
                                    <div class="row row-itemcar">
                                @endif
                            @endif
                            @if ($currentyear != $rows->modelyear)
                                @if ($currentyear == "")
                                @elseif (($index+1) > 0 && ($index+1) % 10 == 0)
                                @else
                                    </div>
                                    </div>
                
                                    
                                    <div class="box-itemcar">
                                    <div class="car-year">{{$rows->modelyear}}</div>
                                    <div class="row row-itemcar">
                                @endif
                                @php
                                    $currentyear = $rows->modelyear;
                                @endphp
                            @endif
                            
                        

                        @endforeach
                    </div>

                    

                    <div class="box-car-article">
                        <h4 class="topic-car-article">Mercedes-Benz ในประเทศไทยรุ่นรถมีอะไรบ้าง</h4>
                        <div class="content-editor">
                            <p>
                            Mercedes-Benz ประเทศไทย มีให้เลือกหลายรุ่นและหลากหลายประเภทรถ โดยมีทั้งกลุ่มรถสมรรถนะสูง Mercedes-AMG, กลุ่มไฟฟ้า Mercedes-EQ และอัลตร้าลักชัวรี่ Mercedes-Maybach ส่วนประเภทรถได้แบ่งเป็นไลน์ คูเป้, เปิดประทุน, เอสยูวี, รถตู้ และซาลูน
                            </p>
                            <p style="text-align:center;"><img src="{{asset('frontend/images/image 7.jpg')}}" alt=""></p>
                            <p>
                            Mercedes-Benz เป็นแบรนด์พรีเมียมที่มียอดขายสูงสุดในไทย และ Mercedes-Benz มือสอง ก็ได้รับความนิยมมากเช่นกัน สามารถสังเกตได้ในเว็บไซต์ RodPromptkai.com มีรถ Mercedes-Benz มือสองจำนวนมากที่ผ่านการตรวจสอบแล้วให้คุณเลือกและเปรียบเทียบก่อนตัดสินใจ
                            </p>
                            <h5 style="color: #000;">Mercedes-Benz รุ่นไหนน่าซื่อที่สุดปี 2023?</h5>
                            <p style="text-align:center;"><img src="{{asset('frontend/images/Group 410.jpg')}}" alt=""></p>
                            <p>
                            Mercedes-Benz SLC คือที่สุดของรถยนต์สายสปอร์ต Roadster ที่มีความคลาสสิกผสมผสานกับความทันสมัยได้อย่างลงตัวราคาเริ่มตั้งแต่ 4,090,000 บาท ถึง 4,990,000 บาทสำหรับใครที่ต้องการตรวจสอบราคารถเบนซ์มือสอง, อยากซื้อรถเบนซ์มือสอง, ซื้อขายเบนซ์ มือสองรถบ้านสภาพดี และรถเบนซ์มือสอง ราคาถูก สามารถเข้าไปดูเพิ่มเติมได้ที่ RodPromptkai.com ตลาดรถให้ข้อมูลที่ดีที่สุดสำหรับการซื้อขายรถยนต์ สำหรับใครที่สนใจอยากตรวจสอบราคารถเบนซ์ มือสอง, ซื้อรถเบนซ์มือสอง, รถเบนซ์ มือ สอง เจ้าของขายเอง สภาพดี, ซื้อขายเบนซ์มือสองรถบ้าน และรถเบนซ์ มือสองราคาถูก สามารถเข้าไปที่ RodPromptkai.com ตลาดรถให้ข้อมูลที่ดีที่สุดสำหรับการซื้อขายรถยนต์มือสองในไทย และใครที่สนใจจะขายรถเบนซ์มือสอง RodPromptkai ก็สามารถช่วยคุณ ได้ ด้วยจำนวนผู้เข้าชมเว็บไซต์กว่า 2 ล้านคน/เดือน คุณจึงมั่นใจได้ว่ารถของคุณที่ลงประกาศขายในเว็บไซต์ RodPromptkai.com จะสามารถเข้าถึงผู้ซื้อได้ง่าย กว่า และโอกาสที่รถของคุณจะขายได้สูงกว่าในราคาที่คุณกำหนดเอง
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
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
    var brand_id=1, model_id=1, generation_id=1, submodel_id=1, evtype=0, payment=0, pricelow=0, pricehigh=10000000, color="ขาว", gear="auto", power=1, province_id=1;
    $( document ).ready(function() {
            // range price
    var priceslider = document.getElementById('priceslider');

var minrange = 0;
var maxrange = 3000000;

// noUiSlider.create(priceslider, {
//     start: [minrange, maxrange],
//     connect: true,
//     snap: true,
//     range: {
//         'min': minrange,
//         '8%': 100000,
//         '16%': 200000,
//         '24%': 300000,
//         '32%': 400000,
//         '40%': 500000,
//         '48%': 600000,
//         '56%': 700000,
//         '64%': 800000,
//         '72%': 900000,
//         '80%': 1000000,
//         '88%': 2000000,
//         'max': maxrange
//     },
//       format: wNumb({
//         decimals: 0,
//         thousand: ',',
//         postfix: '',
//     })
// });

var formatValues = [
    document.getElementById('minprice'),
    document.getElementById('maxprice')
];

priceslider.noUiSlider.on('update', function (values, handle) {
    if (values[handle].replace(/[^0-9.-]+/g,"") == minrange){
        formatValues[handle].innerHTML = "ต่ำสุด"
    }else if (values[handle].replace(/[^0-9.-]+/g,"") == maxrange){
        formatValues[handle].innerHTML = "สูงสุด"
    }else{
        formatValues[handle].innerHTML = values[handle];
    }
    
});

//year

var yearslider = document.getElementById('yearslider');

var minyearrange = 2010;
var maxyearrange = 2023;


// noUiSlider.create(yearslider, {
//     start: [minyearrange, maxyearrange],
//     connect: true,
//     snap: true,
//     range: {
//         'min': minyearrange,
//         '10%': 2012,
//         '20%': 2013,
//         '30%': 2015,
//         '50%': 2017,
//         '60%': 2019,
//         '70%': 2020,
//         '90%': 2021,
//         'max': maxyearrange
//     },
//       format: wNumb({
//         decimals: 0,
//     })
// });

var formatYear = [
    document.getElementById('minyear'),
    document.getElementById('maxyear')
];

yearslider.noUiSlider.on('update', function (values, handle) {
    console.log(values[1],values[2]);
    if (values[0] == minyearrange && values[1] == maxyearrange){
        formatYear[0].innerHTML = " ";
        formatYear[1].innerHTML = "ทุกปี";
    }else if (values[0] != minyearrange && values[1] == maxyearrange){
        formatYear[0].innerHTML = values[0] + " - ";
        formatYear[1].innerHTML = maxyearrange;
    }else if (values[0] == minyearrange && values[1] != maxyearrange){
        formatYear[0].innerHTML = "ต่ำสุด - ";
        formatYear[1].innerHTML = values[1];
    }else {
        formatYear[0].innerHTML = values[0] + " - ";
        formatYear[1].innerHTML = values[1];
    }
});

    
});
    function search2() {
        $.get("{{url('/search')}}"+"/"+brand_id+"/"+model_id+"/"+generation_id+"/"+submodel_id+"/"+evtype+"/"+payment+"/"+pricelow+"/"+pricehigh+"/"+color+"/"+gear+"/"+power+"/"+province_id, function(data, status){
            // console.log("Data: " + data + "\nStatus: " + status);
            var html="", currentyear="", total=0;
            total = data.length;
            $('.txt-numresult span').text(total);
            $.each(data, function( index, value ) {
                // เริ่มต้น
                if (index == 0) {
                    currentyear = value.modelyear;
                    // section year
                    html+='<div class="box-itemcar">';
                    html+='<div class="car-year">'+value.modelyear+'</div>';
                    html+='<div class="row row-itemcar">';


                    // section car
                    html+='<div class="col-itemcar col-6 col-xl-4">';
                    html+='<a href="{{url('')}}/car-detail/'+value.id+'" class="item-car">';
                    html+='<figure>';
                    html+='<div class="cover-car">';
                    html+='<img src="{{asset('')}}'+value.feature+'" alt="">';
                    html+='</div>';
                    html+='<figcaption>';
                    html+='<div class="grid-desccar">';
                    html+='<div class="car-name">'+value.modelyear+' '+value.brand_name+' '+value.model_name+' </div>';
                    html+='<div class="car-series">'+value.submodel_name+' '+value.generation_name+'</div>';
                    html+='<div class="car-province">'+value.province+'</div>';
                    html+='<div class="row">';
                    html+='<div class="col-12 col-md-8">';
                    html+='<div class="descpro-car">'+value.title+'</div>';
                    html+='</div>';
                    html+='<div class="col-12 col-md-4 text-end">';
                    html+='<div class="txt-readmore">ดูเพิ่มเติม</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='<div class="linecontent"></div>';
                    html+='<div class="row caritem-price">';
                    html+='<div class="col-12 col-md-6">';
                    html+='<div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> '+(value.gear==="auto"?'เกียร์อัตโนมัติ':'เกียร์ธรรมดา')+'</div>';
                    html+='</div>';
                    html+='<div class="col-12 col-md-6 text-end">';
                    html+='<div class="car-price">'+value.price.toLocaleString("en-US")+'.-</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</figcaption>';
                    html+='</figure>';
                    html+='</a>';
                    html+='</div>';
                    // end section car
                }
                else {
                    // section car
                    html+='<div class="col-itemcar col-6 col-xl-4">';
                    html+='<a href="{{url('')}}/car-detail/'+value.id+'" class="item-car">';
                    html+='<figure>';
                    html+='<div class="cover-car">';
                    html+='<img src="{{asset('')}}'+value.feature+'" alt="">';
                    html+='</div>';
                    html+='<figcaption>';
                    html+='<div class="grid-desccar">';
                    html+='<div class="car-name">'+value.modelyear+' '+value.brand_name+' '+value.model_name+' </div>';
                    html+='<div class="car-series">'+value.submodel_name+' '+value.generation_name+'</div>';
                    html+='<div class="car-province">'+value.province+'</div>';
                    html+='<div class="row">';
                    html+='<div class="col-12 col-md-8">';
                    html+='<div class="descpro-car">'+value.title+'</div>';
                    html+='</div>';
                    html+='<div class="col-12 col-md-4 text-end">';
                    html+='<div class="txt-readmore">ดูเพิ่มเติม</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='<div class="linecontent"></div>';
                    html+='<div class="row caritem-price">';
                    html+='<div class="col-12 col-md-6">';
                    html+='<div class="txt-gear"><img src="{{asset('frontend/images/icon-kear.svg')}}" alt=""> '+(value.gear==="auto"?'เกียร์อัตโนมัติ':'เกียร์ธรรมดา')+'</div>';
                    html+='</div>';
                    html+='<div class="col-12 col-md-6 text-end">';
                    html+='<div class="car-price">'+value.price.toLocaleString("en-US")+'.-</div>';
                    html+='</div>';
                    html+='</div>';
                    html+='</figcaption>';
                    html+='</figure>';
                    html+='</a>';
                    html+='</div>';
                    // end section car
                }
                if (index === total - 1){
                    // end section year
                    html+='</div>';
                    html+='</div>';
                    // html+='</div>';
                }
                if ((index+1) > 0 && (index+1) % 10 === 0) {
                    if (index === total - 1) {
                        // แทรกค้นหารถ ทุกๆ 10 คัน
                        html+='<div class="box-frmhelpcar">';
                        html+='<div class="topic-frmhelpcar">';
                        html+='<img src="{{asset("frontend/images/carred.svg")}}" alt=""> <span>ช่วยคุณหารถที่ใช่</span> ให้รถพร้อมขายช่วยหารถให้คุณ';
                        html+='</div>';
                        html+='<form action="">';
                        html+='<div>';
                        html+='<input type="text" class="form-control" placeholder="ชื่อ - นามสกุล">';
                        html+='<input type="text" class="form-control" placeholder="เบอร์โทรติดต่อ">';
                        html+='<input type="text" class="form-control" placeholder="Line ID">';
                        html+='<input type="text" class="form-control" placeholder="รุ่นรถที่ต้องการ">';
                        html+='</div>';
                        html+='<button>คลิกเลย <i class="bi bi-chat-text-fill"></i></button>';
                        html+='</form>';
                        html+='</div>';
                    }
                    else {
                        // end section year
                        html+='</div>';
                        html+='</div>';
                        // html+='</div>';

                        // แทรกค้นหารถ ทุกๆ 10 คัน
                        html+='<div class="box-frmhelpcar">';
                        html+='<div class="topic-frmhelpcar">';
                        html+='<img src="{{asset("frontend/images/carred.svg")}}" alt=""> <span>ช่วยคุณหารถที่ใช่</span> ให้รถพร้อมขายช่วยหารถให้คุณ';
                        html+='</div>';
                        html+='<form action="">';
                        html+='<div>';
                        html+='<input type="text" class="form-control" placeholder="ชื่อ - นามสกุล">';
                        html+='<input type="text" class="form-control" placeholder="เบอร์โทรติดต่อ">';
                        html+='<input type="text" class="form-control" placeholder="Line ID">';
                        html+='<input type="text" class="form-control" placeholder="รุ่นรถที่ต้องการ">';
                        html+='</div>';
                        html+='<button>คลิกเลย <i class="bi bi-chat-text-fill"></i></button>';
                        html+='</form>';
                        html+='</div>';

                        // section year
                        html+='<div class="box-itemcar">';
                        html+='<div class="car-year">'+value.modelyear+'</div>';
                        html+='<div class="row row-itemcar">';
                    }
                }
                if (currentyear !== value.modelyear){
                    if (currentyear === "") {

                    }
                    else if ((index+1) > 0 && (index+1) % 10 === 0) {
                        
                    }
                    else {
                        // end section year
                        html+='</div>';
                        html+='</div>';
                        // html+='</div>';

                        // section year
                        html+='<div class="box-itemcar">';
                        html+='<div class="car-year">'+value.modelyear+'</div>';
                        html+='<div class="row row-itemcar">';
                    }
                    currentyear = value.modelyear;
                }
            });
            $('#caryearcontent').empty().append(html);
        });
    }
</script>

@endsection





