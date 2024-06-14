@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

@section('content')

<?php
// $default_image = asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png');
$customerdata = session('customer');
// echo "<pre>";
// print_r($customerdata->id);
// echo "</pre>";
// echo "<pre>";
// print_r($item);
// echo "</pre>";
?>
    <section class="row">
        <div class="col-12 bg-package bg-order">
            <div class="container">
                <form method="post" action="{{ route('cartactionPage') }}" >
                    @csrf
                    <input type="hidden" name="customer_id" value="{{$customerdata->id}}" />
                    <input type="hidden" name="type" value="{{$type}}" />
                    <input type="hidden" name="package_dealers_id" value="{{$item->id}}" />
                    <input type="hidden" name="price" id="price" value="" />
                    <input type="hidden" name="vat" id="vat" value="" />
                    <input type="hidden" name="net_price" id="net_price" value="{{$item->price}}" />
                    <input type="hidden" name="total" value="{{$item->price}}" />
                    <div class="row">
                        <div class="col-12 col-xl-8">
                            <div class="wrap-order">
                                <h2>Your <span>Order</span></h2>
                                <div class="wrap-order-detail">

                                    @if($type=='package')
                                    <div class="topic-cart"><i class="bi bi-circle-fill"></i> รายการสั่งซื้อแพคเกจ</div>
                                    <div class="bg-orderdetail">
                                        <div class="topic-orderdetail">{{$item->name}}</div>
                                        <div class="cart-pack-price">
                                            <div class="box-package-price">
                                                <span>฿{{$item->price}}</span>
                                                <!-- <span>฿{{$item->price}}</span> / ปี -->
                                            </div>
                                            <!-- <div class="box-package-sale">
                                                <div class="box-package-sale-save">ประหยัด 30%</div>
                                                <div class="box-package-sale-pricesave">฿ 455,000.00</div>
                                            </div> -->
                                        </div>
                                        <!-- <p>พร้อมเงื่อนไข 1 ปี คุณจ่าย ฿1,020.00 ในวันนี้ ต่ออายุในราคา ฿1,668.00</p> -->
                                    </div>
                                    @endif
                                    



                                    <div class="login-checkbox">
                                        <label class="list-checkbox"> &nbsp ฉันยอมรับหากชำระเงินแล้วจะไม่สามาถขอคืนเงินหรือยกเลิกในภายหลัง
                                            <input type="checkbox" name="accept" value="1" checked="checked">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="wrap-order-detail">
                                    <div class="topic-cart"><i class="bi bi-circle-fill"></i> ข้อมูลการออกใบเสร็จรับเงิน / ใบกำกับภาษี</div>
                                    <div>
                                        <div class="box_invoice md-radio md-radio-inline">
                                            <input id="invoice1" type="radio" name="invoiceform" value="full_receipt" rel="w_invoice1">
                                            <label for="invoice1" >ออกใบเสร็จรับเงิน / ใบกำกับภาษี</label>
                                        </div>
                                        <div class="w_invoice1 box-invoice-form">
                                            <div class="box_type_form md-radio md-radio-inline">
                                                <input id="people1" type="radio" name="person_type" rel="w_people" value="individual" />
                                                <label for="people1">บุคคลธรรมดา</label>
                                            </div>
                                            <div class="box_type_form md-radio md-radio-inline">
                                                <input id="office1" type="radio" name="person_type" rel="w_office"  value="corporation" />
                                                <label for="office1">นิติบุคคล</label>
                                            </div>

                                            <!-- บุคคลธรรมดา -->
                                            <div class="w_people box-invoice-type">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>ชื่อ - นามสกุล <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เลขประจำตัวผู้เสียภาษี <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>อีเมล <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="box-package-contact">
                                                            <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                            <input type="text" name="full_name"  placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>จังหวัด <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เขต/อำเภอ <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>แขวง/ตำบล <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>รหัสไปรษณีย์ <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- นิติบุคคล -->
                                            <div class="w_office box-invoice-type">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>ชื่อนิติบุคคล <span>*</span></label>
                                                            <input type="text" name="full_name"  placeholder="กรอกชื่อนิติบุคคล, บริษัท, ห้างหุ้นส่วน" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เลขประจำตัวผู้เสียภาษี (นิติบุคคล) <span>*</span></label>
                                                            <input type="text" name="full_name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="box-package-contact">
                                                            <label>สาขา <span>*</span></label> <br>
                                                            <div class="box-branch-type md-radio md-radio-inline">
                                                                <input id="headoffice" type="radio" name="branch" rel="w_headoffice">
                                                                <label for="headoffice">สำนักงานใหญ่</label>
                                                            </div>
                                                            <div class="box-branch-type md-radio md-radio-inline">
                                                                <input id="officebranch" type="radio" name="branch" rel="w_officebranch">
                                                                <label for="officebranch">สาขา</label>
                                                            </div>
                                                            <div class="w_officebranch office_branch">
                                                                <input type="text" placeholder="กรอกรหัสสาขา">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>อีเมล <span>*</span></label>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="box-package-contact">
                                                            <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                            <input type="text" placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน">
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>จังหวัด <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>เขต/อำเภอ <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>แขวง/ตำบล <span>*</span></label>
                                                            <select>
                                                                <option value="">กรุณาเลือก</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <div class="box-package-contact">
                                                            <label>รหัสไปรษณีย์ <span>*</span></label>
                                                            <input type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- ออกใบเสร็จรับเงิน / ใบกำกับภาษี -->

                                        <div class="box_invoice md-radio md-radio-inline">
                                            <input id="invoice2" type="radio" name="invoiceform" value="short_receipt"  rel="w_invoice2">
                                            <label for="invoice2">ออกใบเสร็จธรรมดา (แบบย่อ)</label>
                                        </div>
                                        <div class="w_invoice2 box-invoice-form">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="box-package-contact">
                                                        <label>ชื่อ - นามสกุล <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>อีเมล <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="box-package-contact">
                                                        <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                        <input type="text" placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>จังหวัด <span>*</span></label>
                                                        <select>
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เขต/อำเภอ <span>*</span></label>
                                                        <select>
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>แขวง/ตำบล <span>*</span></label>
                                                        <select>
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>รหัสไปรษณีย์ <span>*</span></label>
                                                        <input type="text">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ออกใบเสร็จธรรมดา (แบบย่อ) -->

                                        <div class="box_invoice md-radio md-radio-inline">
                                            <input id="invoice3" type="radio" name="invoiceform" value="no_receipt" >
                                            <label for="invoice3">ไม่ต้องการรับใบกำกับภาษีหรือใบเสร็จแบบย่อ</label>
                                        </div>
                                        <!-- ไม่ต้องการรับใบกำกับภาษีหรือใบเสร็จแบบย่อ -->

                                    </div>
                                </div>

                                <div class="wrap-order-detail">
                                    <div class="topic-cart"><i class="bi bi-circle-fill"></i> ร่วมบริจาคเงินเพื่อช่วยเหลือมูลนิธิ</div>
                                    <div class="box-donate md-radio md-radio-inline">
                                        <input id="donate" type="radio" name="boxdonate" rel="w_donate">
                                        <label for="donate">บริจาคช่วยเหลือหมาแมว สัตว์พิการและสัตว์ด้อยโอกาส</label>
                                    </div>
                                    <div class="w_donate wrap-donate">
                                        <div class="bg-orderdetail">
                                            <div class="box-package-contact">
                                                <label>ยอดเงินที่ต้องการบริจาค</label>
                                                <select>
                                                    <option value="">กรุณาเลือก</option>
                                                    <option value="5">5 บาท</option>
                                                    <option value="10">10 บาท</option>
                                                    <option value="15">15 บาท</option>
                                                    <option value="20">20 บาท</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- <div class="box-donate md-radio md-radio-inline">
                                        <input id="notdonate" type="radio" name="boxdonate" rel="w_notdonate">
                                        <label for="notdonate">ยังไม่ใช่วันนี้</label>
                                    </div> -->
                                </div>

                            </div>
                        </div>

                        <div class="col-12 col-xl-4">
                            <div class="box-sum-cart">
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> สรุปรายการสั่งซื้อ</div>
                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-8">ราคาแพคเกจ</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="price_show"></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">บริจาคช่วยเหลือหมาแมว สัตว์พิการและสัตว์ด้อยโอกาส</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="vat_show"></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">Vat 7%</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="netPrice_show"></span></div>
                                    </div>
                                </div>
                                <div class="cartright-box cartright-code">
                                    <div>Promo Code</div>
                                    <!-- <div class="box-input-code">
                                        <input type="submit" placeholder="กรอกโค้ดส่วนลด"> <button class="btn-submitcode">ยืนยัน</button>
                                    </div> -->
                                    <div class="box-input-code">
                                        <input type="text" placeholder="กรอกโค้ดส่วนลด" id="discount-code"> 
                                        <button type="button" class="btn-submitcode" id="submit-code">ยืนยัน</button>
                                    </div>

                                    <!-- <div class="code-error">โค้ดส่วนลดไม่สามารถใช้งานได้</div>
                                    <div class="code-success">โค้ดส่วนลดใช้งานได้</div> -->
                                </div>
                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-8">ราคาแพคเกจรวม Vat</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="total_show">฿</span></div>
                                    </div>
                                    <!-- <div class="row">
                                        <div class="col-8">
                                            ส่วนลด <br>
                                            <div class="box-code-use">9feyvy63 <button class="btn-del-code"><i class="bi bi-x-circle-fill"></i></button></div>
                                        </div>
                                        <div class="col-4 text-end"><span class="txt-cart-price">-600.00฿</span></div>
                                    </div> -->
                                </div>
                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-5">
                                            <span class="txt-totalprice">ยอดรวมทั้งหมด</span> 
                                            <div class="txt-total-vat">ยอดรวม Vat 7%</div>
                                        </div>
                                        <div class="col-7 text-end">
                                            <span class="txt-totalprice" id="net_total_show">฿</span>
                                        </div>
                                    </div>
                                    <button class="btn-default btn-red">ยืนยันการสั่งซื้อ</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                    
            </div>
        </div>
    </section>



