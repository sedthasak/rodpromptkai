@extends('../frontend/layouts/layout')

@section('subhead')
    <title>Package - รถพร้อมขาย</title>
@endsection

@section('content')

<section class="row">
    <div class="col-12 bg-package">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h2 class="title-pricing">Pricing</h2>
                        <div class="tab-menu-pricing">
                            <a href="{{ route('packagecontactPage') }}" class="btn-menu-pricing">ประสิทธิภาพการทำงานมาตรฐาน</a>
                            <div class="btn-menu-pricing active">ประสิทธิภาพสูง</div>
                        </div>
                        <div class="sub-topic-pricing">
                            <h3>ลงขายสำหรับธุรกิจขนาดใหญ่</h3>
                            <p>เลือกแพ็กเกจที่เหมาะสมกับธุรกิจของคุณและสมัครใช้งานได้ทันที</p>
                        </div>
                        <div class="box-package-premium">
                            <div class="owl-package owl-carousel owl-theme">
                                @foreach($vipPackages as $package)
                                    <div class="items">
                                        <div class="wrap-pack-premium {{ strtolower(str_replace(' ', '', $package->name)) }}">
                                            <div class="box-diamond">
                                                <!-- Display package-specific icons or images if available -->
                                                <img src="{{ asset('frontend/images2/diamond-' . strtolower(str_replace(' ', '', $package->name)) . '.svg') }}" alt="{{ $package->name }}">
                                            </div>
                                            <h2>{{ $package->name }}</h2>
                                            @if($package->label_save)
                                                <div class="box-package-sale">
                                                    <div class="box-package-sale-save">{{ $package->label_save }}</div>
                                                    <div class="box-package-sale-pricesave">฿ {{ number_format($package->old_price, 2) }}</div>
                                                </div>
                                            @endif
                                            <div class="box-package-price">
                                                <span>฿ {{ number_format($package->price, 2) }}</span> / ปี
                                            </div>
                                            <div class="box-package-note">ลงรถได้สูงสุด {{ $package->limit }} คัน</div>
                                            
                                            <!-- Update "ซื้อเลย" button to go to the detail page -->
                                            <a href="{{ route('packagepremiumdetailPage', ['id' => $package->id]) }}" class="btn-default">ซื้อเลย</a>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')

@endsection
