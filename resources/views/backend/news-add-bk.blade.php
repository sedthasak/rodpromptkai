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
            <a href="{{route('BN_news')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >ย้อนกลับ</a>    
        </div>
    </div>
    <form method="post" action="{{route('BN_news_add_action')}}" enctype="multipart/form-data" >
        
        @csrf
        <input type="hidden" name="user_id" value="{{auth()->user()->id}}" required />
        <div class="grid grid-cols-12 gap-6 mt-5">
            <!-- <div class="intro-y col-span-12 lg:col-span-3"></div> -->
            <div class="intro-y col-span-12 lg:col-span-12">
                <!-- BEGIN: Form Layout -->
                <div class="intro-y box p-5">
                    
                    <div class="mt-3">
                        <div class="sm:grid grid-cols-1 gap-1">
                            <div class="">
                                <label for="" class="form-label">ชื่อ</label>
                                <input type="text" class="form-control w-full" id="" name="title" autocomplete="on" required/>
                            </div>
                        </div>

                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="feature" class="form-label">รูปภาพหน้าปก</label>
                                <input type="file" class="form-control w-full" id="feature" name="feature" autocomplete="off" required/>
                            </div>
                        </div>


                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">คำอธิบาย</label>
                                <input type="text" class="form-control w-full" id="" name="excerpt"  autocomplete="on" required/>
                            </div>
                        </div>
                        <div class="sm:grid grid-cols-1 gap-1 mt-5">
                            <div class="">
                                <label for="" class="form-label">เนื้อหา</label>
                                <textarea class="form-control" id="content" placeholder="Enter the Description" rows="5" name="content"></textarea>
                            </div>
                        </div>
                        
                    </div>


                    <div class="text-right mt-5">
                        <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                    </div>
                </div>
                <!-- END: Form Layout --> 
                
            </div>
        </div>
    </form>




@endsection

@section('script')
<script>
    
</script>
@endsection