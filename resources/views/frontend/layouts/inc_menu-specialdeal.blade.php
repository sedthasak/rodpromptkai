<div class="wrap-menu-specialdeal">
    <div class="row">
        <div class="col-12 col-sm-8">
            <div class="menu-specialdeal menu-mycar">
                <ul>
                    <li><a href="{{ route('specialdealPage') }}" data-page="special-deal" class="{{ $page == 'special-deal' ? 'here' : '' }}">เพิ่มรูปแบบ<br>การขาย</a></li>
                    <li><a href="{{ route('specialadddealPage') }}" data-page="special-adddeal" class="{{ $page == 'special-adddeal' ? 'here' : '' }}">ใส่โปรโมชั่น </a></li>
                    <li><a href="{{ route('specialchangedealPage') }}" data-page="special-changedeal" class="{{ $page == 'special-changedeal' ? 'here' : '' }}">เปลี่ยนรูปแบบ<br>โปรโมชั่น </a></li>
                </ul>
            </div>
        </div>
        <div class="col-12 col-sm-4">
            <div class="txt-deal-remaining">จำนวนดีลคงเหลือ <span>{{ $customer_deal['free'] }}</span> ดีล</div>
        </div>
    </div>
</div>
