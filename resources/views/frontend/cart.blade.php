@extends('../frontend/layouts/layout')

@section('subhead')
<title>รถพร้อมขาย - profile</title>

@endsection

@section('content')
<style>
    .box-package-contact input, .box-package-contact select {
        background: #231f1f;
    }
</style>
<?php
$customerdata = session('customer');
?>
<section class="row">
    <div class="col-12 bg-package bg-order">
        <div class="container">
            <form method="post" id="cart_form" action="{{ route('cartactionPage') }}">
                @csrf

                <div class="row">
                    <div class="col-12 col-xl-8">
                        <div class="wrap-order">
                            <h2>Your <span>Order</span></h2>


                            <div class="wrap-order-detail">
                                @if($type == 'package')
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> รายการสั่งซื้อแพคเกจ</div>

                                <div class="bg-orderdetail">
                                    <div class="topic-orderdetail">{{$item->name}}</div>
                                    <div class="cart-pack-price">
                                        <div class="box-package-price">
                                            <span>฿{{ number_format($item->price, 2) }}</span>
                                             <!-- / ปี -->
                                        </div>
                                        <div class="box-package-sale">
                                            <div class="box-package-sale-save">ประหยัด {{$item->label_save}}%</div>
                                            <div class="box-package-sale-pricesave">฿ {{ number_format($item->old_price, 2) }}</div>
                                        </div>
                                    </div>
                                    <p>{{$item->label_bottom}}</p>
                                </div>
                                <input type="hidden" name="package_dealers_id" value="{{$item->id}}" />
                                @endif

                                @if($type == 'deal')
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> รายการสั่งซื้อดีล</div>

                                <div class="bg-orderdetail">
                                    <div class="head-cartdeal">
                                        <div class="row">
                                            <div class="col-6">รายการ</div>
                                            <div class="col-3 text-center">จำนวน</div>
                                            <div class="col-3 text-end">ราคา</div>
                                        </div>
                                    </div>
                                    <div class="list-cartdeal">
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="table-list-cartdeal">
                                                    <div>ดีลพิเศษ</div>
                                                    (ราคาคันละ 500 บ.)
                                                </div>
                                            </div>
                                            <div class="col-3 text-center">
                                                <input type="number" id="deal_amount" name="amount" value="{{$amount}}">
                                            </div>
                                            <div class="col-3 text-end">{{$amount * 500}}</div>
                                        </div>
                                    </div>
                                    
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
                                                        <input type="text" name="individual_name" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เลขประจำตัวผู้เสียภาษี <span>*</span></label>
                                                        <input type="text" name="individual_taxidno" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                        <input type="text" name="individual_telephone" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>อีเมล <span>*</span></label>
                                                        <input type="text" name="individual_email" />
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="box-package-contact">
                                                        <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                        <input type="text" name="individual_address"  placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน" />
                                                    </div>
                                                </div>

                                                <!-- จังหวัด -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>จังหวัด <span>*</span></label>
                                                        <select name="individual_province" id="individual_province">
                                                            <option value="">กรุณาเลือก</option>
                                                            @foreach($pvs as $keypvs => $pv)
                                                            <option value="{{$pv->id}}">{{$pv->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- เขต/อำเภอ -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เขต/อำเภอ <span>*</span></label>
                                                        <select name="individual_district" id="individual_district">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- แขวง/ตำบล -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>แขวง/ตำบล <span>*</span></label>
                                                        <select name="individual_subdistrict" id="individual_subdistrict">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>รหัสไปรษณีย์ <span>*</span></label>
                                                        <input type="text" name="individual_zipcode" />
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
                                                        <input type="text" name="corporation_name"  placeholder="กรอกชื่อนิติบุคคล, บริษัท, ห้างหุ้นส่วน" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เลขประจำตัวผู้เสียภาษี (นิติบุคคล) <span>*</span></label>
                                                        <input type="text" name="corporation_taxidno" />
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
                                                            <input id="officebranch" type="radio" name="corporation_branch" rel="w_officebranch">
                                                            <label for="officebranch">สาขา</label>
                                                        </div>
                                                        <div class="w_officebranch office_branch">
                                                            <input type="text" name="corporation_branchid" placeholder="กรอกรหัสสาขา">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                        <input type="text" name="corporation_telephone" >
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>อีเมล <span>*</span></label>
                                                        <input type="text" name="corporation_email" >
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="box-package-contact">
                                                        <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                        <input type="text" name="corporation_address"  placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน">
                                                    </div>
                                                </div>

                                                <!-- จังหวัด -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>จังหวัด <span>*</span></label>
                                                        <select name="corporation_province" id="corporation_province">
                                                            <option value="">กรุณาเลือก</option>
                                                            @foreach($pvs as $keypvs => $pv)
                                                            <option value="{{$pv->id}}">{{$pv->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- เขต/อำเภอ -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>เขต/อำเภอ <span>*</span></label>
                                                        <select name="corporation_district" id="corporation_district">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- แขวง/ตำบล -->
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>แขวง/ตำบล <span>*</span></label>
                                                        <select name="corporation_subdistrict" id="corporation_subdistrict">
                                                            <option value="">กรุณาเลือก</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-6">
                                                    <div class="box-package-contact">
                                                        <label>รหัสไปรษณีย์ <span>*</span></label>
                                                        <input type="text" name="corporation_zipcode">
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
                                                    <input type="text" name="short_name" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>เบอร์โทรศัพท์ <span>*</span></label>
                                                    <input type="text" name="short_telephone" >
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>อีเมล <span>*</span></label>
                                                    <input type="text" name="short_email" >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="box-package-contact">
                                                    <label>ที่อยู่สำหรับออกใบเสร็จรับเงิน <span>*</span></label>
                                                    <input type="text" name="short_address"  placeholder="กรอกบ้านเลขที่, หมู่, ซอย, ถนน">
                                                </div>
                                            </div>

                                            <!-- จังหวัด -->
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>จังหวัด <span>*</span></label>
                                                    <select name="short_province" id="short_province">
                                                        <option value="">กรุณาเลือก</option>
                                                        @foreach($pvs as $keypvs => $pv)
                                                        <option value="{{$pv->id}}">{{$pv->name_th}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- เขต/อำเภอ -->
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>เขต/อำเภอ <span>*</span></label>
                                                    <select name="short_district" id="short_district">
                                                        <option value="">กรุณาเลือก</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- แขวง/ตำบล -->
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>แขวง/ตำบล <span>*</span></label>
                                                    <select name="short_subdistrict" id="short_subdistrict">
                                                        <option value="">กรุณาเลือก</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <div class="box-package-contact">
                                                    <label>รหัสไปรษณีย์ <span>*</span></label>
                                                    <input type="text" name="short_zipcode" >
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
                                    <input id="donate" type="radio" name="boxdonate" value="donate" rel="w_donate">
                                    <label for="donate">บริจาคช่วยเหลือหมาแมว สัตว์พิการและสัตว์ด้อยโอกาส</label>
                                </div>
                                <div class="w_donate wrap-donate">
                                    <div class="bg-orderdetail">
                                        <div class="box-package-contact">
                                            <label>ยอดเงินที่ต้องการบริจาค</label>
                                            <select name="donation">
                                                <option value="">กรุณาเลือก</option>
                                                <option value="5">5 บาท</option>
                                                <option value="10">10 บาท</option>
                                                <option value="15">15 บาท</option>
                                                <option value="20">20 บาท</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="box-donate md-radio md-radio-inline">
                                    <input id="notdonate" type="radio" name="boxdonate" value="notdonate" rel="w_notdonate">
                                    <label for="notdonate">ยังไม่ใช่วันนี้</label>
                                </div>
                                <div class="error-donate"></div>
                            </div>



                        </div>
                    </div>



                    @if($type == 'package')
                        <div class="col-12 col-xl-4">
                            <div class="box-sum-cart">
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> สรุปรายการสั่งซื้อ</div>

                                <input type="hidden" name="customer_id" value="{{$customerdata->id}}" />
                                <input type="hidden" name="type" value="{{$type}}" />
                                <input type="hidden" name="package_dealers_id" value="{{$item->id}}" />
                                <input type="hidden" name="amount" value="" />
                                <input type="hidden" name="price" id="price" value="{{$item->price}}" />
                                <input type="hidden" name="price_not_vat" id="price_not_vat" value="{{ $item->price - ($item->price * 0.07) }}" />
                                <input type="hidden" name="vat" id="vat" value="{{ $item->price * 0.07 }}" />
                                <input type="hidden" name="discount" id="discount" value="0" />
                                <input type="hidden" name="net_price" id="net_price" value="0" />
                                <input type="hidden" name="total_result" id="total_result" value="{{ $item->price }}" />
                                <input type="hidden" name="donate_input" id="donate_input" value="0" />
                                <input type="hidden" name="total" id="total" value="{{ $item->price }}" />

                                <input type="hidden" name="coupons_id" id="coupons_id" value="" />
                                <input type="hidden" name="coupons_rate" id="coupons_rate" value="" />
                                <input type="hidden" name="coupons_limit_rate" id="coupons_limit_rate" value="" />
                                <input type="hidden" name="coupons" id="coupons" value="" />

                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-8">ราคาแพคเกจ</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="price_not_vat_show">฿{{ number_format($item->price - ($item->price * 0.07), 2) }}</span></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-8">Vat 7%</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="vat_show">฿{{ number_format($item->price * 0.07, 2) }}</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">ราคาแพคเกจรวม Vat</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="price_show">฿{{ number_format($item->price, 2) }}</span></div>
                                    </div>


                                    <div class="row" id="discount_info" style="display: none;">
                                        <div class="col-8">ส่วนลด <span id="discount_span"></span></div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="discount_amount"></span></div>
                                    </div>
                                </div>

                                <div class="cartright-box cartright-code" id="coupon_add">
                                    <div>Promo Code</div>
                                    <div class="box-input-code">
                                        <input type="text" placeholder="กรอกโค้ดส่วนลด" id="discount-code">
                                        <button type="button" class="btn-submitcode" id="submit-code">ยืนยัน</button>
                                    </div>
                                    <div class="code-error code-warning" style="display: none;"></div>
                                </div>

                                <div class="cartright-box cartright-price" id="coupon_info" style="display: none;">
                                    <div class="row">
                                        <div class="col-8">
                                            ส่วนลด 
                                            <br>
                                            <div class="box-code-use"><span id="coupon-name"></span> <button type="button" class="btn-del-code"><i class="bi bi-x-circle-fill"></i></button></div>
                                        </div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="discount_show"></span></div>
                                    </div>
                                </div>

                                <div class="cartright-box cartright-price" id="donate_info" style="display:none;">
                                    <div class="row" id="" >
                                        <div class="col-8">ยอดรวม</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="total_before"></span></div>
                                    </div>
                                    <div class="row"  >
                                        <div class="col-8">ยอดบริจาค</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="donate_amount"></span></div>
                                    </div>
                                </div>
                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-5">
                                            <span class="txt-totalprice">ยอดรวมทั้งหมด</span> 
                                            <div class="txt-total-vat">ยอดรวม Vat 7%</div>
                                        </div>
                                        <div class="col-7 text-end">
                                            <span class="txt-totalprice" id="total_show">฿{{ number_format($item->price, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="code-error error-invoiceform"></div>
                                    <!-- <button class="btn-default btn-red">ยืนยันการสั่งซื้อ</button> -->
                                    <div id="submit-button" class="btn-default btn-red">ยืนยันการสั่งซื้อ</div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if($type == 'deal')
                        <div class="col-12 col-xl-4">
                            <div class="box-sum-cart">
                                <div class="topic-cart"><i class="bi bi-circle-fill"></i> สรุปรายการสั่งซื้อ</div>

                                <input type="hidden" name="customer_id" value="{{$customerdata->id}}" />
                                <input type="hidden" name="type" value="{{$type}}" />
                                <input type="hidden" name="deal_id" value="{{$amount}}" />
                                <input type="hidden" name="price" id="price" value="{{ $amount * 500 }}" />
                                <input type="hidden" name="price_not_vat" id="price_not_vat" value="{{ ($amount * 500) - (($amount * 500) * 0.07) }}" />
                                <input type="hidden" name="vat" id="vat" value="{{ ($amount * 500) * 0.07 }}" />
                                <input type="hidden" name="discount" id="discount" value="0" />
                                <input type="hidden" name="net_price" id="net_price" value="0" />
                                <input type="hidden" name="total_result" id="total_result" value="{{ $amount * 500 }}" />
                                <input type="hidden" name="donate_input" id="donate_input" value="0" />
                                <input type="hidden" name="total" id="total" value="{{ $amount * 500 }}" />

                                <input type="hidden" name="coupons_id" id="coupons_id" value="" />
                                <input type="hidden" name="coupons_rate" id="coupons_rate" value="" />
                                <input type="hidden" name="coupons_limit_rate" id="coupons_limit_rate" value="" />
                                <input type="hidden" name="coupons" id="coupons" value="" />

                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-8">ราคา Deal</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="price_not_vat_show">฿{{ number_format(($amount * 500) - (($amount * 500) * 0.07), 2) }}</span></div>
                                    </div>

                                    <div class="row">
                                        <div class="col-8">Vat 7%</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="vat_show">฿{{ number_format(($amount * 500) * 0.07, 2) }}</span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">ราคา Deal รวม Vat</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="price_show">฿{{ number_format($amount * 500, 2) }}</span></div>
                                    </div>

                                    <div class="row" id="discount_info" style="display: none;">
                                        <div class="col-8">ส่วนลด <span id="discount_span"></span></div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="discount_amount"></span></div>
                                    </div>
                                </div>

                                <div class="cartright-box cartright-code" id="coupon_add">
                                    <div>Promo Code</div>
                                    <div class="box-input-code">
                                        <input type="text" placeholder="กรอกโค้ดส่วนลด" id="discount-code">
                                        <button type="button" class="btn-submitcode" id="submit-code">ยืนยัน</button>
                                    </div>
                                    <div class="code-error code-warning" style="display: none;"></div>
                                </div>

                                <div class="cartright-box cartright-price" id="coupon_info" style="display: none;">
                                    <div class="row">
                                        <div class="col-8">
                                            ส่วนลด 
                                            <br>
                                            <div class="box-code-use"><span id="coupon-name"></span> <button type="button" class="btn-del-code"><i class="bi bi-x-circle-fill"></i></button></div>
                                        </div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="discount_show"></span></div>
                                    </div>
                                </div>

                                <div class="cartright-box cartright-price" id="donate_info" style="display:none;">
                                    <div class="row">
                                        <div class="col-8">ยอดรวม</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="total_before"></span></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-8">ยอดบริจาค</div>
                                        <div class="col-4 text-end"><span class="txt-cart-price" id="donate_amount"></span></div>
                                    </div>
                                </div>

                                <div class="cartright-box cartright-price">
                                    <div class="row">
                                        <div class="col-5">
                                            <span class="txt-totalprice">ยอดรวมทั้งหมด</span> 
                                            <div class="txt-total-vat">ยอดรวม Vat 7%</div>
                                        </div>
                                        <div class="col-7 text-end">
                                            <span class="txt-totalprice" id="total_show">฿{{ number_format($amount * 500, 2) }}</span>
                                        </div>
                                    </div>
                                    <div class="code-error error-invoiceform"></div>
                                    <div id="submit-button" class="btn-default btn-red">ยืนยันการสั่งซื้อ</div>
                                </div>
                            </div>
                        </div>
                    @endif




                </div>
            </form>
        </div>
    </div>
</section>

@endsection

@section('script')
@include('frontend.layouts.inc_cart_script')	
@endsection
