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

$default_image = asset('frontend/deal-example.webp');
// echo "<pre>";
// print_r($default_image);
// echo "</pre>";
?>
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                @include('frontend.layouts.inc_menuprofile_search_2024')
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
                                    <div class="item-car" style="border: 2px solid #BC0000; 
                                        @if($deal->image_background) 
                                            @php
                                                $imagePath = str_replace('public/uploads/deal/', '', $deal->image_background);
                                            @endphp
                                            background-image: url('{{ asset('storage/uploads/deal/' . $imagePath) }}');
                                        @elseif($deal->background) 
                                            background-color: {{ $deal->background }};
                                        @endif">
                                        @if($deal->topleft)
                                            @php
                                                $topleftPath = str_replace('public/uploads/deal/', '', $deal->topleft);
                                            @endphp
                                            <div class="tag-top-left"><img src="{{ asset('storage/uploads/deal/' . $topleftPath) }}" alt=""></div>
                                        @endif

                                        @if($deal->bigbrand == 1)
                                            <div class="logo-bigbrand"><img src="{{ asset('frontend/images2/logo-bigbrand.svg') }}" alt=""></div>
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
                                                <img src="{{$default_image}}" alt="">
                                            </div>
                                            <figcaption>
                                                <div class="grid-desccar">
                                                    <div class="car-name" style="color: #FFFFFF">2016 Honda CR-V </div>
                                                    <div class="car-series" style="color: #FFDADA">CR-V 2.0 E (MY12) (MNC)</div>
                                                    <div class="car-province" style="color: #FFDADA">กรุงเทพมหานคร</div>
                                                    <div class="row">
                                                        <div class="col-12 col-md-8">
                                                            <div class="descpro-car" style="color: #FFFFFF">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                        </div>
                                                        <div class="col-12 col-md-4 text-end">
                                                            <div class="txt-readmore" style="color: #FFFFFF">ดูเพิ่มเติม</div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="linecontent"></div>
                                                <div class="row caritem-price">
                                                    <div class="col-12 col-md-6">
                                                        <div class="txt-gear" style="color: #fff"><img src="{{ asset('frontend/images2/icon-gear.svg') }}" alt="" class="svg"> เกียร์อัตโนมัติ</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="car-price" style="color: #FFE500">599,000.-</div>
                                                        <div class="car-price-discount" style="color: #fff">
                                                            <span>999,000.-</span> 15%
                                                        </div>
                                                    </div>
                                                </div>
                                            </figcaption>
                                        </figure>
                                    </div>
                                </div>
                            @endforeach


                            <!-- <div class="col-6 col-xl-4 col-itemcar">
                                <div class="deal-nametype">รูปแบบที่ 1</div>
                                <div class="item-car" style="background-color: #BC0000; border: 2px solid #BC0000">
                                    <div class="tag-top-left"><img src="images2/tag-specialprice.svg" alt=""></div>
                                    <div class="logo-bigbrand"><img src="images2/logo-bigbrand.svg" alt=""></div>
                                    <figure>
                                        <div class="cover-car">
                                            <div class="box-timeout">
                                                <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก 3 วัน 18 ชม.</div>
                                                <div class="tag-bottom-right"><img src="images2/tag-44.png" alt=""></div>
                                            </div>
                                            <img src="images/CAR202304060092_Mini_Cooper_20230406_153757523_WATERMARK.png" alt="">
                                        </div>
                                        <figcaption>
                                            <div class="grid-desccar">
                                                <div class="car-name" style="color: #FFFFFF">2016 Honda CR-V </div>
                                                <div class="car-series" style="color: #FFDADA">CR-V 2.0 E (MY12) (MNC)</div>
                                                <div class="car-province" style="color: #FFDADA">กรุงเทพมหานคร</div>
                                                <div class="row">
                                                    <div class="col-12 col-md-8">
                                                        <div class="descpro-car" style="color: #FFFFFF">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 text-end">
                                                        <div class="txt-readmore" style="color: #FFFFFF">ดูเพิ่มเติม</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="linecontent"></div>
                                            <div class="row caritem-price">
                                                <div class="col-12 col-md-6">
                                                    <div class="txt-gear" style="color: #fff"><img src="images2/icon-gear.svg" alt="" class="svg"> เกียร์อัตโนมัติ</div>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <div class="car-price" style="color: #FFE500">599,000.-</div>
                                                    <div class="car-price-discount" style="color: #fff">
                                                        <span>999,000.-</span> 15%
                                                    </div>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div>

                            <div class="col-6 col-xl-4 col-itemcar">
                                <div class="deal-nametype">รูปแบบที่ 7</div>
                                <div class="item-car" style="border: 2px solid #FE9600">
                                    <figure>
                                        <div class="cover-car">
                                            <div class="box-timeout">
                                                <div class="txt-timeout"><i class="bi bi-clock"></i> เหลืออีก 3 วัน 18 ชม.</div>
                                            </div>
                                            <img src="images/CAR202304060092_Mini_Cooper_20230406_153757523_WATERMARK.png" alt="">
                                        </div>
                                        <figcaption>
                                            <div class="grid-desccar">
                                                <div class="car-name" style="color: #F18B14">2016 Honda CR-V </div>
                                                <div class="car-series" style="color: #666">CR-V 2.0 E (MY12) (MNC)</div>
                                                <div class="car-province" style="color: #666">กรุงเทพมหานคร</div>
                                                <div class="row">
                                                    <div class="col-12 col-md-8">
                                                        <div class="descpro-car" style="color: #F18B14">โปรออกรถ 1000 บาท ขับฟรี 15 วัน โปรออกรถ 1000 บาท ขับฟรี 15 วัน</div>
                                                    </div>
                                                    <div class="col-12 col-md-4 text-end">
                                                        <div class="txt-readmore" style="color: #F18B14">ดูเพิ่มเติม</div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="linecontent"></div>
                                            <div class="row caritem-price">
                                                <div class="col-12 col-md-6">
                                                    <div class="txt-gear" style="color: #666"><img src="images2/icon-gear.svg" alt="" class="svg"> เกียร์อัตโนมัติ</div>
                                                </div>
                                                <div class="col-12 col-md-6 text-end">
                                                    <div class="car-price" style="color: #F18B14">599,000.-</div>
                                                </div>
                                            </div>
                                        </figcaption>
                                    </figure>
                                </div>
                            </div> -->





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
    $( ".box-menuprofile > ul > li:nth-child(1) > a" ).addClass( "here" );
    $( ".menu-mycar > ul > li:nth-child(1) > a" ).addClass( "here" );
