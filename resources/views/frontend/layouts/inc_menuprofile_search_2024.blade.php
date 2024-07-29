<div class="col-12 col-lg-4 col-xl-3 menuprofile-mb">
    <div class="close-menuprofile"><i class="bi bi-x-circle-fill"></i></div>
    <a href="{{route('customercontactPage')}}" class="btn-customer">
        <div><i class="bi bi-person"></i> ลูกค้ารอติดต่อกลับ</div>
        <div class="num-contactcus">{{count($contacts_back)}}</div>
    </a>
    @include('frontend.layouts.inc-menu-deal')




    <div class="box-menuprofile">
        <div class="topic-menuprofile"><img src="{{asset('frontend/images/carred2.svg')}}" alt="" class="svg"> ค้นหารถในบัญชี</div>
        <div class="wrap-mycarsearch">
            <div class="item_mycarsearch">
                <div class="topicmycarsearch"> ยี่ห้อรถ</div>
                <div class="content_mycarsearch">
                    <input type="text" class="form-control" placeholder="ค้นหา...">
                    <div class="mycarsearch-type">
                        @foreach ($customer_cars_by_status['approved']['brands'] as $brandId => $brandData)
                            <button class="list-mycarsearch">
                                <div><img src="{{ asset($brandData['feature']) }}" alt=""> {{ $brandData['title'] }}</div>
                                <div class="num-mycarsearch">({{ $brandData['car_count_brand'] }})</div>
                            </button>
                        @endforeach
                        


                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-mycarsearch-sub">
            <div class="item_mycarsearch-sub">
                <div class="topicmycarsearch-sub"> เลือกรุ่น</div>
                <div class="content_mycarsearch-sub">
                    <input type="text" class="form-control" placeholder="ค้นหา...">
                    <div class="mycarsearch-type">

                        <!-- <button class="list-mycarsearch">
                            <div>C-CLASS</div>
                            <div class="num-mycarsearch">(5)</div>
                        </button> -->

                    </div>
                </div>
            </div>
        </div>
        <div class="search-carid">
            <label>เลขทะเบียน | รหัสรถ</label>
            <input type="text" class="form-control">
        </div>
        <button class="btn-red">ค้นหารถยนต์</button>
    </div>



















    <div class="box-menuprofile box-menuprofile-hide">
        <div class="topic-menuprofile">รถที่ลงขาย</div>
        <ul>
            <li><a href="{{route('profilePage')}}">ออนไลน์ <span>({{count($carfromstatus['approved'])??0}})</span></a></li>
            <li><a href="{{route('profilecheckPage')}}">รอตรวจสอบ <span>({{count($carfromstatus['created'])??0}})</span></a></li>
            <li><a href="{{route('profileeditcarinfoPage')}}">รอแก้ไข <span>({{count($carfromstatus['rejected'])??0}})</span></a></li>
            <li><a href="{{route('profileexpirePage')}}">หมดอายุ <span>({{count($carfromstatus['expired'])??0}})</span></a></li>
            <li><a href="{{route('profilesoldoutPage')}}">ขายแล้ว <span>({{count($carfromstatus['soldout'])??0}})</span></a></li>
        </ul>
    </div>


</div>





    