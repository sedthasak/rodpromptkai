<section class="row">
    <div class="col-12 bg-profile wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-3 col-lg-2">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <?php
                            $avatar = asset('frontend/images/avatar.jpeg');
                            ?>
                            <div id="imagePreview" style="background-image: url('{{$avatar}}');">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 col-md-6 col-lg-5">
                    <div class="profile-boxname">
                        <div class="profile-name">สมชาย ใจดี</div>
                        <div class="level-member">Member</div>
                        <div class="profile-phone"><i class="bi bi-phone"></i> 081-234-5678</div>
                        <a href="{{route('editprofile2Page')}}" class="btn-editprofile"><i class="bi bi-pencil-square"></i> แก้ไขโปรไฟล์</a>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-5 profile-boxbtn text-end">
                    <a href="{{route('profilePage')}}" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> รถที่ลงขาย</a>
                    <a href="{{route('performancePage')}}" class="btn-performance"><img src="{{asset('frontend/images/icon-performance.svg')}}" alt=""> Performance</a>
                    <a href="{{route('customercontactPage')}}" class="btn-cuscontact">รอติดต่อ <div>3</div></a>
                </div>
            </div>
        </div>
    </div>
</section>