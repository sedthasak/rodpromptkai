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
            <!-- <a href="{{route('BN_user_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่ม user</a>     -->
        </div>
    </div>
    <div id="fetchUserss"></div>
    <!-- <div class="grid gap-6 mt-5 p-5 box">
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="">
                    <tr class="">
                        <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">#</td>
                        <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">เวลา</td>
                        <td class="font-medium px-5 py-3 border-b-2 dark:border-darkmode-300 whitespace-nowrap">กิจกรรม</td>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap">1 </td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"> Angelina </td>
                        <td class="px-5 py-3 border-b dark:border-darkmode-300 whitespace-nowrap"> @angelinajolie </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div> -->

    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <a href="{{route('BN_user_add')}}" class="btn btn-primary shadow-md mr-2">เพิ่มยูสเซอร์</a>
            
            <div class="hidden md:block mx-auto text-slate-500"></div>
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:ml-0">
                <div class="w-56 relative text-slate-500">
                    <form method="get" action="">
                        <input type="text" name="s" class="form-control w-56 box pr-10" placeholder="Search...">
                        <i type="submit" class="w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0" data-lucide="search"></i>
                    </form>
                        
                </div>
            </div>
        </div>
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap"></th>
                        <th class="whitespace-nowrap">ชื่อ</th>
                        <th class="whitespace-nowrap">อีเมล</th>
                        <th class="whitespace-nowrap">หน้าที่</th>
                        <th class="text-center whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($User as $keyres => $res)
                    @php
                    $profile_img = ($res->photo)?asset($res->photo):asset('frontend/images/avatar.jpeg');
                    @endphp
                        <tr class="intro-x">
                            <td class="text-center">{{$keyres+1}}</td>
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="{{$res->firstname.' '.$res->lastname}}" class="tooltip rounded-full" src="{{$profile_img}}" >
                                    </div>
                                </div>
                            </td>
                            
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->name}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->email}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->role}}</div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center text-success mr-3" href="#" >
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูข้อมูล
                                    </a>
                                    <a class="flex items-center" href="#">
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END: Data List -->
        <div class="d-flex">
            {!! $User->links() !!}
        </div>




@endsection

@section('script')
<script>

    jQuery(function() {
        fetchUsers();
        function fetchUsers(){
            jQuery.ajax({
                url: '{{route('BN_usersFetch')}}',
                method: 'get',
                success: function(response){
                    jQuery('#fetchUsers').html(response);
                }
            });
        }
    });

</script>


@endsection