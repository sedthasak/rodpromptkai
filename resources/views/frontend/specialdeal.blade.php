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
$usesearchbox  = 'off';
$default_feature = asset('frontend/deal-example.webp');
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
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> เพิ่มการมองเห็น</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        @include('frontend.layouts.inc_menu-specialdeal')
                        <div class="row wrpa-topic-dealspecial">
                            <div class="col-6">
                                <h3 class="topic-dealspecial">ซื้อรูปแบบทั้งหมด</h3>
                                <p>กดที่<span>ปุ่มซื้อเลย</span>เพื่อรับรูปแบบทั้งหมด</p>
                            </div>
                            <div class="col-6 text-end">
                                @include('frontend.layouts.inc_btn_adddeal')
                            </div>
                        </div>

                        <div class="row box-item-cardeal">


                            @foreach($alldeals as $deal)    
                                <div class="col-6 col-xl-4 col-itemcar">
                                    <div class="deal-nametype">{{$deal->name}}</div>
                                    <div class="item-car" style="border: 2px solid {{ $deal->border ?? '#000000' }}; 
                                        @if($deal->image_background) 
                                            @php
                                                $imagePathbg = str_replace('public/uploads/deal/', '', $deal->image_background);
                                            @endphp
                                            background-image: url('{{ asset('storage/uploads/deal/' . $imagePathbg) }}');
                                        @elseif($deal->background) 
                                            background-color: {{ $deal->background }};
                                        @endif">
                                        @if($deal->topleft)
                                            @php
                                                $topleftPath = str_replace('public/uploads/deal/', '', $deal->topleft);
                                            @endphp
                                            <div class="tag-top-left"><img src="{{ asset('storage/uploads/deal/' . $topleftPath) }}" alt=""></div>
                                        @endif


                                        <figure>
                                            <div class="cover-car">
                                                <div class="box-timeout">
                                                    <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก 3 วัน 18 ชม.</div>
                                                    @if($deal->bottomright)
                                                        @php
                                                            $bottomrightPath = str_replace('public/uploads/deal/', '', $deal->bottomright);
                                                        @endphp
                                                        <div class="tag-bottom-right"><img src="{{ asset('storage/uploads/deal/' . $bottomrightPath) }}" alt=""></div>
                                                    @endif
                                                </div>
                                                <img src="{{$default_feature}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name" style="color: {{ $deal->font1 ?? '#FFFFFF' }}">2016 Honda CR-V </div>
                                                    <div class="car-series" style="color: {{ $deal->font2 ?? '#FFDADA' }}">CR-V 2.0 E (MY12) (MNC)</div>
                                                    <div class="car-province" style="color: {{ $deal->font2 ?? '#FFDADA' }}">กรุงเทพมหานคร</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car" style="color: {{ $deal->font1 ?? '#FFFFFF' }}">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore" style="color: {{ $deal->font1 ?? '#FFFFFF' }}">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear" style="color: {{ $deal->font3 ?? '#FFFFFF' }}"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> เกียร์อัตโนมัติ</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price" style="color: {{ $deal->font4 ?? '#FFE500' }}">599,000.-</div>
                                                        <div class="car-price-discount" style="color: {{ $deal->font3 ?? '#FFFFFF' }}">
                                                            <span>999,000.-</span> 15%
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
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
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const amountInput = document.getElementById('deal-amount');
        const totalPriceSpan = document.getElementById('total-price');

        // Function to update the total price based on the amount
        function updateTotalPrice() {
            const amount = parseInt(amountInput.value, 10) || 0;
            const pricePerUnit = 500; // Price per car
            const totalPrice = amount * pricePerUnit;
            totalPriceSpan.textContent = totalPrice.toLocaleString();
        }

        // Event listener for amount input changes
        amountInput.addEventListener('input', updateTotalPrice);

        // Form submission
        const form = document.getElementById('deal-form');
        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
            const amount = amountInput.value;

            if (!amount) {
                alert('กรุณาระบุจำนวนรถ');
                return;
            }

            form.submit(); // Submit the form if amount is valid
        });
    });
</script>
@endsection