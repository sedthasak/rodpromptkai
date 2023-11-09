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
// echo "<pre>";
// print_r($provinces);
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
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                <input type="hidden" name="customer_id" value="999" />
                <div class="intro-y box p-5">

                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-12">
                                <div>
                                    <label for="" class="form-label">ยูสเซอร์</label>
                                    <input type="text" name="user_name" id="" class="form-control" value="{{auth()->user()->name}}" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">ลูกค้าเจ้าของรถ</label>
                                    <select name="customer" id="" data-search="true" class="tom-select w-full">
                                        <option value="999">ลูกค้าเจ้าของรถ</option>
                                        @foreach($customer as $keycustomer => $cus)
                                        <option value="{{$cus->id}}">{{$cus->firstname}} {{$cus->lastname}} - {{$cus->phone}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="mt-3 ">
                                    <label for="" class="form-label">เบอร์โทรศัพท์ลูกค้า</label>
                                    <input type="text" name="customer_phone" id="" class="form-control" value="0999999999" readonly >
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-3">
                                <div class="mt-3 ">
                                    <label for="" class="form-label">ประเภทลูกค้า</label>
                                    <input type="text" name="type" id="" class="form-control" value="ลูกค้าทั่วไป" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">ยี่ห้อ</label>
                                    <select name="brand_id" id="brand_id" data-search="true" class="tom-select w-full">
                                        <option value="999">เลือกยี่ห้อ</option>
                                        @foreach($brands as $keybrands => $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">โฉม</label>
                                    <select name="generations_id" id="generations_id" data-search="true" class="tom-select w-full">
                                        <option value="999">เลือกโฉม</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">สี</label>
                                    <select name="color" id="color" class="form-select">
                                        <option value="">เลือกสี</option>
                                        @foreach($arr_color as $keycolor => $color)
                                        <option value="{{$color}}">{{$color}}</option>
                                        @endforeach
                                        <option value="999">สีอื่นๆ</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่นปี</label>
                                    <select name="modelyear" id="modelyear" data-search="true" class="tom-select w-full">
                                        <option value="999">เลือกรุ่นปี</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">เกียร์</label>
                                    <select name="gear" id="gear" class="form-select">
                                        <option value="auto">ออโต้</option>
                                        <option value="manual">ธรรมดา</option>
                                    </select>
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">เลขทะเบียนรถ</label>
                                    <input type="text" name="vehicle_code" id="" class="form-control" value="กก-1111"  >
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่น</label>
                                    <select name="model_id" id="model_id" data-search="true" class="tom-select w-full">
                                        <option value="999">เลือกรุ่น</option>
                                    </select>
                                </div> 
                                <div class="mt-3">
                                    <label for="" class="form-label">รุ่นย่อย</label>
                                    <select name="sub_models_id" id="sub_models_id" data-search="true" class="tom-select w-full">
                                        <option value="999">เลือกรุ่นย่อย</option>
                                    </select>
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">สีอื่นๆ</label>
                                    <input type="text" name="other_color" id="other_color" class="form-control" value=""  >
                                </div>
                                <div class="mt-3 ">
                                    <label for="" class="form-label">เลขไมล์</label>
                                    <input type="text" name="mileage" id="mileage" class="form-control" value=""  >
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">แก๊ส</label>
                                    <select id="gas" id="gas" class="form-select">
                                        <option value="no">ไม่ติดแก๊ส</option>
                                        <option value="ngv">NGV</option>
                                        <option value="lpg">LPG</option>
                                        <option value="ev">รถไฟฟ้า</option>
                                    </select>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">จังหวัด</label>
                                    <select name="" id="" data-search="true" class="tom-select w-full">
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
                                    <input type="text" name="title" id="title" class="form-control" value="หัวข้อโฆษณา" >
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">รายละเอียดรถ</label>
                                    <textarea name="detail" id="detail" class="form-control" >รายละเอียดรถ</textarea>
                                </div>
                                <div class="mt-3">
                                    <label for="" class="form-label">ราคา</label>
                                    <input type="text" name="price" id="price" class="form-control" value="1000000" >
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

@endsection