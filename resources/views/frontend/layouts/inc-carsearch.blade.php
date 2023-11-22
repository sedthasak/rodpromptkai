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
                        <input type="checkbox" checked id="searchev">
                        <span class="slider"></span>
                    </label>
                </div>
            </div>
            <div class="carsearch-input">
                <a data-fancybox data-src="#popup-searchcar" href="javascript:;">
                    <input type="text" readonly value="ยี่ห้อรถ">
                </a>
                
                
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
                            <div id="minprice"></div>
                            <span>-</span>
                            <div id="maxprice"></div>
                        </div>
                    </div>
                    <div class="box-priceslider">
                        <div id="priceslider"></div>
                    </div>
                </div>
                <div class="search-range">
                    <div class="topic-range">
                        <div>ปี</div>
                        <div>
                            <div id="minyear"></div>
                            <div id="maxyear"></div>
                        </div>
                    </div>
                    <div class="box-priceslider">
                        <div id="yearslider"></div>
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

        <div class="left-boxsearch-item">
            <div class="left-boxsearch-topic2">รถมือสอง ประเภทอื่นๆ</div>
            <div class="row">
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type01.svg')}}" alt="">
                    </a>
                </div>
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type02.svg')}}" alt="">
                    </a>
                </div>
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type03.svg')}}" alt="">
                    </a>
                </div>
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type04.svg')}}" alt="">
                    </a>
                </div>
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type05.svg')}}" alt="">
                    </a>
                </div>
                <div class="col-4 col-lg-6 boxsearch-cartype">
                    <a href="{{route('carPage')}}">
                        <img src="{{asset('frontend/images/car-type06.svg')}}" alt="">
                    </a>
                </div>
            </div>
        </div>

        <div class="left-boxsearch-item search-carview">
            <div class="left-boxsearch-topic2">รถที่คุณดูล่าสุด</div>
            <div>
                <a href="{{route('cardetailPage')}}" class="item-car">
                    <figure>
                        <div class="cover-car"><img src="{{asset('frontend/images/cover-car.jpg')}}" alt=""></div>
                        <figcaption>
                            <div class="car-name">2016 Honda CR-V </div>
                            <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                            <div class="car-province">กรุงเทพมหานคร</div>
                            <div class="car-price">599,000.-</div>
                        </figcaption>
                    </figure>
                </a>
                <a href="{{route('cardetailPage')}}" class="item-car">
                    <figure>
                        <div class="cover-car"><img src="{{asset('frontend/images/cover-car.jpg')}}" alt=""></div>
                        <figcaption>
                            <div class="car-name">2016 Honda CR-V </div>
                            <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                            <div class="car-province">กรุงเทพมหานคร</div>
                            <div class="car-price">599,000.-</div>
                        </figcaption>
                    </figure>
                </a>
                <a href="{{route('cardetailPage')}}" class="item-car">
                    <figure>
                        <div class="cover-car"><img src="{{asset('frontend/images/cover-car.jpg')}}" alt=""></div>
                        <figcaption>
                            <div class="car-name">2016 Honda CR-V </div>
                            <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                            <div class="car-province">กรุงเทพมหานคร</div>
                            <div class="car-price">599,000.-</div>
                        </figcaption>
                    </figure>
                </a>
                <a href="{{route('cardetailPage')}}" class="item-car">
                    <figure>
                        <div class="cover-car"><img src="{{asset('frontend/images/cover-car.jpg')}}" alt=""></div>
                        <figcaption>
                            <div class="car-name">2016 Honda CR-V </div>
                            <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                            <div class="car-province">กรุงเทพมหานคร</div>
                            <div class="car-price">599,000.-</div>
                        </figcaption>
                    </figure>
                </a>
                <a href="{{route('cardetailPage')}}" class="item-car">
                    <figure>
                        <div class="cover-car"><img src="{{asset('frontend/images/cover-car.jpg')}}" alt=""></div>
                        <figcaption>
                            <div class="car-name">2016 Honda CR-V </div>
                            <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                            <div class="car-province">กรุงเทพมหานคร</div>
                            <div class="car-price">599,000.-</div>
                        </figcaption>
                    </figure>
                </a>
            </div>
        </div>  

    </div>
    <a href="#" target="_blank" class="banner-adv"><img src="{{asset('frontend/images/bannera.jpg')}}" alt=""></a>
</div>
