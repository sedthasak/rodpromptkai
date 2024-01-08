<div class="col-12 col-lg-4 col-xl-3 menuprofile-mb">
    <div class="close-menuprofile"><i class="bi bi-x-circle-fill"></i></div>
    <a href="{{route('customercontactPage')}}" class="btn-customer">
        <div><i class="bi bi-person"></i> ลูกค้ารอติดต่อกลับ</div>
        <div class="num-contactcus">{{count($contacts_back)}}</div>
    </a>
    <div class="box-menuprofile box-menuprofile-hide">
        <div class="topic-menuprofile">รถที่ลงขาย</div>
        <ul>
            <li><a href="{{route('profilePage')}}">ออนไลน์ <span>({{count($carfromstatus['approved'])??0}})</span></a></li>
            <li><a href="{{route('profilecheckPage')}}">รอตรวจสอบ <span>({{count($carfromstatus['created'])??0}})</span></a></li>
            <li><a href="{{route('profileeditcarinfoPage')}}">รอแก้ไข <span>({{count($carfromstatus['rejected'])??0}})</span></a></li>
            <li><a href="{{route('profileexpirePage')}}">หมดอายุ <span>({{count($carfromstatus['expired'])??0}})</span></a></li>
        </ul>
    </div>

    <form name="profileform" method="GET">
        <input type="hidden" name="profile_brand_id">
        <input type="hidden" name="profile_model_id">
        <input type="hidden" name="profile_vehicle_code">
        <input type="hidden" name="profile_options" value="{{$carstatus}}">
        <input type="hidden" name="profile_customer_id" value={{$customer_id}}>
    </form>

    <div class="box-menuprofile">
        <div class="topic-menuprofile"><img src="{{asset('frontend/images/carred2.svg')}}" alt="" class="svg"> ค้นหารถในบัญชี</div>
        <div class="wrap-mycarsearch">
            <div class="item_mycarsearch">
                <div class="topicmycarsearch"> ยี่ห้อรถ</div>
                <div class="content_mycarsearch">
                    <input type="text" class="form-control brand" placeholder="ค้นหา...">
                    <div class="mycarsearch-type">
                        @php
                            $cnt=0;
                            $currentbrand = "";
                            $currentbrandid = 0;
                            $currentimage = "";
                            $total=count($brandsearch);
                        @endphp
                        
                        @if (isset($brandsearch))
                        @foreach ($brandsearch as $index => $rows)

                            @php
                                $cnt++;
                            @endphp

                            @if ($index==0)
                                @php
                                    $currentbrand = $rows->title;
                                    $currentbrandid = $rows->id;
                                    $currentimage = asset($rows->feature);
                                @endphp
                            @endif
                            
                            @if ($currentbrand != $rows->title)
                                

                                <button type="button" class="list-mycarsearch brand" onclick="profilesearchmodel({{$currentbrandid}});">
                                    <div><img src="{{$currentimage}}" alt=""> {{$currentbrand}}</div>
                                    <div class="num-mycarsearch">({{$cnt-1}})</div>
                                    
                                </button>
                                @php
                                    $cnt=0;
                                @endphp

                                @php
                                    $currentbrand = $rows->title;
                                    $currentbrandid = $rows->id;
                                    $currentimage = asset($rows->feature);
                                @endphp

                            @endif

                            @if ($index+1 == $total)
                                <button type="button" class="list-mycarsearch brand" onclick="profilesearchmodel({{$currentbrandid}});">
                                    <div><img src="{{$currentimage}}" alt=""> {{$currentbrand}}</div>
                                    <div class="num-mycarsearch">(@if($cnt>1){{$cnt+1}}@else{{$cnt}}@endif)</div>
                                </button>
                                @php
                                    $cnt=0;
                                @endphp
                            @endif

                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="wrap-mycarsearch-sub disabled">
            <div class="item_mycarsearch-sub">
                <div class="topicmycarsearch-sub"> เลือกรุ่น</div>
                <div class="content_mycarsearch-sub">
                    <input type="text" class="form-control model" placeholder="ค้นหา...">
                    <div class="mycarsearch-type model">
                        


                    </div>
                </div>
            </div>
        </div>
        <div class="search-carid">
            <label>เลขทะเบียน | รหัสรถ</label>
            <input type="text" class="form-control" name="vehiclesearch">
        </div>
        <button type="button" class="btn-red" onclick="search6();">ค้นหารถยนต์</button>
    </div>
</div>

<script>
    function profilesearchmodel(brand_id) {
        $.get('/profilesearchmodel/a?customer_id={{$customer_id}}&brand_id=' + brand_id + '&carstatus={{$carstatus}}', function (data, status) {

            $('.wrap-mycarsearch-sub').removeClass('disabled');


            console.log(data);
            var html = '';
            $('input[name="profile_brand_id"]').val(brand_id);

            var cnt = 0,
                currentmodel = "",
                currentmodelid = 0,
                total = 0,
                index2 = 0;
            
            $.each(data.modelsearch, function (index, value) {
                total++;
            });
            
            $.each(data.modelsearch, function (index, value) {
                cnt++;
                
                if (index2 === 0) {
                    currentmodel = value.model;
                    currentmodelid = value.id;
                }
                if (currentmodel != value.model) {
                    html += '<button type="button" class="list-mycarsearch model" onclick="profilemodel(\''+currentmodelid+'\')">';
                    html += '<div>' + currentmodel + '</div>';
                    html += '<div class="num-mycarsearch">(' + (cnt-1) + ')</div>';
                    html += '</button>';
                    cnt = 0;
                    currentmodel = value.model;
                    currentmodelid = value.id;
                }
                if (index2 + 1 === total) {
                    html += '<button type="button" class="list-mycarsearch model" onclick="profilemodel(\''+currentmodelid+'\')">';
                    html += '<div>' + currentmodel + '</div>';
                    html += '<div class="num-mycarsearch">(' + (index2>1?(cnt+1):(cnt)) + ')</div>';
                    html += '</button>';
                    cnt = 0;
                }
                index2++;
            });

            $('.mycarsearch-type.model').empty().append(html);
        });
    }

    function profilemodel(model_id) {
        $('input[name="profile_model_id"]').val(model_id);
    }

    function search6() {
        $('input[name="profile_vehicle_code"]').val($('input[name="vehiclesearch"]').val());

        // กำหนดค่า action
        if ($('input[name="profile_options"]').val() === "created") {
            $('form[name="profileform"]').attr('action', '/searchprofilecheckpage');
        }
        if ($('input[name="profile_options"]').val() === "rejected") {
            $('form[name="profileform"]').attr('action', '/searchprofileeditcarinfopage');
        }
        if ($('input[name="profile_options"]').val() === "approved") {
            $('form[name="profileform"]').attr('action', '/searchprofilepage');
        }
        if ($('input[name="profile_options"]').val() === "expired") {
            $('form[name="profileform"]').attr('action', '/searchprofileexpirepage');
        }

        // console.log($('input[name="profile_options"]').val());

        // ทำการ submit ฟอร์ม
        $('form[name="profileform"]').submit();

    }

</script>



    