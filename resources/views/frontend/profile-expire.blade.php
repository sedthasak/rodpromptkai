@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile-expire</title>
@endsection

@section('content')
@include('frontend.layouts.inc_profile')

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
<?php
$usestatus = 'expired';
$default_image = asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png');
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

                        <!-- Conditional display of the note -->
                        @if($results->count() > 0)
                            <div class="note-expire">ต่ออายุประกาศ</div>
                        @else
                            <div class="note-expire">คุณไม่มีประกาศที่หมดอายุ</div>
                        @endif

                        <!-- Form to submit selected cars -->
                        @if($results->count() > 0)
                            <form id="renew-post-form" method="POST" action="{{ route('carpostrenewactionPage') }}">
                                @csrf

                                <!-- Loop through the expired cars from the paginated results -->
                                @foreach($results as $cars)
                                    @php
                                    $profilecar_img = ($cars->feature) ? asset('storage/' . $cars->feature) : asset('public/uploads/default-car.jpg');
                                    @endphp

                                    <div class="boxcar-expire">
                                        <div class="login-checkbox">
                                            <label class="list-checkbox">
                                                <!-- Checkbox to select cars -->
                                                <input type="checkbox" name="selected_cars[]" value="{{ $cars->id }}" class="car-checkbox">
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                        <div class="item-mycar">
                                            <div class="item-mycar-cover">
                                                <figure>
                                                    <img src="{{ $profilecar_img }}" alt="">
                                                </figure>
                                            </div>
                                            <div class="mycar-detail-mb">
                                                <div class="mycar-name">
                                                    {{ $cars->yearregis ?? $cars->modelyear }} {{ $cars->brand->title ?? 'N/A' }} {{ $cars->model->model ?? 'N/A' }}
                                                </div>
                                                <div class="mycar-type">
                                                    {{ $cars->generation->generations ?? 'N/A' }} {{ $cars->subModel->sub_models ?? 'N/A' }}
                                                </div>
                                                <div class="mycar-idcar">{{ $cars->vehicle_code }}</div>
                                            </div>
                                            <div class="item-mycar-detail">
                                                <div class="row">
                                                    <div class="col-12 col-md-6">
                                                        <div class="mycar-name">
                                                            {{ $cars->yearregis ?? $cars->modelyear }} {{ $cars->brand->title ?? 'N/A' }} {{ $cars->model->model ?? 'N/A' }}
                                                        </div>
                                                        <div class="mycar-type">
                                                            {{ $cars->generation->generations ?? 'N/A' }} {{ $cars->subModel->sub_models ?? 'N/A' }}
                                                        </div>
                                                        <div class="mycar-idcar">{{ $cars->vehicle_code }}</div>
                                                    </div>
                                                    <div class="col-12 col-md-6 text-end">
                                                        <div class="mycar-post">วันที่ลงขาย :  {{ date('d/m/Y', strtotime($cars->created_at)) }}</div>
                                                    </div>
                                                </div>
                                                <div class="mycar-boxline">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="mycar-boxprice">
                                                                <div class="mycar-price">{{ number_format($cars->price, 0, '.', ',') }}.-</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="item-mycar-button">
                                                <a href="{{ route('carpostbrowseedit', ['id' => $cars->id]) }}" class="btn-mycar btn-mycar-edit">
                                                    <i class="bi bi-pencil-square"></i> แก้ไข
                                                </a>
                                                <button type="button" class="btn-mycar btn-mycar-delete button-delete" data-carsid="{{ $cars->id }}">
                                                    <i class="bi bi-trash3-fill"></i> ลบ
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <!-- Select all and renew button section -->
                                <div class="expire-selectall">
                                    <div class="login-checkbox">
                                        <label class="list-checkbox">
                                            <span class="txt-itemcar">เลือกทั้งหมด</span>
                                            <input type="checkbox" id="select-all-checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div>
                                        <span class="txt-itemcar">รวม (<span id="selected-count">0</span> รายการ)</span>
                                        <button type="button" id="renew-selected-button">ต่ออายุ</button>
                                    </div>
                                </div>
                            </form>
                        @endif

                        <!-- Pagination Links -->
                        <div class="pagination-wrapper">
                            {{ $results->onEachSide(1)->links() }}
                        </div>

                        <div class="totop-mb">
                            <a id="button-top">กลับสู่ด้านบน</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('script')
<script>
    $( ".box-menuprofile > ul > li:nth-child(4) > a" ).addClass( "here" );
    $( ".menu-mycar > ul > li:nth-child(4) > a" ).addClass( "here" );

    // Script for select all checkbox
    document.getElementById('select-all-checkbox').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.car-checkbox');
        const selectAll = this.checked;
        checkboxes.forEach(checkbox => checkbox.checked = selectAll);
        updateSelectedCount();
    });

    // Script to update the selected count display
    document.querySelectorAll('.car-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
        });
    });

    function updateSelectedCount() {
        const selectedCount = document.querySelectorAll('.car-checkbox:checked').length;
        document.getElementById('selected-count').textContent = selectedCount;
    }

    document.getElementById('renew-selected-button').addEventListener('click', function() {
        const selectedCount = document.querySelectorAll('.car-checkbox:checked').length;
        if (selectedCount > 0) {
            Swal.fire({
                title: 'ยืนยันการต่ออายุ?',
                text: `คุณต้องการต่ออายุประกาศสำหรับ ${selectedCount} รายการหรือไม่?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ตกลง',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('renew-post-form').submit();
                }
            });
        } else {
            Swal.fire({
                title: 'ไม่สามารถดำเนินการได้',
                text: 'กรุณาเลือกประกาศที่ต้องการต่ออายุ',
                icon: 'warning',
                confirmButtonText: 'ตกลง'
            });
        }
    });

    // Handle delete button click event
    document.querySelectorAll('.btn-mycar-delete').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-carsid');
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
                if (result.isConfirmed) {
                    $('#wait').show();
                    axios.post('{{ route("carpostdeleteactionPage") }}', { id: postId })
                    .then((response) => {
                        $('#wait').hide();
                        Swal.fire('สำเร็จ!', response.data.message, 'success')
                        .then(() => location.reload());
                    })
                    .catch((error) => {
                        $('#wait').hide();
                        Swal.fire('ล้มเหลว!', 'ไม่สามารถทำตามที่ร้องขอได้ !!!', 'error');
                    });
                }
            });
        });
    });
</script>
@endsection
