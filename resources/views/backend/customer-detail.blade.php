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
        
        <a href="{{route('BN_customers_register_vip', ['id' => $Customer->id])}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >
            เพิ่มแพ็คเกจวีไอพี
        </a>   
        <a href="{{route('BN_customers_edit', ['id' => $Customer->id])}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >
            แก้ไขข้อมูลลูกค้า
        </a>  
    </div>
</div>
<div class="intro-y news xl:w-5/5 p-5 box mt-8">
    <div class="intro-y text-justify leading-relaxed">
        <div class="box">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="" class="rounded-full" src="{{ file_exists(public_path($Customer->image)) ? asset($Customer->image) : asset('uploads/avatar.jpeg') }}">
                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">{{$Customer->firstname." ".$Customer->lastname}}</div>
                        <div class="text-slate-500">{{$Customer->phone}}</div>
                    </div>
                </div>
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">ข้อมูลลูกค้า</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Circle" class="w-4 h-4 mr-2"></i> {{$Customer->email}}
                        </div>

                    </div>
                </div>
            </div>
        </div>
            
    </div>
</div>
<!-- BEGIN: Data List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
    <table class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">วันที่</th>
                <th class="whitespace-nowrap">โพสท์</th>
                <th class="text-center whitespace-nowrap">ราคา</th>
                <th class="text-center whitespace-nowrap">ประเภท</th>
                <th class="text-center whitespace-nowrap">สถานะ</th>
                <th class="text-center whitespace-nowrap">แอคชั่น</th>
            </tr>
        </thead>
        <tbody >
            @if($cars->count() > 0)
                @foreach($cars as $res)
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
                            <a href="" class="font-medium whitespace-nowrap">{{$res->modelyear." ".$res->brand->title." ".$res->model->model}}</a>
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
                                <a class="flex items-center mr-3" href="{{route('BN_posts_detail', ['id' => $res->id])}}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูโพสท์
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
    {!! $cars->appends(request()->input())->links() !!}
</div>




@endsection

@section('script')
<script>

</script>


@endsection