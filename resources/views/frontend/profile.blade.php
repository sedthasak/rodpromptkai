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
// print_r($carcontact);
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
                            <div class="topic-profilepage"><i class="bi bi-circle-fill"></i> รถที่ลงขาย</div>
                            <button class="show-menuprofile"><i class="bi bi-search"></i>ค้นหารถในบัญชี</button>
                        </div>
                        
                        @include('frontend.layouts.inc_menu-mycar')

                        @foreach($results as $keycarsModel => $car)
                        @php
                        $profilecar_img = ($car->feature)?asset('storage/' . $car->feature):asset('public/uploads/default-car.jpg');
                        $resve_state = ($car->reserve==1)?'active':'';
                        @endphp
                        <div class="item-mycar">
                            @if ($car->myDeal)
                            <div class="boxdeal-nametype">{{$car->myDeal->deal->name??''}}</div>
                            @endif
                            <div class="item-mycar-cover">
                                <a href="{{route('cardetailPage', ['slug' => $car->slug])}}" target="_blank"><figure><img src="{{$profilecar_img}}" alt=""></figure></a>
                            </div>
                            <div class="mycar-detail-mb">
                                <a href="{{route('cardetailPage', ['slug' => $car->slug])}}">
                                    <div class="mycar-name">{{$car->yearregis??$car->modelyear}} {{$car->brand->title}} {{$car->model->model}}</div>
                                    <div class="mycar-type">{{ ($car->generation->generations ?? 'N/A') . ' ' . ($car->subModel->sub_models ?? 'N/A') }}</div>
                                    <div class="mycar-idcar">{{$car->vehicle_code}}</div>
                                </a>
                            </div>
                            <div class="item-mycar-detail">
                                <div class="row">
                                    <div class="col-12 col-md-6">
                                        <a href="{{route('cardetailPage', ['slug' => $car->slug])}}">
                                            <div class="mycar-name">{{$car->yearregis??$car->modelyear}} {{$car->brand->title}} {{$car->model->model}}</div>
                                            <div class="mycar-type">{{ ($car->generation->generations ?? 'N/A') . ' ' . ($car->subModel->sub_models ?? 'N/A') }}</div>
                                            <div class="mycar-idcar">{{$car->vehicle_code}}</div>
                                        </a>
                                    </div>
                                    <div class="col-12 col-md-6 text-end">
                                        @if(isset($car->approvedate))
                                            <div class="mycar-post">วันที่ลงขาย :  {{date('d/m/Y', $car->approvedate)}}</div>
                                        @endif
                                        @if(isset($car->expiredate))
                                            <div class="mycar-expire">วันที่หมดอายุ :  {{date('d/m/Y', $car->expiredate)}}</div>
                                        @endif
                                    </div>
                                </div>
                                <div class="mycar-boxline">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="mycar-boxprice">
                                                <div class="mycar-price">{{number_format($car->price, 0, '.', ',')}}.-</div>
                                                @if (isset($car->edit_price))
                                                    @if((2 - $car->edit_price) > 0)
                                                    <a data-fancybox data-src="#edit-carprice{{$car->id}}" href="javascript:;" class="mycar-editprice">
                                                        <i class="bi bi-pencil-square"></i> แก้ไขราคา
                                                    </a>
                                                    @endif 
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6 text-end">
                                            
                                            <div class="wrap-btn-carsold">

                                                <button class="mycar-soldout" data-post-id="{{ $car->id }}" data-current-status="{{ $car->status }}">
                                                    <img src="{{asset('frontend/images2/icon-soldout.svg')}}" class="svg" alt="">
                                                    ขายแล้ว
                                                </button>
                                                
                                                <button class="mycar-reserve {{$resve_state}}" data-post-id="{{ $car->id }}" data-current-value="{{ $car->reserve }}" >
                                                    <img src="{{asset('frontend/images/icon-check.svg')}}" class="svg" alt="">
                                                     จองแล้ว
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="item-mycar-button">
                                @if(in_array($car->id, $carcontact))
                                    <a href="{{route('customercontactPage')}}"><div class="mycar-waitcontact blink">รอติดต่อ</div></a>
                                @endif
                                <a href="{{route('carpostbrowseedit', ['id' => $car->id])}}" class="btn-mycar btn-mycar-edit"><i class="bi bi-pencil-square"></i> แก้ไข</a>
                                <button class="btn-mycar btn-mycar-delete button-delete" data-carsid="{{ $car->id }}">
                                    <i class="bi bi-trash3-fill"></i> ลบ
                                </button>

                            </div>
                        </div>

                        <div style="display: none;" id="edit-carprice{{$car->id}}" class="box-edit-carprice">
                            <div class="frm-edit-carprice">
                                <div class="text-center">
                                    <div class="txt-editprices">แก้ไขราคา</div>
                                    <div class="txt-editprices2">ท่านสามารถแก้ไขราคาขายได้ 2 ครั้งเท่านั้น</div>
                                </div>
                                <form method="post" action="{{ route('updatepricePage') }}">
                                @csrf
                                    <input type="hidden" name="id" value="{{$car->id}}" />
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <label>ราคาเดิม</label>
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <div class="txt-editprices3">{{number_format($car->price, 0, '.', ',')}}.-</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-4 col-md-3">
                                            <label>ราคาใหม่</label>
                                        </div>
                                        <div class="col-8 col-md-9">
                                            <input type="number" name="newprice" class="form-control">
                                            <div>จำนวนครั้งที่ท่านสามารถแก้ไขได้  @if(isset($car->edit_price)){{2 - $car->edit_price}}/2 @else 2/2 @endif</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 text-center">
                                            <div class="frm-step-button">
                                                <div class="btn-step btn-nextstep btn-confirm-edit-carprice">ยืนยันการแก้ไข</div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endforeach
                        <hr>
                        <!-- Add pagination links -->
                        <!-- <div class="pagination-wrapper">
                            {{ $results->links('pagination::bootstrap-4') }}
                        </div> -->
                        <div class="pagination-wrapper">
                            {{ $results->onEachSide(1)->links() }}
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
    var selectedBrandId = null;
    var selectedModelId = null;

    function filterBrands() {
        var input = document.getElementById('search-input').value.toLowerCase();
        var brandList = document.getElementById('brand-list');
        var buttons = brandList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var brandTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (brandTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    function filterModels() {
        var input = document.getElementById('model-search-input').value.toLowerCase();
        var modelList = document.getElementById('model-list');
        var buttons = modelList.getElementsByClassName('list-mycarsearch');

        for (var i = 0; i < buttons.length; i++) {
            var modelTitle = buttons[i].getElementsByTagName('div')[0].innerText.toLowerCase();
            if (modelTitle.indexOf(input) > -1) {
                buttons[i].style.display = '';
            } else {
                buttons[i].style.display = 'none';
            }
        }
    }

    document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
        button.addEventListener('click', function() {
            selectedBrandId = this.getAttribute('data-brand-id');
            var modelList = document.getElementById('model-list');
            modelList.innerHTML = '';

            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(btn) {
                btn.classList.remove('active');
            });
            this.classList.add('active');

            var brandData = @json($brandData);
            if (brandData[selectedBrandId]) {
                var models = brandData[selectedBrandId].models;
                for (var modelId in models) {
                    if (models.hasOwnProperty(modelId)) {
                        var model = models[modelId];
                        var modelButton = document.createElement('button');
                        modelButton.className = 'list-mycarsearch';
                        modelButton.setAttribute('data-model-id', modelId);
                        modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                        modelButton.addEventListener('click', function() {
                            selectedModelId = this.getAttribute('data-model-id');
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                btn.classList.remove('active');
                            });
                            this.classList.add('active');
                            window.location.href = `{{ route('profilePage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                        });
                        modelList.appendChild(modelButton);
                    }
                }
            }
        });
    });

    document.getElementById('search-button').addEventListener('click', function() {
        var keyword = document.getElementById('car-id-input').value;
        var url = new URL(window.location.href);

        url.searchParams.delete('brand_id');
        url.searchParams.delete('model_id');
        url.searchParams.set('keyword', keyword);

        window.location.href = url.toString();
    });

    document.getElementById('reset-button').addEventListener('click', function() {
        var url = new URL(window.location.href);
        url.search = '';
        window.location.href = url.toString();
    });

    document.addEventListener('DOMContentLoaded', function() {
        var urlParams = new URLSearchParams(window.location.search);
        var brandId = urlParams.get('brand_id');
        var modelId = urlParams.get('model_id');

        if (brandId) {
            document.querySelectorAll('#brand-list .list-mycarsearch').forEach(function(button) {
                if (button.getAttribute('data-brand-id') === brandId) {
                    button.classList.add('active');
                    selectedBrandId = brandId;

                    var brandData = @json($brandData);
                    if (brandData[selectedBrandId]) {
                        var models = brandData[selectedBrandId].models;
                        var modelList = document.getElementById('model-list');
                        modelList.innerHTML = '';

                        for (var modelId in models) {
                            if (models.hasOwnProperty(modelId)) {
                                var model = models[modelId];
                                var modelButton = document.createElement('button');
                                modelButton.className = 'list-mycarsearch';
                                modelButton.setAttribute('data-model-id', modelId);
                                modelButton.innerHTML = '<div>' + model.modelname + '</div><div class="num-mycarsearch">(' + model.car_count_model + ')</div>';
                                modelButton.addEventListener('click', function() {
                                    selectedModelId = this.getAttribute('data-model-id');
                                    document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(btn) {
                                        btn.classList.remove('active');
                                    });
                                    this.classList.add('active');
                                    window.location.href = `{{ route('profilePage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
                                });
                                modelList.appendChild(modelButton);
                            }
                        }

                        if (modelId) {
                            document.querySelectorAll('#model-list .list-mycarsearch').forEach(function(button) {
                                if (button.getAttribute('data-model-id') === modelId) {
                                    button.classList.add('active');
                                    selectedModelId = modelId;
                                }
                            });
                        }
                    }
                }
            });
        }
    });
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




    document.querySelectorAll('.mycar-soldout').forEach(button => {
        button.addEventListener('click', function () {
            var postId = this.getAttribute('data-post-id');
            var currentStatus = this.getAttribute('data-current-status');

            Swal.fire({
                title: 'เปลี่ยนสถานะเป็นขายแล้ว ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post('{{ route('updatesoldoutAction') }}', {
                        id: postId,
                        currentStatus: currentStatus,
                    })
                    .then((response) => {
                        Swal.fire({
                            title: 'สำเร็จ !',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    })
                    .catch((error) => {
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


    





    // $(document).on('click', '.button-delete', function(e) {
    //     Swal.fire({
    //     title: 'ยืนยันการลบข้อมูล',
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#C60D0D',
    //     cancelButtonColor: '#666',
    //     confirmButtonText: 'ยืนยัน',
    //     cancelButtonText: 'ยกเลิก',
    //     denyButtonText: 'ยกเลิก'
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire({
    //             title: 'ลบข้อมูลสำเร็จ',
    //             icon: 'success',
    //             confirmButtonText: 'ตกลง',
    //             confirmButtonColor: '#C60D0D',
    //         })
    //     }
    //     })
    // });
    
    // $(document).on('click', '.button-delete', function(e) {
    //     Swal.fire({
    //     title: 'ยืนยันการลบข้อมูล',
    //     icon: 'warning',
    //     showCancelButton: true,
    //     confirmButtonColor: '#C60D0D',
    //     cancelButtonColor: '#666',
    //     confirmButtonText: 'ยืนยัน',
    //     cancelButtonText: 'ยกเลิก',
    //     denyButtonText: 'ยกเลิก'
    //     }).then((result) => {
    //     if (result.isConfirmed) {
    //         Swal.fire({
    //             title: 'ลบข้อมูลสำเร็จ',
    //             icon: 'success',
    //             confirmButtonText: 'ตกลง',
    //             confirmButtonColor: '#C60D0D',
    //         })
    //     }
    //     })
    // });
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
