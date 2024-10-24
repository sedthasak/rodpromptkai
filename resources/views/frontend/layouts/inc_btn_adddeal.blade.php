<a data-fancybox data-src="#popup-adddeal" href="javascript:;" class="btn-default btn-red">ซื้อเลย <img src="{{ asset('frontend/images2/iconcart.svg') }}" alt=""></a>
<div style="display: none;" id="popup-adddeal">
    <div class="popup-logout">
        <div class="logo-top"><img src="{{ asset('frontend/images/logo.svg') }}" alt=""></div>
        <h3>ซื้อดีลพิเศษ</h3>
        <p>ท่านสามารถระบุจำนวนรถที่ต้องการซื้อในช่องด้านล่าง</p>
        <form id="deal-form" action="{{ route('cartPage') }}" method="POST">
            @csrf
            <input type="hidden" name="type" value="deal">
            <div class="row popupdeal-amount">
                <div class="col-6 col-sm-4">
                    <div class="popupdeal-txt-amount">จำนวนรถ<span>*</span></div>
                    <div class="popupdeal-txt-note">ราคาคันละ 500 บ.</div>
                </div>
                <div class="col-4 col-sm-6">
                    <div class="popupdeal-input">
                        <input type="text" name="amount" id="deal-amount" required>
                    </div>
                </div>
                <div class="col-2">
                    <div class="txt-amount-car">คัน</div>
                </div>
            </div>
            <div class="popupdeal-totalprice">
                <div class="row">
                    <div class="col-6">ราคารวมทั้งหมด</div>
                    <div class="col-6 text-end">
                        <span id="total-price">0</span> บาท
                    </div>
                </div>
            </div>
            <div class="wrap-btn-thx">
                <a data-fancybox-close class="btn-backhome">ยกเลิก</a>
                <button type="submit" class="btn-viewpack">ซื้อเลย</button>
            </div>
        </form>
    </div>
</div>
