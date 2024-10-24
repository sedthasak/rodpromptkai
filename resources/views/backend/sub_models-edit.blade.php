@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
// echo "<pre>";
// print_r($generations);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_sub_models')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    <form method="post" action="{{route('BN_sub_models_edit_action')}}" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
        <input type="hidden" name="id" value="{{$mysub_models->id}}" />
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
                            <div class="col-span-12 xl:col-span-6">

                                <div class="">
                                    <label for="update-profile-form-8" class="form-label">โฉมรถ</label>
                                    <select id="update-profile-form-8" class="form-select" name="generations_id">
                                        @foreach($generations as $keygenerations => $generation)
                                        <option value="{{$generation->generations_id}}" @if($mysub_models->generations_id == $generation->generations_id) selected @endif >{{$generation->brands_name.' / '.$generation->models_name.' / '.$generation->generations_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-6">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">รุ่นย่อย</label>
                                    <input type="text" class="form-control" name="sub_models" value="{{$mysub_models->sub_models}}"  autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-span-12 xl:col-span-12 mt-3">
                                <div class="mt-3 xl:mt-0">
                                    <label for="update-profile-form-10" class="form-label">รายละเอียด</label>
                                    <input type="text" class="form-control" name="description" value="{{$mysub_models->description}}"  autocomplete="off" />
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
                                <input type="text" class="form-control w-full" id="" name="meta_title" value="{{$mysub_models->meta_title}}"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">meta_keyword</label>
                                <input type="text" class="form-control w-full" id="" name="meta_keyword" value="{{$mysub_models->meta_keyword}}"  autocomplete="off" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">meta_description</label>
                                <input type="text" class="form-control w-full" id="" name="meta_description" value="{{$mysub_models->meta_description}}"  autocomplete="off" />
                            </div>
                        </div>
                        <!-- <div class="flex justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-20 mr-auto">บันทึก</button>
                            <a href="" class="text-danger flex items-center">
                                <i data-lucide="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a>
                        </div> -->
                        <div class="mt-4 flex justify-end">
                            <div class="btn-delete-brand btn btn-danger mr-auto w-24" onclick="confirmDelete({{ $mysub_models->id }})">ลบ</div>
                            <button type="submit" class="btn btn-primary w-24 mr-2">บันทึก</button>
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
    function confirmDelete(id) {
        Swal.fire({
            title: 'ยืนยัน?',
            text: 'ยืนยันการลบรุ่นย่อยรถนี้ใช่ไหม !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง !',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to delete route
                window.location.href = '/backend/car/sub_models-delete/' + id;
            }
        });
    }
</script>


@endsection