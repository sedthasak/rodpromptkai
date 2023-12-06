<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script> 
<script src="{{asset('frontend/js/jquery.ui.touch-punch.min.js')}}"></script> 
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
<script src="{{asset('frontend/js/dropzone-min.js')}}"></script>
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<!-- Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->
<script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
document.addEventListener('DOMContentLoaded', function () {
cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"light","language":"en","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"rodpromptkai","website_privacy_policy_url":"https://rodpromptkai.com/privacypolicy"});
});
</script>

<!-- Google Analytics -->
<!-- Google tag (gtag.js) -->
<script type="text/plain" data-cookie-consent="tracking" async src="https://www.googletagmanager.com/gtag/js?id=G-4X91LQDB17"></script>
<script type="text/plain" data-cookie-consent="tracking">
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-4X91LQDB17');
</script>
<!-- end of Google Analytics-->

<noscript>Cookie Consent by <a href="https://www.freeprivacypolicy.com/">Free Privacy Policy Generator</a></noscript>
<!-- End Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->





<!-- Below is the link that users can use to open Preferences Center to change their preferences. Do not modify the ID parameter. Place it where appropriate, style it as needed. -->

<a href="#" id="open_preferences_center">Update cookies preferences</a>

<?php

// echo "<pre>";
// print_r($setFooterModel);
// echo "</pre>";
?>

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
        <a href="{{route('indexPage')}}">
            <img src="{{asset('frontend/images/menu-home.svg')}}" alt="">
            <div>หน้าแรก</div>
        </a>
        <a href="{{route('indexPage')}}" target="_blank">
            <img src="{{asset('frontend/images/menu-contact.svg')}}" alt="">
            <div>ติดต่อเรา</div>
        </a>
        <a href="{{route('postcarPage')}}">
            <img src="{{asset('frontend/images/menu-post.svg')}}" alt="">
            <div>ลงขาย</div>
        </a>
        <button class="show-menucarsearch">
            <img src="{{asset('frontend/images/menu-search.svg')}}" alt="">
            <div>ค้นหารถ</div>
        </button>
        <a href="{{route('profilePage')}}">
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

@include('frontend.layouts.inc_javascript')
@include('frontend.layouts.footer_script')


<script type="text/javascript">
    function brand(param, param2) {
        $.get('/popup-carsearch-model/'+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกรุ่น" onclick="model(0, \''+param2+' ทุกรุ่น\')">รุ่นทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.model.toUpperCase()+'" onclick="model('+value.id+', \''+param2+' '+value.model.toUpperCase()+'\')">'+value.model.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv2 .carsearch-ul').empty().append(html);
        });
    }

    function model(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        $.get('/popup-carsearch-generation/'+param+'?models_id='+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกโฉม" onclick="generation(0, \''+param2+' ทุกโฉม\')">โฉมทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.generations.toUpperCase()+'" onclick="generation('+value.id+', \''+param2+' '+value.generations.toUpperCase()+'\')">'+value.generations.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv3 .carsearch-ul').empty().append(html);
        });
        // resources\views\frontend\layouts\inc_javascript.blade.php
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.carsearch-lv3').fadeIn();
            $('.carsearch-lv2').hide();
        }
    }

    function generation(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        $.get('/popup-carsearch-submodel/'+param+'?generations_id='+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' ทุกรุ่นย่อย" onclick="submodel(0, \''+param2+' ทุกรุ่นย่อย\')">รุ่นย่อยทั้งหมด</button></li>';
            $.each(data, function(index, value){
                html+='<li><button rel="'+param2+' '+value.sub_models.toUpperCase()+'" onclick="submodel('+value.id+', \''+param2+' '+value.sub_models.toUpperCase()+'\')">'+value.sub_models.toUpperCase()+'</button></li>';
            });
            $('.carsearch-lv4 .carsearch-ul').empty().append(html);
        });
        // resources\views\frontend\layouts\inc_javascript.blade.php
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.carsearch-lv4').fadeIn();
            $('.carsearch-lv3').hide();
        }
    }

    function submodel(param, param2) {
        $('.box-search-car .carsearch-input input').val(param2);
        if (param == 0){
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
        else {
            $('.box-search-car .carsearch-lv2, .box-search-car .carsearch-lv3, .box-search-car .carsearch-lv4').hide();
            $('.box-search-car .carsearch-lv1').show();
            $( ".box-search-car .carsearch-popup" ).effect('slide', { direction: 'right', mode: 'hide' }, 500);
        }
    }
</script>



