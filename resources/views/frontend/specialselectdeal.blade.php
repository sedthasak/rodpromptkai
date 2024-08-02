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
</style>

@section('content')

@include('frontend.layouts.inc_profile')	
<?php

// $default_image = asset('frontend/deal-example.webp');
$usesearchbox  = 'off';
$arr_gear = array(
    'auto' => 'เกียร์อัตโนมัติ',
    'manual' => 'เกียร์ธรรมดา',
);
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
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> ดีลพิเศษ</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        @include('frontend.layouts.inc_menu-specialdeal')
                        <div class="row wrpa-topic-dealspecial">
                            <div class="col-6">
                                <h3 class="topic-dealspecial">เลือกรูปแบบดีล</h3>
                            </div>
                            <div class="col-6 text-end">
                                <a href="{{route('specialchangedealPage')}}" class="btn-backdeal">ย้อนกลับ</a>
                            </div>
                        </div>

                        <div class="row box-item-cardeal">
                            @foreach($alldeals as $deal)    
                                @php
                                    $feature = $car->feature ? asset('storage/' . $car->feature) : asset('frontend/deal-example.webp');
                                    $oldPrice = $car->old_price;
                                    $newPrice = $car->price;
                                    $discountPercentage = $oldPrice > 0 ? floor((($oldPrice - $newPrice) / $oldPrice) * 100) : 0;
                                    $isSelected = $deal->id == $car->mydeal->deals_id;

                                    $border = $deal->border ?? '#000000';
                                    $imagePath = $deal->image_background ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $deal->image_background)) : null;
                                    $background = $deal->background ?? null;
                                    $topleftPath = $deal->topleft ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $deal->topleft)) : null;
                                    $bottomrightPath = $deal->bottomright ? asset('storage/uploads/deal/' . str_replace('public/uploads/deal/', '', $deal->bottomright)) : null;
                                    $font1 = $deal->font1 ?? '#FFFFFF';
                                    $font2 = $deal->font2 ?? '#FFDADA';
                                    $font3 = $deal->font3 ?? '#FFFFFF';
                                    $font4 = $deal->font4 ?? '#FFE500';
                                @endphp

                                <div class="col-6 col-xl-4 item-changedeal col-itemcar">
                                    <div class="deal-nametype">{{ $deal->name }}</div>
                                    <div class="item-car" style="border: 2px solid {{ $border }}; background-image: url('{{ $imagePath }}'); background-color: {{ $background }}">
                                        @if($topleftPath)
                                            <div class="tag-top-left"><img src="{{ $topleftPath }}" alt=""></div>
                                        @endif

                                        @if($deal->bigbrand == 1)
                                            <div class="logo-bigbrand"><img src="{{ asset('frontend/images2/logo-bigbrand.svg') }}" alt=""></div>
                                        @endif

                                        <figure>
                                            <div class="cover-car">
                                                <div class="box-timeout">
                                                    <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก {{ $car->remaining_time }}</div>
                                                    @if($bottomrightPath)
                                                        <div class="tag-bottom-right"><img src="{{ $bottomrightPath }}" alt=""></div>
                                                    @endif
                                                </div>
                                                <img src="{{ $feature }}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name" style="color: {{ $font1 }}">{{ $car->modelyear }} {{ $car->brand->title }} {{ $car->model->model }}</div>
                                                    <div class="car-series" style="color: {{ $font2 }}">{{ $car->generation->generations }} {{ $car->subModel->sub_models }}</div>
                                                    <div class="car-province" style="color: {{ $font2 }}">{{ $car->province }}</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car" style="color: {{ $font1 }}">{{ strip_tags($car->detail) }}</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore" style="color: {{ $font1 }}">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear" style="color: {{ $font3 }}"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> {{ $arr_gear[$car->gear] }}</div>
                                                    </div>

                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price" style="color: {{ $font4 }}">
                                                            {{ number_format($newPrice, 0, '.', ',') }}.-
                                                        </div>

                                                        @if($oldPrice > 0)
                                                            <div class="car-price-discount" style="color: {{ $font3 }}">
                                                                <span>{{ number_format($oldPrice, 0, '.', ',') }}.-</span> {{ floor($discountPercentage) }}%
                                                            </div>
                                                        @endif
                                                    </div>


                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                    <button class="btn-changedeal deal-selectcar {{ $isSelected ? 'selected' : '' }}" data-deal-id="{{ $deal->id }}" data-car-id="{{ $car->id }}" {{ $isSelected ? 'disabled' : '' }}>
                                        <i class="bi bi-check-circle-fill"></i> {{ $isSelected ? 'ดีลที่เลือกแล้ว' : 'เลือกใช้รูปแบบนี้' }}
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        

                    </div>
                    <div class="totop-mb"><a id="button-top">กลับสู่ด้านบน</a></div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('.deal-selectcar').click(function() {
            var dealId = $(this).data('deal-id');
            var carId = $(this).data('car-id');

            Swal.fire({
                title: 'ยืนยันการเลือกดีลนี้?',
                text: "คุณต้องการเลือกดีลนี้สำหรับรถคันนี้หรือไม่?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ยืนยัน',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("updateMyDeal") }}',
                        method: 'POST',
                        data: {
                            deal_id: dealId,
                            car_id: carId,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            console.log('Response:', response); // Log the response to the console
                            if (response.success) {
                                Swal.fire(
                                    'สำเร็จ!',
                                    'ดีลนี้ถูกเลือกสำหรับรถคันนี้แล้ว.',
                                    'success'
                                ).then(() => {
                                    // Redirect to the specialchangedealPage route
                                    window.location.href = '{{ route("specialchangedealPage") }}';
                                });
                            } else {
                                Swal.fire(
                                    'เกิดข้อผิดพลาด!',
                                    'ไม่สามารถเลือกดีลนี้ได้ กรุณาลองใหม่อีกครั้ง.',
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Error:', status, error); // Log the error details to the console
                            Swal.fire(
                                'เกิดข้อผิดพลาด!',
                                'เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>
@endsection

