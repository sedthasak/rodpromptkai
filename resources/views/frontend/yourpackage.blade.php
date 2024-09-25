@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

<style>
    .list-mycarsearch.brand.active {
        background-color: #E4EEFA;
    }
    .list-mycarsearch.model.active {
        background-color: #E4EEFA;
    }

    .pagination-wrapper {
        overflow-x: auto;
        padding: 10px 0;
        text-align: center;
        white-space: nowrap;
    }

    .pagination-wrapper .pagination {
        display: inline-flex;
        justify-content: flex-start; /* Or 'center' based on your preference */
        flex-wrap: nowrap;
    }

    .pagination-wrapper .page-item {
        margin: 0 2px;
    }

    .pagination-wrapper .page-link {
        width: 40px; /* Set a fixed width for the buttons */
        height: 40px; /* Set a fixed height for the buttons */
        line-height: 40px; /* Center the text vertically */
        text-align: center; /* Center the text horizontally */
        padding: 0; /* Remove default padding */
        display: inline-block; /* Ensure the element remains inline */
        border: 1px solid #dee2e6;
        border-radius: 5px;
        color: #007bff;
        text-decoration: none;
        background-color: #fff;
    }

    .pagination-wrapper .page-item.active .page-link {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .pagination-wrapper .page-item.disabled .page-link {
        color: #6c757d;
        pointer-events: none;
        background-color: #e9ecef;
        border-color: #dee2e6;
    }

    @media (max-width: 768px) {
        .pagination-wrapper .page-link {
            width: 30px; /* Smaller width for mobile */
            height: 30px; /* Smaller height for mobile */
            line-height: 30px; /* Adjusted line height */
        }
    }





</style>

@section('content')
@include('frontend.layouts.inc_profile')	
<?php
$usestatus = 'approved';
$default_image = asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png');
// $data = session()->all();
// echo "<pre>";
// print_r($customer_role);
// echo "</pre>";
// echo "<pre>";
// print_r($customer_login);
// echo "</pre>";
// echo "<pre>";
// print_r($customer_level);
// echo "</pre>";
// echo "<pre>";
// print_r($customer_post);
// echo "</pre>";
// echo "<pre>";
// print_r($customer_deal);
// echo "</pre>";
?>
@php
    $usestatus = $usestatus ?? 'approved';
    $usewithdeal = $usewithdeal ?? null;
    $usesearchbox = $usesearchbox ?? 'on';

    if ($usewithdeal === 'yes') {
        $customerCars = $customer_cars_with_deals[$usestatus] ?? [];
    } elseif ($usewithdeal === 'no') {
        $customerCars = $customer_cars_without_deals[$usestatus] ?? [];
    } else {
        $customerCars = $customer_cars_by_status[$usestatus] ?? [];
    }
    $brandData = $customerCars['brands'] ?? [];
@endphp
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.inc_menuprofile_search_2024', ['customerCars' => $customerCars])
                <div class="col-12 col-lg-8 col-xl-9">
                    <div class="desc-pageprofile">
                        <div class="wraptopic-pageprofile">
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> แพ็คเกจของคุณ</div>
                        </div>

                        @if(empty($customer_role['order_id']))
                        <div class="wrap-desc-yourpack">
                            <div class="row">
                                <div class="col-12 col-md-9">
                                    <div class="note-notdeal">คุณยังไม่มีโควต้าสำหรับลงขายธุรกิจ คลิก เพื่อซื้อแพคเกจลงขายธุรกิจ</div>
                                </div>
                                <div class="col-12 col-md-3 text-end">
                                    <a d href="{{route('packagePage')}}" class="btn-default btn-red">ซื้อเลย <img src="{{ asset('frontend/images2/iconcart.svg') }}" alt=""></a>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="wrap-yourpack">
                            <div class="row">
                                <div class="col-12 col-md-3">
                                    <div class="wrap-yourpack-name">({{strtoupper($customer_role['role'])}}) {{$customer_role['pack']}}</div>
                                </div>
                                <div class="col-12 col-md-9">
                                    <div class="wrap-yourpack-date">
                                        @if($customer_role['role'] == 'dealer')
                                        วันที่สั่งซื้อ: {{ \Carbon\Carbon::parse($customer_role['dealerpack_regis'])->format('d/m/Y') }} | {{ \Carbon\Carbon::parse($customer_role['dealerpack_regis'])->format('H:i') }} 
                                        @elseif($customer_role['role'] == 'vip')
                                        วันที่สั่งซื้อ: {{ \Carbon\Carbon::parse($customer_role['vippack_regis'])->format('d/m/Y') }} | {{ \Carbon\Carbon::parse($customer_role['vippack_regis'])->format('H:i') }} 
                                        @endif
                                        <span>ราคา : ฿ {{ number_format($customer_role['last_order']->total, 0) }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="wrap-yourpack-detail">
                                <div class="wrap-yourpack-detail-list">
                                    <div>สถานะปัจจุบัน</div>
                                    <div><span>{{$customer_role['role']}}</span></div>
                                </div>
                                <div class="wrap-yourpack-detail-list">
                                    <div>Slot ลงขาย</div>
                                    <div><span>{{$customer_post['dealer']}}
                                    /
                                    @if ($customer_role['role'] == 'dealer')
                                        {{$customer_role['dealerpack_quota']}}
                                    @elseif ($customer_role['role'] == 'vip')
                                        {{$customer_role['vippack_quota']}}
                                    @endif
                                     คัน</span></div>
                                </div>
                                <div class="wrap-yourpack-detail-list">
                                    <div>สัญญาหมดอายุ</div>
                                    @if($customer_role['role'] == 'dealer')
                                    <div><span>{{ \Carbon\Carbon::parse($customer_role['dealerpack_expire'])->format('d/m/Y H:i') }}</span></div>
                                    @elseif($customer_role['role'] == 'vip')
                                    <div><span>{{ \Carbon\Carbon::parse($customer_role['vippack_expire'])->format('d/m/Y H:i') }}</span></div>
                                    @endif
                                    
                                </div>
                            </div>
                        </div>
                        @endif
                        

                        
                        


                    </div>

                    <div class="totop-mb"><a id="button-top">กลับสู่ด้านบน</a></div>
                </div>
            </div>
        </div>
    </div>
</section>




@endsection

@section('script')

@endsection
