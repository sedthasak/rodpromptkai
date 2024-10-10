@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - orderpay</title>
@endsection

@section('content')


<section class="row">
    <div class="col-12 wrap-postcar">
        <div class="container">
            <div class="row wow fadeInDown">
                <div class="col-12 wrap-postwelcome">
                    <div class="topic-postcar-welcome topic-postcar">
                        <div class="topic-imgcar"><img src="{{asset('frontend/images/Isolation_Mode.svg')}}" alt=""></div>
                        <p>ชำระเงิน</p>
                        <h1>Order : {{$myorder->order_number}}</h1>
                        <h1>ยอดชำระ : {{ number_format($myorder->total, 0, '.', ',') }} ฿</h1>
                        <form method="post" action="{{route('orderpayaction')}}" >
                        @csrf
                            <input type="hidden" name="order_id" value="{{$myorder->id}}" />
                            <button class="btn-postcar"><img src="{{asset('frontend/images/icon-car.svg')}}" alt=""> คลิกเพื่อจำลองการชำระสำเร็จ</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('script')

@endsection


