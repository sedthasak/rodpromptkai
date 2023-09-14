<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script> 
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/owl.carousel.js')}}"></script>
<script src="{{asset('frontend/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/js/fancybox.umd.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap-datepicker.th.min.js')}}"></script>
<script src="{{asset('frontend/js/modernizr.custom.js')}}"></script>
<script src="{{asset('frontend/js/nouislider.min.js')}}"></script>
<script src="{{asset('frontend/js/wNumb.min.js')}}"></script>
<script src="{{asset('frontend/js/sweetalert.min.js')}}"></script>
<script src="{{asset('frontend/js/script.js')}}"></script>

<section class="row">
    <div class="col-12 wrap-footer">
        <div class="container">
            <div class="row">
                <div class="col-12 footer-pad">
                    <div class="footer-logo">
                        <img src="{{asset('frontend/images/logo.svg')}}" alt="">
                    </div>
                    <p>RodPromptKai ช่องทางที่ดีที่สุดในการซื้อและขายรถยนต์</p>
                    <div class="link-footer">
                        <a href="tel:+6622345678" target="_blank"><i class="bi bi-telephone"></i> Tel. : +662 234 5678</a>
                        <a href="mailto:admin@rodpromptkai.com" target="_blank"><i class="bi bi-envelope"></i> Email : admin@rodpromptkai.com</a>
                        <a href="http://line.me/ti/p/~@rodpromptkai"" target="_blank"><i class="bi bi-line"></i> Line ID : @rodpromptkai</a>
                    </div>
                    <div class="row footer-cc">
                        <div class="col-12 col-md-8">
                            <a href="#">นโยบายความเป็นส่วนตัว</a> <span>|</span>
                            <a href="#">ข้อกำหนดและเงื่อนไขการใช้งานเว็บไซต์</a>
                        </div>
                        <div class="col-12 col-md-4 text-end">
                        Copyright © 2023 RodPromptkai
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <nav class="menu-mobile">
        <a href="index.php">
            <img src="{{asset('frontend/images/menu-home.svg')}}" alt="">
            <div>หน้าแรก</div>
        </a>
        <a href="#" target="_blank">
            <img src="{{asset('frontend/images/menu-contact.svg')}}" alt="">
            <div>ติดต่อเรา</div>
        </a>
        <a href="postcar.php">
            <img src="{{asset('frontend/images/menu-post.svg')}}" alt="">
            <div>ลงขาย</div>
        </a>
        <button class="show-menucarsearch">
            <img src="{{asset('frontend/images/menu-search.svg')}}" alt="">
            <div>ค้นหารถ</div>
        </button>
        <a href="profile.php">
            <img src="{{asset('frontend/images/menu-account.svg')}}" alt="">
            <div>บัญชีของฉัน</div>
        </a>
    </nav>
    <div class="boxslide-search">
        <div class="wrap-left-boxsearch">
        <div class="close-menucarsearch"><i class="bi bi-x-circle-fill"></i></div>
        <div class="left-boxsearch">
            <div class="left-boxsearch-topic"><img src="{{asset('frontend/images/carred.svg')}}" alt=""> ค้นหารถยนต์</div> 
            
            <div class="left-boxsearch-desc">
                <div class="hide-carsearch left-boxsearch-topic2">รายละเอียดรถยนต์</div>
                <div class="row box-ecocar">
                    <div class="col-9">
                        <div class="topic-careco"><img src="{{asset('frontend/images/icon-careco.svg')}}" alt=""> รถยนต์ไฟฟ้า</div>
                    </div>
                    <div class="col-3 text-end">
                        <label class="switch">
                            <input type="checkbox" checked>
                            <span class="slider"></span>
                        </label>
                    </div>
                </div>
                <div class="carsearch-input">
                    <a data-fancybox data-src="#popup-searchcar" href="javascript:;">
                        <input type="text" readonly value="ยี่ห้อรถ">
                    </a>
                    
                    <div style="display: none;" id="popup-searchcar">
                        <div class="cardesc-frmcontact frm-contactback">
                            @include('frontend.layouts.inc-popup-carsearch')	
                        </div>
                    </div>
                </div>

                <div class="carsearch-radio">
                    <label class="car-radio">ซื้อสด 
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                    <label class="car-radio">จัดไฟแนนซ์
                        <input type="radio" name="radio">
                        <span class="checkmark"></span>
                    </label>
                </div>

                <div class="box-searchrange">
                    <div class="search-range">
                        <div class="topic-range">
                            <div>งบประมาณ</div>
                            <div>
                                <div id="popup-minprice"></div>
                                <span>-</span>
                                <div id="popup-maxprice"></div>
                            </div>
                        </div>
                        <div class="box-priceslider">
                            <div id="popup-priceslider"></div>
                        </div>
                    </div>
                    <div class="search-range">
                        <div class="topic-range">
                            <div>ปี</div>
                            <div>
                                <div id="popup-minyear"></div>
                                <div id="popup-maxyear"></div>
                            </div>
                        </div>
                        <div class="box-priceslider">
                            <div id="popup-yearslider"></div>
                        </div>
                    </div>
                </div>
                <div class="wrap-advancesearch">
                    <div class="item_advancesearch">
                        <div class="left-boxsearch-topic2">ค้นหารถยนต์แบบละเอียด <img src="{{asset('frontend/images/chevron-red.svg')}}" alt=""></div>
                        <div class="content_advancesearch">
                            <div class="boxfrm-advancesearch">
                                <label>สี</label>
                                <select name="" id="" class="form-select">
                                    <option>เลือกสี</option>
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
                            <div class="boxfrm-advancesearch">
                                <div class="advance-boxgear">
                                    <div class="txt-label">เกียร์</div>
                                    <div>
                                        <label><input type="radio" name="advance-gear"> <span>อัตโนมัติ</span></label>
                                        <label><input type="radio" name="advance-gear"> <span>ธรรมดา</span></label>
                                    </div>
                                </div>
                            </div>
                            <div class="boxfrm-advancesearch">
                                <label>แก๊ส</label>
                                <select name="" id="" class="form-select">
                                    <option>เลือกแก๊ส</option>
                                    <option>ติดแก๊ส</option>
                                    <option>ไม่ติดแก๊ส</option>
                                </select>
                            </div>
                            <div class="boxfrm-advancesearch">
                                <label>จังหวัด</label>
                                <select name="" id="" class="form-select">
                                    <option>จังหวัด</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="#" class="btn-searchcar">ค้นหารถยนต์</a>
            </div>

        </div>
    </div>

    </div> 
