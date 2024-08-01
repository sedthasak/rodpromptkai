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
    .swal2-container {
        z-index: 99995 !important; /* Adjust this value if needed */
    }
</style>
@section('content')
@include('frontend.layouts.inc_profile')   
<?php
$usestatus = 'approved';
$usewithdeal  = 'no';

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
                                <h3 class="topic-dealspecial">ใส่โปรโมชั่น</h3>
                            </div>
                            <div class="col-6 text-end">
                                @include('frontend.layouts.inc_btn_adddeal')
                            </div>
                            @if($customer_deal['free'] < 1)
                                <div class="col-12">
                                    <div class="note-notdeal">ท่านไม่สามารถใส่ดีลเพิ่มเติมได้ โควต้ารถของท่านไม่เพียงพอ กรุณาซื้อดีลเพิ่ม</div>
                                </div>
                            @endif

                            
                        </div>

                        <div class="row">
                            @foreach($results as $car)
                            @php
                            $profilecar_img = ($car->feature)?asset('storage/' . $car->feature):asset('public/uploads/default-car.jpg');
                            @endphp
                            <div class="col-12 col-md-6 col-xl-4 adddeal-item">
                                <div class="item-mycar">
                                    <div class="item-mycar-cover">
                                        <figure><img src="{{$profilecar_img}}" alt=""></figure>
                                    </div>
                                    <div class="adddeal-desc">
                                        <div class="mycar-name">
                                            {{ $car->modelyear . ' ' . ($car->brand->title ?? 'N/A') . ' ' . ($car->model->model ?? 'N/A') }}
                                        </div>
                                        <div class="mycar-type">
                                            {{ ($car->generation->generation ?? 'N/A') . ' ' . ($car->subModel->sub_models ?? 'N/A') }}
                                        </div>
                                        <div class="mycar-type">
                                            {{ number_format($car->price, 0, '.', ',') }} บาท
                                        </div>
                                        @if($customer_deal['free'] > 0)
                                        <a data-fancybox data-src="#popup-editprice" href="javascript:;" class="deal-selectcar" data-id="{{ $car->id }}" data-price="{{ $car->price }}">
                                            <i class="bi bi-check-circle-fill"></i> เลือก
                                        </a>
                                        @endif
                                    </div>

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
@include('frontend.layouts.inc_deal_adddeal')

@endsection

@section('script')

<script>
    $(document).ready(function() {
        $('.deal-selectcar').on('click', function() {
            var price = $(this).data('price');
            var id = $(this).data('id');
            $('#current_price').val(price);
            $('#car_id').val(id);
            $('#promotion_price').val('');
        });

        $('#promotion_price').on('input', function() {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = parseFloat($(this).val());

            if (promoPrice > currentPrice) {
                alert('ราคาโปรโมชั่นไม่สามารถสูงกว่าราคาเดิมได้');
                $(this).val(currentPrice);
            }
        });

        $('#editprice_form').on('submit', function(e) {
            var currentPrice = parseFloat($('#current_price').val().replace(/,/g, ''));
            var promoPrice = parseFloat($('#promotion_price').val());
            
            if (isNaN(promoPrice)) {
                e.preventDefault(); // Prevent form submission
                Swal.fire({
                    title: 'ยืนยัน',
                    text: 'คุณแน่ใจว่าจะไม่กรอก "ราคาโปรโมชั่น"?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ยืนยัน',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $('#editprice_form').off('submit').submit(); // Allow form submission
                    }
                });
            } else if (promoPrice > currentPrice) {
                alert('ราคาโปรโมชั่นไม่สามารถสูงกว่าราคาเดิมได้');
                e.preventDefault(); // Prevent form submission
            }
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
                            window.location.href = `{{ route('specialadddealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
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
                                    window.location.href = `{{ route('specialadddealPage') }}?brand_id=${selectedBrandId}&model_id=${selectedModelId}`;
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