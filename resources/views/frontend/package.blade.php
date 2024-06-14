@extends('../frontend/layouts/layout')

@section('subhead')
    <title>รถพร้อมขาย - profile</title>
@endsection

@section('content')

<?php
// $default_image = asset('frontend/images/CAR202304060018_BMW_X5_20230406_101922704_WATERMARK.png');
// echo "<pre>";
// print_r($pack1);
// echo "</pre>";
?>
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
                    <div class="col-12 col-md-4 item-box-package">
                        <div class="box-package">
                            <h4>{{$pack1->name}}</h4>
                            <div class="box-package-sale">
                                @if($pack1->label_save)
                                <div class="box-package-sale-save">ประหยัด {{$pack1->label_save}}%</div>
                                @endif
                                
                                @if($pack1->old_price)
                                <div class="box-package-sale-pricesave">฿ {{$pack1->old_price}}</div>
                                @endif
                            </div>
                            <div class="box-package-price">
                                <span>฿6,000.00</span> / 4 เดือน
                            </div>
                            @if($pack1->label_bottom)
                            <div class="box-package-note">{{$pack1->label_bottom}}</div>
                            @endif
                            
                            <!-- <a href="#" class="btn-default btn-red">ซื้อเลย</a> -->
                            <form action="{{ route('cartPage') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$pack1->id}}">
                                <input type="hidden" name="type" value="package">
                                <button type="submit" class="btn-default btn-red">ซื้อเลย</button>
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
                                <!-- <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package05.svg" alt="" class="svg"></div> อัพเกรดโพสต์อัตโนมัติ
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 item-box-package package-reccommend">
                        <div class="tag-reccommend"><img src="{{asset('frontend/images2/tag-reccommend.svg')}}" alt=""></div>
                        <div class="box-package">
                            <h4>{{$pack2->name}}</h4>
                            <div class="box-package-sale">
                                @if($pack2->label_save)
                                <div class="box-package-sale-save">ประหยัด {{$pack2->label_save}}%</div>
                                @endif
                                @if($pack2->old_price)
                                <div class="box-package-sale-pricesave">฿ {{$pack2->old_price}}</div>
                                @endif
                            </div>
                            <div class="box-package-price">
                                <span>฿14,250.00</span> / 4 เดือน
                            </div>
                            @if($pack2->label_bottom)
                            <div class="box-package-note">{{$pack2->label_bottom}}</div>
                            @endif
                            <!-- <a href="#" class="btn-default btn-red">ซื้อเลย</a> -->
                            <form action="{{ route('cartPage') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$pack2->id}}">
                                <input type="hidden" name="type" value="package">
                                <button type="submit" class="btn-default btn-red">ซื้อเลย</button>
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
                                <!-- <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package05.svg" class="svg" alt=""></div> อัพเกรดโพสต์อัตโนมัติ
                                </div>
                                <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package06.svg" class="svg" alt=""></div> ฟรี คูปองกระตุ้นการขาย
                                </div> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4 item-box-package">
                        <div class="box-package">
                            <h4>{{$pack3->name}}</h4>
                            <div class="box-package-sale">
                                @if($pack3->label_save)
                                <div class="box-package-sale-save">ประหยัด {{$pack3->label_save}}%</div>
                                @endif
                                @if($pack3->old_price)
                                <div class="box-package-sale-pricesave">฿ {{$pack3->old_price}}</div>
                                @endif
                                
                            </div>
                            <div class="box-package-price">
                                <span>฿28,000.00</span> / 4 เดือน
                            </div>
                            @if($pack3->label_bottom)
                            <div class="box-package-note">{{$pack3->label_bottom}}</div>
                            @endif
                            <!-- <a href="#" class="btn-default btn-red">ซื้อเลย</a> -->
                            <form action="{{ route('cartPage') }}" method="POST">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$pack3->id}}">
                                <input type="hidden" name="type" value="package">
                                <button type="submit" class="btn-default btn-red">ซื้อเลย</button>
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
                                <!-- <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package05.svg" alt="" class="svg"></div> อัพเกรดโพสต์อัตโนมัติ
                                </div>
                                <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package06.svg" alt="" class="svg"></div> ฟรี คูปองกระตุ้นการขาย
                                </div>
                                <div class="box-package-spec-list">
                                    <div><img src="images2/icon-package07.svg" alt="" class="svg"></div> ฟรี เข้าร่วมแคมเปญโปรโมทการขายทุกเดือน
                                </div> -->
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





