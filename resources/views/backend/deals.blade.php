@extends('backend.layout.side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')

<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
    <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <a href="{{route('BN_deals_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >
            เพิ่มดีล
        </a>    
    </div>
</div>

<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="text-center whitespace-nowrap" width="10%">#</th>
                <th class="whitespace-nowrap">ดีล</th>
                <th class="text-center whitespace-nowrap"></th>
            </tr>
        </thead>
        <tbody>
            
            @foreach($query as $keyres => $res)
                <tr class="intro-x">
                    <td class="text-center">{{$keyres+1}}</td>
                    <td>
                        <div class="font-medium whitespace-nowrap">{{$res->name}}</div>
                    </td>
                    <td class="table-report__action w-56">
                        <div class="flex justify-center items-center">
                            
                            <!-- <a class="flex items-center text-success mr-3" href="{{route('BN_news_edit', ['id' => $res->id])}}" >
                                <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูข้อมูล
                            </a> -->
                            <a class="flex items-center" href="{{route('BN_deals_edit', ['id' => $res->id])}}">
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




    















@endsection

@section('script')

@endsection
