@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - สิทธิพิเศษตามระดับ</title>
@endsection

@section('content')

{{-- Section ด้านบนใช้โค้ดที่คุณให้มา --}}
<section class="row">
    <div class="col-12 wrap-seetier wrap-seetier-card">
        <div class="menu-seetiers">
            <div class="container">
                <div class="row">
                    <div class="col-2 col-md-3">
                        <a href="{{url()->previous()}}" class="btn-tiers-back"><img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""><span>ย้อนกลับ</span></a>
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
                                {{-- แสดงระดับสมาชิกทั้งหมด --}}
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

{{-- Section ด้านล่างที่จะแสดงตารางสิทธิพิเศษตามระดับ --}}
<section class="row bg-blue">
    <div class="col-12">
        <div class="list-special-member">
            <div class="row">
                <div class="col-12">
                    {{-- ตารางการแสดงระดับสมาชิก --}}
                    <div class="member-boxpad">
                        <div class="row">
                            {{-- แสดงคอลัมน์หัวข้อสิทธิพิเศษ --}}
                            <div class="col-4"><h3>สิทธิพิเศษ</h3></div>
                            @foreach ($levels as $level)
                                <div class="col-2 card-colpad text-center">
                                    <div class="tab-member tab-member-lv{{ $level->id }}">{{ $level->name }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="member-boxpad bgwhite-member">
                        {{-- Row for displaying accumulated purchase values per level --}}
                        <div class="row">
                            <div class="col-4"><h4>ยอดสั่งซื้อ</h4></div>
                            @foreach ($levels as $level)
                                <div class="col-2 card-colpad text-center">
                                    <div class="txt-point point-lv{{ $level->id }}">
                                        {{ number_format($level->accumulate) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Section title for special privileges --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="bg-topic-special"><span>สิทธิพิเศษ</span></div>
                            </div>
                        </div>

                        {{-- Loop through each privilege and display check marks per level --}}
                        @foreach ($allTexts as $text)
                            <div class="special-list">
                                <div class="row">
                                    {{-- Display privilege name --}}
                                    <div class="col-4">
                                        <h5>{{ $text }}</h5>
                                    </div>
                                    
                                    {{-- Check if each level has this privilege --}}
                                    @foreach ($levels as $level)
                                        @php
                                            // Determine if this privilege exists for the current level
                                            $hasPrivilege = collect(range(1, 12))->contains(function ($i) use ($level, $text) {
                                                return $level->{'text' . $i} === $text;
                                            });
                                        @endphp
                                        <div class="col-2 card-colpad text-center">
                                            <div class="txt-point point-lv{{ $level->id }} {{ $hasPrivilege ? '' : 'not-special' }}">
                                                {{-- Display checkmark if privilege is available, otherwise show empty div --}}
                                                @if ($hasPrivilege)
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="19" height="15" viewBox="0 0 19 15" fill="none" class="svg replaced-svg">
                                                        <path d="M7.25 14.25C6.6875 14.25 6.125 14.025 5.675 13.575L1.175 9.075C0.275 8.175 0.275 6.825 1.175 5.925C2.075 5.025 3.5375 5.025 4.325 5.925L7.25 8.85L14.675 1.425C15.575 0.525 16.925 0.525 17.825 1.425C18.725 2.325 18.725 3.675 17.825 4.575L8.825 13.575C8.375 14.025 7.8125 14.25 7.25 14.25Z"></path>
                                                    </svg>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('script')
<script>
    // JavaScript (ถ้ามีการใช้งานเพิ่มเติม)
</script>
@endsection
