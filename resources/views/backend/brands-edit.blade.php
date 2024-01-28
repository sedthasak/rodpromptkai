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
    <form method="post" action="{{route('BN_brands_edit_action')}}" enctype="multipart/form-data" >
        @csrf
        <input type="hidden" name="id" value="{{$brands->id}}" />
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- <div class="intro-y col-span-12 lg:col-span-3"></div> -->
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-1 gap-1">
                            <div class="">
                                <label for="" class="form-label">ชื่อยี่ห้อ</label>
                                <input type="text" class="form-control w-full" name="title" autocomplete="off" value="{{$brands->title}}" />
                            </div>
                        </div>
                        
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">โลโก้</label>
                                <input type="file" class="form-control w-full" id="" name="feature"  autocomplete="off" />
                            </div>
                        </div>
                        @if(isset($brands->feature))
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">โลโก้ปัจจุบัน</label>
                                <image width="150" src="{{asset($brands->feature)}}">
                            </div>
                        </div>
                        @endif
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">คำโปรย</label>
                                <input type="text" class="form-control w-full" id="" name="excerpt"  autocomplete="off" value="{{$brands->excerpt}}" />
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">ข่าว</label>
                                <textarea class="form-control" id="content" rows="5" name="content">{{$brands->content}}</textarea>
                            </div>
                        </div>
                        
                    </div>


                    <!-- <div class="text-right mt-5">
                        <a href="#" class="btn btn-danger w-24 mr-auto ">ลบ</a>
                        <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                    </div> -->
                    <div class="mt-4 flex justify-end">
                        <div class="btn-delete-brand btn btn-danger mr-auto w-24" onclick="confirmDelete({{ $brands->id }})">ลบ</div>
                        <button type="submit" class="btn btn-primary w-24 mr-2">บันทึก</button>
                    </div>
                </div>
                <!-- END: Form Layout -->
            </div>
        </div>
    </form>




@endsection

@section('script')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'ยืนยัน?',
            text: 'ยืนยันการลบยี่ห้อรถนี้ใช่ไหม !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ตกลง !',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                // If confirmed, redirect to delete route
                window.location.href = '/backend/car/brands-delete/' + id;
            }
        });
    }
    
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection