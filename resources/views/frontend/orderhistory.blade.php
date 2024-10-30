@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - </title>
@endsection

@section('content')
<?php
// echo "<pre>";
// print_r($customer_level);
// echo "</pre>";
// echo "<pre>";
// print_r($Levels);
// echo "</pre>";

?>
<section class="row">
    <div class="col-12 page-member levelclass-{{$customer_level['slug']}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="boxtext-membername">
                        <h2>{{$customer_level['slug']}}</h2>
                        <h3>{{$customer_login->firstname}} {{$customer_login->lastname}}</h3>
                    </div>
                </div>
                <div class="col-12 col-md-9">
                    <div class="member-profile-userid">
                        <div class="boxtext-memid">
                            <i class="bi bi-person-circle"></i> บัญชีที่ใช้เข้าสู่ระบบ : เบอร์โทรศัพท์มือถือ <span>{{$customer_login->phone}}</span>
                        </div>
                        <a href="{{route('seealltiersPage')}}" class="btn-seetier">See all tiers <img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-12">
                    <div class="member-boxid">
                        <div class="row">
                            <div class="col-12">
                                <div class="box-memberid">
                                    <div class="title-orderhis">
                                        <img src="{{asset('frontend/images2/icon-coin.svg')}}" alt="">
                                        <span>ยอดสั่งซื้อ</span> 
                                        {{-- <div class="amount-orderhis"><span>฿{{$thiscustomer->accumulate}}</span> /50,000</div> (Member ถัดไป) --}}
                                        @php
                                            $currentAccumulate = $customer_level['accumulate'];
                                            $nextAccumulate = null;

                                            // Loop through the Levels to find the next level based on the current accumulate
                                            foreach($Levels as $level) {
                                                if ($level->accumulate > $currentAccumulate) {
                                                    $nextAccumulate = $level->accumulate;
                                                    break;
                                                }
                                            }
                                        @endphp

                                        <div class="amount-orderhis">
                                            <span>฿{{ number_format($thiscustomer->accumulate) }}</span> /
                                            {{ number_format($nextAccumulate ?? 0) }} (Member ถัดไป)
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-orderhistory">
                        <h3>รายการสั่งซื้อ</h3>
                        <div class="box-orderhistory">
                            @foreach ($customerOrders as $order)
                                <div class="row box-orderhistory-list">
                                    <div class="col-12 col-md-9">
                                        <h5>
                                            <i class="bi bi-circle-fill"></i> 
                                            @if ($order->type === 'deal')
                                                แพ็คเพิ่มการมองเห็น จำนวน {{ $order->amount }} ดีล
                                            @elseif ($order->type === 'package')
                                                รายการสั่งซื้อแพคเกจดีลเลอร์ {{ $order->package_name }}
                                            @elseif ($order->type === 'vip')
                                                รายการสั่งซื้อแพคเกจวีไอพี {{ $order->package_name }}
                                            @endif
                                        </h5>
                                        <div class="box-orderhistory-list-date">
                                            {{ $order->created_at->format('d/m/Y') }} <span>|</span> {{ $order->created_at->format('H:i') }}
                                        </div>
                                        <div class="box-orderhistory-list-date">
                                            สถานะ <span>|</span> {{ $order->status }}
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-3 text-end">
                                        <div class="box-orderhistory-list-price">฿ {{ number_format($order->total) }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <br>
                            <!-- Pagination Links -->
                            <div class="pagination-wrapper">
                                {{ $customerOrders->onEachSide(1)->links() }}
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
