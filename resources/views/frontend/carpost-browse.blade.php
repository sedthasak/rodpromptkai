@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - อัพโหลดรูปภาพ</title>
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
    ?>

    <div id="wait" class="box-waiting" style="display:none;">
        <div class="waiting-wrapper-image">
            <img src="{{ asset('uploads/spin.gif') }}" />
        </div>
    </div>

    <form id="carpostForm" action="{{ route('carpostbrowsesubmit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div id="topontop"></div>
        <div id="step1" style="display:none;">
            <section class="row">
                <div class="col-12 wrap-bgstep">
                    <div class="container">
                        <div class="row wow fadeInDown">
                            <div class="col-12 text-center">
                                <h1>ลงขายรถยนต์</h1>
                                <div class="box-iconstep">
                                    <div><img src="{{ asset('frontend/images/icon-step1-active.svg') }}" alt=""></div>
                                    <div><img src="{{ asset('frontend/images/step-arrow.svg') }}" alt=""></div>
                                    <div><img src="{{ asset('frontend/images/icon-step2.svg') }}" alt=""></div>
                                    <div><img src="{{ asset('frontend/images/step-arrow.svg') }}" alt=""></div>
                                    <div><img src="{{ asset('frontend/images/icon-step3.svg') }}" alt=""></div>
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
                                    <div class="topic-step"><span>1.1</span> ข้อมูลทั่วไป</div>
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>ข้อมูล</label>
                                                <input type="text" name="teststep1" class="form-control" value="" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="wrap-boxstep">
                                    <div class="topic-step"><span>1.2</span> รายละเอียดรถยนต์</div>
                                    <div class="frm-step-button text-center">
                                        <div class="btn btn-step btn-nextstep btn_to_step2">ถัดไป</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div id="step2" style="display:none;">
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
                                    <div><img src="{{ asset('frontend/images/icon-step3.svg') }}" alt=""></div>
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
                                    <div class="topic-step"><span>2</span> ข้อมูลผู้ขาย</div>
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>ข้อมูล</label>
                                                <input type="text" name="teststep2" class="form-control" value="" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="frm-step-button text-center">
                                        <div class="btn btn-step btn-backstep btn_to_step1">ย้อนกลับ</div>
                                        <div class="btn btn-step btn-nextstep btn_to_step3">ถัดไป</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <div id="step3">
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
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 frm-step">
                                                <div class="topic-notephoto">อัพโหลดรูปรถ</div>

                                                <!-- Exterior Images Section -->
                                                <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto">
                                                        <img src="{{ asset('frontend/images/icon-upload1.svg') }}" alt=""> รูปภายนอกรถ
                                                    </div>
                                                    <div>
                                                        <label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถยนต์<span>*</span></label>
                                                    </div>
                                                    <div id="exterior-preview" class="row row-photoupload"></div>
                                                    <div class="btn-uploadimg" id="exterior-upload-button">
                                                        <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                    </div>
                                                    <input type="file" id="upload-exterior-input" accept="image/*" multiple style="display: none;">
                                                </div>

                                                <!-- Interior Images Section -->
                                                <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto">
                                                        <img src="{{ asset('frontend/images/icon-upload2.svg') }}" alt=""> รูปห้องโดยสาร
                                                    </div>
                                                    <div>
                                                        <label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label>
                                                    </div>
                                                    <div id="interior-preview" class="row row-photoupload"></div>
                                                    <div class="btn-uploadimg" id="interior-upload-button">
                                                        <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                    </div>
                                                    <input type="file" id="upload-interior-input" accept="image/*" multiple style="display: none;">
                                                </div>

                                                <!-- Registration Image Section -->
                                                <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto">
                                                        <img src="{{ asset('frontend/images/icon-upload3.svg') }}" alt=""> รูปเอกสารทะเบียนรถยนต์
                                                    </div>
                                                    <div id="registration-preview" class="row row-photoupload"></div>
                                                    <div class="btn-uploadimg" id="registration-upload-button">
                                                        <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                    </div>
                                                    <input type="file" id="upload-registration-input" accept="image/*" style="display: none;">
                                                </div>

                                                <!-- Navigation Buttons -->
                                                <div class="frm-step-button text-center">
                                                    <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                                    <button type="submit" class="btn btn-step btn-nextstep" id="submitBtn">สร้าง</button>
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
@include('frontend.layouts.inc_register_sellcar_script')	
@endsection

