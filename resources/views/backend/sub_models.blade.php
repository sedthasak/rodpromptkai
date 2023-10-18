@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
// echo "<pre>";
// print_r($query);
// echo "</pre>";
?>
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_sub_models_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่ม</a>    
        </div>
    </div>
    <!-- <div class="intro-y grid grid-cols-12 gap-5">
        <div class="intro-y col-span-12 lg:col-span-12">
            <div class="grid grid-cols-12 gap-5 mt-5 pt-5 border-t" id="fetchBrandsaa">
                
            </div>
        </div>
    </div> -->
    <div class=" " id="fetchSub_models">
        
    </div>


@endsection

@section('script')
<script>
    jQuery(function() {
        fetchSub_models();
        function fetchSub_models(){
            jQuery.ajax({
                url: '{{route('BN_sub_modelsFetch')}}',
                method: 'get',
                success: function(response){
                    jQuery('#fetchSub_models').html(response);
                }
            });
        }
    });
</script>
@endsection