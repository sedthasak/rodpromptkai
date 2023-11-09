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

// echo "<pre>";
// print_r($customerid);
// echo "</pre>";
// for ($x = $query->yearlast; $x <= $query->yearfirst; $x++) {
//     echo "The number is: $x <br>";
// }

?>
    

<form method="POST" id="form" action="{{route('carpostregisterSubmitPage')}}" enctype="multipart/form-data">
@csrf
    <div id="step1">
        <section class="row">
            <div class="col-12 wrap-bgstep">
                <div class="container">
                    <div class="row wow fadeInDown">
                        <div class="col-12 text-center">
                            <h1>ลงขายรถยนต์</h1>
                            <div class="box-iconstep">
                                <div href="{{route('carpoststep1Page')}}"><img src="{{asset('frontend/images/icon-step1-active.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div href="{{route('carpoststep2Page')}}"><img src="{{asset('frontend/images/icon-step2.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div href="{{route('carpoststep3Page')}}"><img src="{{asset('frontend/images/icon-step3.svg')}}" alt=""></div>
                                <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                                <div href="{{route('carpoststep4Page')}}"><img src="{{asset('frontend/images/icon-step4.svg')}}" alt=""></div>
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
                                <div class="box-frm-step">
                                    <div class="row">
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>ชื่่อผู้ลงทะเบียน</label>
                                            <input type="text" name="name" class="form-control" value="{{$firstname.' '.$lastname}}" readonly />
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>ประเภทการลงทะเบียน</label>
                                            <select class="form-select" name="type">
                                                <option value="home">รถทั่วไป</option>
                                                <option value="dealer">ดีลเลอร์</option>
                                                <option value="lady">รถคุณผู้หญิง</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>อีเมล</label>
                                            <input type="text" name="email" class="form-control" value="{{$email}}" readonly />
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>เบอร์โทรศัพท์</label>
                                            <input type="text" name="phone" class="form-control" value="{{$phone}}" readonly />
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
                                            <select class="form-select" name="brands" id="brands">
                                                <option value="">เลือกยี่ห้อ</option>
                                                @foreach($brands as $keybn => $bn)
                                                <option value="{{$bn->id}}">{{$bn->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>2. รุ่น<span>*</span></label>
                                            <select class="form-select" name="models" id="models">
                                                <option value="">เลือกรุ่น</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>3. โฉม<span>*</span></label>
                                            <select class="form-select" name="generations" id="generations">
                                                <option value="">เลือกโฉม</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>4. รุ่นย่อย<span>*</span></label>
                                            <select class="form-select" name="sub_models" id="sub_models">
                                                <option value="">เลือกรุ่นย่อย</option>
                                            </select>
                                        </div>
                                        <div class="col-12 frm-step frm-step-inline">
                                            <label>สี<span>*</span></label>
                                            <div class="row">
                                                <div class="col-12 col-md-6">
                                                    <select class="form-select" name="color" >
                                                        <option value="">เลือกสี</option>
                                                        @foreach($arr_color as $keycolor => $color)
                                                        <option value="{{$color}}">{{$color}}</option>
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
                                            <select class="form-select" name="years" id="years">
                                                <option value="">เลือกรุ่นปี</option>
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>เลขไมล์<span>*</span></label>
                                            <input type="text" name="mileage" class="form-control">
                                        </div>
                                        <div class="col-12 col-lg-6 frm-step">
                                            <label>เกียร์<span>*</span></label>
                                            <div class="carsearch-radio">
                                                <label class="car-radio">ออโต้
                                                    <input type="radio" name="gear" value="auto" />
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="car-radio">ธรรมดา
                                                    <input type="radio" name="gear" value="manual" />
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-6 frm-step">
                                            <label>แก๊ส<span>*</span></label>
                                            <div class="carsearch-radio">
                                                <label class="car-radio">ไม่ติดแก๊ส
                                                    <input type="radio" name="gashas" value="no" />
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="car-radio">NGV
                                                    <input type="radio" name="gashas" value="ngv" />
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="car-radio">LPG
                                                    <input type="radio" name="gashas" value="lpg" />
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="car-radio">รถไฟฟ้า
                                                    <input type="radio" name="gashas" value="ev" />
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>ทะเบียนรถ<span>*</span></label>
                                            <input type="text" name="vehicle_code" class="form-control">
                                        </div>
                                        <div class="col-12 col-md-6 frm-step">
                                            <label>จังหวัด<span>*</span></label>
                                            <select class="form-select" name="province" >
                                                <option value="">เลือกจังหวัด</option>
                                                @foreach($provinces as $keypv => $pv)
                                                <option value="{{$pv->name_th}}">{{$pv->name_th}}</option>
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
                                            <input type="text" class="form-control" name="title" placeholder="ข้อความโฆษณาของคุณ">
                                            <div class="box-introtext">
                                                <div class="topic-introtext">ข้อความแนะนำ</div>
                                                <div class="btn-introtext">
                                                    <div class="btn button">มีประวัติการเข้าศูนย์</div>
                                                    <button>ไม่มีชนหนัก</button>
                                                    <button>รถสภาพดี</button>
                                                    <button>มีประกัน</button>
                                                    <button>ดูแลอย่างดี</button>
                                                    <button>รถบ้าน</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 frm-step">
                                            <label>รายละเอียดรถ<span>*</span></label>
                                            <img src="{{asset('frontend/images/editor.jpg')}}" style="width: 100%" alt="">
                                        </div>
                                        <div class="col-12 frm-step">
                                            <label>ตั้งราคาขาย<span>*</span></label>
                                            <div class="txt-noteedit">หลังจากลงขายแล้ว สามารถแก้ไขราคาขายได้ 2 ครั้งเท่านั้น</div>
                                            <input type="number" class="form-control" name="price">
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
                                                        <div><label>อัพโหลดรูปภายนอกรถยนต์<span>*</span></label></div>

                                                        <div class="row row-photoupload" id="image-preview-exterior">
                                                            {{-- <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                                <div class="item-photoupload">
                                                                    <button type="button"><i class="bi bi-trash3-fill"></i></button>
                                                                    <img src="{{asset('frontend/images/Rectangle 2338.jpg')}}" alt="">
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div id="hidden-inputs-exterior"></div>
                                                        <div id="hidden-inputs-feature"></div>
                                                        <div class="btn-uploadimg">
                                                            <input type="file" name="exterior_pictures[]" id="exterior_pictures" multiple>
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                        </div>
                                                    </div>
                                                    <div class="box-uploadphoto">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload2.svg')}}" alt=""> รูปห้องโดยสาร</div>
                                                        <div><label>อัพโหลดรูปห้องโดยสาร<span>*</span></label></div>
                                                        
                                                        <div class="row row-photoupload" id="image-preview">
                                                            {{-- <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                                <div class="item-photoupload">
                                                                    <button type="button"><i class="bi bi-trash3-fill"></i></button>
                                                                    <img src="{{asset('frontend/images/Rectangle 2338.jpg')}}" alt="">
                                                                </div>
                                                            </div> --}}
                                                        </div>
                                                        <div id="hidden-inputs"></div>
                                                        <div class="btn-uploadimg">
                                                            <input type="file" name="interior_pictures[]" id="interior_pictures" multiple>
                                                            <i class="bi bi-plus-circle-fill"></i> อัพโหลดรูปรถ
                                                        </div>
                                                    </div>
                                                    <div class="box-uploadphoto">
                                                        <div class="topic-uploadphoto"><img src="{{asset('frontend/images/icon-upload3.svg')}}" alt=""> เล่มทะเบียนรถ</div>
                                                        <div><label>เอกสารชุดนี้จะไม่แสดงในโพสต์</label></div>
                                                        <div class="row row-photoupload" id="image-preview-licenseplate">
                                                            <div class="col-4 col-md-3 col-lg-2 col-photoupload">
                                                                {{-- <div class="item-photoupload">
                                                                    <button type="button"><i class="bi bi-trash3-fill"></i></button>
                                                                    <img src="{{asset('frontend/images/Rectangle 2338.jpg')}}" alt="">
                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                        <div class="btn-uploadimg">
                                                            <input type="file" accept="image/*" name="licenseplate" id="licenseplate">
                                                            <i class="bi bi-plus-circle-fill"></i> เพิ่มสำเนา/เล่มทะเบียนรถ
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="step-chceckbox">
                                                    <div class="login-checkbox">
                                                        <label class="list-checkbox"><a href="#" target="_blank">ยอมรับเงื่อนไขการใช้งาน</a> และ <a href="#" target="_blank">นโยบายของเว็บไซต์</a> RodPromptkai.com
                                                            <input type="checkbox" checked="checked">
                                                            <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                </div>
                                <div class="frm-step-button text-center">
                                    <div class="btn btn-step btn-backstep btn_to_step2">ย้อนกลับ</div>
                                    <button type="submit" class="btn btn-step btn-nextstep">สร้าง</button>
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
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

</script>
<script>

    // const exterior = new Dropzone("div.exterior-dropzone", { url: "/file/post" });
    // const interior = new Dropzone("div.interior-dropzone", { url: "/file/post" });
    // const licence = new Dropzone("div.licence-dropzone", { url: "/file/post" });

    Dropzone.options.exteriorDropzone = {
        url: "/fake/location",
        autoProcessQueue: false,
        paramName: "exteriorDropzone",
        clickable: true,
        maxFilesize: 5, //in mb
        addRemoveLinks: true,
        acceptedFiles: '.png,.jpg,.jpeg',
        dictDefaultMessage: "อัพโหลดรูปภายนอกรถยนต์",
        init: function() {
            this.on("sending", function(file, xhr, formData) {
            console.log("sending file");
            });
            this.on("success", function(file, responseText) {
            console.log('great success');
            });
            this.on("addedfile", function(file){
                console.log('file added');
            });
        }
    };

    

    $(document).ready(function() {

        $(".btn_to_step1").on( "click", function() {
            $('#step1').show();
            $('#step2').hide();
            $('#step3').hide();
            $('#step4').hide();
        } );
        $(".btn_to_step2").on( "click", function() {
            console.log("JJJJJJJJJJJJJ");
            $('#step1').hide();
            $('#step2').show();
            $('#step3').hide();
            $('#step4').hide();
        } );
        $(".btn_to_step3").on( "click", function() {
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
    $(document).ready(function() {
        $('#interior_pictures').change(function(event){
            let files = event.target.files;
            let hiddenInputs = $('#hidden-inputs');
            let imagePreview = $('#image-preview');
            hiddenInputs.empty(); // เคลียร์ค่าที่เก่าออก

            $.each(files, function(index, file){
                let reader = new FileReader();

                reader.onload = function(){
                    // console.log(reader.result);
                    // let base64String = reader.result.split(',')[1]; // เอาเฉพาะส่วนที่เป็น base64
                    let base64String = reader.result; // เอาเฉพาะส่วนที่เป็น base64
                    
                    // สร้าง input hidden
                    interior_count++;
                    let hiddenInput = '<input type="hidden" name="picture_interior[]" id="hidden_interior_'+interior_count+'" value="'+base64String+'">';
                    hiddenInputs.append(hiddenInput);

                    // สร้าง image tag
                    // let imageTag = `<img src="data:image/jpeg;base64,${base64String}" width="100">`;
                    // imagePreview.append(imageTag);

                    let imageTag = '<div class="col-4 col-md-3 col-lg-2 col-photoupload" id="border_interior_'+interior_count+'"><div class="item-photoupload"><button type="button" id="picture_interior_'+interior_count+'" onClick="del(this.id);"><i class="bi bi-trash3-fill"></i></button><img src="'+base64String+'" alt=""></div></div>';
                    imagePreview.append(imageTag);
                }

                reader.readAsDataURL(file);
            });
        });
        $('#exterior_pictures').change(function(event){
            let filesExterior = event.target.files;
            let hiddenInputsExterior = $('#hidden-inputs-exterior');
            let imagePreviewExterior = $('#image-preview-exterior');
            let hiddenInputsFeature = $('#hidden-inputs-feature');
            hiddenInputsExterior.empty(); // เคลียร์ค่าที่เก่าออก

            $.each(filesExterior, function(index, file){
                let readerExterior = new FileReader();

                readerExterior.onload = function(){
                    // console.log(reader.result);
                    let base64StringExterior = readerExterior.result; // เอาเฉพาะส่วนที่เป็น base64
                    
                    // สร้าง input hidden
                    exterior_count++;
                    let hiddenInputExterior = '<input type="hidden" name="picture_exterior[]" id="hidden_exterior_'+exterior_count+'" value="'+base64StringExterior+'">';
                    hiddenInputsExterior.append(hiddenInputExterior);

                    if (exterior_count == 1) {
                        let hiddenInputFeature = '<input type="hidden" name="picture_feature" id="hidden_feature_'+exterior_count+'" value="'+base64StringExterior+'">';
                        hiddenInputsFeature.append(hiddenInputFeature);
                    }

                    // สร้าง image tag
                    // let imageTag = `<img src="data:image/jpeg;base64,${base64String}" width="100">`;
                    // imagePreview.append(imageTag);

                    let imageTagExterior = '<div class="col-4 col-md-3 col-lg-2 col-photoupload" id="border_exterior_'+exterior_count+'"><div class="item-photoupload"><button type="button" id="picture_exterior_'+exterior_count+'" onClick="delexterior(this.id);"><i class="bi bi-trash3-fill"></i></button><img src="'+base64StringExterior+'" alt=""></div></div>';
                    imagePreviewExterior.append(imageTagExterior);
                }

                readerExterior.readAsDataURL(file);
            });
        });
        $('#licenseplate').change(function(event){
            let filelicenseplate = event.target.files[0];
            let imagePreviewlicenseplate = $('#image-preview-licenseplate');

            let readerlicenseplate = new FileReader();

            readerlicenseplate.onload = function(){
                let base64Stringlicenseplate = readerlicenseplate.result; // เอาเฉพาะส่วนที่เป็น base64

                // สร้าง image tag
                let imageTaglicenseplate = '<div class="col-4 col-md-3 col-lg-2 col-photoupload"><div class="item-photoupload"><img src="'+base64Stringlicenseplate+'" alt=""></div></div>';
                imagePreviewlicenseplate.empty().append(imageTaglicenseplate); // เพิ่มรูปใหม่เข้าไปแทนที่รูปเดิม (ถ้ามี)
            }

            readerlicenseplate.readAsDataURL(filelicenseplate);
        });

    });
    $(function() {
        $("#image-preview").sortable({
            animation: 200,
        });
        $("#image-preview-exterior").sortable({
            animation: 200,
        });
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
</script>
@endsection