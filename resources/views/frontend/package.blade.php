@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - Package</title>
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
                            <div class="btn-menu-pricing active">ประสิทธิภาพการทำงานมาตรฐาน</div>
                            <a href="package-contact.php" class="btn-menu-pricing">ประสิทธิภาพสูง</a>
                        </div>
                        <div class="sub-topic-pricing">
                            <h3>ประสิทธิภาพการทำงานมาตรฐาน</h3>
                            <p>เหมาะสำหรับเริ่มต้นใช้งานกับเว็บไซต์</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Package 1 -->
                <div class="col-12 col-md-4 item-box-package">
                    <div class="box-package">
                        <h4>{{$pack1->name}}</h4>
                        <div class="box-package-sale">
                            @if($pack1->label_save)
                            <div class="box-package-sale-save">ประหยัด {{$pack1->label_save}}%</div>
                            @endif
                            
                            @if($pack1->old_price)
                            <div class="box-package-sale-pricesave">฿ {{ number_format($pack1->old_price, 2) }}</div>
                            @endif
                        </div>

                        <div class="box-package-price">
                            <span>฿{{ number_format($pack1->price, 2) }}</span> / 4 เดือน
                        </div>
                        @if($pack1->label_bottom)
                        <div class="box-package-note">{{$pack1->label_bottom}}</div>
                        @endif
                        
                        <form action="{{ route('cartPage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$pack1->id}}">
                            <input type="hidden" name="type" value="package">
                            <button type="submit" class="btn-default btn-red" 
                                    @if(($customer_role['role'] == 'dealer' && $customer_role['dealerpack'] >= $pack1->id) || $customer_role['role'] == 'vip')
                                    disabled 
                                    style="background-color: #333;olor: #fff;" 
                                    @endif
                                    >ซื้อเลย</button>
                        </form>
                        <div class="box-package-spec">
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> ลงขายได้สูงสุด {{$pack1->limit}} คัน
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package03.svg')}}" alt="" class="svg"></div> เมื่อลงขายแล้ว คันโควต้าสามารถลงใหม่ได้
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package02.svg')}}" alt="" class="svg"></div> มีระยะเวลาใช้งาน 4 เดือนเต็ม (สัญญา)
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package04.svg')}}" alt="" class="svg"></div> อายุที่โพสต์สูงสุด 4 เดือน
                            </div>
                            
                            <!-- New fields text1 to text6 -->
                            @if($pack1->text1)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text1}}
                            </div>
                            @endif
                            @if($pack1->text2)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text2}}
                            </div>
                            @endif
                            @if($pack1->text3)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text3}}
                            </div>
                            @endif
                            @if($pack1->text4)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text4}}
                            </div>
                            @endif
                            @if($pack1->text5)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text5}}
                            </div>
                            @endif
                            @if($pack1->text6)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack1->text6}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Repeat the same for pack2 and pack3, adding the text1 to text6 fields if available -->

                <!-- Package 2 -->
                <div class="col-12 col-md-4 item-box-package package-reccommend">
                    <div class="tag-reccommend"><img src="{{asset('frontend/images2/tag-reccommend.svg')}}" alt=""></div>
                    <div class="box-package">
                        <h4>{{$pack2->name}}</h4>
                        <div class="box-package-sale">
                            @if($pack2->label_save)
                            <div class="box-package-sale-save">ประหยัด {{$pack2->label_save}}%</div>
                            @endif
                            @if($pack2->old_price)
                            <div class="box-package-sale-pricesave">฿ {{ number_format($pack2->old_price, 2) }}</div>
                            @endif
                        </div>
                        <div class="box-package-price">
                            <span>฿{{ number_format($pack2->price, 2) }}</span> / 4 เดือน
                        </div>
                        @if($pack2->label_bottom)
                        <div class="box-package-note">{{$pack2->label_bottom}}</div>
                        @endif

                        <form action="{{ route('cartPage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$pack2->id}}">
                            <input type="hidden" name="type" value="package">
                            <button type="submit" class="btn-default btn-red" 
                                    @if(($customer_role['role'] == 'dealer' && $customer_role['dealerpack'] >= $pack2->id) || $customer_role['role'] == 'vip')
                                    disabled
                                    @endif
                                    >ซื้อเลย</button>
                        </form>
                        <div class="box-package-spec">
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" class="svg" alt=""></div> ลงขายได้สูงสุด {{$pack2->limit}} คัน
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package03.svg')}}" class="svg" alt=""></div> เมื่อลงขายแล้ว คันโควต้าสามารถลงใหม่ได้
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package02.svg')}}" class="svg" alt=""></div> มีระยะเวลาใช้งาน 4 เดือนเต็ม (สัญญา)
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package04.svg')}}" class="svg" alt=""></div> อายุที่โพสต์สูงสุด 4 เดือน
                            </div>

                            <!-- New fields text1 to text6 for pack2 -->
                            @if($pack2->text1)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text1}}
                            </div>
                            @endif
                            @if($pack2->text2)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text2}}
                            </div>
                            @endif
                            @if($pack2->text3)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text3}}
                            </div>
                            @endif
                            @if($pack2->text4)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text4}}
                            </div>
                            @endif
                            @if($pack2->text5)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text5}}
                            </div>
                            @endif
                            @if($pack2->text6)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack2->text6}}
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Package 3 -->
                <div class="col-12 col-md-4 item-box-package">
                    <div class="box-package">
                        <h4>{{$pack3->name}}</h4>
                        <div class="box-package-sale">
                            @if($pack3->label_save)
                            <div class="box-package-sale-save">ประหยัด {{$pack3->label_save}}%</div>
                            @endif
                            @if($pack3->old_price)
                            <div class="box-package-sale-pricesave">฿ {{ number_format($pack3->old_price, 2) }}</div>
                            @endif
                        </div>
                        <div class="box-package-price">
                            <span>฿{{ number_format($pack3->price, 2) }}</span> / 4 เดือน
                        </div>
                        @if($pack3->label_bottom)
                        <div class="box-package-note">{{$pack3->label_bottom}}</div>
                        @endif

                        <form action="{{ route('cartPage') }}" method="POST">
                            @csrf
                            <input type="hidden" name="package_id" value="{{$pack3->id}}">
                            <input type="hidden" name="type" value="package">
                            <button type="submit" class="btn-default btn-red" 
                                    @if(($customer_role['role'] == 'dealer' && $customer_role['dealerpack'] >= $pack3->id) || $customer_role['role'] == 'vip')
                                    disabled
                                    @endif
                                    >ซื้อเลย</button>
                        </form>
                        <div class="box-package-spec">
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> ลงขายได้สูงสุด {{$pack3->limit}} คัน
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package03.svg')}}" alt="" class="svg"></div> เมื่อลงขายแล้ว คันโควต้าสามารถลงใหม่ได้
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package02.svg')}}" alt="" class="svg"></div> มีระยะเวลาใช้งาน 4 เดือนเต็ม (สัญญา)
                            </div>
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package04.svg')}}" alt="" class="svg"></div> อายุที่โพสต์สูงสุด 4 เดือน
                            </div>

                            <!-- New fields text1 to text6 for pack3 -->
                            @if($pack3->text1)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text1}}
                            </div>
                            @endif
                            @if($pack3->text2)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text2}}
                            </div>
                            @endif
                            @if($pack3->text3)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text3}}
                            </div>
                            @endif
                            @if($pack3->text4)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text4}}
                            </div>
                            @endif
                            @if($pack3->text5)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text5}}
                            </div>
                            @endif
                            @if($pack3->text6)
                            <div class="box-package-spec-list">
                                <div><img src="{{asset('frontend/images2/icon-package01.svg')}}" alt="" class="svg"></div> {{$pack3->text6}}
                            </div>
                            @endif
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
    // Add any additional JavaScript needed
</script>
@endsection
