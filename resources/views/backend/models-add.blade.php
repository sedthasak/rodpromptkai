@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
// echo "<pre>";
// print_r($page_name);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_brands')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    <form method="post" action="{{route('BN_carmd_add_action')}}" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- <div class="intro-y col-span-12 lg:col-span-3"></div> -->
            <div class="intro-y col-span-12 lg:col-span-12">

                <!-- BEGIN: Personal Information -->
                <div class="intro-y box">
                    <div class="flex items-center p-5 border-b border-slate-200/60 dark:border-darkmode-400">
                        <h2 class="font-medium text-base mr-auto">{{$default_pagename}}</h2>
                    </div>
                    <div class="p-5">
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-4">

                                <div class="">
                                    <label for="update-profile-form-8" class="form-label">ยี่ห้อ</label>
                                    <select id="update-profile-form-8" class="form-select" name="brand_id">
                                        @foreach($brands as $keybrands => $brand)
                                        <option value="{{$brand->id}}">{{$brand->title}}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">รุ่น</label>
                                    <input type="text" class="form-control" name="model" value=""  autocomplete="off" />
                                </div>

                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <div class="">
                                    <label for="update-profile-form-8" class="form-label">รถ EV</label>
                                    <select id="update-profile-form-8" class="form-select" name="evtype">
                                        <option value="0">ไม่ใช่</option>
                                        <option value="1">ใช่</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">รายละเอียด</label>
                                    <input type="text" class="form-control" name="description" value=""  autocomplete="off" />
                                </div>
                            </div>
                            <!-- <div class="col-span-12 xl:col-span-12 mt-3">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">รูปภาพ</label>
                                    <input type="file" class="form-control" name="feature" value="">
                                </div>
                            </div> -->                            
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">meta_title</label>
                                <input type="text" class="form-control w-full" id="" name="meta_title" autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">meta_keyword</label>
                                <input type="text" class="form-control w-full" id="" name="meta_keyword" autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">meta_description</label>
                                <input type="text" class="form-control w-full" id="" name="meta_description" autocomplete="off" />
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">บันทึก</button>
                            <!-- <a href="" class="text-danger flex items-center">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a> -->
                        </div>
                    </div>
                </div>
                <!-- END: Personal Information -->
            </div>
        </div>
    </form>




@endsection

@section('script')
<script>

</script>


@endsection