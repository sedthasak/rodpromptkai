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
    .pointer {
        cursor: pointer;
    }

</style>

@section('content')
@include('frontend.layouts.inc_profile')
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
                                <h3 class="topic-dealspecial">เลือกรถ
                                    @if($customer_deal['free'] > 0)
                                    <span id="car_selected">0</span> / {{$customer_deal['free']}}
                                    @endif
                                </h3>
                            </div>
                            <div class="col-6 text-end">
                                @if($customer_deal['free'] > 0)
                                <div class="btn-default btn-red" id="smt_btn" data-quota="{{$customer_deal['free']}}">
                                    ใส่ดีลรถที่เลือก
                                </div>
                                @endif
                            </div>
                            @if($customer_deal['free'] < 1)
                                <div class="col-8">
                                    <div class="note-notdeal">ท่านไม่สามารถใส่ดีลเพิ่มเติมได้ โควต้ารถของท่านไม่เพียงพอ กรุณาซื้อดีลเพิ่ม</div>
                                </div>
                                <div class="col-4 text-end">
                                    <a href="{{route('specialdealPage')}}" class="btn-default btn-red" >
                                        ซื้อดีล
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="row">
                            @foreach($results as $car)
                            @php
                            $profilecar_img = ($car->feature) ? asset('storage/' . $car->feature) : asset('public/uploads/default-car.jpg');
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
                                            {{ ($car->generation->generations ?? 'N/A') . ' ' . ($car->subModel->sub_models ?? 'N/A') }}
                                        </div>
                                        <div class="mycar-type">
                                            {{ number_format($car->price, 0, '.', ',') }} บาท
                                        </div>
                                        @if($customer_deal['free'] > 0)
                                        <div class="deal-selectcar pointer" data-id="{{ $car->id }}">
                                            <i class="bi bi-check-circle-fill"></i> เลือก
                                        </div>
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
@include('frontend.layouts.inc_specialadddeal_search_script')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const smtBtn = document.getElementById('smt_btn');
        if (!smtBtn) return;
        
        const quota = parseInt(smtBtn.getAttribute('data-quota'), 10);
        if (quota <= 0) return;
        
        let selectedCars = [];
        const carElements = document.querySelectorAll('.deal-selectcar.pointer');

        carElements.forEach(car => {
            car.addEventListener('click', function () {
                const carId = this.getAttribute('data-id');

                if (this.classList.contains('selected')) {
                    this.classList.remove('selected');
                    selectedCars = selectedCars.filter(id => id !== carId);
                } else if (selectedCars.length < quota) {
                    this.classList.add('selected');
                    selectedCars.push(carId);
                }

                document.getElementById('car_selected').innerText = selectedCars.length;

                if (selectedCars.length > 0) {
                    smtBtn.classList.add('clickable');
                    smtBtn.addEventListener('click', handleSubmit);
                } else {
                    smtBtn.classList.remove('clickable');
                    smtBtn.removeEventListener('click', handleSubmit);
                }
            });
        });

        function handleSubmit() {
            if (selectedCars.length > 0) {
                Swal.fire({
                    title: 'ยืนยัน',
                    html: `คุณได้เลือกใส่รูปแบบดีลรถ ${selectedCars.length} คัน.<br>ดำเนินการต่อ ?`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ตกลง',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        const form = document.createElement('form');
                        form.method = 'POST';
                        form.action = "{{ route('adddealgroupaction') }}";
                        form.innerHTML = `
                            @csrf
                            <input type="hidden" name="car_ids" value="${selectedCars.join(',')}">
                        `;
                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            }
        }
    });
</script>
@endsection
