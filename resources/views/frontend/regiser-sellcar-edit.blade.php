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
    $formtype = $mycars->type;
?>

    <div id="wait" class="box-waiting" style="display:none;">
        <div class="waiting-wrapper-image">
            <img src="{{ asset('uploads/spin.gif') }}" />
        </div>
    </div>

    <form id="carpostForm" action="{{ route('carpostbrowseeditsubmit', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="customer_id" value="{{$customerid}}" />
        <input type="hidden" name="customer_type" value="{{$mycars->type}}" />
        <input type="hidden" name="post_id" value="{{$mycars->id}}" />
        <input type="hidden" name="status" value="{{$mycars->status}}" />

        <div id="topontop"></div>
        <div id="step1" class="step active">
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
                                    <input type="hidden" name="customer_id" value="{{$customerid}}" />
                                    <input type="hidden" name="customer_type" value="{{$formtype}}" />
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>ชื่่อผู้ลงทะเบียน</label>
                                                <input type="text" name="name" class="form-control" value="{{$firstname.' '.$lastname}}" readonly />
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>ประเภทการลงทะเบียน</label>
                                                <input type="hidden" name="type" value='{{$formtype}}' />
                                                <select class="form-select" name="typeshow" id="typeshow" disabled>
                                                    @foreach($arr_cartype as $keyarr_cartype => $cartype)
                                                    <option value="{{$keyarr_cartype}}" {{($keyarr_cartype==$formtype)?"selected":""}}>{{$cartype}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>อีเมล</label>
                                                <input type="text" name="email" class="form-control" value="{{$email}}" readonly />
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>เบอร์โทรศัพท์</label>
                                                <input type="text" name="phone" class="form-control" value="{{$phone}}" readonly  />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <div class="wrap-boxstep">
                                    <div class="topic-step"><span>1.2</span> รายละเอียดรถยนต์</div>
                                    <div class="box-frm-step">
                                        <div class="row">
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>1. ยี่ห้อ<span>*</span></label>
                                                <select class="form-select select2s" name="brands" id="brands" required>
                                                    <option value="">เลือกยี่ห้อ</option>
                                                    @foreach($brands as $keybn => $bn)
                                                    <option value="{{$bn->id}}" {{($bn->id == $mycars->brand_id)?'selected':''}}>{{$bn->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>2. รุ่น<span>*</span></label>
                                                <select class="form-select select2s" name="models" id="models"  required>
                                                    <option value="">เลือกรุ่น</option>
                                                    <option value="{{$mycars->model->id}}" selected >{{$mycars->model->model}}</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>3. โฉม<span>*</span></label>
                                                <select class="form-select select2s" name="generations" id="generations" required>
                                                    <option value="">เลือกโฉม</option>
                                                    <option value="{{$mycars->generation->id}}" selected >{{$mycars->generation->generations}}</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>4. รุ่นย่อย<span>*</span></label>
                                                <select class="form-select select2s" name="sub_models" id="sub_models" required>
                                                    <option value="">เลือกรุ่นย่อย</option>
                                                    <option value="{{$mycars->subModel->id}}" selected >{{$mycars->subModel->sub_models}}</option>
                                                </select>
                                            </div>
                                            <div class="col-12 frm-step frm-step-inline">
                                                <label>สี<span>*</span></label>
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <select class="form-select" name="color"  required>
                                                            <option value="">เลือกสี</option>
                                                            @foreach($arr_color as $keycolor => $color)
                                                            <option value="{{$color}}" {{($color == $mycars->color)?'selected':''}}>{{$color}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-12 col-md-6">
                                                        <input type="text" name="other_color" class="form-control" placeholder="สีอื่นๆ โปรดระบุ">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>รุ่นปี<span>*</span></label>
                                                <select class="form-select" name="years" id="years" required>
                                                    <option value="">เลือกรุ่นปี</option>
                                                    <option value="{{$mycars->modelyear}}" selected >{{$mycars->modelyear}}</option>
                                                </select>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>เลขไมล์<span>*</span></label>
                                                <input type="text" name="mileage" class="form-control" required value="{{$mycars->mileage??''}}">
                                            </div>
                                            <div class="col-12 col-lg-6 frm-step">
                                                <label>เกียร์<span>*</span></label>
                                                <div class="carsearch-radio">
                                                    <label class="car-radio">ออโต้
                                                        <input type="radio" name="gear" value="auto" {{('auto' == $mycars->gear)?'checked':''}} />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="car-radio">ธรรมดา
                                                        <input type="radio" name="gear" value="manual" {{('manual' == $mycars->gear)?'checked':''}} />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-lg-6 frm-step">
                                                <label>เชื้อเพลิง<span>*</span></label>
                                                <div class="carsearch-radio">
                                                    <label class="car-radio">รถน้ำมัน / hybrid
                                                        <input type="radio" name="gashas" value="1"  {{('รถน้ำมัน / hybrid' == $mycars->gas)?'checked':''}} />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="car-radio">รถไฟฟ้า EV 100%
                                                        <input type="radio" name="gashas" value="2" {{('รถไฟฟ้า EV 100%' == $mycars->gas)?'checked':''}} />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="car-radio">รถติดแก๊ส
                                                        <input type="radio" name="gashas" value="3" {{('รถติดแก๊ส' == $mycars->gas)?'checked':''}} />
                                                        <span class="checkmark"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>ทะเบียนรถ / รหัสรถ</label>
                                                <input type="text" name="vehicle_code" class="form-control" value="{{$mycars->vehicle_code??''}}" >
                                            </div>
                                            <div class="col-12 col-md-6 frm-step">
                                                <label>จังหวัด<span>*</span></label>
                                                <select class="form-select select2s" name="province" required >
                                                    <option value="">เลือกจังหวัด</option>
                                                    @foreach($provinces as $keypv => $pv)
                                                    <option value="{{$pv->name_th}}" {{($pv->name_th == $mycars->province)?'selected':''}}  >{{$pv->name_th}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                                        
                                        </div>
                                    </div>
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

        <div id="step2" class="step">
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

                                            <div class="col-12 frm-step">
                                                <label id="title_label">หัวข้อโฆษณา/โปรโมชั่น<span>*</span></label>
                                                <input aria-labelledby="title_label" type="text" class="form-control" name="title" id="title_txt1" required value="{{$mycars->title??''}}" >
                                                
                                            </div>
                                            <div class="col-12 frm-step">
                                                <label id="detail_label">รายละเอียดรถ<span>*</span></label>
                                                <!-- <img src="{{asset('frontend/images/editor.jpg')}}" style="width: 100%" alt=""> -->
                                                <textarea aria-labelledby="detail_label" class="form-control" id="car_detail"  rows="10" name="detail" required>{{$mycars->detail??''}}</textarea>
                                                <div class="box-introtext">
                                                    <div class="topic-introtext">ข้อความแนะนำ</div>
                                                    <div class="btn-introtext">
                                                        <div  class="clckads btn btn-default button" data-text="มีประวัติการเข้าศูนย์">มีประวัติการเข้าศูนย์</div>
                                                        <div  class="clckads btn btn-default button" data-text="ไม่มีชนหนัก">ไม่มีชนหนัก</div>
                                                        <div  class="clckads btn btn-default button" data-text="รถสภาพดี">รถสภาพดี</div>
                                                        <div  class="clckads btn btn-default button" data-text="มีประกัน">มีประกัน</div>
                                                        <div  class="clckads btn btn-default button" data-text="ดูแลอย่างดี">ดูแลอย่างดี</div>
                                                        <div  class="clckads btn btn-default button" data-text="รถบ้าน">รถบ้าน</div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 frm-step">
                                                <label id="price_label">ตั้งราคาขาย<span>*</span></label>
                                                <div class="txt-noteedit">หลังจากลงขายแล้ว สามารถแก้ไขราคาขายได้ 2 ครั้งเท่านั้น</div>
                                                <input aria-labelledby="price_label" type="text" class="form-control" name="price" id="price" required oninput="formatNumber(this)" value="{{number_format($mycars->price??0)}}"  {{($mycars->edit_price < 2)?'':'readonly'}} >
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
        
        <div id="step3" class="step">
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

                                                @if($formtype == 'home')
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
                                                    <input type="file" id="upload-registration-input" accept="image/*" style="display: none;" required >
                                                </div>
                                                @endif

                                            </div>

                                        @if($formtype=='dealer')
                                        <div class="step-chceckbox dealerstepcheck">
                                            <div class="topic-notephoto">การรับประกันหลังการขาย</div>
                                            <div class="login-checkbox">
                                                <label class="list-checkbox">รถได้รับการตรวจสภาพโดยผู้เชี่ยวชาญ
                                                    <input type="checkbox" name="warranty_1" {{('1' == $mycars->warranty_1)?'checked':''}} >
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="list-checkbox">มีการรับประกัน กรุณาระบุระยะเวลา
                                                    <input type="checkbox" name="warranty_2" {{('1' == $mycars->warranty_2)?'checked':''}} >
                                                    <span class="checkmark"></span>
                                                </label>
                                                <input type="text" class="form-control" placeholder="เช่น 1 ปี / 10,000 กม." name="warranty_2_input" value="{{$mycars->warranty_2_input??''}}"  >
                                                <label class="list-checkbox">มีบริการช่วยเหลือฉุกเฉิน 24 ชม.
                                                    <input type="checkbox" name="warranty_3" {{('1' == $mycars->warranty_3)?'checked':''}} >
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
                                                    <input id="acceptance-checkbox" type="checkbox" name="acception" value="1"  checked required >
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12 frm-step">
                                                <!-- Navigation Buttons -->
                                                <div class="frm-step-button text-center">
                                                    <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                                    <button type="submit" class="btn btn-step btn-nextstep" id="submitBtn">อัพเดทข้อมูล</button>
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
