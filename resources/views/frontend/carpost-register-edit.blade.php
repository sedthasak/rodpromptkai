@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-step1</title>
@endsection

@section('content')

<?php

$data = session()->all();
$customerdata = session('customer');
$customerid = $customerdata->id;
$phone = $customerdata->phone??'';
$username = $customerdata->username??'';
$email = $customerdata->email??'';
$image = $customerdata->image??asset('frontend/images/avatar.jpeg');
$firstname = $customerdata->firstname??'';
$lastname = $customerdata->lastname??'';
$place = $customerdata->place??'';
$province = $customerdata->province??'';
$map = $customerdata->map??'';
$google_map = $customerdata->google_map??'';
$facebook = $customerdata->facebook??'';
$line = $customerdata->line??'';

$arr_color = array(
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
);
$arr_cartype = array(
    'home' => 'รถบ้าน / เจ้าของรถขายเอง',
    'dealer' => 'ดีลเลอร์ / ลงแบบฝากขาย',
    'lady' => 'รถคุณผู้หญิง',
);

// echo "<pre>";
// print_r($mycars);
// echo "</pre>";
// for ($x = $query->yearlast; $x <= $query->yearfirst; $x++) {
//     echo "The number is: $x <br>";
// }


?>

<style>
    .select2-container .select2-selection--single {
        box-sizing: border-box;
        cursor: pointer;
        display: block;
        height: 45px;
        user-select: none;
        -webkit-user-select: none;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 9px;
        right: 12px;
        width: 20px;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #444;
        line-height: 43px;
    }
    .select2-container .select2-selection--single .select2-selection__rendered {
        display: block;
        padding-left: 17px;
        padding-right: 20px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    /* CSS */
    .dropzone {
        min-height: 0px;
        border: 0px solid rgba(0,0,0,.3);
        background: #fff;
        padding: 0px 0px;
    }

    .dropzone .dz-preview {
        position: relative;
        display: inline-block;
        vertical-align: top;
        margin: 8px;
        border: 0px solid #ebebeb;
        background: #f9f9f9;
        padding: 8px;
        text-align: center;
    }

    .dropzone .dz-preview .dz-remove {
        position: absolute;
        top: 15px;
        right: 15px;
        cursor: pointer;
        font-size: 11px;
        color: white;
        background-color: lightgray;
        border: none;
        z-index: 100000;
        border-radius: 50%; /* เพิ่มบรรทัดนี้เพื่อทำให้มีรูปวงกลม */
        width: 25px; /* Adjust width and height for the desired size */
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        /* opacity: 90%; */
    }

    .dropzone .dz-remove:hover {
        color: red;
    }

    .dz-details {
        display: none;
    }

    .dz-button {
        display: none;
    }

    .dropzone .dz-remove i {
    /* Style for the trash icon */
        color: white;
    }
    .bi {
        line-height: 2.2;
    }

    .dropzone .dz-remove:hover {
        /* Add hover effect if needed */
        background-color: darkred;
    }
</style>

<form method="POST" id="form" action="{{route('carpostregistereditubmitPage')}}" enctype="multipart/form-data">
@csrf
    <div id="topontop"></div>
    <div id="step1">
        <section class="row">
            <div class="col-12 wrap-bgstep">
                <div class="container">
                    <div class="row wow fadeInDown">
                        <div class="col-12 text-center">
                            <h1>ลงขายรถยนต์</h1>
                            <div class="box-iconstep">
                                <div ><img src="{{asset('frontend/images/icon-step1-active.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div ><img src="{{asset('frontend/images/icon-step2.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div ><img src="{{asset('frontend/images/icon-step3.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div ><img src="{{asset('frontend/images/icon-step4.svg')}}" alt=""></div>
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
                                <input type="hidden" name="customer_type" value="{{$mycars->type}}" />
                                <input type="hidden" name="post_id" value="{{$mycars->id}}" />
                                <input type="hidden" name="status" value="{{$mycars->status}}" />
                                <div class="box-frm-step">
                                    <div class="row">
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>ชื่่อผู้ลงทะเบียน</label>
                                            <input type="text" name="name" class="form-control" value="{{$firstname.' '.$lastname}}" readonly />
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>ประเภทการลงทะเบียน</label>
                                            <input type="hidden" name="type" value='{{$mycars->type}}' />
                                            <select class="form-select" name="typeshow" id="typeshow" disabled>
                                                @foreach($arr_cartype as $keyarr_cartype => $cartype)
                                                <option value="{{$keyarr_cartype}}" {{($keyarr_cartype==$mycars->type)?"selected":""}}>{{$cartype}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>อีเมล</label>
                                            <input type="text" name="email" class="form-control" value="{{$email}}" readonly />
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text" name="phone" class="form-control" value="{{$phone}}" readonly  required />
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
                                                <option value="{{$mycars->model_id}}" selected >{{$mycars->model_name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>3. โฉม<span>*</span></label>
                                            <select class="form-select select2s" name="generations" id="generations" required>
                                                <option value="">เลือกโฉม</option>
                                                <option value="{{$mycars->generations_id}}" selected >{{$mycars->generations_name}}</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>4. รุ่นย่อย<span>*</span></label>
                                            <select class="form-select select2s" name="sub_models" id="sub_models" required>
                                                <option value="">เลือกรุ่นย่อย</option>
                                                <option value="{{$mycars->sub_models_id}}" selected >{{$mycars->sub_models_name}}</option>
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

    <div id="step2" style="display:none;">
        <section class="row">
            <div class="col-12 wrap-bgstep">
                <div class="container">
                    <div class="row wow fadeInDown">
                        <div class="col-12 text-center">
                            <h1>ลงขายรถยนต์</h1>
                            <div class="box-iconstep">
                                <a href="{{route('carpoststep1Page')}}"><img src="{{asset('frontend/images/icon-step1-active.svg')}}" alt=""></a>
                                <div class="active"><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep2Page')}}"><img src="{{asset('frontend/images/icon-step2-active.svg')}}" alt=""></a>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep3Page')}}"><img src="{{asset('frontend/images/icon-step3.svg')}}" alt=""></a>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep4Page')}}"><img src="{{asset('frontend/images/icon-step4.svg')}}" alt=""></a>
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
                                            <label>หัวข้อโฆษณา<span>*</span></label>
                                            <input type="text" class="form-control" name="title" id="title_txt1" required value="{{$mycars->title??''}}" >
                                            
                                        </div>
                                        <div class="col-12 frm-step">
                                            <label>รายละเอียดรถ<span>*</span></label>
                                            <!-- <img src="{{asset('frontend/images/editor.jpg')}}" style="width: 100%" alt=""> -->
                                            <textarea class="form-control" id="car_detail"  rows="10" name="detail" required>{{$mycars->detail??''}}</textarea>
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
                                            <label>ตั้งราคาขาย<span>*</span></label>
                                            <div class="txt-noteedit">หลังจากลงขายแล้ว สามารถแก้ไขราคาขายได้ 2 ครั้งเท่านั้น</div>
                                            <input type="text" class="form-control" name="price" id="price" required oninput="formatNumber()" value="{{number_format($mycars->price??0)}}"  {{($mycars->edit_price < 2)?'':'readonly'}} >
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

    <div id="step3" style="display:none;">
        <section class="row">
            <div class="col-12 wrap-bgstep">
                <div class="container">
                    <div class="row wow fadeInDown">
                        <div class="col-12 text-center">
                            <h1>ลงขายรถยนต์</h1>
                            <div class="box-iconstep">
                                <a href="{{route('carpoststep1Page')}}"><img src="{{asset('frontend/images/icon-step1-active.svg')}}" alt=""></a>
                                <div class="active"><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep2Page')}}"><img src="{{asset('frontend/images/icon-step2-active.svg')}}" alt=""></a>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep3Page')}}"><img src="{{asset('frontend/images/icon-step3-active.svg')}}" alt=""></a>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <a href="{{route('carpoststep4Page')}}"><img src="{{asset('frontend/images/icon-step4.svg')}}" alt=""></a>
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
                                                <div class="box-introtext">
                                                    <div class="btn-introtext">
                                                        <ul>
                                                            <li>ไม่อนุญาตให้มีรายละเอียดช่องทางการติดต่อ หรือโปรโมชั่นต่างๆ ภายในรูปภาพ</li>
                                                            <li>สามารถอัพโหลดรูปภาพทั้งภายนอกและห้องโดยสารรวม 5-25 รูป</li>
                                                            <li>ขนาดรูปภาพจะต้องมีขนาดระหว่าง 10Kb แต่ไม่เกิน 12Mb</li>
                                                            <li>นามสกุลไฟล์รูปภาพที่รองรับคือ .jpg และ .jpeg เท่านั้น</li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="box-uploadphoto">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload1.svg')}}" alt=""> รูปภายนอกรถ</div>
                                                        <div><label id="exterior_pictures_label">อัพโหลดรูปภายนอกรถยนต์<span>*</span></label></div>

                                                        <div id="exterior-dropzone" class="dropzone exterior-dropzone">
                                                            
                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <input aria-labelledby="exterior_pictures_label" type="button" name="exterior_pictures[]" id="exterior_pictures">
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                            </button>
                                                        </div>
                                                    </div>
                                                    <div class="box-uploadphoto">
                                                    <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload2.svg')}}" alt=""> รูปห้องโดยสาร</div>
                                                        <div><label id="interior_pictures_label">อัพโหลดรูปห้องโดยสาร<span>*</span></label></div>
                                                        
                                                        <div id="interior-dropzone" class="dropzone interior-dropzone">

                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <input aria-labelledby="interior_pictures_label" type="button" name="interior_pictures[]" id="interior_pictures">
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                        </div>
                                                    </div>
                                                    <div class="box-uploadphoto dealerlicenseplate">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload3.svg')}}" alt=""> เล่มทะเบียนรถ</div>
                                                        <div><label>เอกสารชุดนี้จะไม่แสดงในโพสต์<span>*</span></label></div>
                                                        
                                                        <div id="licenseplate-dropzone" class="dropzone licenseplate-dropzone">
                                                            
                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <input aria-labelledby="licenseplate_pictures_label" type="button" name="licenseplate_pictures" id="licenseplate_pictures">
                                                            <i class="bi bi-plus-circle-fill"></i> เพิ่มสำเนา/เล่มทะเบียนรถ
                                                        </div>
                                                    </div>
                                                </div>
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
                                                <div class="step-chceckbox">
                                                    <div class="login-checkbox">
                                                        <label class="list-checkbox"><a href="{{route('termconditionPage')}}" target="_blank">ยอมรับเงื่อนไขการใช้งาน</a> และ <a href="{{route('privacypolicyPage')}}" target="_blank">นโยบายของเว็บไซต์</a> RodPromptkai.com
                                                            <input type="checkbox" name="submit" value="1" required  checked="checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="frm-step-button text-center">
                                    <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                    <button type="submit" class="btn btn-step btn-nextstep">อัพเดทข้อมูล</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <input type="hidden" name="genname" id="genname" value="{{bin2hex(random_bytes(8))}}">
</form>






@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>

    document.addEventListener("DOMContentLoaded", function () {
        document.getElementById("submit-btn").addEventListener("click", function (event) {
            event.preventDefault();
            validateForm();
        });

        function validateForm() {
            var requiredFields = document.querySelectorAll("[required]");
            var emptyFields = [];

            for (var i = 0; i < requiredFields.length; i++) {
                var fieldValue = requiredFields[i].value.trim();

                // Check if the selected color is "สีอื่นๆ"
                if (requiredFields[i].name === "color" && fieldValue === "9999999999") {
                    // If "สีอื่นๆ" is selected, check if other_color is not empty
                    var otherColorInput = document.querySelector("[name='other_color']");
                    if (otherColorInput.value.trim() === "") {
                        // If other_color is empty, add the label to the emptyFields array
                        var labelId = otherColorInput.getAttribute("aria-labelledby");
                        var label = document.getElementById(labelId);
                        emptyFields.push(label.innerText);
                    }
                } else if (fieldValue === "") {
                    // If other fields are empty, add them to the emptyFields array
                    // console.log(i);
                    var labelId = requiredFields[i].getAttribute("aria-labelledby");
                    var label = document.getElementById(labelId);
                    emptyFields.push(label.innerText);
                }
            }



            // ตรวจสอบขนาดของไฟล์ exterior_pictures
            var files = $("[name='exterior_pictures[]']")[0].files;
            var isValid = true;

            for (var i = 0; i < files.length; i++) {
                var fileSize = files[i].size / 1024; // แปลงเป็น KB

                if (fileSize < 10 || fileSize > 12000) {
                    isValid = false;
                    break;
                }
            }

            // ถ้าขนาดไฟล์ไม่ถูกต้อง ยกเลิกการ submit
            if (!isValid) {
                emptyFields.push("ขนาดภาพไม่ถูกต้องตามเงื่อนไข");
            }

            // ตรวจสอบขนาดของไฟล์ interior_pictures
            var files = $("[name='interior_pictures[]']")[0].files;
            var isValid = true;

            for (var i = 0; i < files.length; i++) {
                var fileSize = files[i].size / 1024; // แปลงเป็น KB

                if (fileSize < 10 || fileSize > 12000) {
                    isValid = false;
                    break;
                }
            }

            // ถ้าขนาดไฟล์ไม่ถูกต้อง ยกเลิกการ submit
            if (!isValid) {
                emptyFields.push("ขนาดภาพไม่ถูกต้องตามเงื่อนไข");
            }
            
            // ตรวจสอบขนาดของไฟล์ licenseplate
            var inputFile = $("[name='licenseplate']")[0];
            if (inputFile.files.length > 0) {
                // ดึงขนาดของไฟล์
                var fileSize = inputFile.files[0].size; // ขนาดไฟล์อยู่ในหน่วย bytes

                // ตรวจสอบว่าขนาดไฟล์อยู่ในช่วงที่กำหนดหรือไม่
                if (fileSize >= 10240 && fileSize <= 12000000) {
                    // ขนาดไฟล์ถูกต้อง
                } else {
                    // ขนาดไฟล์ไม่ถูกต้อง
                    emptyFields.push("ขนาดภาพไม่ถูกต้องตามเงื่อนไข");
                }
            } else {
                // ไม่มีไฟล์ถูกเลือก
            }







            if (emptyFields.length > 0) {
                var errorMessage = "\n";
                for (var j = 0; j < emptyFields.length; j++) {
                    errorMessage += "- " + emptyFields[j] + ",\n";
                }

                Swal.fire({
                    icon: "error",
                    title: "กรุณากรอกข้อมูลให้ครบถ้วน...",
                    text: errorMessage,
                });
            } else {
                // document.getElementById("#form").submit();

                var form = document.querySelector("#regis");
                // console.log(form);
                if (form) {
                    // console.log(form.submit);
                    form.submit();
                    $('#wait').show();

                    // You can also disable the submit button to prevent multiple submissions
                    $('.btn-nextstep').prop('disabled', true);
                }
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Initialize CKEditor
        ClassicEditor
            .create(document.querySelector('#car_detail'))
            .then(editor => {
                // Add event listener to buttons with class 'clckads'
                var buttons = document.querySelectorAll('.clckads');
                if (buttons) {
                    buttons.forEach(button => {
                        button.addEventListener('click', function () {
                            // Get the text from the 'data-text' attribute
                            var buttonText = button.getAttribute('data-text');

                            // Get the CKEditor instance
                            var editorInstance = editor;

                            // Check if the instance is available
                            if (editorInstance) {
                                // Get the current content
                                var currentContent = editorInstance.getData();

                                // Concatenate the current content with the button text
                                var newText = currentContent + buttonText ;

                                // Set the new content
                                editorInstance.setData(newText);
                            } else {
                                console.error('CKEditor instance not found.');
                            }
                        });
                    });
                } else {
                    console.error('Buttons with class "clckads" not found.');
                }
            })
            .catch(error => {
                console.error(error);
            });
    });

    

    $(document).ready(function() {


        $(".clckads").on( "click", function() {
            var oldtext = $("#car_detail").val();
            var thistext = $(this).text();
            var newtext = oldtext+thistext;
            

            add_text(newtext);
        } );


        function add_text(newtext){ 
            document.getElementById("car_detail").value = newtext;
        }






        $(".btn_to_step1").on( "click", function() {
            $('html, body').animate({
                scrollTop: $("#topontop").offset().top
            }, 100);
            $('#step1').show();
            $('#step2').hide();
            $('#step3').hide();
            $('#step4').hide();
        } );
        $(".btn_to_step2").on( "click", function() {
            $('html, body').animate({
                scrollTop: $("#topontop").offset().top
            }, 100);
            $('#step1').hide();
            $('#step2').show();
            $('#step3').hide();
            $('#step4').hide();
        } );
        $(".btn_to_step3").on( "click", function() {
            $('html, body').animate({
                scrollTop: $("#topontop").offset().top
            }, 100);
            $('#step1').hide();
            $('#step2').hide();
            $('#step3').show();
            $('#step4').hide();
        } );
        // $(".btn_to_step4").on( "click", function() {
        //     $('#step1').hide();
        //     $('#step2').hide();
        //     $('#step3').hide();
        //     $('#step4').show();
        // } );

        $("#generations").on( "change", function() {
            var generations_id = $(this).val();
            if(generations_id){
                $.ajax({
                    url: "{{route('carpostSelectGenerations')}}",
                    type: "post",
                    data: { 
                        generations_id: generations_id, 
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#sub_models').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
                $.ajax({
                    url: "{{route('carpostSelectGenerationsYear')}}",
                    type: "post",
                    data: { 
                        generations_id: generations_id, 
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#years').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        } );

        $("#models").on( "change", function() {
            var models_id = $(this).val();
            if(models_id){
                $.ajax({
                    url: "{{route('carpostSelectModel')}}",
                    type: "post",
                    data: { 
                        models_id: models_id, 
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#generations').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        } );

        $("#brands").on( "change", function() {
            var brands_id = $(this).val();
            if(brands_id){
                $.ajax({
                    url: "{{route('carpostSelectBrand')}}",
                    type: "post",
                    data: { 
                        brands_id: brands_id, 
                        _token: '{{csrf_token()}}'
                    },
                    success: function (response) {
                        // console.log(response);
                        $('#models').html(response);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus, errorThrown);
                    }
                });
            }
        } );
    }); 

    
</script>
<script>
    var interior_count = 0;
    var exterior_count = 0;
    var totalimage = 25;
    var currentImageCount = 0;
    $(document).ready(function() {
        
        $(".select2s").select2();
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });
        if ($("#typeshow").val() == "dealer") {
            $(".dealerlicenseplate").hide();
            $(".dealerstepcheck").show();
        }
        else {
            $(".dealerlicenseplate").show();
            $(".dealerstepcheck").hide();
        }
        $('#price').on('input', function() {
            let value = $(this).val().replace(/,/g, ''); // ลบ comma เดิม
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ','); // เพิ่ม comma ทุก 3 หลัก

            $(this).val(value);
        });
    });
    $(function() {
        
    });
    function del(e) {
        id = e.replace("picture_interior_", "");
        $("#hidden_interior_"+id).remove();
        $("#border_interior_"+id).remove();
        interior_count--;
    }
    function delexterior(e) {
        id = e.replace("picture_exterior_", "");
        $("#hidden_exterior_"+id).remove();
        $("#border_exterior_"+id).remove();
        exterior_count--;
    }
    Dropzone.autoDiscover = true;
    var exteriorDropzone = new Dropzone("#exterior-dropzone", {
        paramName: "file",
        url: "/exterior-upload",
        clickable: "#exterior_pictures", // Attach the button to trigger file selection
        // Additional configuration options as needed
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        addRemoveLinks: true,  // เพิ่มลิงก์ลบสำหรับแต่ละไฟล์
        maxFilesize: 12,        // ขนาดไฟล์สูงสุด (MB)
        acceptedFiles: ".jpeg,.jpg,.png", // ประเภทไฟล์ที่ยอมรับ
        dictRemoveFile: '<i class="bi bi-trash3-fill"></i>', // Change the text for the remove link
        parallelUploads: 1,

        init: function () {
            this.on("addedfile", function (file) {
                currentImageCount++;
                // Check if the current image count is less than the total allowed images
                if (currentImageCount-1 < totalimage) {
                    // Increment the current image count
                } else {
                    // If the limit is reached, remove the file from Dropzone
                    this.removeFile(file);
                }
                
            });

            this.on("removedfile", function (file) {
                currentImageCount--; // Decrease count when file is removed
                // Add AJAX request to delete file from the database
                $.ajax({
                    url: '/exterior-delete', // Replace with the actual endpoint to delete a file
                    method: 'POST',
                    data: {
                        filename: file.name,
                        genname: $('#genname').val()
                    },
                    success: function (response) {
                        // Handle the response from the server (if needed)
                    },
                    error: function (error) {
                        // Handle the error (if needed)
                    }
                });
            });

            // Set up the params to send additional data
            this.on("sending", function (file, xhr, formData) {
                formData.append("genname", $('#genname').val());
            });
            var existingImageUrls = [];
            @foreach ($exterior as $row)
                existingImageUrls.push("{{url('/').'/'.$row->gallery}}");
            @endforeach

            // console.log(existingImageUrls);
            // ตำแหน่งที่รูปภาพเก่าถูกแสดงใน Dropzone
            
            existingImageUrls.forEach(function(imageUrl) {
                // Add existing images to Dropzone
                exteriorDropzone.addFile(imageUrl);
            });
        }
    });

    $(".exterior-dropzone").sortable({
        items:'.dz-preview',
        containment: '.exterior-dropzone',
        cursor: 'grab',
        opacity: 0.5,
        distance: 5,
        tolerance: 'pointer',

        stop: function () {
            var queue = exteriorDropzone.getAcceptedFiles();
            newQueue = [];
            $('#exterior-dropzone .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {           
                    var name = el.innerHTML;
                    queue.forEach(function(file) {
                        if (file.name === name) {
                            newQueue.push(file);
                        }
                    });
            });
            exteriorDropzone.files = newQueue;

            // Include the CSRF token in the AJAX request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/exterior-rearrange',
                method: 'POST',
                data: {
                    files: newQueue.map(file => file.name),
                    genname: $('#genname').val()
                },
                success: function (response) {
                    // console.log(response); // Handle the response from the server
                },
                error: function (error) {
                    // console.error(error);
                }
            });


        }
    });
    var interiorDropzone = new Dropzone("#interior-dropzone", {
        paramName: "file",
        url: "/interior-upload",
        clickable: "#interior_pictures", // Attach the button to trigger file selection
        // Additional configuration options as needed
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        addRemoveLinks: true,  // เพิ่มลิงก์ลบสำหรับแต่ละไฟล์
        maxFilesize: 12,        // ขนาดไฟล์สูงสุด (MB)
        acceptedFiles: ".jpeg,.jpg,.png", // ประเภทไฟล์ที่ยอมรับ
        dictRemoveFile: '<i class="bi bi-trash3-fill"></i>', // Change the text for the remove link
        parallelUploads: 1,

        init: function () {
            this.on("addedfile", function (file) {
                currentImageCount++;
                // Check if the current image count is less than the total allowed images
                if (currentImageCount-1 < totalimage) {
                    // Increment the current image count
                } else {
                    // If the limit is reached, remove the file from Dropzone
                    this.removeFile(file);
                }
                
            });

            this.on("removedfile", function (file) {
                currentImageCount--; // Decrease count when file is removed
                // Add AJAX request to delete file from the database
                $.ajax({
                    url: '/interior-delete', // Replace with the actual endpoint to delete a file
                    method: 'POST',
                    data: {
                        filename: file.name,
                        genname: $('#genname').val()
                    },
                    success: function (response) {
                        // Handle the response from the server (if needed)
                    },
                    error: function (error) {
                        // Handle the error (if needed)
                    }
                });
            });

            // Set up the params to send additional data
            this.on("sending", function (file, xhr, formData) {
                formData.append("genname", $('#genname').val());
            });
        }
    });

    $(".interior-dropzone").sortable({
        items:'.dz-preview',
        containment: '.interior-dropzone',
        cursor: 'grab',
        opacity: 0.5,
        distance: 5,
        tolerance: 'pointer',

        stop: function () {
            var queue = interiorDropzone.getAcceptedFiles();
            newQueue = [];
            $('#interior-dropzone .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {           
                    var name = el.innerHTML;
                    queue.forEach(function(file) {
                        if (file.name === name) {
                            newQueue.push(file);
                        }
                    });
            });
            interiorDropzone.files = newQueue;

            // Include the CSRF token in the AJAX request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/interior-rearrange',
                method: 'POST',
                data: {
                    files: newQueue.map(file => file.name),
                    genname: $('#genname').val()
                },
                success: function (response) {
                    // console.log(response); // Handle the response from the server
                },
                error: function (error) {
                    // console.error(error);
                }
            });


        }
    });

    var licenseplateDropzone = new Dropzone("#licenseplate-dropzone", {
        paramName: "file",
        url: "/licenseplate-upload",
        clickable: "#licenseplate_pictures", // Attach the button to trigger file selection
        // Additional configuration options as needed
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        addRemoveLinks: true,  // เพิ่มลิงก์ลบสำหรับแต่ละไฟล์
        maxFilesize: 12,        // ขนาดไฟล์สูงสุด (MB)
        acceptedFiles: ".jpeg,.jpg,.png", // ประเภทไฟล์ที่ยอมรับ
        dictRemoveFile: '<i class="bi bi-trash3-fill"></i>', // Change the text for the remove link
        parallelUploads: 1,

        init: function () {
            this.on("addedfile", function (file) {
                currentImageCount++;
                // Check if the current image count is less than the total allowed images
                if (currentImageCount-1 < totalimage) {
                    // Increment the current image count
                } else {
                    // If the limit is reached, remove the file from Dropzone
                    this.removeFile(file);
                }

                if (this.files.length > 1) {
                    // ถ้ามีไฟล์มากกว่า 1 ให้ลบไฟล์ทั้งหมดที่เพิ่มเข้ามา
                    this.removeFile(this.files[0]);
                }
                
            });

            this.on("removedfile", function (file) {
                currentImageCount--; // Decrease count when file is removed
                // Add AJAX request to delete file from the database
                $.ajax({
                    url: '/licenseplate-delete', // Replace with the actual endpoint to delete a file
                    method: 'POST',
                    data: {
                        filename: file.name,
                        genname: $('#genname').val()
                    },
                    success: function (response) {
                        // Handle the response from the server (if needed)
                    },
                    error: function (error) {
                        // Handle the error (if needed)
                    }
                });
            });

            // Set up the params to send additional data
            this.on("sending", function (file, xhr, formData) {
                formData.append("genname", $('#genname').val());
            });
        }
    });

    $(".licenseplate-dropzone").sortable({
        items:'.dz-preview',
        containment: '.licenseplate-dropzone',
        cursor: 'grab',
        opacity: 0.5,
        distance: 5,
        tolerance: 'pointer',

        stop: function () {
            var queue = licenseplateDropzone.getAcceptedFiles();
            newQueue = [];
            $('#licenseplate-dropzone .dz-preview .dz-filename [data-dz-name]').each(function (count, el) {           
                    var name = el.innerHTML;
                    queue.forEach(function(file) {
                        if (file.name === name) {
                            newQueue.push(file);
                        }
                    });
            });
            licenseplateDropzone.files = newQueue;

            // Include the CSRF token in the AJAX request
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: '/licenseplate-rearrange',
                method: 'POST',
                data: {
                    files: newQueue.map(file => file.name),
                    genname: $('#genname').val()
                },
                success: function (response) {
                    // console.log(response); // Handle the response from the server
                },
                error: function (error) {
                    // console.error(error);
                }
            });


        }
    });
</script>
@endsection