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
            <a href="{{route('BN_posts_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่ม</a>    
        </div>
    </div>

    <!-- BEGIN: Data List -->
    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="whitespace-nowrap">วันที่</th>
                    <th class="whitespace-nowrap">เจ้าของโพสท์</th>
                    <th class="whitespace-nowrap">โพสท์</th>
                    <th class="text-center whitespace-nowrap">ราคา</th>
                    <th class="text-center whitespace-nowrap">สถานะ</th>
                    <th class="text-center whitespace-nowrap">แอคชั่น</th>
                </tr>
            </thead>
            <tbody id="fetchPosts">
                
            </tbody>
        </table>
    </div>
    <!-- END: Data List -->




@endsection

@section('script')
<script>
    jQuery(function() {
        fetchPosts();
        function fetchPosts(){
            jQuery.ajax({
                url: '{{route('BN_postsFetch')}}',
                method: 'get',
                success: function(response){
                    jQuery('#fetchPosts').html(response);
                }
            });
        }
    });
</script>
@endsection