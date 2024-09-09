@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-5 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }}</h2>
        <div class="mt-4 flex w-full sm:mt-0 sm:w-auto">
            <a href="{{ route('BN_discounts_add') }}" class="transition duration-200 border inline-flex items-center justify-center py-2 px-3 rounded-md font-medium cursor-pointer focus:ring-4 focus:ring-primary focus:ring-opacity-20 focus-visible:outline-none dark:focus:ring-slate-700 dark:focus:ring-opacity-50 bg-primary border-primary text-white mr-2 shadow-md">
                เพิ่มคูปอง
            </a>    
        </div>
    </div>

    <div class="lg:flex intro-y mt-5 mb-5">
        <div class="relative">
            <input type="text" name="keyword" id="keyword" class="form-control py-3 px-4 w-full lg:w-64 box pr-10" placeholder="ค้นหา..." value="{{ request()->input('keyword') }}" onkeypress="handleEnter(event)">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0 text-slate-500 cursor-pointer" onclick="applyFilters()">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg> 
        </div>
    </div>

    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
        <table class="table table-report -mt-2">
            <thead>
                <tr>
                    <th class="text-center whitespace-nowrap">#</th>
                    <th class="whitespace-nowrap">ชื่อ</th>
                    <th class="whitespace-nowrap">โค๊ด</th>
                    <th class="whitespace-nowrap">ส่วนลด</th>
                    <th class="whitespace-nowrap">สูงสุด</th>
                    <th class="whitespace-nowrap">หมดอายุ</th>
                    <th class="whitespace-nowrap">จำกัดจำนวน</th>
                    <th class="whitespace-nowrap">คำอธิบาย</th>
                    <th class="whitespace-nowrap">เลเวล</th>
                    <th class="whitespace-nowrap">สถานะ</th>
                    <th class="text-center whitespace-nowrap"></th>
                </tr>
            </thead>
            <!-- <tbody>
                @foreach($coupons as $key => $coupon)
                    <tr class="intro-x">
                        <td class="text-center">{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $key + 1 }}</td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->name }}</div></td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->code }}</div></td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->rate }}</div></td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->limit_rate }}</div></td>
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                {{ $coupon->expirecoupon ? date('d/m/Y', strtotime($coupon->expirecoupon)) : 'ไม่หมดอายุ' }}
                            </div>
                        </td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->limit }}</div></td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->description }}</div></td>
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                {{ $coupon->level ? $coupon->level->name : 'ไม่จำกัด' }}
                            </div>
                        </td>
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->status }}</div></td>
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-success mr-3" href="{{ route('BN_discounts_detail', ['id' => $coupon->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> ดูข้อมูล
                                </a>
                                <a class="flex items-center" href="{{ route('BN_discounts_edit', ['id' => $coupon->id]) }}">
                                    <i data-lucide="check-square" class="w-4 h-4 mr-1"></i> แก้ไข
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody> -->
            <tbody>
                @foreach($coupons as $key => $coupon)
                    <tr class="intro-x">
                        <td class="text-center">{{ ($coupons->currentPage() - 1) * $coupons->perPage() + $key + 1 }}</td>

                        <!-- Coupon Name -->
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->name }}</div></td>

                        <!-- Coupon Code -->
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->code }}</div></td>

                        <!-- Discount Rate: Display as percentage without decimals -->
                        <td><div class="font-medium whitespace-nowrap">{{ intval($coupon->rate) }}%</div></td>

                        <!-- Limit Rate: Show number or infinity icon if limit rate is not set -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                @if($coupon->limit_rate && $coupon->limit_rate != 0)
                                    {{ intval($coupon->limit_rate) }}
                                @else
                                    <i data-lucide="infinity" class="w-4 h-4"></i>
                                @endif
                            </div>
                        </td>

                        <!-- Expiration Date: Show infinity icon if no expiry, otherwise formatted date -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                @if($coupon->expirecoupon)
                                    {{ date('d/m/y', strtotime($coupon->expirecoupon)) }}
                                @else
                                    <i data-lucide="infinity" class="w-4 h-4"></i>
                                @endif
                            </div>
                        </td>

                        <!-- Limit: Show infinity icon if no limit, otherwise display the number -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                @if($coupon->limit && $coupon->limit != 0)
                                    {{ $coupon->limit }}
                                @else
                                    <i data-lucide="infinity" class="w-4 h-4"></i>
                                @endif
                            </div>
                        </td>

                        <!-- Description -->
                        <td><div class="font-medium whitespace-nowrap">{{ $coupon->description }}</div></td>

                        <!-- Level Member: Show 'ไม่จำกัด' if no level, otherwise show level name -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                {{ $coupon->level ? $coupon->level->name : 'ไม่จำกัด' }}
                            </div>
                        </td>

                        <!-- Status: Show a green or red solid circle without text -->
                        <td>
                            <div class="font-medium whitespace-nowrap">
                                @if($coupon->status === 'active')
                                    <i data-lucide="circle" class="text-green-500 w-5 h-5" style="fill: green;"></i>
                                @else
                                    <i data-lucide="circle" class="text-red-500 w-5 h-5" style="fill: red;"></i>
                                @endif
                            </div>
                        </td>

                        <!-- Action Buttons -->
                        <td class="table-report__action w-56">
                            <div class="flex justify-center items-center">
                                <a class="flex items-center text-success mr-3" href="{{ route('BN_discounts_detail', ['id' => $coupon->id]) }}">
                                    <i data-lucide="Eye" data-tw-merge data-placement="top" title="See Detail" class="tooltip w-4 h-4 mr-1"></i>
                                </a>
                                <a class="flex items-center" href="{{ route('BN_discounts_edit', ['id' => $coupon->id]) }}">
                                    <i data-lucide="Edit" data-tw-merge data-placement="top" title="Edit" class="tooltip  w-4 h-4 mr-1"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>





        </table>
    </div>

    <div class="d-flex">
        {!! $coupons->appends(request()->input())->links() !!}
    </div>
@endsection

@section('script')
<script>
    function applyFilters() {
        const keyword = document.getElementById('keyword').value;
        window.location.href = `{{ route('BN_discounts') }}?keyword=${encodeURIComponent(keyword)}`;
    }

    function handleEnter(event) {
        if (event.key === 'Enter') {
            event.preventDefault();
            applyFilters();
        }
    }
</script>
@endsection
