<div style="display: none;" id="popup-editprice">
    <div class="popup-logout">
        <h3>แก้ไขราคา</h3>
        <p>ท่านสามารถแก้ไขราคาที่ต้องการในช่องด้านล่าง</p>
        <form id="editprice_form" method="POST" action="{{ route('adddealaction') }}">
            @csrf
            <input type="hidden" id="car_id" name="car_id" value="">
            <div class="row popupdeal-amount">
                <div class="col-4 col-sm-4">
                    <div class="txt-amount-car">ราคาเดิม</div>
                </div>
                <div class="col-6 col-sm-6">
                    <div class="popupdeal-input"><input type="number" id="current_price" name="current_price" value="" readonly></div>
                </div>
                <div class="col-2">
                    <div class="txt-amount-car">บาท</div>
                </div>
            </div>
           
            <div class="popupdeal-totalprice">
                <div class="row">
                    <div class="col-4 col-sm-4">
                        <div class="txt-amount-car">ราคาโปรโมชั่น</div>
                    </div>
                    <div class="col-6 col-sm-6">
                        <div class="popupdeal-input"><input type="number" id="promotion_price" name="promotion_price" value="" required></div>
                    </div>
                    <div class="col-2">
                        <div class="txt-amount-car">บาท</div>
                    </div>
                </div>
            </div>
            <div class="wrap-btn-thx">
                <a data-fancybox-close class="btn-backhome">ยกเลิก</a>
                <button type="submit" class="btn-viewpack">ยืนยัน</button>
            </div>
        </form>
    </div>
</div>