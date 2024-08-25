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
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{$default_pagename}}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{route('BN_customers_add')}}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 [&amp;:hover:not(:disabled)]:bg-opacity-90 [&amp;:hover:not(:disabled)]:border-opacity-90 [&amp;:not(button)]:text-center disabled:opacity-70 disabled:cursor-not-allowed bg-primary border-primary text-white dark:border-primary mr-2 shadow-md" >เพิ่มรายชื่อลูกค้า</a>    
        </div>
    </div>

    <div class="lg:flex intro-y mt-5 mb-5">

        <div class="relative">
            <input type="text" name="keyword" id="keyword" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="เบอร์ / ชื่อ /นามสกุล ลูกค้า..." value="{{ request()->input('keyword') }}" onkeypress="handleEnter(event)" >
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" icon-name="search" class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500" data-lucide="search">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg> 
        </div>
        <select id="status" name="status" onchange="applyFilters()" class="form-select py-3 px-4 box w-full lg:w-auto mt-3 lg:mt-0 ml-auto">
            <option value="">ทุกสถานะ&emsp;&emsp;</option>
            <option value="normal" @if(request()->input('status') == 'normal') selected @endif>ลูกค้าทั่วไป&emsp;&emsp;</option>
            <option value="dealer" @if(request()->input('status') == 'dealer') selected @endif>ดีลเลอร์&emsp;&emsp;</option>
            <option value="vip" @if(request()->input('status') == 'vip') selected @endif>วีไอพี&emsp;&emsp;</option>
        </select>
    </div>
    <!-- <div id="fetchCustomerss"></div> -->



        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead>
                    <tr>
                        <th class="text-center whitespace-nowrap">#</th>
                        <th class="whitespace-nowrap"></th>
                        <th class="whitespace-nowrap">เบอร์โทร</th>
                        <th class="whitespace-nowrap">ชื่อ</th>
                        <th class="whitespace-nowrap">อีเมล</th>
                        <th class="whitespace-nowrap">สถานะ</th>
                        <th class="text-center whitespace-nowrap"></th>
                    </tr>
                </thead>
                <tbody>
                    
                    @foreach($query as $keyres => $res)
                    @php
                    $profile_img = ($res->image)?asset($res->image):asset('frontend/images/avatar.jpeg');
                    @endphp
                        <tr class="intro-x">
                            <td class="text-center">{{(($query->currentPage()-1)*24)+$keyres+1}}</td>
                            <td class="w-40">
                                <div class="flex">
                                    <div class="w-10 h-10 image-fit zoom-in -ml-5">
                                        <img alt="{{$res->firstname.' '.$res->lastname}}" class="tooltip rounded-full" src="{{$profile_img}}" >
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->phone}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->firstname." ".$res->lastname}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->email}}</div>
                            </td>
                            <td>
                                <div class="font-medium whitespace-nowrap">{{$res->role}}</div>
                            </td>
                            <td class="table-report__action w-56">
                                <div class="flex justify-center items-center">
                                    
                                    <a class="flex items-center text-success mr-3" href="{{route('BN_customers_detail', ['id' => $res->id])}}" >
                                        <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูข้อมูล
                                    </a>
                                    <a class="flex items-center" href="{{route('BN_customers_edit', ['id' => $res->id])}}">
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
        {!! $query->appends(request()->input())->links() !!}
        </div>





      



@endsection

@section('script')
<script>

    function applyFilters() {
        var status = document.getElementById('status').value;
        var keyword = document.getElementById('keyword').value;
        var newUrl = `{{ route('BN_customers') }}?status=${status}&keyword=${keyword}`;
        window.location.href = newUrl;
    }

    // Add event listeners to the select boxes
    document.getElementById('status').addEventListener('change', applyFilters);
    function handleEnter(event) {
        if (event.key === 'Enter') {
            applyFilters();
        }
    }

</script>


@endsection