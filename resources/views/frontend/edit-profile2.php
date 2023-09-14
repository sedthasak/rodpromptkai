<!doctype html>
<html>

<head>
	<?php require('inc_head.php'); ?>
</head>

<body>

<div class="container-fluid">
	
<?php require('inc_menu.php'); ?>

<section class="row">
    <div class="col-12 wrap-page wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="topic-insidepage"><i class="bi bi-circle-fill"></i> แก้ไขโปรไฟล์</h1>
                    <div class="bg-white-profile">
                        <div class="row">
                            <div class="col-12 col-lg-3">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload"></label>
                                    </div>
                                    <div class="avatar-preview">
                                        <div id="imagePreview" style="background-image: url('images/avatar.jpeg');">
                                        </div>
                                    </div>
                                </div>
                                <div class="txt-uploadavatar">เปลี่ยนรูปโปรไฟล์</div>
                            </div>
                            <div class="col-12 col-lg-9">
                                <form class="box-editprofile">
                                    <div class="wrap-frmprofile">
                                        <h2 class="topic-profile">จัดการบัญชี</h2>
                                        <div class="row">
                                            <div class="col-12 boxfrm-profile">
                                                <label>เบอร์โทรศัพท์</label>
                                                <input type="text" class="form-control" value="0812345678" disabled>
                                            </div>
                                            <div class="col-12 col-md-6 boxfrm-profile">
                                                <label>ชื่อผู้ขาย<span>*</span></label>
                                                <input type="text" class="form-control" placeholder="สมชาย">
                                            </div>
                                            <div class="col-12 col-md-6 boxfrm-profile">
                                                <label>นามสกุล</label>
                                                <input type="text" class="form-control" placeholder="ใจดี">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="wrap-frmprofile">
                                        <h2 class="topic-profile">สถานที่นัดดูรถ</h2>
                                        <div class="row">
                                            <div class="col-12 col-xl-9 boxfrm-profile">
                                                <label>สถานที่นัดดูรถ<span>*</span></label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-12 col-xl-3 boxfrm-profile">
                                                <label>จังหวัด<span>*</span></label>
                                                <select name="" id="" class="form-select">
                                                    <option value="">เลือกจังหวัด</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-xl-6 boxfrm-profile">
                                                <label>แผนที่</label>
                                                <input type="file" class="form-control">
                                            </div>
                                            <div class="col-12 col-xl-6 boxfrm-profile">
                                                <label>Google Map</label>
                                                <input type="text" class="form-control">
                                            </div>
                                            <div class="col-12 text-end">
                                                <a href="profile.php" class="btn-profile btn-red">บันทึก</a>
                                            </div>
                                        </div>
                                    </div>  
                                </form>
                            </div>
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
