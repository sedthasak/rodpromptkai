@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
// echo "<pre>";
// print_r($users);
// echo "</pre>";
// echo "<pre>";
// print_r($customer);
// echo "</pre>";
// echo "<pre>";
// print_r($brands);
// echo "</pre>";
// echo "<pre>";
// print_r($models);
// echo "</pre>";
// echo "<pre>";
// print_r($generations);
// echo "</pre>";
// echo "<pre>";
// print_r($sub_models);
// echo "</pre>";
// echo "<pre>";
// print_r($postcar);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium"></h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_posts_edit', ['id' => $postcar->id])}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >แก้ไข</a>    
        </div>
    </div>

    <div class="intro-y news xl:w-5/5 p-5 box mt-8">
        <!-- BEGIN: Blog Layout -->
        <h2 class="intro-y font-medium text-3xl sm:text-3xl">2019 Mercedes-Benz S560e</h2>
        <div class="intro-y text-slate-600 dark:text-slate-500 mt-3 text-xs sm:text-sm mb-6">
            สร้างเมื่อ {{date('d/m/Y', strtotime($postcar->created_at))}}  <span class="mx-1">•</span> <a class="text-primary" href="#">{{date('H:i:s', strtotime($postcar->created_at))}} น.</a> 
        </div>
        <!-- <div class="intro-y mt-6">
            <div class="news__preview image-fit">
                <img alt="Midone - HTML Admin Template" class="rounded-md" src="{{ asset('dist/images/' . $fakers[0]['images'][0]) }}">
            </div>
        </div> -->
        <div class="intro-y text-justify leading-relaxed">
            <div class="box">
                <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                            <img alt="" class="rounded-full" src="{{asset($customer->image)}}">
                        </div>
                        <div class="ml-5">
                            <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{$customer->firstname." ".$customer->lastname}}</div>
                            <div class="text-slate-500">{{$customer->phone}}</div>
                        </div>
                    </div>
                    <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-3">ข้อมูลลูกค้า</div>
                        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i> {{$customer->province}}
                            </div>
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i> {{$customer->place}}
                            </div>
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <i data-lucide="Map" class="w-4 h-4 mr-2"></i> <a href="{{$customer->google_map}}">Google Map</a>
                            </div>

                        </div>
                    </div>
                    <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                        <div class="font-medium text-center lg:text-left lg:mt-5">MAP</div>
                        <div class="">
                            <img alt="" data-action="zoom" class="rounded-md" width="100" height="60" src="{{asset($customer->map)}}">
                        </div>
                    </div>
                </div>
            </div>
                
        </div>
        <div class="intro-y text-justify leading-relaxed">
            <div class="box">
                <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                        
                    </div>
                    <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i> รออนุมัติ
                            </div>

                        </div>
                    </div>
                    <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
           
                    </div>
                </div>
            </div>
                
        </div>
        <div class="intro-y text-justify leading-relaxed">
            <div class="box sm:flex">
                <div class="px-6 py-8 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                    <div class="news__preview image-fit">
                        <img alt="" data-action="zoom" class="rounded-md" src="{{asset($postcar->feature)}}">
                    </div>
                </div>
                <div class="px-6 py-8 flex flex-col justify-center flex-1">
                    
                    <div class="relative text-2xl font-medium mt-12 ml-0.5"> {{$postcar->modelyear." ".$brands->title." ".$models->model}} </div>
                    <div class="mt-4 text-xl text-slate-500">{{$generations->generations." ".$sub_models->sub_models}} <span>|</span>  </div>
                    <!-- <div class="mt-4 text-xl text-slate-500">โฉม F48 ปี21-ปัจจุบัน  </div> -->
                    <div class="pt-5 pb-5">
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> ราคา </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->price}}.- </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> เลขไมล์ </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->mileage}} กม. </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> สี </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->color}} </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> เลขทะเบียน </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->vehicle_code}} </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> เกียร์ </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->gear}} </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> แก็ส </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> {{$postcar->gasname}} </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> วันที่ลงขาย </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> 16 มิ.ย. 66 </div>
                        </div>
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500 sm:mr-5"> วันที่หมดอายุ </div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500"> 16 ธ.ค. 66 </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        


        <div class="intro-y text-justify leading-relaxed">
            <br><br>
            <p>
            Lorem ipsum dolor sit amet, ante dignissim, varius elit urna erat odio lectus. Aenean laoreet pellentesque justo maecenas nec, viverra diam cras, lorem at vitae vestibulum, arcu lobortis ac. Netus vitae wisi odio vitae sagittis tortor, cras mauris accumsan sed ornare phasellus pellentesque, tellus morbi non in lectus vel volutpat, arcu eu a, et at urna donec integer suscipit orci. Elit nisl hendrerit mus dui. Commodo eget odio, in nulla eget, curabitur enim sed semper. At malesuada pharetra felis commodo facilisi egestas, in praesent in neque lorem libero nostrud, turpis ac, blandit fringilla vestibulum odio nullam, sit etiam ut. Lectus integer facilisis in fusce erat amet. 
            </p>
            <p>
            Lorem ipsum dolor sit amet, ante dignissim, varius elit urna erat odio lectus. Aenean laoreet pellentesque justo maecenas nec, viverra diam cras, lorem at vitae vestibulum, arcu lobortis ac. Netus vitae wisi odio vitae sagittis tortor, cras mauris accumsan sed ornare phasellus pellentesque, tellus morbi non in lectus vel volutpat, arcu eu a, et at urna donec integer suscipit orci. Elit nisl hendrerit mus dui. Commodo eget odio, in nulla eget, curabitur enim sed semper. At malesuada pharetra felis commodo facilisi egestas, in praesent in neque lorem libero nostrud, turpis ac, blandit fringilla vestibulum odio nullam, sit etiam ut. Lectus integer facilisis in fusce erat amet. 
            </p>
            <br><br>
        </div>


        <div class="intro-y text-justify leading-relaxed">
            <div class="box sm:flex">
                <div class="px-6 py-8 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">

                    <div id="" class="p-5">
                        <div class="preview">
                            <div class="mx-6 pb-8">
                                <div class="fade-mode">
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" data-action="zoom" src="{{ asset('dist/images/' . $fakers[0]['images'][0]) }}" />
                                        </div>
                                    </div>
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" data-action="zoom" src="{{ asset('dist/images/' . $fakers[1]['images'][1]) }}" />
                                        </div>
                                    </div>
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" data-action="zoom" src="{{ asset('dist/images/' . $fakers[2]['images'][2]) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="px-6 py-8 flex flex-col justify-center flex-1">
                    
                    <div id="" class="p-5">
                        <div class="preview">
                            <div class="mx-6 pb-8">
                                <div class="fade-mode">
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/' . $fakers[0]['images'][0]) }}" />
                                        </div>
                                    </div>
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/' . $fakers[1]['images'][1]) }}" />
                                        </div>
                                    </div>
                                    <div class="h-64 px-2">
                                        <div class="h-full image-fit rounded-md overflow-hidden">
                                            <img alt="Midone - HTML Admin Template" src="{{ asset('dist/images/' . $fakers[2]['images'][2]) }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>

        <div class="intro-y flex text-xs sm:text-sm flex-col sm:flex-row items-center mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
            <div class="flex items-center">
                <div class="w-12 h-12 flex-none image-fit">
                    <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('uploads/1695725433.jpg') }}">
                </div>
                <div class="ml-3 mr-auto">
                    <div class="font-medium">kongphopots</div>
                    <div class="text-slate-500">kk.supernova00@gmail.com</div>
                </div>
            </div>
        </div>
        <!-- END: Blog Layout -->

    </div>
    




@endsection

@section('script')

@endsection