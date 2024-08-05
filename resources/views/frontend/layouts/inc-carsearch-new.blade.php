<div class="wrap-left-boxsearch">
    <div class="left-boxsearch">
        <div class="left-boxsearch-topic"><img src="{{asset('frontend/images/carred.svg')}}" alt=""> ค้นหารถยนต์</div> 
        
        <div class="left-boxsearch-desc">
            <div class="left-boxsearch-topic2">รายละเอียดรถยนต์</div>
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
                    <input type="text" name="textsearch" id="textsearch" readonly value="ยี่ห้อรถ">
                </a>
                
                <!-- <div style="display: none;" id="popup-searchcar-left">
                    <div class="cardesc-frmcontact frm-contactback">
                        <?php 
                        // require('inc-popup-carsearch.php');
                        ?>
                    </div>
                </div> -->
                @include('frontend.layouts.inc-popup-carsearch')	
            </div>

            <!-- เพิ่มใหม่ -->
            <div class="left-boxsearch-money">
                <div class="left-boxsearch-topic2">งบประมาณที่ต้องการ</div>
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
            </div>
            <!-- เพิ่มใหม่ -->

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
    <a href="#" target="_blank" class="banner-adv"><img src="{{asset('frontend/images/bannera.jpg')}}" alt=""></a>
</div>
