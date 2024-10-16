@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - edit-profile2</title>
@endsection

@section('content')
@php
$bg = asset('frontend/images/avatar.jpeg');
@endphp
<?php

$data = session()->all();
$customerdata = session('customer');
$phone = $Customer->phone??'';
$username = $Customer->username??'';
$email = $Customer->email??'';
$image = $Customer->image??asset('frontend/images/avatar.jpeg');
$firstname = $Customer->firstname??'';
$lastname = $Customer->lastname??'';
$place = $Customer->place??'';
$province1 = $Customer->province??'';
$map = $Customer->map??'';
$google_map = $Customer->google_map??'';
$facebook = $Customer->facebook??'';
$line = $Customer->line??'';

// echo "<pre>";
// print_r(session('success'));
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 wrap-page wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="topic-insidepage"><i class="bi bi-circle-fill"></i> แก้ไขโปรไฟล์</h1>
                    <div class="bg-white-profile">
                        <form method="post" action="{{route('editprofileactionPage')}}" enctype="multipart/form-data" onsubmit="return confirmSubmit()" >
                        @csrf
                            <input type="hidden" name="id" value="{{$customerdata->id}}" />
                            <div class="row">
                                <div class="col-12 col-lg-3">
                                    <div class="avatar-upload">
                                        <div class="avatar-edit">
                                            <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                                            <label for="imageUpload"></label>
                                        </div>
                                        <div class="avatar-preview">
                                            <div id="imagePreview" style="background-image: url('{{$image}}');">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="txt-uploadavatar">เปลี่ยนรูปโปรไฟล์</div>
                                </div>
                                <div class="col-12 col-lg-9">
                                    <div class="box-editprofile">
                                        <div class="wrap-frmprofile">
                                            <h2 class="topic-profile">จัดการบัญชี</h2>
                                            <div class="row">
                                                <div class="col-12 col-md-6  boxfrm-profile">
                                                    <label>เบอร์โทรศัพท์</label>
                                                    <input type="text" name="phone" class="form-control" value="{{$phone}}" disabled>
                                                </div>
                                                <div class="col-12 col-md-6  boxfrm-profile">
                                                    <label>อีเมล</label>
                                                    <input type="text" name="email" class="form-control" value="{{$email}}" >
                                                </div>
                                                <div class="col-12 col-md-6 boxfrm-profile">
                                                    <label>ชื่อผู้ขาย<span>*</span></label>
                                                    <input type="text" name="firstname" class="form-control" value="{{$firstname}}">
                                                </div>
                                                <div class="col-12 col-md-6 boxfrm-profile">
                                                    <label>นามสกุล</label>
                                                    <input type="text" name="lastname" class="form-control" value="{{$lastname}}">
                                                </div>
                                                <!-- <div class="col-12 col-md-6 boxfrm-profile">
                                                    <label>เฟสบุ๊ค</label>
                                                    <input type="text" name="facebook" class="form-control" value="{{$facebook}}">
                                                </div> -->
                                                <div class="col-12 col-md-6 boxfrm-profile">
                                                    <label>ไลน์ไอดี</label>
                                                    <input type="text" name="line" class="form-control" value="{{$line}}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="wrap-frmprofile">
                                            <h2 class="topic-profile">สถานที่นัดดูรถ</h2>
                                            <div class="row">
                                                <div class="col-12 col-xl-9 boxfrm-profile">
                                                    <label>สถานที่นัดดูรถ<span>*</span></label>
                                                    <input type="text" name="place" class="form-control" value="{{$place}}">
                                                </div>
                                                <div class="col-12 col-xl-3 boxfrm-profile">
                                                    <label>จังหวัด<span>*</span></label>
                                                    <select name="province" id="" class="form-select">
                                                        <option value="">เลือกจังหวัด</option>
                                                        @foreach($provinces as $keypv => $pv)
                                                        @php
                                                        $selected = $province1==$pv->name_th?'selected':'';
                                                        @endphp
                                                        <option value="{{$pv->name_th}}" {{$selected}}>{{$pv->name_th}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-12 col-xl-6 boxfrm-profile">
                                                    <label>แผนที่</label>
                                                    <input type="file" name="map" accept=".png, .jpg, .jpeg" class="form-control">
                                                </div>
                                                <div class="col-12 col-xl-6 boxfrm-profile">
                                                    <label>Google Map</label>
                                                    <input type="text" name="google_map" class="form-control" value="{{$google_map}}">
                                                </div>
                                                <div class="col-12 col-xl-6 boxfrm-profile">
                                                    <img width="250px" src="{{$map}}" />
                                                </div>
                                                <div class="col-12 text-end">
                                                    <button type="submit" class="btn-profile btn-red"  >บันทึก</button>
                                                </div>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>
                        </form>   
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    function confirmSubmit() {
        Swal.fire({
            title: 'ยืนยันการบันทึกข้อมูล?',
            text: 'คุณแน่ใจหรือไม่ที่ต้องการบันทึกข้อมูลนี้?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ยืนยัน',
            cancelButtonText: 'ยกเลิก',
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, submit the form
                document.forms[0].submit();
            }
        });

        // Prevent default form submission
        return false;
    }

    // @if(session('success'))
    //     Swal.fire({
    //         title: 'บันทึกข้อมูลสำเร็จ!',
    //         text: '{{ session('success') }}',
    //         icon: 'success',
    //         showConfirmButton: false,
    //         timer: 2000  // Adjust the time the success message is displayed (in milliseconds)
    //     });
    // @endif
</script>

@endsection

