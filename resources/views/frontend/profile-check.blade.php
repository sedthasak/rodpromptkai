@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile-check</title>
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
$usestatus = 'created';
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

                        <!-- Loop through the created cars from the paginated results -->
                        @foreach($results as $cars)
                            @php
                            $profilecar_img = ($cars->feature) ? asset('storage/' . $cars->feature) : asset('public/uploads/default-car.jpg');
                            @endphp
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
                                            <div class="col-8 col-md-8">
                                                <div class="mycar-boxprice">
                                                    <div class="mycar-price">{{ number_format($cars->price, 0, '.', ',') }}.-</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

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
    $( ".box-menuprofile > ul > li:nth-child(2) > a" ).addClass( "here" );
    $( ".menu-mycar > ul > li:nth-child(2) > a" ).addClass( "here" );

    $(document).ready(function(){
        $(".btn-confirm-edit-carprice").on("click", function () {
            $(this).closest("form").submit();
        });
    });
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
                            window.location.href = `{{ route('profilecheckPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
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
                                    window.location.href = `{{ route('profilecheckPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
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
@endsection
