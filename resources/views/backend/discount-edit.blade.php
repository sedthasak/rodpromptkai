@extends('../backend/layout/side-menu')

@section('subhead')
    <title>Backend - {{ $default_pagename }}</title>
@endsection

@section('subcontent')
    <div class="intro-y mt-8 flex flex-col items-center sm:flex-row">
        <h2 class="mr-auto text-lg font-medium">{{ $default_pagename }}</h2>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ route('BN_discounts_edit_action') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="id" value="{{ $coupon->id }}">
        <div class="grid grid-cols-12 gap-6 mt-5">
            <div class="intro-y col-span-12 lg:col-span-12">
                <div class="intro-y box p-5">
                    <div class="grid grid-cols-12 gap-x-5">
                        <div class="col-span-12 xl:col-span-6">
                            <label for="name" class="form-label">ชื่อคูปอง</label>
                            <input type="text" class="form-control w-full" name="name" value="{{ old('name', $coupon->name) }}" autocomplete="off"/>
                        </div>
                        <div class="col-span-12 xl:col-span-6">
                            <label for="code" class="form-label">รหัสคูปอง</label>
                            <input type="text" class="form-control w-full" name="code" value="{{ old('code', $coupon->code) }}" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-x-5 mt-3">
                        <div class="col-span-12 xl:col-span-4">
                            <label for="rate" class="form-label">เปอร์เซ็นต์ส่วนลด</label>
                            <input type="text" class="form-control w-full" name="rate" value="{{ old('rate', $coupon->rate) }}" autocomplete="off"/>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <label for="limit_rate" class="form-label">ส่วนลดสูงสุด</label>
                            <input type="text" class="form-control w-full" name="limit_rate" value="{{ old('limit_rate', $coupon->limit_rate) }}" autocomplete="off"/>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <label for="limit" class="form-label">จำกัดจำนวนการใช้</label>
                            <input type="text" class="form-control w-full" name="limit" value="{{ old('limit', $coupon->limit) }}" autocomplete="off"/>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-x-5 mt-3">
                        <div class="col-span-12 xl:col-span-4">
                            <label for="have_expire" class="form-label">หมดอายุ</label>
                            <select name="have_expire" id="have_expire" class="form-control w-full" onchange="toggleExpireSection()">
                                <option value="0" {{ old('have_expire', $coupon->expirecoupon ? '1' : '0') == '0' ? 'selected' : '' }}>ไม่หมดอายุ</option>
                                <option value="1" {{ old('have_expire', $coupon->expirecoupon ? '1' : '0') == '1' ? 'selected' : '' }}>จำกัดวันหมดอายุ</option>
                            </select>
                        </div>
                        <div class="col-span-12 xl:col-span-4" id="expireSection" style="{{ old('have_expire', $coupon->expirecoupon ? '1' : '0') == '1' ? '' : 'display:none;' }}">
                            <label for="expire" class="form-label">วันหมดอายุ</label>
                            <input type="date" class="form-control w-full" name="expire" value="{{ old('expire', $coupon->expirecoupon) }}" autocomplete="off"/>
                        </div>
                        <div class="col-span-12 xl:col-span-4">
                            <label for="level_member" class="form-label">ผูกกับเลเวลเมมเบอร์</label>
                            <select name="level_member" id="level_member" class="form-control w-full">
                                <option value="">ไม่ผูก</option>
                                @foreach($Levels as $Level)
                                    <option value="{{ $Level->id }}" {{ old('level_member', $coupon->level_member) == $Level->id ? 'selected' : '' }}>{{ $Level->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-x-5 mt-3">
                        <div class="col-span-12 xl:col-span-4">
                            <label for="status" class="form-label">สถานะ</label>
                            <select name="status" id="status" class="form-control w-full">
                                <option value="active" {{ old('status', $coupon->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $coupon->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-12 gap-x-5 mt-3">
                        <div class="col-span-12">
                            <label for="description" class="form-label">รายละเอียด</label>
                            <textarea class="form-control w-full" name="description">{{ old('description', $coupon->description) }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="text-right mt-5">
                    <button type="submit" class="btn btn-primary w-24">บันทึก</button>
                </div>
            </div>
        </div>
    </form>
@endsection

@section('script')
<script>
    function toggleExpireSection() {
        var haveExpire = document.getElementById('have_expire').value;
        var expireSection = document.getElementById('expireSection');

        if (haveExpire == '0') {
            expireSection.style.display = 'none';
        } else {
            expireSection.style.display = 'block';
        }
    }

    window.onload = toggleExpireSection;
</script>
@endsection
