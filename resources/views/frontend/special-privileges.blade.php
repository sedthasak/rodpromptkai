@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

@section('content')

<section class="row">
    <div class="col-12 wrap-seetier wrap-seetier-card">
        <div class="menu-seetiers">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-3">
                        <a href="#" class="btn-tiers-back"><img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""><span>ย้อนกลับ</span></a>
                    </div>
                    <div class="col-10 col-md-9">
                        <div class="wrap-btntiers">
                            <a class="btn-tiers-back active"><img src="{{asset('frontend/images2/icon-wink.svg')}}" class="svg" alt=""><span>สิทธิพิเศษ</span></a>
                            <a href="{{route('seealltiersPage')}}" class="btn-tiers-back"><img src="{{asset('frontend/images2/icon-tiers.svg')}}" class="svg" alt=""><span>การปรับระดับ</span></a>
                        </div>
                    </div>
                </div>
            </div>    
        </div>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-desc-seetiers">
                        <h3>สิทธิพิเศษ</h3>
                        <div class="seetiers-topic-gold">ตามระดับสมาชิกของคุณ</div>
                        <div class="box-detail-tiers box-detail-tiers-card">
                            <div class="row row-cardmember">
                                @foreach ($levels as $index => $level)
                                    @php
                                        $activeClass = $customer_level['slug'] == $level->slug ? 'member-active' : ($index < array_search($customer_level['slug'], array_column($levels->toArray(), 'slug')) ? 'member-past' : '');
                                    @endphp
                                    <div class="col-3 col-card-member {{ $activeClass }}">
                                        <div class="photo-membercard"><img src="{{ asset('frontend/images2/card-level' . $level->id . '.svg') }}" alt=""></div>
                                        <div class="txt-cardlevel">{{ $level->name }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="topic-special-level">
                        <h3 class="topic-seetier2"><img src="{{asset('frontend/images2/icon-wink.svg')}}" class="svg" alt=""> สิทธิพิเศษตามระดับ</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="row bg-blue">
    <div class="col-12">
        <div class="list-special-member">
            <div class="row">
                <div class="col-12">
                    <div class="member-boxpad">
                        <div class="row">
                            <div class="col-4"><h3>ระดับสมาชิก</h3></div>
                            @foreach ($levels as $level)
                                <div class="col-2 card-colpad text-center">
                                    <div class="tab-member tab-member-lv{{ $level->id }}">{{ $level->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="member-boxpad bgwhite-member">
                        <div class="row">
                            <div class="col-4"><h4>ยอดสั่งซื้อ</h4></div>
                            @foreach ($levels as $index => $level)
                                <div class="col-2 card-colpad text-center">
                                    <div class="txt-point point-lv{{ $level->id }}">
                                        @if ($index == 0)
                                            0 - {{ $levels[$index + 1]->accumulate - 1 }}
                                        @elseif ($index == count($levels) - 1)
                                            {{ $level->accumulate }}+
                                        @else
                                            {{ $level->accumulate }} - {{ $levels[$index + 1]->accumulate - 1 }}
                                        @endif
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-topic-special"><span>สิทธิพิเศษ</span></div> 
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>โค้ดส่วนลด</h5></div>
                                @foreach ($levels as $level)
                                    <div class="col-2 card-colpad text-center">
                                        <div class="txt-point point-lv{{ $level->id }}">
                                            @if ($level->coupon)
                                                <img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt="">
                                            @else
                                                <img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg not-special" alt="">
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="special-list">
                            <div class="row">
                                <div class="col-4"><h5>Movie & Popcorn</h5></div>
                                @foreach ($levels as $level)
                                    <div class="col-2 card-colpad text-center">
                                        <div class="txt-point point-lv{{ $level->id }} {{ $level->id < 2 ? 'not-special' : '' }}">
                                            <img src="{{asset('frontend/images2/icon-checklist.svg')}}" class="svg" alt="">
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
<script>

</script>
@endsection