</script>
<script>

    $(document).ready(function(){
        $(".btn-confirm-edit-carprice").on("click", function () {
            $(this).closest("form").submit();
        });
    });


    document.querySelectorAll('.btn-mycar-delete').forEach(button => {
        button.addEventListener('click', function () {
            var postId = this.getAttribute('data-carsid');

            $('#wait').show();

            Swal.fire({
                title: 'ต้องการจะลบหรือไม่ ?',
                text: 'หากลบแล้ว ข้อมูลจะหายไปทั้งหมด',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {

                $('#wait').hide();

                if (result.isConfirmed) {
                    $('#wait').show();
                    axios.post('{{ route("carpostdeleteactionPage") }}', {
                        id: postId
                    })
                    .then((response) => {
                        $('#wait').hide();
                        Swal.fire({
                            title: 'สำเร็จ !',
                            text: response.data.message,
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch((error) => {
                        $('#wait').hide();
                        Swal.fire(
                            'ล้มเหลว!',
                            'ไม่สามารถทำตามที่ร้องขอได้ !!!',
                            'error'
                        );
                    });
                }
            });
        });
    });


    document.querySelectorAll('.mycar-reserve').forEach(button => {
        button.addEventListener('click', function () {
            var postId = this.getAttribute('data-post-id');
            var currentValue = this.getAttribute('data-current-value');

            // You can customize the Swal.fire() method according to your needs
            Swal.fire({
                title: 'เปลี่ยนสถานะการจอง ?',
                // text: 'You are about to toggle the data for post ' + postId + '!',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Handle the toggle action here using Ajax or any other method
                    // For example, you can use Axios to make an Ajax request
                    axios.post('/update-reserve', {
                        id: postId,
                        currentValue: currentValue,
                        // Other data to be sent for toggle
                    })
                    .then((response) => {
                        // Handle the success response
                        Swal.fire({
                            title: 'สำเร็จ !',
                            // text: 'Your data has been toggled for post ' + postId + '.',
                            icon: 'success'
                        }).then(() => {
                            // Reload the page after clicking "OK"
                            location.reload();
                        });
                        
                        // Update the button's data-current-value attribute after a successful toggle
                        this.setAttribute('data-current-value', response.data.newValue);
                    })
                    .catch((error) => {
                        // Handle the error response
                        Swal.fire(
                            'ล้มเหลว!',
                            'ไม่สามารถทำตามที่ร้องขอได้ !!!',
                            'error'
                        );
                    });
                }
            });
        });
    });


</script>


<script>
    // $(".btn-confirm-edit-carprice").on("click", function () {
    //     $(this).closest("form").submit();
    // });

    $(document).ready(function(){
      // เมื่อมีการเปลี่ยนแปลงใน input type="text"
      $('input[type="text"]').on('input', function() {
        var searchTerm = $(this).val().toLowerCase(); // ดึงข้อความที่ใส่ใน input
        // วนลูปผ่านทุก <div class="list-mycarsearch">
        $('.list-mycarsearch').each(function() {
          var brandName = $(this).find('div:first-child').text().toLowerCase(); // ดึงข้อความใน div แรก
          // ถ้า brandName ไม่ตรงกับ searchTerm ให้ซ่อน div
          if (brandName.indexOf(searchTerm) === -1) {
            $(this).hide();
          } else {
            $(this).show(); // แสดง div ถ้าตรง
          }
        });
      });
    });
</script>

@endsection
