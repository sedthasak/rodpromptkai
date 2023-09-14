<!doctype html>
<html>

<head>
	<?php require('inc_head.php'); ?>
</head>

<body>

<div class="container-fluid">
	
<?php require('inc_menu.php'); ?>
<?php require('inc_profile.php'); ?>

<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                <?php require('inc-menuprofile-search.php'); ?>
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="item-mycar-edit desc-pageprofile">
                        <div class="wraptopic-pageprofile">
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> รถที่ลงขาย</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        <?php require('inc_menu-mycar.php'); ?>

                        <div class="note-expire">กรุณาแก้ไขภายใน 3 วัน ไม่เช่นนั้นโพสของคุณจะถูกลบ</div>

                        <div class="txt-editnote">กรุณาแก้ไข: Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                        <div class="item-mycar">
                            <div class="item-mycar-cover">
                                <a href="car-detail.php"><figure><img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt=""></figure></a>
                            </div>
                            <div class="mycar-detail-mb">
                                <a href="car-detail.php">
                                    <div class="mycar-name">2023 BMW X1</div>
                                    <div class="mycar-type">X1 2.0 sDrive18i</div>
                                    <div class="mycar-idcar">4กข 8113</div>
                                </a>
                            </div>
                            <div class="item-mycar-detail">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="car-detail.php">
                                            <div class="mycar-name">2023 BMW X1</div>
                                            <div class="mycar-type">X1 2.0 sDrive18i</div>
                                            <div class="mycar-idcar">4กข 8113</div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <div class="mycar-post">วันที่ลงขาย :  16 มิ.ย. 66</div>
                                        <div class="mycar-expire">วันที่หมดอายุ :  16 ธ.ค. 66</div>
                                    </div>
                                </div>
                                <div class="mycar-boxline">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mycar-boxprice">
                                                <div class="mycar-price">599,000.-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-mycar-button">
                                <a href="#" class="btn-mycar btn-mycar-edit"><i class="bi bi-pencil-square"></i> แก้ไข</a>
                                <button class="btn-mycar btn-mycar-delete button-delete"><i class="bi bi-trash3-fill"></i> ลบ</button>
                            </div>
                        </div>

                        <div class="txt-editnote">กรุณาแก้ไข: Lorem Ipsum is simply dummy text of the printing and typesetting industry.</div>
                        <div class="item-mycar">
                            <div class="item-mycar-cover">
                                <a href="car-detail.php"><figure><img src="images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png" alt=""></figure></a>
                            </div>
                            <div class="mycar-detail-mb">
                                <a href="car-detail.php">
                                    <div class="mycar-name">2023 BMW X1</div>
                                    <div class="mycar-type">X1 2.0 sDrive18i</div>
                                    <div class="mycar-idcar">4กข 8113</div>
                                </a>
                            </div>
                            <div class="item-mycar-detail">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="car-detail.php">
                                            <div class="mycar-name">2023 BMW X1</div>
                                            <div class="mycar-type">X1 2.0 sDrive18i</div>
                                            <div class="mycar-idcar">4กข 8113</div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        <div class="mycar-post">วันที่ลงขาย :  16 มิ.ย. 66</div>
                                        <div class="mycar-expire">วันที่หมดอายุ :  16 ธ.ค. 66</div>
                                    </div>
                                </div>
                                <div class="mycar-boxline">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="mycar-boxprice">
                                                <div class="mycar-price">599,000.-</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="item-mycar-button">
                                <a href="#" class="btn-mycar btn-mycar-edit"><i class="bi bi-pencil-square"></i> แก้ไข</a>
                                <button class="btn-mycar btn-mycar-delete button-delete"><i class="bi bi-trash3-fill"></i> ลบ</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

	
<?php require('inc_footer.php'); ?>

<script>
    $( ".box-menuprofile > ul > li:nth-child(3) > a" ).addClass( "here" );
    $( ".menu-mycar > ul > li:nth-child(3) > a" ).addClass( "here" );
</script>
<script>
    $(document).on('click', '.button-delete', function(e) {
        Swal.fire({
        title: 'ยืนยันการลบข้อมูล',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#C60D0D',
        cancelButtonColor: '#666',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        denyButtonText: 'ยกเลิก'
        }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                title: 'ลบข้อมูลสำเร็จ',
                icon: 'success',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#C60D0D',
            })
        }
        })
  });
</script>

</div>

</body>

</html>
