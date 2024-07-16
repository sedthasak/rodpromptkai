@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - Edit Car Post</title>
@endsection

@section('content')
@include('frontend.layouts.inc_register_sellcar_style')
<?php
    $data = session()->all();
    $customerdata = session('customer');
    $customerid = $customerdata->id;
    $phone = $customerdata->phone ?? '';
    $username = $customerdata->username ?? '';
    $email = $customerdata->email ?? '';
    $image = $customerdata->image ?? asset('frontend/images/avatar.jpeg');
    $firstname = $customerdata->firstname ?? '';
    $lastname = $customerdata->lastname ?? '';
    $place = $customerdata->place ?? '';
    $province = $customerdata->province ?? '';
    $map = $customerdata->map ?? '';
    $google_map = $customerdata->google_map ?? '';
    $facebook = $customerdata->facebook ?? '';
    $line = $customerdata->line ?? '';

    $arr_color = [
        'white' => 'ขาว',
        'เขียว' => 'เขียว',
        'แดง' => 'แดง',
        'ดำ' => 'ดำ',
        'ชมพู' => 'ชมพู',
        'ครีม' => 'ครีม',
        'เทา' => 'เทา',
        'เทา-เขียว' => 'เทา-เขียว',
        'เทา-ดำ' => 'เทา-ดำ',
        'เทา-น้ำเงิน' => 'เทา-น้ำเงิน',
        'น้ำเงิน' => 'น้ำเงิน',
        'น้ำตาล' => 'น้ำตาล',
        'บรอนซ์เงิน' => 'บรอนซ์เงิน',
        'บรอนซ์ทอง' => 'บรอนซ์ทอง',
        'ฟ้า' => 'ฟ้า',
        'ม่วง' => 'ม่วง',
        'ส้ม' => 'ส้ม',
        'เหลือง' => 'เหลือง',
    ];

    $arr_cartype = [
        'home' => 'รถบ้าน / เจ้าของรถขายเอง',
        'dealer' => 'ดีลเลอร์ / ลงแบบฝากขาย',
        'lady' => 'รถคุณผู้หญิง',
    ];
    $_POST['type'] = 'home';
?>

<div id="wait" class="box-waiting" style="display:none;">
    <div class="waiting-wrapper-image">
        <img src="{{ asset('uploads/spin.gif') }}" />
    </div>
</div>

