<!doctype html>
<html>

<head>
	<?php require('inc_head.php'); ?>
</head>

<body>

<div class="container-fluid">
	
<?php require('inc_menu.php'); ?>

<section class="row">
    <div class="col-12 wrap-bgstep">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 text-center">
                    <h1>ลงขายรถยนต์</h1>
                    <div class="box-iconstep">
                        <a href="{{route('carpoststep1Page')}}"><img src="images/icon-step1-active.svg" alt=""></a>
                        <div class="active"><img src="images/step-arrow.svg" alt=""></div>
                        <a href="{{route('carpoststep2Page')}}"><img src="images/icon-step2-active.svg" alt=""></a>
                        <div><img src="images/step-arrow.svg" alt=""></div>
                        <a href="{{route('carpoststep3Page')}}"><img src="images/icon-step3.svg" alt=""></a>
                        <div><img src="images/step-arrow.svg" alt=""></div>
                        <a href="{{route('carpoststep4Page')}}"><img src="images/icon-step4.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="col-12 wrap-page-step wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-boxstep">
                        <div class="topic-step"><span>2</span> ข้อมูลผู้ขาย</div>
                        <div class="box-frm-step">
                            <form>
                                <div class="row">
                                    <div class="col-12 frm-step">
                                        <label>หัวข้อโฆษณา<span>*</span></label>
                                        <input type="text" class="form-control" placeholder="ข้อความโฆษณาของคุณ">
                                        <div class="box-introtext">
                                            <div class="topic-introtext">ข้อความแนะนำ</div>
                                            <div class="btn-introtext">
                                                <button>มีประวัติการเข้าศูนย์</button>
                                                <button>ไม่มีชนหนัก</button>
                                                <button>รถสภาพดี</button>
                                                <button>มีประกัน</button>
                                                <button>ดูแลอย่างดี</button>
                                                <button>รถบ้าน</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 frm-step">
                                        <label>รายละเอียดรถ<span>*</span></label>
                                        <img src="images/editor.jpg" style="width: 100%" alt="">
                                    </div>
                                    <div class="col-12 frm-step">
                                        <label>ตั้งราคาขาย<span>*</span></label>
                                        <div class="txt-noteedit">หลังจากลงขายแล้ว สามารถแก้ไขราคาขายได้ 2 ครั้งเท่านั้น</div>
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="frm-step-button text-center">
                            <a href="dealer-carpost-step1.php" class="btn-step btn-backstep">ย้อนกลับ</a>
                            <a href="dealer-carpost-step3.php" class="btn-step btn-nextstep">ถัดไป</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

	
<?php require('inc_footer.php'); ?>

</div>

</body>

</html>
