<?php

$data = session()->all();
$customerdata = session('customer');
$phone = $customerdata->phone??'-';
$username = $customerdata->username??'-';
$email = $customerdata->email??'-';
$image = $customerdata->image??asset('frontend/images/avatar.jpeg');
$firstname = $customerdata->firstname??'-';
$lastname = $customerdata->lastname??'';
$place = $customerdata->place??'-';
$province = $customerdata->province??'-';
$map = $customerdata->map??'-';
$google_map = $customerdata->google_map??'-';
$facebook = $customerdata->facebook??'-';
$line = $customerdata->line??'-';

// echo "<per>";
// print_r($data);
// echo "</per>";

?>
<!-- <section class="row">
    <div class="col-12 bg-profile wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-3 col-md-3 col-lg-2">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg"  disabled />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('{{$image}}');">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 col-md-6 col-lg-5">
                    <div class="profile-boxname">
                        <div class="profile-name">{{$firstname}} {{$lastname}}</div>
                        <div class="level-member">Member</div>
                        <div class="profile-phone"><i class="bi bi-phone"></i> {{$phone}}</div>
                        <a href="{{route('editprofilePage')}}" class="btn-editprofile"><i class="bi bi-pencil-square"></i> แก้ไขโปรไฟล์</a>&emsp;
                        <a href="/clearsessioncustomer" class="btn-editprofile"><i class="bi bi-pencil-square"></i> ออกจากระบบ</a>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-5 profile-boxbtn text-end">
                    <a href="{{route('profilePage')}}" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> รถที่ลงขาย</a>
                    <a href="{{route('performancePage')}}" class="btn-performance"><img src="{{asset('frontend/images/icon-performance.svg')}}" alt=""> Performance</a>
                    <a href="{{route('customercontactPage')}}" class="btn-cuscontact">รอติดต่อ <div>{{count($contacts_back)}}</div></a>
                </div>
            </div>
        </div>
    </div>
</section> -->
<section class="row">
    <div class="col-12 bg-profile wow fadeInDown">
        <div class="container">
            <div class="row">
                <!-- เพิ่มใหม่ -->
                <div class="col-12">
                    <div class="txt-deal-slot">
                        <img src="{{asset('frontend/images/icon-car.svg')}}" alt="">
                        Slot ลงขาย <div>50</div> คัน
                        <span>|</span>
                        สัญญาหมดอายุ <div>22/05/2024</div> 
                    </div>
                </div>
                <div class="col-3 col-md-3 col-lg-2">
                    <div class="avatar-upload">
                        <div class="avatar-edit">
                            <input type='file' id="imageUpload" accept=".png, .jpg, .jpeg" disabled />
                            <label for="imageUpload"></label>
                        </div>
                        <div class="avatar-preview">
                            <div id="imagePreview" style="background-image: url('{{$image}}');">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-9 col-md-6 col-lg-5">
                    <div class="profile-boxname">
                        <div class="profile-name">{{$firstname}} {{$lastname}}</div>
                        <!-- เพิ่มใหม่ -->
                        <div>
                            <div class="level-member user_member">Member <img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt="" class="member-arrow"></div>
                            <div class="level-member user_silver">Silver Member <img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt="" class="member-arrow"></div>
                            <div class="level-member user_gold">Gold  Member <img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt="" class="member-arrow"></div>
                            <div class="level-member user_platinum">
                                <img src="{{asset('frontend/images2/icon-platinum.svg')}}" class="icon-platinum" alt="">
                                Platinum  Member <img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt="" class="member-arrow">
                            </div>
                        </div>
                        <div class="profile-phone"><i class="bi bi-phone"></i> {{$phone}}</div>
                        <a href="{{route('editprofilePage')}}" class="btn-editprofile"><i class="bi bi-pencil-square"></i> แก้ไขโปรไฟล์</a>
                        <!-- เพิ่มใหม่ -->
                        <a data-fancybox data-src="#logout" href="javascript:;" class="btn-editprofile"><i class="bi bi-box-arrow-right"></i> ออกจากระบบ</a>
                        <div style="display: none;" id="logout">
                            <div class="popup-logout">
                                <h2>ออกจากระบบ</h2>
                                <button class="btn-logout logout-user">ออกจากระบบ <i class="bi bi-box-arrow-right"></i></button>
                                <div class="logout-note">
                                    หากคุณต้องการออกจากระบบทุกบัญชีการใช้งาน กรุณากดที่ปุ่ม <div>ออกจากระบบทุกบัญชี</div>
                                </div>
                                <button class="btn-logout logout-all">ออกจากระบบทุกบัญชี <i class="bi bi-box-arrow-right"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3 col-lg-5 profile-boxbtn text-end">
                    <a href="{{route('profilePage')}}" class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> รถที่ลงขาย</a>
                    <a href="{{route('performancePage')}}" class="btn-performance"><img src="{{asset('frontend/images/icon-performance.svg')}}" alt=""> Performance</a>
                    <a href="{{route('customercontactPage')}}" class="btn-cuscontact">รอติดต่อ <div>{{count($contacts_back)}}</div></a>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
    // console.log("TES");
</script>
<?php

// echo "<pre>";
// print_r($data);
// echo "</pre>";
?>