@endsection

@section('script')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var netPrice = parseFloat(document.getElementById('net_price').value);
        var vat = netPrice * 0.07;
        var price = netPrice - vat;

        document.getElementById('price').value = price.toFixed(2);
        document.getElementById('vat').value = vat.toFixed(2);

        document.getElementById('price_show').innerText = price.toFixed(2) + '฿';
        document.getElementById('vat_show').innerText = vat.toFixed(2) + '฿';
        document.getElementById('netPrice_show').innerText = netPrice.toFixed(2) + '฿';
        document.getElementById('total_show').innerText = netPrice.toFixed(2) + '฿';
        document.getElementById('net_total_show').innerText = netPrice.toFixed(2) + '฿';
    });
        
    $('.box_invoice input').click(function () {
        var box_invoice = $('.box_invoice').find('input:checked').attr('rel');
            if (  $('.'+box_invoice).is( ":hidden" ) ) {
                $('.w_invoice1, .w_invoice2').hide();
                $('.'+box_invoice).fadeIn();
            }else{
                $('.w_invoice1, .w_invoice2').hide();
            }
    }); 
    $('.box_type_form input').click(function () {
        var box_type_form = $('.box_type_form').find('input:checked').attr('rel');
            if (  $('.'+box_type_form).is( ":hidden" ) ) {
                $('.w_people, .w_office').hide();
                $('.'+box_type_form).fadeIn();
            }else{
                $('.w_people, .w_office').hide();
            }
    }); 
    $('.box-branch-type input').click(function () {
        var box_branch = $('.box-branch-type').find('input:checked').attr('rel');
            if (  $('.'+box_branch).is( ":hidden" ) ) {
                $('.w_headoffice, .w_officebranch').hide();
                $('.'+box_branch).fadeIn();
            }else{
                $('.w_headoffice, .w_officebranch').hide();
            }
    }); 
    $('.box-donate input').click(function () {
        var box_donate = $('.box-donate').find('input:checked').attr('rel');
            if (  $('.'+box_donate).is( ":hidden" ) ) {
                $('.w_donate, .w_notdonate').hide();
                $('.'+box_donate).fadeIn();
            }else{
                $('.w_donate, .w_notdonate').hide();
            }
    }); 
</script>
@endsection




