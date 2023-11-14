@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
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
// $arr_cartype = array(
//     'home' => 'รถบ้าน / เจ้าของรถขายเอง',
//     'dealer' => 'ดีลเลอร์ / ลงแบบฝากขาย',
//     'lady' => 'รถคุณผู้หญิง',
// );

// echo "<pre>";
// print_r($generations);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_brands')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    
        
        
        
    



    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <!-- BEGIN: Form Layout -->
            <form method="post" action="{{route('BN_posts_add_action')}}" enctype="multipart/form-data" >
            @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required />
                <!-- <input type="hidden" name="customer_id" value="22" /> -->
                <div class="intro-y box p-5">

                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <div>
                                    <label for="" class="form-label">ยูสเซอร์</label>
                                    <input type="text" name="user_name" class="form-control" value="{{auth()->user()->name}}" readonly required  >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">ลูกค้าเจ้าของรถ</label>
                                    <select name="customer_id" id="customer_id" data-search="true" class="tom-select w-full" required >
                                        <option value="">ลูกค้าเจ้าของรถ</option>
                                        @foreach($customer as $keycustomer => $cus)
                                        <option value="{{$cus->id}}" data-role="{{$cus->sp_role}}">{{$cus->firstname}} {{$cus->lastname}} - {{$cus->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3 ">
                                    <!-- <label for="" class="form-label">ประเภทลูกค้า</label>
                                    <input type="text" name="cusrole" id="cusrole" class="form-control" value="" readonly required  > -->
                                    <label for="" class="form-label">ประเภทรถที่ลงขาย</label>
                                    <select name="type" id="type" class="form-select" required >
                                        <option value="home">รถบ้าน / เจ้าของรถขายเอง</option>
                                        <option value="dealer">ดีลเลอร์ / ลงแบบฝากขาย</option>
                                        <option value="lady">รถคุณผู้หญิง</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <hr class="mt-10">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">ยี่ห้อ</label>
                                    <select name="brand_id" id="brand_id" data-search="true" class="tom-select w-full" required >
                                        <option value="">เลือกยี่ห้อ</option>
                                        @foreach($brands as $keybrands => $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">โฉม</label>
                                    <select name="generations_id" id="generations_id"  class=" w-full" required >
                                        <option value="">เลือกโฉม</option>
                                        <!-- @foreach($generations as $keygenerations => $generation)
                                        <option value="{{$generation->id}}">{{$generation->generations}}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">สี</label>
                                    <select name="color" id="color_sel" class="form-select" required >
                                        <option value="">เลือกสี</option>
                                        @foreach($arr_color as $keycolor => $color)
                                        <option value="{{$color}}">{{$color}}</option>
                                        @endforeach
                                        <option value="999">สีอื่นๆ</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่นปี</label>
                                    <select name="modelyear" id="modelyear" class=" w-full" required >
                                        <option value="">เลือกรุ่นปี</option>
                                        
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">เกียร์</label>
                                    <select name="gear" id="gear" class="form-select" required >
                                        <option value="auto">ออโต้</option>
                                        <option value="manual">ธรรมดา</option>
                                    </select>
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">เลขทะเบียนรถ</label>
                                    <input type="text" name="vehicle_code" id="" class="form-control" value="" required  >
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่น</label>
                                    <select name="model_id" id="model_id" class=" w-full" required >
                                        <option value="">เลือกรุ่น</option>
                                        <!-- @foreach($models as $keymodels => $model)
                                        <option value="{{$model->id}}">{{$model->model}}</option>
                                        @endforeach -->
                                    </select>
                                </div> 
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่นย่อย</label>
                                    <select name="sub_models_id" id="sub_models_id" class=" w-full" required >
                                        <option value="">เลือกรุ่นย่อย</option>
                                        <!-- @foreach($sub_models as $keysub_models => $sub_model)
                                        <option value="{{$sub_model->id}}">{{$sub_model->sub_models}}</option>
                                        @endforeach -->
                                    </select>
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">สีอื่นๆ</label>
                                    <input type="text" name="other_color" id="other_color" class="form-control" value=""  >
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">เลขไมล์</label>
                                    <input type="text" name="mileage" id="mileage" class="form-control" value=""  required  >
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">แก๊ส</label>
                                    <select id="gas" id="gas" class="form-select" required >
                                        <option value="no">ไม่ติดแก๊ส</option>
                                        <option value="ngv">NGV</option>
                                        <option value="lpg">LPG</option>
                                        <option value="ev">รถไฟฟ้า</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">จังหวัด</label>
                                    <select name="province" id="province" data-search="true" class="tom-select w-full" required >
                                        <option value="">เลือกจังหวัด</option>
                                        @foreach($provinces as $keypv => $pv)
                                        <option value="{{$pv->name_th}}">{{$pv->name_th}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <div class="mt-3">
                                    <label for="" class="form-label">หัวข้อโฆษณา</label>
                                    <input type="text" name="title" id="title" class="form-control" value="" required  >
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">รายละเอียดรถ</label>
                                    <textarea name="detail" id="detail" class="form-control" required ></textarea>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control" value=""  required >
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">รูปปก</label>
                                    <input type="file" name="feature" id="feature" class="form-control" accept="image/*" >
                                </div>
                                <div class="mt-5">
                                    <label for="" class="form-label">รูปภายนอกรถ</label>
                                    <input type="file" name="exterior[]" id="exterior" class="form-control" accept="image/*" multiple >
                                </div>
                                <div class="mt-5">
                                    <label for="" class="form-label">รูปภายในรถ</label>
                                    <input type="file" name="interior[]" id="interior" class="form-control" accept="image/*" multiple >
                                </div>
                                <div class="mt-5">
                                    <label for="" class="form-label">รูปเล่มทะเบียนรถ</label>
                                    <input type="file" name="licenseplate" id="licenseplate" class="form-control"  accept="image/*" >
                                </div>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                        </div>
                    </div>
                
                </div>
            </form>
            <!-- END: Form Layout -->
        </div>
    </div>




@endsection

@section('script')


<script>

    // var roles = [];
    //     @foreach ($customer as $keycustomer => $tomer)
    //     roles[{{$tomer->id}}] = '{{$tomer->sp_role}}';
    //     @endforeach

    // jQuery("#customer_id").on( "change", function() {

    //     var roletype = ['']
    //     roletype['home'] = 'ลูกค้าทั่วไป';
    //     roletype['dealer'] = 'นายหน้า';
    //     var rorororor = $(this).val();
    //     $("#cusrole").val(roletype[roles[rorororor[0]]]);

    // } );

    $("#brand_id").on( "change", function() {
        var brands_id = $(this).val();
        if(brands_id[0]){
            jQuery.ajax({
                url: "{{route('carpostSelectBrand')}}",
                type: "post",
                data: { 
                    brands_id: brands_id[0], 
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    $('#model_id').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    } );
    $("#model_id").on( "change", function() {
        var model_id = $(this).val();
        if(model_id[0]){
            jQuery.ajax({
                url: "{{route('carpostSelectModel')}}",
                type: "post",
                data: { 
                    models_id: model_id[0], 
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    $('#generations_id').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });
        }
    } );
    $("#generations_id").on( "change", function() {
        var generations_id = $(this).val();
        if(generations_id[0]){
            jQuery.ajax({
                url: "{{route('carpostSelectGenerations')}}",
                type: "post",
                data: { 
                    generations_id: generations_id[0], 
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    $('#sub_models_id').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

            jQuery.ajax({
                url: "{{route('carpostSelectGenerationsYear')}}",
                type: "post",
                data: { 
                    generations_id: generations_id[0],
                    _token: '{{csrf_token()}}'
                },
                success: function (response) {
                    $('#modelyear').html(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }
            });

        }
    } );



    // jQuery(function() {
    //     fetchPosts();
    //     function fetchPosts(){
    //         jQuery.ajax({
    //             url: '{{route('BN_postsFetch')}}',
    //             method: 'get',
    //             success: function(response){
    //                 jQuery('#fetchPosts').html(response);
    //             }
    //         });
    //     }
    // });
</script>


@endsection