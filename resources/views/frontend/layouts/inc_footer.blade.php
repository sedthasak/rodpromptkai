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
                        <a href="tel:+6622345678" target="_blank"><i class="bi bi-telephone"></i> Tel. : 098-969-1120</a>
                        <a href="mailto:admin@rodpromptkai.com" target="_blank"><i class="bi bi-envelope"></i> Email : support@rodpromptkai.com</a>
                        <a href="http://line.me/ti/p/~@rodpromptkai"" target="_blank"><i class="bi bi-line"></i> Line ID : @rodpromptkai</a>
                    </div>
                    <div class="row footer-cc">
                        <div class="col-12 col-md-8">
                            <a target="_blank" href="{{route('privacypolicyPage')}}">นโยบายความเป็นส่วนตัว</a> <span>|</span>
                            <a target="_blank" href="{{route('termconditionPage')}}">ข้อกำหนดและเงื่อนไขการใช้งานเว็บไซต์</a>
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
            <form action="/search2" id="my_form" method="GET">
                @csrf
                <div class="left-boxsearch-topic"><img src="{{asset('frontend/images/carred.svg')}}" alt=""> ค้นหารถยนต์</div> 
                
                <div class="left-boxsearch-desc my-box-search-mobile">
                    <div class="hide-carsearch left-boxsearch-topic2">รายละเอียดรถยนต์</div>
                    <div class="row box-ecocar">
                        <div class="col-9">
                            <div class="topic-careco">
                                <img src="{{asset('frontend/images/icon-careco.svg')}}" alt=""> รถยนต์ไฟฟ้า
                            </div>
                        </div>
                        <div class="col-3 text-end">
                            <label class="switch">
                                <input class="evcheck evcheck-mobile" type="checkbox" name="ev_mobile" value="1">
                                <span class="slider"></span>
                            </label>
                        </div>
                    </div>
                    <div class="carsearch-input">
                        <a data-fancybox data-src="#popup-searchcar" href="javascript:;">
                            <input type="text" id="textsearchfooter" readonly value="ยี่ห้อรถ">
                            <input type="hidden" name="brand_id">
                            <input type="hidden" name="model_id">
                            <input type="hidden" name="generation_id">
                            <input type="hidden" name="submodel_id">
                        </a>
                        
                        <div style="display: none;" id="popup-searchcar">
                            <div class="cardesc-frmcontact frm-contactback">
                                @include('frontend.layouts.inc-popup-carsearch')	
                            </div>
                        </div>
                    </div>

                    <!-- Updated Budget Section -->
                    <div class="box-budget-footer">
                        <div class="left-boxsearch-topic2">งบประมาณที่ต้องการ</div>
                        <div class="tab_footer_btn">
                            <div class="active btn-default">ราคาซื้อสด</div>
                            <div class="btn-default">จัดไฟแนนซ์</div>
                        </div>
                        <div>
                            <div class="tab_footer">
                                <div class="price-select-wrap">
                                    <div class="box-inputyear">
                                        <input type="text" readonly class="price-select-value" placeholder="ราคา">
                                    </div>
                                    <div class="price-select-dropdown">
                                        <div class="price-select-input-flex">
                                            <input type="text" name="price_minimum_mobile" class="price-select-input price-minimum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ต่ำสุด">
                                            <span>-</span>
                                            <input type="text" name="price_maximum_mobile" class="price-select-input price-maximum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="สูงสุด">
                                            <!-- Minimum Price Options -->
                                            <ul class="price-select-option price-minimum">
                                                @foreach ($priceOptions as $option)
                                                    <li data-value="{{ $option['value'] }}">{{ $option['label'] }}</li>
                                                @endforeach
                                            </ul>

                                            <!-- Maximum Price Options -->
                                            <ul class="price-select-option price-maximum">
                                                @foreach ($priceOptions as $option)
                                                    <li data-value="{{ $option['value'] }}">{{ $option['label'] }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab_footer">
                                <div class="sel">
                                    <select name="installment_price_mobile">
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
                            </div>
                        </div>
                    </div>

                    <!-- Updated Year Section -->
                    <div class="left-boxsearch-year">
                        <div class="left-boxsearch-topic2">เลือกปี</div>
                        <div class="year-select-wrap">
                            <div class="box-inputyear">
                                <input type="text" readonly class="year-select-value" placeholder="ปีเริ่มต้น - ปีสิ้นสุด">
                            </div>
                            <div class="year-select-dropdown">
                                <div class="year-select-input-flex">
                                    <input type="text" class="year-select-input year-minimum" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ปีเริ่มต้น">
                                    <span>-</span>
                                    <input type="text" class="year-select-input year-maximum" maxlength="4" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ปีสิ้นสุด">
                                    <!-- Minimum Year Options -->
                                    <ul class="year-select-option year-minimum">
                                        @php
                                            $currentYear = date('Y');
                                            $startYear = $currentYear - 16;
                                        @endphp
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <li>{{ $year }}</li>
                                        @endfor
                                    </ul>

                                    <!-- Maximum Year Options -->
                                    <ul class="year-select-option year-maximum">
                                        @for ($year = $currentYear; $year >= $startYear; $year--)
                                            <li>{{ $year }}</li>
                                        @endfor
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Advanced Search Section -->
                    <div class="wrap-advancesearch">
                        <div class="item_advancesearch">
                            <div class="left-boxsearch-topic2">ค้นหารถยนต์แบบละเอียด
                                <img src="{{ asset('frontend/images/chevron-red.svg') }}" alt="">
                            </div>
                            <div class="content_advancesearch">
                                <div class="boxfrm-advancesearch">
                                    <label for="color-select-mobile">สี</label>
                                    <select name="color_mobile" id="color-select-mobile" class="form-select">
                                        <option value="">สี</option>
                                        <option value="">ทุกสี</option>
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
                                <div class="boxfrm-advancesearch">
                                    <div class="advance-boxgear">
                                        <div class="txt-label">เกียร์</div>
                                        <div>
                                            <label><input type="radio" name="advance-gear-mobile" value="auto"> <span>อัตโนมัติ</span></label>
                                            <label><input type="radio" name="advance-gear-mobile" value="manual"> <span>ธรรมดา</span></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="boxfrm-advancesearch">
                                    <label for="gas-select-mobile">เลือกเชื้อเพลิง</label>
                                    <select name="gas_mobile" id="gas-select-mobile" class="form-select">
                                        <option value="">เลือกเชื้อเพลิง</option>
                                        <option value="1">รถน้ำมัน / hybrid</option>
                                        <option value="2">รถไฟฟ้า EV 100%</option>
                                        <option value="3">รถติดแก๊ส</option>
                                    </select>
                                </div>
                                <div class="boxfrm-advancesearch">
                                    <label for="province-mobile">จังหวัด</label>
                                    <select name="province_mobile" id="province-mobile" class="form-select">
                                        <option value="">จังหวัด</option>
                                        @foreach ($allprovince as $rows)
                                            <option value="{{ $rows->name_th }}">{{ $rows->name_th }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="#" class="btn-searchcar">ค้นหารถยนต์ผ่านมือถือ</a>
                </div>
                


            </form>
        </div>
    </div>

    </div> 
</section>

<a id="button-top"><img src="{{asset('frontend/images/totop.svg')}}" alt=""></a>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script src="{{asset('frontend/js/jquery.min.js')}}"></script> -->
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



<!-- <script src="{{asset('frontend/js/dropzone-min.js')}}"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.js"></script>
<script src="{{asset('frontend/js/select2.min.js')}}"></script>
<script src="{{asset('frontend/js/ckeditor.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/resumablejs@1.0.3/resumable.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

<script src="{{asset('frontend/js/script.js')}}"></script>




<!-- Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->
<!-- <script type="text/javascript" src="//www.freeprivacypolicy.com/public/cookie-consent/4.1.0/cookie-consent.js" charset="UTF-8"></script>
<script type="text/javascript" charset="UTF-8">
    document.addEventListener('DOMContentLoaded', function () {
    cookieconsent.run({"notice_banner_type":"simple","consent_type":"express","palette":"light","language":"en","page_load_consent_levels":["strictly-necessary"],"notice_banner_reject_button_hide":false,"preferences_center_close_button_hide":false,"page_refresh_confirmation_buttons":false,"website_name":"rodpromptkai","website_privacy_policy_url":"https://rodpromptkai.com/privacypolicy"});
    });
</script> -->

<!-- Google Analytics -->
<!-- Google tag (gtag.js) -->
<!-- <script type="text/plain" data-cookie-consent="tracking" async src="https://www.googletagmanager.com/gtag/js?id=G-4X91LQDB17"></script>
<script type="text/plain" data-cookie-consent="tracking">
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-4X91LQDB17');
</script> -->
<!-- end of Google Analytics-->

<!-- <noscript>Cookie Consent by <a href="https://www.freeprivacypolicy.com/">Free Privacy Policy Generator</a></noscript> -->
<!-- End Cookie Consent by FreePrivacyPolicy.com https://www.FreePrivacyPolicy.com -->





<!-- Below is the link that users can use to open Preferences Center to change their preferences. Do not modify the ID parameter. Place it where appropriate, style it as needed. -->

<!-- <a href="#" id="open_preferences_center">Update cookies preferences</a> -->
<script src="{{asset('frontend/js/jquery.jscroll.min.js')}}"></script>
@include('frontend.layouts.inc_javascript')
@include('frontend.layouts.footer_script')
<!-- footer_script -->


<script type="text/javascript">
    function brand(param, param2) {
        $.get('/popup-carsearch-model/'+param, function(data, status) {
            // console.log(data);
            var html='<li><button rel="'+param2+' รุ่นทั้งหมด" onclick="model(0, \''+param2+' รุ่นทั้งหมด\')">รุ่นทั้งหมด</button></li>';
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

    function search5() {
        $('input[name="brand_id"]').val(brand_id);
        $('input[name="model_id"]').val(model_id);
        $('input[name="generation_id"]').val(generation_id);
        $('input[name="submodel_id"]').val(submodel_id);
        $('input[name="pricelow"]').val($('.pricelowfooter').text().replace(/,/g, ''));
        $('input[name="pricehigh"]').val($('.pricehighfooter').text().replace(/,/g, ''));
        $('input[name="yearlow"]').val($('.yearlowfooter').text());
        $('input[name="yearhigh"]').val($('.yearhighfooter').text());
        $('#my_form').submit();
    }

    $('#searchev').click(function(){
        if($('#searchev').is(':checked')) {
            $.get('/brandev', function(data, status) {
                // console.log(data);
                var param2 = "";
                var html='<li><button class="gg" rel="ทุกยี่ห้อ" onclick="brand2(0, \'ทุกยี่ห้อ\')">ทุกยี่ห้อ</button></li>';
                $.each(data, function(index, value){
                    html+='<li><button class="hh" rel="'+value.title+'" onclick="brand2('+value.id+', \''+value.title+'\')"> '+value.title+'</button></li>';
                });
                $('.carsearch-lv1 .carsearch-ul').empty().append(html);
            });
        }
        else {
            $.get('/brandnotev', function(data, status) {
                // console.log(data);
                var param2 = "";
                var html='<li><button  class="ii" rel="ทุกยี่ห้อ" onclick="brand2(0, \'ทุกยี่ห้อ\')">ทุกยี่ห้อ</button></li>';
                $.each(data, function(index, value){
                    html+='<li><button  class="jj" rel="'+value.title+'" onclick="brand2('+value.id+', \''+value.title+'\')"> '+value.title+'</button></li>';
                });
                $('.carsearch-lv1 .carsearch-ul').empty().append(html);
            });
        }
    });
</script>



