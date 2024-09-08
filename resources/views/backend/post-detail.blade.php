@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{$default_pagename}}</title>
@endsection

@section('subcontent')

@php
$customerimage = $customer->image ? asset($customer->image) : asset('img/user-default.png');
$arrsprole = [
    'home' => 'ลูกค้าทั่วไป',
    'dealer' => 'ดีลเลอร์',
];
@endphp

<div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
    <h2 class="mr-auto text-lg font-medium">
        {{$postcar->modelyear . " " . $brands->title . " " . $models->model . " " . $generations->generations . " " . $sub_models->sub_models}}
    </h2>
    <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
        <a href="{{route('BN_posts_edit', ['id' => $postcar->id])}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer bg-primary border-primary text-white shadow-md">
            แก้ไข
        </a>    
    </div>
</div>

<div class="intro-y news xl:w-5/5 p-5 box mt-8">
    <!-- BEGIN: Blog Layout -->
    <h2 class="intro-y font-medium text-3xl sm:text-3xl">
        {{$postcar->modelyear . " " . $brands->title . " " . $models->model . " " . $generations->generations . " " . $sub_models->sub_models}}
    </h2>
    <div class="intro-y text-slate-600 dark:text-slate-500 mt-3 text-xs sm:text-sm mb-6">
        สร้างเมื่อ {{date('d/m/Y', strtotime($postcar->created_at))}}  
        <span class="mx-1">•</span> 
        <a class="text-primary" href="#">{{date('H:i:s', strtotime($postcar->created_at))}} น.</a> 
    </div>
    
    <!-- Customer Information -->
    <div class="intro-y text-justify leading-relaxed">
        <div class="box">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
                    <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
                        <img alt="Customer Image" class="rounded-full" src="{{ $customerimage }}">
                    </div>
                    <div class="ml-5">
                        <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                            {{$customer->firstname . " " . $customer->lastname}}
                        </div>
                        <div class="text-slate-500">{{$customer->phone}}</div>
                    </div>
                </div>
                
                <div class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-3">ข้อมูลลูกค้า</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i>สถานะ : {{$arrsprole[$customer->sp_role] ?? 'ไม่ระบุ'}}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Mail" class="w-4 h-4 mr-2"></i>อีเมล : {{$customer->email}}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Phone" class="w-4 h-4 mr-2"></i>Line ID : {{$customer->line}}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i>จังหวัด : {{$customer->province}}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Map Pin" class="w-4 h-4 mr-2"></i>สถานที่รับรถ : {{$customer->place}}
                        </div>
                        <div class="truncate sm:whitespace-normal flex items-center">
                            <i data-lucide="Map" class="w-4 h-4 mr-2"></i>Map : 
                            @if(isset($customer->map))
                                <a href="{{$customer->google_map}}"> Google Map</a>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="mt-6 lg:mt-0 flex-1 px-5 border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
                    <div class="font-medium text-center lg:text-left lg:mt-5">MAP</div>
                    @if($customer->map)
                        <img alt="Map Image" data-action="zoom" class="rounded-md" width="100" height="60" src="{{asset($customer->map)}}">
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Postcar Information -->
    <div class="intro-y text-justify leading-relaxed mt-5">
        <div class="box sm:flex">
            <div class="px-6 py-8 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                <div class="news__preview image-fit">
                    <img alt="Post Feature Image" data-action="zoom" class="rounded-md" src="{{asset('storage/' . $postcar->feature)}}">
                </div>
            </div>
            <div class="px-6 py-8 flex flex-col justify-center flex-1">
                <div class="relative text-2xl font-medium mt-12 ml-0.5">{{$postcar->modelyear . " " . $brands->title . " " . $models->model}}</div>
                <div class="mt-4 text-xl text-slate-500">{{$generations->generations . " " . $sub_models->sub_models}}</div>
                
                <div class="pt-5 pb-5">
                    @php
                        $carDetails = [
                            'ราคา' => number_format($postcar->price, 2) . ' ฿',
                            'เลขไมล์' => $postcar->mileage . ' กม.',
                            'สี' => $postcar->color,
                            'เลขทะเบียน' => $postcar->vehicle_code,
                            'เกียร์' => $postcar->gear,
                            'แก็ส' => $postcar->gasname,
                        ];
                    @endphp
                    
                    @foreach ($carDetails as $label => $value)
                        <div class="relative flex items-center mb-2">
                            <div class="mr-auto">
                                <div class="font-medium text-base mr-5 text-slate-500">{{ $label }}</div>
                            </div>
                            <div class="font-medium text-base text-slate-600 dark:text-slate-500">{{ $value }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Warranty Information -->
    <div class="intro-y text-justify leading-relaxed mt-5">
        <div class="box">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                <div class="flex-1 px-5">
                    <div class="font-medium text-center lg:text-left lg:mt-5">ข้อมูลการรับประกัน</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        @php
                            $warrantyDetails = [
                                'รถได้รับการตรวจสภาพโดยผู้เชี่ยวชาญ' => $postcar->warranty_1,
                                'มีการรับประกัน ระยะเวลา ' . ($postcar->warranty_2_input ?? '') => $postcar->warranty_2,
                                'มีบริการช่วยเหลือฉุกเฉิน 24 ชม.' => $postcar->warranty_3,
                            ];
                        @endphp
                        
                        @foreach ($warrantyDetails as $label => $condition)
                            <div class="truncate sm:whitespace-normal flex items-center">
                                <i data-lucide="{{ $condition == 1 ? 'Check' : 'X' }}" class="w-4 h-4 mr-2"></i>{{ $label }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <!-- Categories Section -->
    <div class="intro-y text-justify leading-relaxed mt-5">
        <div class="box">
            <div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                <div class="flex-1 px-5">
                    <div class="font-medium text-center lg:text-left lg:mt-5">หมวดหมู่</div>
                    <div class="flex flex-col justify-center items-center lg:items-start mt-4">
                        @if(is_array($categories) && count($categories) > 0)
                            @foreach($categories as $category)
                                <div class="truncate sm:whitespace-normal flex items-center">
                                    <i data-lucide="Bookmark" class="w-4 h-4 mr-2"></i> {{ $category->name }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>    
    </div>

    <!-- Interior and Exterior Gallery -->
    <div class="intro-y text-justify leading-relaxed mt-5">
        <div class="box sm:flex">
            <div class="px-6 py-8 flex flex-col justify-center flex-1 border-t sm:border-t-0 sm:border-l border-slate-200 dark:border-darkmode-300 border-dashed">
                <div class="fade-mode">
                    @foreach($interior as $image)
                        <div class="h-64 px-2">
                            <div class="h-full image-fit rounded-md overflow-hidden">
                                <img data-action="zoom" src="{{asset('storage/' . $image->gallery)}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="px-6 py-8 flex flex-col justify-center flex-1">
                <div class="fade-mode">
                    @foreach($exterior as $image)
                        <div class="h-64 px-2">
                            <div class="h-full image-fit rounded-md overflow-hidden">
                                <img data-action="zoom" src="{{asset('storage/' . $image->gallery)}}">
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Licenseplate Section -->
    @if($postcar->licenseplate)
    <div class="intro-y text-justify leading-relaxed mt-5">
        <div class="box">
            <div class="flex flex-col lg:flex-row border-slate-200/60 dark:border-darkmode-400 px-5 py-5 -mx-5">
                <div class="flex-1 px-5">
                    <div class="font-medium text-center lg:text-left lg:mt-5">เล่มรถ</div>
                    
                        <img alt="Licenseplate" data-action="zoom" class="rounded-md" width="100" height="60" src="{{ asset($postcar->licenseplate) }}">
                    
                </div>
            </div>
        </div>    
    </div>
    @endif
    <?php
    // echo "<pre>";
    // print_r($postcar->user);
    // echo "</pre>";
    ?>
    @if($postcar->user)
    <div class="intro-y flex text-xs sm:text-sm flex-col sm:flex-row items-center mt-5 pt-5 border-t border-slate-200/60 dark:border-darkmode-400">
        <div class="flex items-center">
            <div class="w-12 h-12 flex-none image-fit">
                <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('uploads/1695725433.jpg') }}">
            </div>
            <div class="ml-3 mr-auto">
                <div class="font-medium">{{$postcar->user->name}}</div>
                <div class="text-slate-500">{{$postcar->user->email}}</div>
            </div>
        </div>
    </div>
    @endif

@endsection

@section('script')
<script>
    // Show or hide the reason box based on the status selected
    $("#select_status").on("change", function() {
        var status = $(this).val();
        if (status === 'rejected') {
            $('#reason_box').show();
        } else {
            $('#reason_box').hide();
        }
    });
</script>
@endsection
