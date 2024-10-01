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
                        {{-- แสดงสิทธิพิเศษตามหัวข้อที่จัดเรียงไว้ --}}
                        @foreach ($allTexts as $text)
                            <div class="special-list">
                                <div class="row">
                                    {{-- คอลัมน์ชื่อสิทธิพิเศษ --}}
                                    <div class="col-4"><h5>{{ $text }}</h5></div>
                                    {{-- วนลูปแสดงระดับสมาชิก --}}
                                    @foreach ($levels as $level)
                                        <div class="col-2 card-colpad text-center">
                                            <div class="txt-point point-lv{{ $level->id }}">
                                                @php
                                                    // ตรวจสอบว่า Level นี้มีสิทธิพิเศษนั้นหรือไม่
                                                    $hasPrivilege = false;
                                                    for ($i = 1; $i <= 12; $i++) {
                                                        if ($level->{'text' . $i} === $text) {
                                                            $hasPrivilege = true;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                {{-- แสดงผลเครื่องหมายเช็คหรือไม่เช็คตามเงื่อนไข --}}
                                                @if ($hasPrivilege)
                                                    <img src="{{ asset('frontend/images2/icon-checklist.svg') }}" class="svg" alt="">
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
