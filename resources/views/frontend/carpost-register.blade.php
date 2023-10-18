@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - carpost-step1</title>
@endsection

@section('content')

<?php

$data = session()->all();
$customerdata = session('customer');
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

// echo "<pre>";
// print_r($customerdata);
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 wrap-bgstep">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 text-center">
                    <h1>ลงขายรถยนต์</h1>
                    <div class="box-iconstep">
                        <a href="{{route('carpoststep1Page')}}"><img src="{{asset('frontend/images/icon-step1-active.svg')}}" alt=""></a>
                        <div><img src="{{asset('frontend/images/step-arrow.svg')}}" alt=""></div>
                        <a href="{{route('carpoststep2Page')}}"><img src="{{asset('frontend/images/icon-step2.svg')}}" alt=""></a>
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

<section class="row" id="step1">
<div class="col-12 wrap-page-step wow fadeInDown">
        <div class="container">
            <div class="row">
                <div class="col-12">
                <div class="wrap-boxstep">
                        <div class="topic-step"><span>1.1</span> ข้อมูลทั่วไป</div>
                        <div class="box-frm-step">
                            <div class="row">
                                <div class="col-12 col-md-6 frm-step">
                                    <label>ชื่่อผู้ลงทะเบียน</label>
                                    <input type="text" class="form-control" value="{{$firstname.' '.$lastname}}" readonly />
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>ประเภทการลงทะเบียน</label>
                                    <select class="form-select" disabled>
                                        <option value="home">รถทั่วไป</option>
                                        <option value="dealer">ดีลเลอร์</option>
                                        <option value="lady">รถคุณผู้หญิง</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>อีเมล</label>
                                    <input type="text" class="form-control" value="{{$email}}" readonly />
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" value="{{$phone}}" readonly />
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
                                            </select>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <input type="text" class="form-control" placeholder="สีอื่นๆ โปรดระบุ">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>รุ่นปี<span>*</span></label>
                                    <select class="form-select">
                                        <option value="">เลือกรุ่นปี</option>
                                    </select>
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>เลขไมล์<span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-12 col-lg-6 frm-step">
                                    <label>เกียร์<span>*</span></label>
                                    <div class="carsearch-radio">
                                        <label class="car-radio">ออโต้
                                            <input type="radio" name="gear">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="car-radio">ธรรมดา
                                            <input type="radio" name="gear">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 frm-step">
                                    <label>แก๊ส<span>*</span></label>
                                    <div class="carsearch-radio">
                                        <label class="car-radio">ไม่ติดแก๊ส
                                            <input type="radio" name="gas">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="car-radio">NGV
                                            <input type="radio" name="gas">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="car-radio">LPG
                                            <input type="radio" name="gas">
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="car-radio">รถไฟฟ้า
                                            <input type="radio" name="gas">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>ทะเบียนรถ<span>*</span></label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="col-12 col-md-6 frm-step">
                                    <label>จังหวัด<span>*</span></label>
                                    <select class="form-select">
                                        <option value="">เลือกจังหวัด</option>
                                        @foreach($provinces as $keypv => $pv)
                                        <option value="{{$pv->name_th}}">{{$pv->name_th}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="frm-step-button text-center">
                            <a href="carpost-step2.php" class="btn-step btn-nextstep">ถัดไป</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row" id="step2" style="display:none;">
    <div>step2</div>
</section>
<section class="row" id="step3" style="display:none;">
    <div>step3</div>
</section>
<section class="row" id="step4" style="display:none;">
    <div>step4</div>
</section>



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
    $(document).ready(function() {

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
@endsection