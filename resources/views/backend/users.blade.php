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
            <a href="{{route('BN_user_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่ม user</a>    
        </div>
    </div>
    <div id="fetchUsers"></div>
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