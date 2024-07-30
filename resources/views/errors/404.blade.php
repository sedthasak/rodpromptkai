<!doctype html>
<html>
<head>
    @include('frontend.layouts.inc_head')	
    <style>
        .error-container {
  text-align: right;
  font-size: 106px;
  font-family: 'Catamaran', sans-serif;
  font-weight: 800;
  margin: 0 15px 20px;
  zoom: 0.6;
}
.error-container > span {
  display: inline-block;
  position: relative;
}
.error-container > span.four {
  width: 136px;
  height: 43px;
  border-radius: 999px;
  background:
    linear-gradient(140deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.07) 43%, transparent 44%, transparent 100%),
    linear-gradient(105deg, transparent 0%, transparent 40%, rgba(0, 0, 0, 0.06) 41%, rgba(0, 0, 0, 0.07) 76%, transparent 77%, transparent 100%),
    linear-gradient(to right, #d89ca4, #e27b7e);
}
.error-container > span.four:before,
.error-container > span.four:after {
  content: '';
  display: block;
  position: absolute;
  border-radius: 999px;
}
.error-container > span.four:before {
  width: 43px;
  height: 156px;
  left: 60px;
  bottom: -43px;
  background:
    linear-gradient(128deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.07) 40%, transparent 41%, transparent 100%),
    linear-gradient(116deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.07) 50%, transparent 51%, transparent 100%),
    linear-gradient(to top, #99749D, #B895AB, #CC9AA6, #D7969E, #E0787F);
}
.error-container > span.four:after {
  width: 137px;
  height: 43px;
  transform: rotate(-49.5deg);
  left: -18px;
  bottom: 36px;
  background: linear-gradient(to right, #99749D, #B895AB, #CC9AA6, #D7969E, #E0787F);
}

.error-container > span.zero {
  vertical-align: text-top;
  width: 156px;
  height: 156px;
  border-radius: 999px;
  background: linear-gradient(-45deg, transparent 0%, rgba(0, 0, 0, 0.06) 50%,  transparent 51%, transparent 100%),
    linear-gradient(to top right, #99749D, #99749D, #B895AB, #CC9AA6, #D7969E, #ED8687, #ED8687);
  overflow: hidden;
  animation: bgshadow 5s infinite;
}
.error-container > span.zero:before {
  content: '';
  display: block;
  position: absolute;
  transform: rotate(45deg);
  width: 90px;
  height: 90px;
  background-color: transparent;
  left: 0px;
  bottom: 0px;
  background:
    linear-gradient(95deg, transparent 0%, transparent 8%, rgba(0, 0, 0, 0.07) 9%, transparent 50%, transparent 100%),
    linear-gradient(85deg, transparent 0%, transparent 19%, rgba(0, 0, 0, 0.05) 20%, rgba(0, 0, 0, 0.07) 91%, transparent 92%, transparent 100%);
}
.error-container > span.zero:after {
  content: '';
  display: block;
  position: absolute;
  border-radius: 999px;
  width: 70px;
  height: 70px;
  left: 43px;
  bottom: 43px;
  background: #FDFAF5;
  box-shadow: -2px 2px 2px 0px rgba(0, 0, 0, 0.1);
}

.screen-reader-text {
    position: absolute;
    top: -9999em;
    left: -9999em;
}
    
@keyframes bgshadow {
  0% {
    box-shadow: inset -160px 160px 0px 5px rgba(0, 0, 0, 0.4);
  }
  45% {
    box-shadow: inset 0px 0px 0px 0px rgba(0, 0, 0, 0.1);
  }
  55% {
    box-shadow: inset 0px 0px 0px 0px rgba(0, 0, 0, 0.1);
  }
  100% {
    box-shadow: inset 160px -160px 0px 5px rgba(0, 0, 0, 0.4);
  }
}

/* demo stuff */
* {
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
}
body {
  background-color: #F6F7FB;
}
.zoom-area { 
  max-width: 490px;
  margin: 30px auto 30px;
  font-size: 19px;
  text-align: center;
}
.link-container {
  text-align: center;
}

@media (max-width: 991px){
    .error-container{
       text-align: center;
    }
}
@media (max-width: 767px){
    .error-container{
        zoom: 0.4;
    }
    h1{
        font-size: 1.2rem;
        margin: 10px 15px;
    }
}

    </style>
</head>
<body>
    <?php
// $sess = session()->all();
// echo "<pre>";
// print_r($sess);
// echo "</pre>";
    ?>
<div class="container">
	<div class="row wrap-errorpage">
		<div class="col-12 col-lg-8 order-errorpage-2">
			<div class="wrap-errorpage-desc">
				<h1>ไม่พบหน้าที่คุณต้องการ</h1>
				<p> หน้าที่คุณต้องการไม่พร้อมใช้งาน คุณอาจเข้าลิงก์เก่าหรือข้อมูลได้ถูกย้ายไปแล้ว <br> คุณสามารถไปยังหน้ารถพร้อมขายทั้งหมดได้จากด้านล่าง
				</p>
				<a href="{{route('indexPage')}}" class="more-link">กลับหน้าแรก</a>
				<a href="{{url()->previous()}}" class="more-link">กลับหน้าก่อนหน้า</a>
			</div>
		</div>
		<div class="col-12 col-lg-4 order-errorpage-1">
			<section class="error-container">
				<span class="four"><span class="screen-reader-text">4</span></span>
				<span class="zero"><span class="screen-reader-text">0</span></span>
				<span class="four"><span class="screen-reader-text">4</span></span>
			</section>
		</div>
	</div>
</div>

<div class="container-fluid">
<section class="row">
    <div class="col-12 wrap-carreccom wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> รถพร้อมขายแนะนำ</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="car-detail.php" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/67_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="car-detail.php" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/CAR202306290015_Mercedes-Benz_GLA250_20230629_102211629_WATERMARK.png" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="car-detail.php" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/14_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 mb-recentlist">
                    <a href="#" class="item-recentlist">
                        <figure>
                            <div class="cover-recentlist"><img src="images/94_1.jpeg" alt=""></div>
                            <figcaption>
                                <div class="price-recentlist">1,290,000.-</div>
                                <span>2023</span>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-12 wrap-alsolike wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="topic-cardesc"><i class="bi bi-circle-fill"></i> รถที่คุณอาจชอบ</div>
                </div>
            </div>
            <div class="row">
                <div class="col-6 col-lg-3 col-itemcar mb-recentlist">
                    <a href="car-detail.php" class="item-car">
                        <figure>
                            <div class="cover-car">
                                <img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt="">
                            </div>
                            <figcaption>
                                <div class="car-name">2016 Honda CR-V </div>
                                <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                                <div class="car-province">กรุงเทพมหานคร</div>
                                <div class="row">
                                    <div class="col-12 col-xl-9">
                                        <div class="descpro-car">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                    </div>
                                    <div class="col-12 col-xl-3 text-end">
                                        <div class="txt-readmore">ดูเพิ่มเติม</div>
                                    </div>
                                </div>
                                <div class="linecontent"></div>
                                <div class="row caritem-price">
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="txt-gear"><img src="images/icon-kear.svg" alt=""> เกียร์อัตโนมัติ</div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 text-end">
                                        <div class="car-price">599,000.-</div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-itemcar mb-recentlist">
                    <a href="car-detail.php" class="item-car">
                        <figure>
                            <div class="cover-car">
                                <img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt="">
                            </div>
                            <figcaption>
                                <div class="car-name">2016 Honda CR-V </div>
                                <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                                <div class="car-province">กรุงเทพมหานคร</div>
                                <div class="row">
                                    <div class="col-12 col-xl-9">
                                        <div class="descpro-car">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                    </div>
                                    <div class="col-12 col-xl-3 text-end">
                                        <div class="txt-readmore">ดูเพิ่มเติม</div>
                                    </div>
                                </div>
                                <div class="linecontent"></div>
                                <div class="row caritem-price">
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="txt-gear"><img src="images/icon-kear.svg" alt=""> เกียร์อัตโนมัติ</div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 text-end">
                                        <div class="car-price">599,000.-</div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-itemcar mb-recentlist">
                    <a href="car-detail.php" class="item-car">
                        <figure>
                            <div class="cover-car">
                                <img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt="">
                            </div>
                            <figcaption>
                                <div class="car-name">2016 Honda CR-V </div>
                                <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                                <div class="car-province">กรุงเทพมหานคร</div>
                                <div class="row">
                                    <div class="col-12 col-xl-9">
                                        <div class="descpro-car">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                    </div>
                                    <div class="col-12 col-xl-3 text-end">
                                        <div class="txt-readmore">ดูเพิ่มเติม</div>
                                    </div>
                                </div>
                                <div class="linecontent"></div>
                                <div class="row caritem-price">
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="txt-gear"><img src="images/icon-kear.svg" alt=""> เกียร์อัตโนมัติ</div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 text-end">
                                        <div class="car-price">599,000.-</div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
                <div class="col-6 col-lg-3 col-itemcar mb-recentlist">
                    <a href="car-detail.php" class="item-car">
                        <figure>
                            <div class="cover-car">
                                <img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt="">
                            </div>
                            <figcaption>
                                <div class="car-name">2016 Honda CR-V </div>
                                <div class="car-series">CR-V 2.0 E (MY12) (MNC)</div>
                                <div class="car-province">กรุงเทพมหานคร</div>
                                <div class="row">
                                    <div class="col-12 col-xl-9">
                                        <div class="descpro-car">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                    </div>
                                    <div class="col-12 col-xl-3 text-end">
                                        <div class="txt-readmore">ดูเพิ่มเติม</div>
                                    </div>
                                </div>
                                <div class="linecontent"></div>
                                <div class="row caritem-price">
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6">
                                        <div class="txt-gear"><img src="images/icon-kear.svg" alt=""> เกียร์อัตโนมัติ</div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-12 col-xl-6 text-end">
                                        <div class="car-price">599,000.-</div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h6>เพื่อป้องกันการถูกหลอกลวง โปรดตรวจสอบข้อมูลรถและผู้ขายก่อนทำการชำระเงิน</h6>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</body>
</html>