</section>

<a id="button-top"><img src="{{asset('frontend/images/totop.svg')}}" alt=""></a>

<script>
    $( document ).ready(function() {

            // range price
    var popuppriceslider = document.getElementById('popup-priceslider');

var popupminrange = 0;
var popupmaxrange = 3000000;

noUiSlider.create(popuppriceslider, {
    start: [popupminrange, popupmaxrange],
    connect: true,
    snap: true,
    range: {
        'min': popupminrange,
        '8%': 100000,
        '16%': 200000,
        '24%': 300000,
        '32%': 400000,
        '40%': 500000,
        '48%': 600000,
        '56%': 700000,
        '64%': 800000,
        '72%': 900000,
        '80%': 1000000,
        '88%': 2000000,
        'max': popupmaxrange
    },
      format: wNumb({
        decimals: 0,
        thousand: ',',
        postfix: '',
    })
});

var formatValues = [
    document.getElementById('popup-minprice'),
    document.getElementById('popup-maxprice')
];

popuppriceslider.noUiSlider.on('update', function (values, handle) {
    if (values[handle].replace(/[^0-9.-]+/g,"") == popupminrange){
        formatValues[handle].innerHTML = "ต่ำสุด"
    }else if (values[handle].replace(/[^0-9.-]+/g,"") == popupmaxrange){
        formatValues[handle].innerHTML = "สูงสุด"
    }else{
        formatValues[handle].innerHTML = values[handle];
    }
    
});

//year

var popupyearslider = document.getElementById('popup-yearslider');

var popupminyearrange = 2010;
var popupmaxyearrange = 2023;


noUiSlider.create(popupyearslider, {
    start: [popupminyearrange, popupmaxyearrange],
    connect: true,
    snap: true,
    range: {
        'min': popupminyearrange,
        '10%': 2012,
        '20%': 2013,
        '30%': 2015,
        '50%': 2017,
        '60%': 2019,
        '70%': 2020,
        '90%': 2021,
        'max': popupmaxyearrange
    },
      format: wNumb({
        decimals: 0,
    })
});

var formatYear = [
    document.getElementById('popup-minyear'),
    document.getElementById('popup-maxyear')
];

popupyearslider.noUiSlider.on('update', function (values, handle) {
    console.log(values[1],values[2]);
    if (values[0] == minyearrange && values[1] == popupmaxyearrange){
        formatYear[0].innerHTML = " ";
        formatYear[1].innerHTML = "ทุกปี";
    }else if (values[0] != popupminyearrange && values[1] == popupmaxyearrange){
        formatYear[0].innerHTML = values[0] + " - ";
        formatYear[1].innerHTML = popupmaxyearrange;
    }else if (values[0] == popupminyearrange && values[1] != popupmaxyearrange){
        formatYear[0].innerHTML = "ต่ำสุด - ";
        formatYear[1].innerHTML = values[1];
    }else {
        formatYear[0].innerHTML = values[0] + " - ";
        formatYear[1].innerHTML = values[1];
    }
});


        $('.boxslide-search .carsearch-input input').click(function (event) {
            if (  $( ".boxslide-search .carsearch-popup" ).is( ":hidden" ) ) {
                // $( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.stopPropagation();
        });
        
        $('.boxslide-search .carsearch-exit').click(function (event) {
            $('.boxslide-search .carsearch-lv2, .boxslide-search .carsearch-lv3, .boxslide-search .carsearch-lv4').hide();
            $('.boxslide-search .carsearch-lv1').show();
            $.fancybox.close();
            // $( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });
        
        $('.boxslide-search .carsearch-head').click(function (event) {
            if (  $(this).parents('.boxslide-search .carsearch-lv1').length) {
                $('.boxslide-search .carsearch-lv2, .boxslide-search .carsearch-lv3, .boxslide-search .carsearch-lv4').hide();
                $('.boxslide-search .carsearch-lv1').show();
                $.fancybox.close();
                // $( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }else if (  $(this).parents('.boxslide-search .carsearch-lv2').length) {
                $('.boxslide-search .carsearch-lv1').fadeIn();
                $('.boxslide-search .carsearch-lv2').hide();
            }else if (  $(this).parents('.boxslide-search .carsearch-lv3').length) {
                $('.boxslide-search .carsearch-lv2').fadeIn();
                $('.boxslide-search .carsearch-lv3').hide();
            }else if (  $(this).parents('.boxslide-search .carsearch-lv4').length) {
                $('.boxslide-search .carsearch-lv3').fadeIn();
                $('.boxslide-search .carsearch-lv4').hide();
            }
            event.stopPropagation();
        });

        $('.boxslide-search .carsearch-ul > li > button').click(function (event) {
            $('.boxslide-search .carsearch-input input').val($(this).attr('rel'));
            if ( $(this).hasClass('carsearch-select-all')){
                $('.boxslide-search .carsearch-lv2, .boxslide-search .carsearch-lv3, .boxslide-search .carsearch-lv4').hide();
                $('.boxslide-search .carsearch-lv1').show();
                $.fancybox.close();
                //$( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }else if (  $(this).parents('.boxslide-search .carsearch-lv1').length) {
                $('.boxslide-search .carsearch-lv2').fadeIn();
                $('.boxslide-search .carsearch-lv1').hide();
            }else if (  $(this).parents('.boxslide-search .carsearch-lv2').length) {
                $('.boxslide-search .carsearch-lv3').fadeIn();
                $('.boxslide-search .carsearch-lv2').hide();
            }else if (  $(this).parents('.boxslide-search .carsearch-lv3').length) {
                $('.boxslide-search .carsearch-lv4').fadeIn();
                $('.boxslide-search .carsearch-lv3').hide();
            }else if (  $(this).parents('.boxslide-search .carsearch-lv4').length) {
                $('.boxslide-search .carsearch-lv2, .boxslide-search .carsearch-lv3, .boxslide-search .carsearch-lv4').hide();
                $('.boxslide-search .carsearch-lv1').show();
                $.fancybox.close();
                // $( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            }
            event.stopPropagation();
        });

        $('.boxslide-search .btn-selectall-car button').click(function (event) {
            $('.boxslide-search .carsearch-input input').val($(this).attr('rel'));
                $('.boxslide-search .carsearch-lv2, .boxslide-search .carsearch-lv3, .boxslide-search .carsearch-lv4').hide();
                $('.boxslide-search .carsearch-lv1').show();
                $.fancybox.close();
                // $( ".carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });

        $('.boxslide-search .btn-advancesearch').click(function (event) {
            if (  $( ".boxslide-search .box-advancesearch" ).is( ":hidden" ) ) {
                $( ".boxslide-search .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'show' }, 500);
            }
            event.preventDefault();
        });

        $('.boxslide-search .advance-exit').click(function (event) {
            $( ".boxslide-search .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.stopPropagation();
        });

        $('.boxslide-search .btn-submitsearch').click(function (event) {
            $( ".boxslide-search .boxshow-advance" ).show();
            $( ".boxslide-search .box-advancesearch" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
            event.preventDefault();
        });

        $('.boxslide-search .btn-resetsearch').click(function (event) {
            $( ".boxslide-search .boxshow-advance" ).hide();
            event.stopPropagation();
        });
        
    });
</script>

<script>
    $( '.item_advancesearch > .left-boxsearch-topic2' ).click(function (event) {
	  if (  $(this).siblings('.content_advancesearch').is( ":hidden" ) ) {
            $('.item_advancesearch').removeClass("active");
            $('.content_advancesearch').slideUp();
            $(this).parent('.item_advancesearch').addClass("active");
            $(this).siblings('.content_advancesearch').slideDown();
	  } else {
          $('.item_advancesearch').removeClass("active");
            $('.content_advancesearch').slideUp();
	  }
	  event.stopPropagation();
	});
</script>




