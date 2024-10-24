@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<?php
$arrrole = array(
    'home' => 'ลูกค้าทั่วไป',
    'dealer' => 'นายหน้า',
    'lady' => '',
);
$arrtype = array(
    'home' => 'รถบ้าน',
    'dealer' => 'ดีลเลอร์',
    'lady' => 'รถผู้หญิง',
);
?>

<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
    <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <a href="{{route('BN_posts_excelpostsell')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">Import Excel</a>
        <a href="{{route('BN_posts_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 bg-primary border-primary text-white dark:border-primary mr-2 shadow-md">เพิ่ม</a>    
    </div>
</div>

<div class="lg:flex intro-y mt-5 mb-5">
    <div class="relative">
        <input type="text" name="keyword" id="keyword" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="ค้นหา..." value="{{ request()->input('keyword') }}" onkeypress="handleEnter(event)" >
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-lucide="search">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
        </svg> 
    </div>

    <select id="type" name="type" onchange="applyFilters()" class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
        <option value="">ทุกประเภท&emsp;&emsp;</option>
        <option value="home" @if(request()->input('type') == 'home') selected @endif>รถบ้าน&emsp;&emsp;</option>
        <option value="lady" @if(request()->input('type') == 'lady') selected @endif>รถผู้หญิง&emsp;&emsp;</option>
        <option value="dealer" @if(request()->input('type') == 'dealer') selected @endif>ดีลเลอร์&emsp;&emsp;</option>
    </select>
    <select id="status" name="status" onchange="applyFilters()" class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
        <option value="">ทุกสถานะ&emsp;&emsp;</option>
        <option value="created" @if(request()->input('status') == 'created') selected @endif>รออนุมัติ&emsp;&emsp;</option>
        <option value="approved" @if(request()->input('status') == 'approved') selected @endif>ออนไลน์&emsp;&emsp;</option>
        <option value="rejected" @if(request()->input('status') == 'rejected') selected @endif>ปฎิเสธ&emsp;&emsp;</option>
        <option value="deleted" @if(request()->input('status') == 'deleted') selected @endif>ถูกลบ&emsp;&emsp;</option>
    </select>
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
                <th class="text-center whitespace-nowrap">ประเภท</th>
                <th class="text-center whitespace-nowrap">สถานะ</th>
                <th class="text-center whitespace-nowrap">แอคชั่น</th>
            </tr>
        </thead>
        <tbody >
            @if($query->count() > 0)
                @foreach($query as $res)
                    @php 
                        $classset = '';
                        $nameset = '';
                        switch($res->status) {
                            case 'created':
                                $classset = 'bg-pending';
                                $nameset = 'รออนุมัติ';
                                break;
                            case 'approved':
                                $classset = 'bg-success';
                                $nameset = 'ออนไลน์';
                                break;
                            case 'rejected':
                                $classset = 'bg-primary';
                                $nameset = 'รอแก้ไข';
                                break;
                            case 'expired':
                                $classset = 'bg-danger';
                                $nameset = 'หมดอายุ';
                                break;
                            case 'deleted':
                                $classset = 'bg-danger';
                                $nameset = 'ถูกลบ';
                                break;
                        }
                    @endphp

                    <?php

                    // echo "<pre>";
                    // print_r($res);
                    // echo "</pre>";
                    ?>
                    <tr class="intro-x">
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{date('d/m/Y', strtotime($res->created_at))}}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{date('H:i:s', strtotime($res->created_at))}} น.</div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{$res->customer->firstname." ".$res->customer->lastname}}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$arrrole[$res->customer->sp_role]}}</div>
                        </td>
                        <td>
                            <a href="" class="font-medium whitespace-nowrap">{{ $res->yearregis??$res->modelyear }} {{ $res->brand->title}} {{ $res->model->model }}</a>
                            <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{$res->generation->generations." ".$res->subModel->sub_models}}</div>
                        </td>
                        <td class="text-center">{{number_format($res->price, 2, '.', ',')}} ฿</td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-default"> {{$arrtype[$res->type]}} </div>
                        </td>
                        <td class="w-40">
                            <div class="flex items-center justify-center text-default">
                                <span class="cursor-pointer rounded-full px-2 py-1 text-xs font-medium text-white {{$classset}}"> {{$nameset}} </span>
                            </div>
                        </td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center mr-3" target="_blank" href="{{ route('cardetailPage', ['slug' => $res->slug]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> โพสท์
                                </a>
                                
                                <a class="flex items-center mr-3" href="{{route('BN_posts_detail', ['id' => $res->id])}}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> รายละเอียด
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
<!-- END: Data List -->
<div class="d-flex">
    {!! $query->appends(request()->input())->links() !!}
</div>
@endsection

@section('script')
<script>
    function applyFilters() {
        var status = document.getElementById('status').value;
        var type = document.getElementById('type').value;
        var keyword = document.getElementById('keyword').value;

        var newUrl = `{{ route('BN_posts') }}?status=${status}&type=${type}&keyword=${keyword}`;
        window.location.href = newUrl;
    }

    function handleEnter(event) {
        if (event.key === 'Enter') {
            applyFilters();
        }
    }
</script>
@endsection
