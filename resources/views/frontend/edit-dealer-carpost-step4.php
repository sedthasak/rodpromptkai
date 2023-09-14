<!doctype html>
<html>

<head>
	<?php require('inc_head.php'); ?>
</head>

<body>

<div class="container-fluid">
	
<?php require('inc_menu.php'); ?>

<section class="row">
    <div class="col-12 wrap-bgstep-edit wrap-bgstep">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 text-center">
                    <h1>แก้ไขประกาศ</h1>
                    <div class="box-iconstep">
                        <a href="edit-dealer-carpost-step1.php"><img src="images/icon-step1-active.svg" alt=""></a>
                        <div class="active"><img src="images/step-arrow.svg" alt=""></div>
                        <a href="edit-dealer-carpost-step2.php"><img src="images/icon-step2-active.svg" alt=""></a>
                        <div><img src="images/step-arrow.svg" alt=""></div>
                        <a href="edit-dealer-carpost-step3.php"><img src="images/icon-step3-active.svg" alt=""></a>
                        <div><img src="images/step-arrow.svg" alt=""></div>
                        <a href="edit-dealer-carpost-step4.php"><img src="images/icon-step4-active.svg" alt=""></a>
                    </div>
                </div>
            </div>
        </div>
        <?php require('inc_edittotal.php'); ?>
    </div>
</section>
<section class="row">
    <div class="col-12 wrap-page-step wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="post-success">
                        <img src="images/icon-success.svg" alt="">
                        <h2>แก้ไขข้อมูลสำเร็จ</h2>
                        <h3>โปรดรอเจ้าหน้าที่ตรวจสอบข้อมูล</h3>
                    </div>
                    <a href="profile.php" class="btn-backpage">กลับสู่หน้าประกาศ</a>
                </div>
            </div>
        </div>
    </div>
</section>

	
<?php require('inc_footer.php'); ?>

</div>

</body>

</html>
