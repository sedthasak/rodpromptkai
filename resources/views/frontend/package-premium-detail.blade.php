@extends('../frontend/layouts/layout')

@section('subhead')
    <title>{{ $packageDetail->name }} - Package Premium Detail</title>
@endsection

@section('content')
@php
    // Mapping for tag positions
    $arr_tag = [
        '1' => 'tag-top',
        '2' => 'tag-top-left',
        '3' => 'tag-top-left2',
        '4' => 'tag-top-left3',
    ];
@endphp

<section class="row">
    <div class="col-12 col-md-8 col-xl-9 bg-show-pack bg-package">
        <div class="wrap-show-pack">
            <h2><img src="{{ asset('images2/dimond-gold.svg') }}" alt=""> {{ $packageDetail->name }}</h2>
            <div class="box-package-sale">
                @if($packageDetail->old_price)
                    <span>฿{{ number_format($packageDetail->price, 2) }} / ปี</span>
                    <div class="box-package-sale-save">{{ $packageDetail->label_save }}</div>
                    <div class="box-package-sale-pricesave">฿{{ number_format($packageDetail->old_price, 2) }}</div>
                @else
                    <span>฿{{ number_format($packageDetail->price, 2) }} / ปี</span>
                @endif
            </div>
            <div class="border-show-pack">
                <div class="page-member levelclass-platinum">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <div class="boxtext-membername">
                                <h2>{{ $packageDetail->name }}</h2>
                                <h3>รายละเอียดแพ็กเกจ</h3>
                            </div>
                        </div>
                        <div class="col-12 col-md-9">
                            <div class="member-profile-userid">
                                <div class="boxtext-memid">
                                    <i class="bi bi-person-circle"></i> ประเภทแพ็กเกจ: {{ $packageDetail->label_bottom }}
                                </div>
                                <div class="boxtext-memid">
                                    ข้อมูลแพ็กเกจ: {{ $packageDetail->text1 }} 
                                    <br>
                                    ข้อมูลเพิ่มเติม: {{ $packageDetail->text2 }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Loop through each deal and display it dynamically -->
                <div>
                    @foreach($alldeals as $deal)
                    <div class="tab_vipdetail">
                        <div class="col-itemcar">
                            <div class="item-car" style="border: 2px solid {{ $deal->border ?? '#000000' }};
                                @if($deal->image_background)
                                    @php $imagePathbg = $deal->image_background ? asset('storage/' . str_replace('public/', '', $deal->image_background)) : null; @endphp
                                    background-image: url('{{ $imagePathbg }}');
                                @elseif($deal->background)
                                    background-color: {{ $deal->background }};
                                @endif">
                                
                                @if($deal->topleft)
                                    @php $topleftPath = $deal->topleft ? asset('storage/' . str_replace('public/', '', $deal->topleft)) : null; @endphp
                                    <div class="{{ $arr_tag[$deal->topleft_position] }}"><img src="{{ $topleftPath }}" alt=""></div>
                                @endif

                                <div class="logo-bigbrand"><img src="{{ asset('frontend/images2/logo-bigbrand.svg') }}" alt=""></div>
                                <figure>
                                    <div class="cover-car">
                                        <div class="box-timeout">
                                            <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก 3 วัน 18 ชม.</div>
                                            @if($deal->bottomright)
                                                @php $bottomrightPath = $deal->bottomright ? asset('storage/' . str_replace('public/', '', $deal->bottomright)) : null; @endphp
                                                <div class="tag-bottom-right"><img src="{{ $bottomrightPath }}" alt=""></div>
                                            @endif
                                        </div>
                                        @php
                                            $random_number = rand(1, 6);
                                            $random_feature = asset('uploads/car-' . $random_number . '.webp');
                                        @endphp
                                        <img src="{{ $random_feature }}" alt="">
                                    </div>
                                    <figcaption>
                                        <div class="grid-desccar">
                                            <div class="car-name" style="color: {{ $deal->font1 ?? '#FFFFFF' }}">2016 Honda CR-V</div>
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
                        <div>{{ $deal->name }}</div>
                    </div>
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- Side Section -->
    <div class="col-12 col-md-4 col-xl-3 package-premium-item">
        <div class="package-premium-padding">
            <div class="box-logobigbrand">
                <div>
                    <h3 class="topic-premium-item">Logo Big Brand</h3>
                    <h6>ธุรกิจร้านค้าอย่างเป็นทางการ</h6>
                </div>
                <div class="logobigbrand"><img src="{{ asset('frontend/images2/logo-bigbrand.svg') }}" alt="Big Brand"></div>
            </div>
            <div class="box-campane">
                <h3 class="topic-premium-item">แคมเปญโปรโมทช่วยขาย</h3>
                <div class="tab_vip_btn">
                    @foreach($alldeals as $index => $deal)
                        <div class="btn-vip @if($index == 0) active @endif">{{ $deal->name }} <i class="bi bi-check-lg"></i></div>
                    @endforeach
                </div>
            </div>
            <div class="box-bannerpromote">
                <h3 class="topic-premium-item">แบนเนอร์โปรโมท</h3>
                <p>Promote ads Banner</p>
                <div class="photo-bannerpromote"><img src="{{ asset('frontend/images2/banner-promote.jpg') }}" alt="Promote Banner"></div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    // Add any specific JavaScript or jQuery if necessary for interactive elements
</script>
@endsection
