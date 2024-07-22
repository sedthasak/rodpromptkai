    <?php 
    $rolearray = array(
        'normal' => 'ลูกค้าทั่วไป',
        'dealer' => 'ดีลเลอร์',
        'vip' => 'วีไอพี',
        'admin' => 'แอดมิน',
    );
    // echo "<pre>";
    // print_r($customer_role);
    // echo "</pre>";
    ?>
    
    <div class="box-menudeal box-menudeal-mb">
        <ul>
            <li class="box-m-code">
                <a href="#"><div><img src="{{asset('frontend/images2/icon-code.svg')}}" alt=""> โค้ดส่วนลด</div> 
                    <!-- <div class="have-code">10+ โค้ด</div> -->
                </a>
            </li>
            <li>
                <a href="{{route('packagePage')}}"><div><img src="{{asset('frontend/images2/icon-menupack.svg')}}" alt="">แพ็คเกจลงขายรถ</div> <span><img src="{{asset('frontend/images/icon-chev-grey.svg')}}" alt=""></span></a>
            </li>
            <li class="hide-pc">
                <a href="#"><div><img src="{{asset('frontend/images2/icon-yourpackage.svg')}}" alt="">แพ็คเกจของคุณ</div></a>
            </li>
            <li>
                <a href="#" class="btn-adddeal btn-adddeal-pc"><div><img src="{{asset('frontend/images2/icon-adddeal-white.svg')}}" alt="">เพิ่มการมองเห็น</div> <span><img src="images/icon-chev-white.svg" alt=""></span></a>
                <a href="#" class="btn-adddeal btn-adddeal-mb"><div><img src="{{asset('frontend/images2/icon-adddeal.svg')}}" alt=""> เพิ่มดีลพิเศษ</div> <span><img src="images/icon-chev-white.svg" alt=""></span></a>
            </li>
        </ul>
    </div>
    <div class="box-menudeal">
        <ul>
            <!-- <li class="hide-mpack">
                <a class="btn-yourpack">แพ็คเกจของคุณ 
                    <span><img src="{{asset('frontend/images/icon-chev-white.svg')}}" alt=""></span>
                </a>
            </li> -->
            <li>
                <a href="#">สถานะปัจจุบัน <span>{{$rolearray[$customer_role['role']]}}</span></a>
            </li>
            <li>
                <a href="#">แพ็คเกจปัจจุบัน <span>{{ $customer_role['pack'] ?: '-' }}</span></a>
            </li>

            <li>
                <a href="#">Slot ลงขาย <span>{{$customer_post}} / {{$customer_role['quota']}} คัน</span></a>
            </li>
            
            <li>
                @if ($customer_role['role'] == 'normal' || $customer_role['role'] == 'admin')
                    <a href="#">สัญญาหมดอายุ <span>ไม่จำกัด</span></a>
                @elseif ($customer_role['role'] == 'dealer' && $customer_role['dealerpack_expire'])
                    @php
                        $dealerpackExpire = new DateTime($customer_role['dealerpack_expire']);
                        $dealerpackExpireFormatted = $dealerpackExpire->format('d/m/Y');
                    @endphp
                    <a href="#">สัญญาหมดอายุ <span>{{ $dealerpackExpireFormatted }}</span></a>
                @elseif ($customer_role['role'] == 'vip' && $customer_role['vippack_expire'])
                    @php
                        $vippackExpire = new DateTime($customer_role['vippack_expire']);
                        $vippackExpireFormatted = $vippackExpire->format('d/m/Y');
                    @endphp
                    <a href="#">สัญญาหมดอายุ <span>{{ $vippackExpireFormatted }}</span></a>
                @else
                    <div>สัญญาหมดอายุ : ไม่จำกัด</div>
                @endif
            </li>

        </ul>
    </div>