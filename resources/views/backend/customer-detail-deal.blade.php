@extends('../backend/layout/side-menu')

@section('subhead')
<title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')
<div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
    <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <a href="{{route('BN_customers_register_vip', ['id' => $Customer->id])}}" class="btn btn-primary mr-2">เพิ่มแพ็คเกจวีไอพี</a>
        <a href="{{route('BN_customers_edit', ['id' => $Customer->id])}}" class="btn btn-secondary">แก้ไขข้อมูลลูกค้า</a>
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
<!-- Include the shared navigation box for the customer pages -->
@include('backend.components._customer_navigation')

<!-- BEGIN: Orders List -->
<div class="intro-y col-span-12 overflow-auto lg:overflow-visible mt-5">
    <table class="table table-report -mt-2">
        <thead>
            <tr>
                <th class="whitespace-nowrap">วันที่</th>
                <th class="whitespace-nowrap">เลขที่ออเดอร์</th>
                <th class="text-center whitespace-nowrap">ราคา</th>
                <th class="text-center whitespace-nowrap">ประเภท</th>
                <th class="text-center whitespace-nowrap">สถานะ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr class="intro-x">
                <td>
                    <a href="" class="font-medium whitespace-nowrap">{{date('d/m/Y', strtotime($order->created_at))}}</a>
                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{date('H:i:s', strtotime($order->created_at))}} น.</div>
                </td>
                <td>{{$order->order_number}}</td>
                <td class="text-center">{{number_format($order->price, 2, '.', ',')}} ฿</td>
                <td class="text-center">{{$order->type}}</td>
                <td class="text-center">{{$order->status}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<div class="d-flex justify-content-center mt-4">
    {!! $orders->links() !!}
</div>
<!-- END: Orders List -->
@endsection
