<div class="col-12 mdeal-hide">
    <div class="box-menudeal box-menudeal-mb">
        <ul>
            <li class="box-m-code">
                <a href="{{route('getcouponPage')}}"><div><img src="{{ asset('frontend/images2/icon-code.svg') }}" alt=""> โค้ดส่วนลด</div> 
                    <!-- <div class="have-code">10+ โค้ด</div> -->
                </a>
            </li>
            <li>
                <a href="{{route('packagePage')}}"><div><img src="{{ asset('frontend/images2/icon-menupack.svg') }}" alt="">แพ็คเกจลงขายรถ</div> <span><img src="{{ asset('frontend/images/icon-chev-grey.svg') }}" alt=""></span></a>
            </li>
            <li class="hide-pc">
                <a href="{{route('yourpackagePage')}}"><div><img src="{{ asset('frontend/images2/icon-yourpackage.svg') }}" alt="">แพ็คเกจของคุณ</div></a>
            </li>
            <li>
                <a href="{{route('specialdealPage')}}" class="btn-adddeal btn-adddeal-pc"><div><img src="{{ asset('frontend/images2/icon-adddeal-white.svg') }}" alt=""> เพิ่มการมองเห็น</div> <span><img src="{{ asset('frontend/images/icon-chev-white.svg') }}" alt=""></span></a>
                <a href="{{route('specialdealPage')}}" class="btn-adddeal btn-adddeal-mb"><div><img src="{{ asset('frontend/images2/icon-adddeal.svg') }}" alt=""> เพิ่มการมองเห็น</div> <span><img src="{{ asset('frontend/images/icon-chev-white.svg') }}" alt=""></span></a>
            </li>
        </ul>
    </div>
    <div class="box-menudeal">
        <ul>
            <li class="hide-mpack">
                <a href="{{route('yourpackagePage')}}" class="btn-yourpack">แพ็คเกจของคุณ <span><img src="{{ asset('frontend/images/icon-chev-white.svg') }}" alt=""></span></a>
            </li>
            <li>
                <!-- <a href="#">Slot ลงขาย <span>50 คัน</span></a> -->
                <a>Slot ลงขาย <span>{{$customer_post['dealer']??0}}
                    @if ($customer_role['role'] == 'dealer')
                        {{" / ".$customer_role['dealerpack_quota']." คัน"}}
                    @elseif ($customer_role['role'] == 'vip')
                        {{" / ".$customer_role['vippack_quota']." คัน"}}
                    @elseif ($customer_role['role'] == 'normal')
                        0
                    @else
                        {{$customer_role['customer_quota']}}
                    @endif
                </span></a>
            </li>
            <li>
                <!-- <a href="#">สัญญาหมดอายุ <span>22/05/2024</span></a> -->
                @if ($customer_role['role'] == 'normal' || $customer_role['role'] == 'admin')
                    <a>สัญญาหมดอายุ <span>ไม่จำกัด</span></a>
                @elseif ($customer_role['role'] == 'dealer' && $customer_role['dealerpack_expire'])
                    @php
                        $dealerpackExpire = new DateTime($customer_role['dealerpack_expire']);
                        $dealerpackExpireFormatted = $dealerpackExpire->format('d/m/Y');
                    @endphp
                    <a href="#">สัญญาหมดอายุ <span>{{ $dealerpackExpireFormatted }}</span></a>
                @elseif ($customer_role['role'] == 'vip' && $customer_role['vippack_expire'])
                    @php
                        $vippackExpire = new DateTime($customer_role['vippack_expire']);
                        $vippackExpireFormatted = $vippackExpire->format('d/m/Y');
                    @endphp
                    <a>สัญญาหมดอายุ <span>{{ $vippackExpireFormatted }}</span></a>
                @else
                    <div>สัญญาหมดอายุ : ไม่จำกัด</div>
                @endif
            </li>
            <li>
                <a href="{{route('orderhistoryPage')}}">ประวัติการทำธุรกรรม  <span><img src="{{ asset('frontend/images/icon-chev-grey.svg') }}" alt=""></span></a>
            </li>
        </ul>
    </div>
</div>



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
                                    <div>
                                        <!-- <img src="{{ $brandData['feature']?asset($brandData['feature']):asset('frontend/images/icon-car2.svg') }}" alt="">  -->
                                        {{ $brandData['title'] }}</div>
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
