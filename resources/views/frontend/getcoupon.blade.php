@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - </title>
@endsection

@section('content')
<section class="row">
    <div class="col-12 page-member levelclass-{{$customer_level['slug']}}">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-3">
                    <div class="boxtext-membername">
                        <h2>member</h2>
                        <h3>{{$customer_login->firstname." ".$customer_login->lastname}}</h3>
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
            </div>
        </div>
    </div>
</section>

<section class="row">
    <div class="col-12 page-profile">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wrap-boxcode">
                        <h3>โค้ดส่วนลดของฉัน</h3>
                        <div class="bg-boxcode">
                            <div class="row">
                                @foreach($allcoupon as $coupon)
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>{{$coupon->name}}</h4>
                                                    <p>{{$coupon->description}}</p>
                                                    <div class="coupon-timeout">
                                                        <i class="bi bi-clock"></i> 
                                                        ใช้ได้ก่อน : {{ date('d.m.Y', strtotime($coupon->expirecoupon)) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                @if($coupon->usage=='active')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-code">
                                                        <h5 id="coupon-code-{{$coupon->id}}">{{$coupon->code}}</h5>
                                                        <button title="คัดลอกโค้ด" class="btn-copycode" onclick="copyToClipboard('{{$coupon->id}}')">copy <img src="{{asset('frontend/images2/icon-copy.svg')}}" alt=""></button>
                                                    </div>
                                                </div>
                                                @elseif($coupon->usage=='gone')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-used">ใช้โค้ดนี้แล้ว</div>
                                                </div>
                                                @elseif($coupon->usage=='inactive')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-soldout"><img src="{{asset('frontend/images2/coupon-soldout.svg')}}" alt=""></div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="wrap-boxcode wrap-boxcode-{{$customer_level['slug']}}">
                        <h3>โค้ดพิเศษสำหรับคุณ</h3>
                        <div class="bg-boxcode">
                            <div class="row">
                                @foreach($allcoupon as $coupon)
                                <div class="col-12 col-md-6 col-xl-4 col-boxcode">
                                    <div class="boxcode">
                                        <div class="row">
                                            <div class="col-9 nopad">
                                                <div class="boxcode-detail">
                                                    <h4>{{$coupon->name}}</h4>
                                                    <p>{{$coupon->description}}</p>
                                                    <div class="coupon-timeout">
                                                        <i class="bi bi-clock"></i> 
                                                        ใช้ได้ก่อน : {{ date('d.m.Y', strtotime($coupon->expirecoupon)) }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-3 nopad">
                                                @if($coupon->usage=='active')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-code">
                                                        <h5 id="coupon-code-{{$coupon->id}}">{{$coupon->code}}</h5>
                                                        <button title="คัดลอกโค้ด" class="btn-copycode" onclick="copyToClipboard('{{$coupon->id}}')">copy <img src="{{asset('frontend/images2/icon-copy.svg')}}" alt=""></button>
                                                    </div>
                                                </div>
                                                @elseif($coupon->usage=='gone')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-used">ใช้โค้ดนี้แล้ว</div>
                                                </div>
                                                @elseif($coupon->usage=='inactive')
                                                <div class="boxcode-boxbutton">
                                                    <div class="coupon-soldout"><img src="{{asset('frontend/images2/coupon-soldout.svg')}}" alt=""></div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
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
    function copyToClipboard(couponId) {
        const couponCodeElement = document.getElementById('coupon-code-' + couponId);
        const textArea = document.createElement('textarea');
        textArea.value = couponCodeElement.textContent;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        Swal.fire({
            title: 'Copied!',
            text: 'Coupon code copied: ' + couponCodeElement.textContent,
            icon: 'success',
            confirmButtonText: 'OK'
        });
    }
</script>
@endsection