<form id="carpostForm" action="{{ route('carpostbrowseeditsubmit', $post->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div id="step3" class="step active">
        <section class="row">
            <div class="col-12 wrap-bgstep">
                <div class="container">
                    <div class="row wow fadeInDown">
                        <div class="col-12 text-center">
                            <h1>ลงขายรถยนต์</h1>
                            <div class="box-iconstep">
                                <div><img src="{{ asset('frontend/images/icon-step1-active.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/step-arrow.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/icon-step2-active.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/step-arrow.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/icon-step3-active.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/step-arrow.svg') }}" alt=""></div>
                                <div><img src="{{ asset('frontend/images/icon-step4.svg') }}" alt=""></div>
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
                                <div class="topic-step"><span>3</span> อัพโหลดรูปภาพ</div>
                                <div class="box-introtext">
                                    <div class="btn-introtext">
                                        <ul>
                                            <li>ไม่อนุญาตให้มีรายละเอียดช่องทางการติดต่อ หรือโปรโมชั่นต่างๆ ภายในรูปภาพ</li>
                                            <li>สามารถอัพโหลดรูปภาพทั้งภายนอกและห้องโดยสารรวม 5-25 รูป</li>
                                            <li>ขนาดรูปภาพจะต้องมีขนาดระหว่าง 10Kb แต่ไม่เกิน 12Mb</li>
                                            <li>นามสกุลไฟล์รูปภาพที่รองรับคือ .png .jpg และ .jpeg เท่านั้น</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="box-frm-step">
                                    <div class="row">
                                        <div class="col-12 frm-step">
                                            <!-- Exterior Images Section -->
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload1.svg') }}" alt=""> รูปภายนอกรถ&emsp;
                                                    <span id="exterior_uploading" style="display:none;">กำลังอัปโหลด</span>
                                                </div>
                                                <div>
                                                    <label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถ<span>*</span></label>
                                                </div>
                                                <div id="exterior-preview" class="row row-photoupload">
                                                    @foreach ($restImages['exterior'] as $imagePath)
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload loading">
                                                                <button type="button" class="remove-image-button" data-path="{{ asset('storage/' . $imagePath) }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img style="opacity:1;" src="{{ asset('storage/' . $imagePath) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="image_paths[]" value="{{ $imagePath }}">
                                                            </div>
                                                            <div class="wrapper-spinner">
                                                                <div class="spinner" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="btn-uploadimg" id="exterior-upload-button">
                                                    <i class="bi bi-plus-circle-fill"></i> เพิ่มรูปภายนอกรถ
                                                </div>
                                                <input type="file" id="upload-exterior-input" accept="image/*" multiple style="display: none;">
                                            </div>

                                            <!-- Interior Images Section -->
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload2.svg') }}" alt=""> รูปห้องโดยสาร&emsp;
                                                    <span id="interior_uploading" style="display:none;">กำลังอัปโหลด</span>
                                                </div>
                                                <div>
                                                    <label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label>
                                                </div>
                                                <div id="interior-preview" class="row row-photoupload">
                                                    @foreach ($restImages['interior'] as $imagePath)
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload loading">
                                                                <button type="button" class="remove-image-button" data-path="{{ asset('storage/' . $imagePath) }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img style="opacity:1;" src="{{ asset('storage/' . $imagePath) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="interior_paths[]" value="{{ $imagePath }}">
                                                            </div>
                                                            <div class="wrapper-spinner">
                                                                <div class="spinner" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="btn-uploadimg" id="interior-upload-button">
                                                    <i class="bi bi-plus-circle-fill"></i> เพิ่มรูปห้องโดยสาร
                                                </div>
                                                <input type="file" id="upload-interior-input" accept="image/*" multiple style="display: none;">
                                            </div>

                                            <!-- Registration Image Section -->
                                            <div class="box-uploadphoto">
                                                <div class="topic-uploadphoto">
                                                    <img src="{{ asset('frontend/images/icon-upload3.svg') }}" alt=""> รูปเอกสารทะเบียนรถยนต์&emsp;
                                                    <span id="registration_uploading" style="display:none;">กำลังอัปโหลด</span>
                                                </div>
                                                <div>
                                                    <label id="registration_pictures_label">อัพโหลดรูปทะเบียนรถ<span>*</span></label>
                                                </div>
                                                <div id="registration-preview" class="row row-photoupload">
                                                    @if (!empty($restImages['registration']))
                                                        <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                            <div class="item-photoupload loading">
                                                                <button type="button" class="remove-image-button" data-path="{{ asset('storage/' . $restImages['registration'][0]) }}"><i class="bi bi-trash3-fill"></i></button>
                                                                <img style="opacity:1;" src="{{ asset('storage/' . $restImages['registration'][0]) }}" alt="Image" class="uploaded-image">
                                                                <input type="hidden" name="registration_paths[]" value="{{ $restImages['registration'][0] }}">
                                                            </div>
                                                            <div class="wrapper-spinner">
                                                                <div class="spinner" style="display: none;"></div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="btn-uploadimg" id="registration-upload-button">
                                                    <i class="bi bi-plus-circle-fill"></i> เพิ่มรูปทะเบียนรถ
                                                </div>
                                                <input type="file" id="upload-registration-input" accept="image/*" style="display: none;">
                                            </div>

                                        </div>
                                    </div>
                                    @if($_POST['type']=='dealer')
                                    <div class="step-chceckbox dealerstepcheck">
                                        <div class="topic-notephoto">การรับประกันหลังการขาย</div>
                                        <div class="login-checkbox">
                                            <label class="list-checkbox">รถได้รับการตรวจสภาพโดยผู้เชี่ยวชาญ
                                                <input type="checkbox" name="warranty_1">
                                                <span class="checkmark"></span>
                                            </label>
                                            <label class="list-checkbox">มีการรับประกัน กรุณาระบุระยะเวลา
                                                <input type="checkbox" name="warranty_2">
                                                <span class="checkmark"></span>
                                            </label>
                                            <input type="text" class="form-control" placeholder="เช่น 1 ปี / 10,000 กม." name="warranty_2_input">
                                            <label class="list-checkbox">มีบริการช่วยเหลือฉุกเฉิน 24 ชม.
                                                <input type="checkbox" name="warranty_3">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="txt-markpost">
                                        **โปรดระบุข้อมูลที่ตรงกับความเป็นจริงเท่านั้น หากตรวจพบว่าไม่เป็นจริง ทางเว็บไซต์จะลบโพสต์ออกทันที 
                                        </div>
                                    </div>
                                    @endif

                                    <div class="step-chceckbox">
                                        <div class="login-checkbox">
                                            <label class="list-checkbox"><a href="{{route('termconditionPage')}}" target="_blank">ยอมรับเงื่อนไขการใช้งาน</a> และ <a href="{{route('privacypolicyPage')}}" target="_blank">นโยบายของเว็บไซต์</a> RodPromptkai.com
                                                <input type="checkbox" value="1"  checked>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 frm-step">
                                            <!-- Navigation Buttons -->
                                            <div class="frm-step-button text-center">
                                                <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                                <button type="submit" class="btn btn-step btn-nextstep" id="บันทึก">สร้าง</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</form>

@endsection

@section('script')
@include('frontend.layouts.inc_regedit_sellcar_script')	

@endsection
