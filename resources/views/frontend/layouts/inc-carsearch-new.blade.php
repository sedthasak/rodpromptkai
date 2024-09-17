<div class="wrap-left-boxsearch">
    <div class="left-boxsearch">
        <div class="left-boxsearch-topic">
            <img src="{{ asset('frontend/images/carred.svg') }}" alt=""> ค้นหารถยนต์
        </div>

        <div class="left-boxsearch-desc my-box-search-desktop">
            <div class="left-boxsearch-topic2">รายละเอียดรถยนต์</div>
            <div class="row box-ecocar">
                <div class="col-9">
                    <div class="topic-careco">
                        <img src="{{ asset('frontend/images/icon-careco.svg') }}" alt=""> รถยนต์ไฟฟ้า
                    </div>
                </div>
                <div class="col-3 text-end">
                    <label class="switch">
                        <input class="evcheck evcheck-desktop" type="checkbox" name="ev" value="1" >
                        <span class="slider"></span>
                    </label>
                </div>
            </div>

            <div class="carsearch-input">
                <a data-fancybox data-src="#popup-searchcar" href="javascript:;">
                    <input type="text" name="textsearch" id="textsearch" readonly value="ยี่ห้อรถ">
                    <input type="hidden" name="brand_id">
                    <input type="hidden" name="model_id">
                    <input type="hidden" name="generation_id">
                    <input type="hidden" name="submodel_id">
                </a>
            </div>

            <!-- เพิ่มใหม่ -->
            <div class="left-boxsearch-money">
                <div class="left-boxsearch-topic2">งบประมาณที่ต้องการ</div>

                <div class="tab_article_btn">
                    <div class="btn-default active">ราคาซื้อสด</div>
                    <div class="btn-default">จัดไฟแนนซ์</div>
                </div>

                <div>
                    <div class="tab_pdetail">
                        <div class="price-select-wrap">
                            <div class="box-inputyear">
                                <input type="text" name="price" readonly class="price-select-value" placeholder="ราคา">
                            </div>
                            <div class="price-select-dropdown">
                                <div class="price-select-input-flex">
                                    <input type="text" name="price_minimum" class="price-select-input price-minimum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="ต่ำสุด">
                                    <span>-</span>
                                    <input type="text" name="price_maximum" class="price-select-input price-maximum" oninput="this.value = this.value.replace(/\D+/g, '')" placeholder="สูงสุด">
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
                    <div class="tab_pdetail">
                        <div class="sel">
                            <select>
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

            <div class="left-boxsearch-money left-boxsearch-year">
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
                                @php
                                    $currentYear = date('Y');
                                    $startYear = $currentYear - 16;
                                @endphp
                                @for ($year = $currentYear; $year >= $startYear; $year--)
                                    <li>{{ $year }}</li>
                                @endfor
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- เพิ่มใหม่ -->

            <div class="wrap-advancesearch">
                <div class="item_advancesearch">
                    <div class="left-boxsearch-topic2">ค้นหารถยนต์แบบละเอียด
                        <img src="{{ asset('frontend/images/chevron-red.svg') }}" alt="">
                    </div>
                    <div class="content_advancesearch">
                        <div class="boxfrm-advancesearch">
                            <label for="color-select">สี</label>
                            <select name="color" id="color-select" class="form-select">
                                <option value="">เลือกสี</option>
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
                                    <label><input type="radio" name="advance-gear" value="auto"> <span>อัตโนมัติ</span></label>
                                    <label><input type="radio" name="advance-gear" value="manual"> <span>ธรรมดา</span></label>
                                </div>
                            </div>
                        </div>
                        <div class="boxfrm-advancesearch">
                            <label for="gas-select">เลือกเชื่อเพลิง</label>
                            <select name="gas" id="gas-select" class="form-select">
                                <option value="">เลือกเชื้อเพลิง</option>
                                <option value="1">รถน้ำมัน / hybrid</option>
                                <option value="2">รถไฟฟ้า EV 100%</option>
                                <option value="3">รถติดแก๊ส</option>
                            </select>

                        </div>
                        <div class="boxfrm-advancesearch">
                            <label for="province">จังหวัด</label>
                            <select name="province" id="province" class="form-select">
                                <option value="">จังหวัด</option>
                                @foreach ($allprovince as $rows)
                                    <option value="{{ $rows->name_th }}">{{ $rows->name_th }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <a href="#" class="btn-searchcar">ค้นหารถยนต์</a>
        </div>
        @include('frontend.layouts.inc-carsearch-new-moremenu')

    </div>
    <a href="{{ asset($banner->link) }}" target="_blank" class="banner-adv">
        <!-- <img src="{{ asset('frontend/images/bannera.jpg') }}" alt=""> -->
        <img src="{{ asset($banner->image) }}" alt="">
    </a>
</div>
