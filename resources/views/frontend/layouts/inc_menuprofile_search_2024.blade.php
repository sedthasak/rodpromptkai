<div class="col-12 col-lg-4 col-xl-3 menuprofile-mb">
    <div class="close-menuprofile"><i class="bi bi-x-circle-fill"></i></div>
    <a href="{{ route('customercontactPage') }}" class="btn-customer">
        <div><i class="bi bi-person"></i> ลูกค้ารอติดต่อกลับ</div>
        <div class="num-contactcus">{{ count($contacts_back) }}</div>
    </a>
    @include('frontend.layouts.inc-menu-deal')

    @if ($usesearchbox === 'on')
    <div class="box-menuprofile">
        <div class="topic-menuprofile"><img src="{{ asset('frontend/images/carred2.svg') }}" alt="" class="svg"> ค้นหารถในบัญชี</div>

        <div class="wrap-mycarsearch">
            <div class="item_mycarsearch">
                <div class="topicmycarsearch">ยี่ห้อรถ</div>
                <div class="content_mycarsearch">
                    <input type="text" id="search-input" class="form-control" placeholder="ค้นหา..." onkeyup="filterBrands()">
                    <div class="mycarsearch-type" id="brand-list">
                        @if (!empty($customerCars['brands']))
                            @foreach ($customerCars['brands'] as $brandId => $brandData)
                                <button class="list-mycarsearch" data-brand-id="{{ $brandId }}">
                                    <div><img src="{{ $brandData['feature']?asset($brandData['feature']):asset('frontend/images/icon-car2.svg') }}" alt=""> {{ $brandData['title'] }}</div>
                                    <div class="num-mycarsearch">({{ $brandData['car_count_brand'] }})</div>
                                </button>
                            @endforeach
                        @else
                            <p>No cars found for this status.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="wrap-mycarsearch-sub">
            <div class="item_mycarsearch-sub">
                <div class="topicmycarsearch-sub"> เลือกรุ่น</div>
                <div class="content_mycarsearch-sub">
                    <input type="text" class="form-control" id="model-search-input" placeholder="ค้นหา..." onkeyup="filterModels()">
                    <div class="mycarsearch-type" id="model-list"></div>
                </div>
            </div>
        </div>

        <div class="search-carid">
            <label>เลขทะเบียน | รหัสรถ</label>
            <input type="text" class="form-control" id="car-id-input">
            <button class="btn-red" id="search-button">ค้นหารถยนต์</button>
            <button class="btn-red" id="reset-button">รีเซท</button>
        </div>
    </div>
    @endif
    <div class="box-menuprofile box-menuprofile-hide">
        <div class="topic-menuprofile">รถที่ลงขาย</div>
        <ul>
            <li><a href="{{ route('profilePage') }}">ออนไลน์ <span>({{ count($carfromstatus['approved'] ?? []) }})</span></a></li>
            <li><a href="{{ route('profilecheckPage') }}">รอตรวจสอบ <span>({{ count($carfromstatus['created'] ?? []) }})</span></a></li>
            <li><a href="{{ route('profileeditcarinfoPage') }}">รอแก้ไข <span>({{ count($carfromstatus['rejected'] ?? []) }})</span></a></li>
            <li><a href="{{ route('profileexpirePage') }}">หมดอายุ <span>({{ count($carfromstatus['expired'] ?? []) }})</span></a></li>
            <li><a href="{{ route('profilesoldoutPage') }}">ขายแล้ว <span>({{ count($carfromstatus['soldout'] ?? []) }})</span></a></li>
        </ul>
    </div>
</div>
